window.onload = function () {
    setListeners();
    console.log("Window loaded");
    var id = getParameterByName('id');
    console.log(id);
    getQuiz(id);
    console.log(quizResults);
};

var quiz;
var questionNum;
var quizResults = {
    'id' : "generated by db",
    'userid' : "",
    'quizid' : "",
    'starttime' : new Date(),
    'endtime' : "generated by db",
    'answers' : "",
    'scores' : "",
    'total' : ""
};
var answers;

/*
 * Get a parameter from the window's url
 * 
 * Credit to: https://stackoverflow.com/questions/901115/how-can-i-get-query-string-values-in-javascript
 */
function getParameterByName(name, url) {
    if (!url)
        url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
    if (!results)
        return null;
    if (!results[2])
        return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function setListeners(){
    document.querySelector('#btnNext').addEventListener('click', nextHandler);
    document.querySelector('#btnBack').addEventListener('click', backHandler);
    document.querySelector('#btnSubmit').addEventListener('click', submitHandler);
}

function nextHandler(){ 
    saveResponse();
    if (questionNum < quiz.questions.length - 1){
        
        questionNum++;
        displayQuestion();
    }
    
}

function backHandler() { 
    saveResponse();
    if (questionNum > 0){ 
        questionNum--;
        displayQuestion();
    }
}

function saveResponse(){ 
    var choice = document.querySelector('input:checked');
    if (choice === null){
        choice = -1;
    } else {
        choice = choice.value;
    }
    console.log(choice);
    console.log("question: " + questionNum);
    answers[questionNum] = choice;
    console.log(answers);
}

function submitHandler() { 
    saveResponse();
    buildResults();
    sendResults();
    
}

function sendResults(){
    var method = "POST";
    var url = "quizmaster/results";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            if (resp === "true"){
                console.log("success");
                window.location.href = "index.php";
            } else {
                alert("Something went wrong!");
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send(JSON.stringify(quizResults));
}

function buildResults(){
    quizResults.answers = answers;
    var user = JSON.parse(window.localStorage.getItem("userLoggedIn"));
    quizResults.userid = user.id;
    quizResults.quizid = quiz.id;
    var responses = "";
    for (var i = 0; i < quiz.questions.length; i++){
        responses += answers[i];
        if (i !== quiz.questions.length - 1){
            responses += ",";
        }
    }
    var score = 0;
    var scores = "";
    var maxScore = 0;
    for (var i = 0; i < quizResults.answers.length; i++){
        var scoreForQuestion = getAnswerValue(i);
        score += scoreForQuestion;
        scores += String(scoreForQuestion);
        maxScore += Number(quiz.questions[i].value);
        if (i !== quizResults.answers.length - 1){
            scores += ",";
        }
    }
    quizResults.total = score / maxScore;
    quizResults.scores = scores;
    quizResults.answers = responses;
    console.log(quizResults);
}

function getAnswerValue(questionNumber){
    var question = quiz.questions[questionNumber];
    var choiceArray = question.choices.split(",");
    var answer = choiceArray[Number(answers[questionNumber])];
    var value = 0;
    if (answer === question.answer){
        value = Number(question.value);
    }
    return value;
}

function getQuiz(id) {

    var method = "GET";
    var url = "quizmaster/quiz/" + id;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            console.log(JSON.parse(resp));
            quiz = JSON.parse(resp);
            answers = initializeAnswers(); 
            questionNum = 0;
            displayQuestion();

        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();

}

function initializeAnswers() {
    var arr = [];
    for (var i = 0; i < quiz.questions.length; i++){
        arr[i] = -1;
    }
    return arr;
}

function displayQuestion(){
    showTitle(); 
    showQuestion();
    showChoices();
}

function showTitle(){
    document.querySelector('#quizName h1').textContent = quiz.title;
}

function showQuestion(){
    document.querySelector('#quizQuestionHolder h2').textContent = quiz.questions[questionNum].questionText;
}

function showChoices() {
    var choices = document.querySelector('#quizChoiceHolder');
    choices.innerHTML = "";
    var arrChoice = quiz.questions[questionNum].choices.split(",");
    for (var i = 0; i < arrChoice.length; i++){
        var choice = document.createElement("input");
        choice.setAttribute("type", "radio");
        choice.setAttribute("value", i);
        choice.setAttribute("name", "choice"); 
        if (Number(answers[questionNum]) === i){ 
            choice.setAttribute("checked", true);
        }
        choices.appendChild(choice);
        choice.outerHTML += arrChoice[i] + "<br>";
    }
}

