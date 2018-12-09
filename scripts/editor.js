/* 
 * Quiz Master Website
 * Created by: Anna Fields, Peter Adam, Zach MacKay
 * Date: 2018-12-01
 */

//globals used to determine which divs to hide / show
var editMode = "quiz";
var startedQuizEdit = 0;
var startedQuestionEdit = 0;
var searchQuizResultsArr = [];
var searchQuestionResultsArr = [];

window.onload = function () {
    document.querySelector("#leftRadio").addEventListener("click", hideQuestion);
    document.querySelector("#rightRadio").addEventListener("click", hideQuiz);
    document.querySelector("#btnCreateNew").addEventListener("click", createNew);
    document.querySelector("#btnEditExisting").addEventListener("click", editExisting);
    document.querySelector("#startOver").addEventListener("click", startOver);

    document.querySelector("#highlightListQuestion").addEventListener("click", handleRowClick);
    document.querySelector("#highlightListQuiz").addEventListener("click", handleRowClick);
    document.querySelector("#highlightListChoice").addEventListener("click", handleRowClick);
    document.querySelector("#highlightListAddToQuiz").addEventListener("click", handleRowClick);
    document.querySelector("#highlightListInQuiz").addEventListener("click", handleRowClick);

    //for create quiz
    document.querySelector("#btnSend").addEventListener("click", sendQuestion);
    document.querySelector("#btnRemove").addEventListener("click", removeQuestion);

    //for create question
    document.querySelector("#btnRemoveChoice").addEventListener("click", removeChoice);
    document.querySelector("#btnDeleteQuestion").addEventListener("click", deleteQuestion);
    document.querySelector("#btnSaveQuestion").addEventListener("click", saveQuestion);
    document.querySelector("#btnAddChoice").addEventListener("click", addChoice);

    document.querySelector("#searchExistingQuiz").addEventListener("click", searchExistingQuiz);

    document.querySelector("#btnLoadQuizInfo").addEventListener("click", loadQuizInfo);
    document.querySelector("#btnEditSelectedQuiz").addEventListener("click", editSelectedQuiz);

    document.querySelector("#editExistingSearch").addEventListener("click", searchExistingQuestion);
    document.querySelector("#btnLoadQuestionInfo").addEventListener("click", loadQuestionToEdit);
    document.querySelector("#btnEditSelectedQuestion").addEventListener("click", editSelectedQuestion);
     document.querySelector("#deleteQuiz").addEventListener("click", deleteQuiz);
    //deleteQuiz
    //editExistingSearch
    //first load, this will clear the proper divs, show buttons, and set default to quiz
    loadAreas();

    if (localStorage.getItem("userLoggedIn") !== null) {

        document.querySelector("#loginOpt").innerHTML = "Log Out";
        document.querySelector("#profile").classList.remove("hidden");
        var user = localStorage.getItem('userLoggedIn');
        console.log(user);
        var userObj = JSON.parse(user);
        username = userObj.username;
        var html = "Hey " + username + ", check our these quizzes!";
//        document.querySelector("#greeting").innerHTML = html;
        var userPermission = userObj.permissionId;
        console.log(userPermission);

        if (userPermission === 1 || userPermission === 2) {
            document.querySelector("#editor").classList.remove("hidden");
        }
    }
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);
}

var choiceArray = [];
var cameFromEdit = false;

function deleteQuiz(){
    alert("DeleteBT");
    
    var id = document.querySelector("#searchExistingQuizInput").value;

    var url = "quizmaster/quiz/" + id; // entity, not action
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            if (resp == "true") {
                console.log("worked");

            } else {

            }

        }
    };
    xmlhttp.open("DELETE", url, true); // "DELETE" is the action, "url" is the entity
    xmlhttp.send();
}

function editSelectedQuestion() {
    cameFromEdit = true;
    //hide stuff and unhide stuff
    var selected = document.querySelector("#questionEditorAll");
    
    //this handles which divs to hide / display
    editMode == "question";
    createNew();
    
    //below is old di handler, left for now commented out in case something breaks
//    selected.classList.remove("hidden");
//    selected = document.querySelector("#questionCreate");
//    selected.classList.remove("hidden");
//    document.querySelector("#searchPanel").classList.add("hidden");
//    document.querySelector("#infoPanel").classList.add("hidden");
    //fill in the input fields
    document.querySelector("#questionText").value = questionBeingEdited.questionText;

    document.querySelector("#questionTag").value = questionBeingEdited.tags;
    document.querySelector("#addquestionDescription").value = questionBeingEdited.description;
    var choicesToSplit = questionBeingEdited.choices;
    var pieces = choicesToSplit.split(",");

    for (var i = 0; i < pieces.length; i++) {

        var option = document.createElement('option');
        option.innerHTML = pieces[i];
        document.getElementById('qA').appendChild(option);

        var el = document.createElement('li');
        el.innerHTML = pieces[i];
        choiceArray.push(el.innerHTML);
        document.getElementById('highlightListChoice').appendChild(el);

    }

    console.log(questionBeingEdited.questionText);
    console.log(questionBeingEdited.description);
    console.log(questionBeingEdited.choices);
    console.log(questionBeingEdited.answer);
    console.log(questionBeingEdited.tags);


}

var questionBeingEdited = "";
function loadQuestionToEdit() {

    var arrIndex = document.querySelector(".highlighted").innerHTML;


    for (var i = 0; i < searchQuestionResultsArr.length; i++) {
        if (searchQuestionResultsArr[i].questionText == arrIndex) {
            document.querySelector("#questionName").value = searchQuestionResultsArr[i].questionText;
            document.querySelector("#questionName").disabled=true;
            document.querySelector("#questionID").value = searchQuestionResultsArr[i].id;
            document.querySelector("#questionID").disabled=true;
            document.querySelector("#questionTags").value = searchQuestionResultsArr[i].tags;
            document.querySelector("#questionTags").disabled=true;
            document.querySelector("#questionDescription").value = searchQuestionResultsArr[i].description;
            document.querySelector("#questionDescription").disabled=true;
            questionBeingEdited = searchQuestionResultsArr[i];
            document.querySelector("#btnEditSelectedQuestion").disabled=false;

        }

    }
}
function searchExistingQuestion() {

    var selectedSearch = document.querySelector("#searchbyQuestionFilter").value;
    var searchValue = document.getElementById("searchTermQuestionInput").value;
    console.log(searchValue);
    if (selectedSearch == "id") {
        var url = "quizmaster/question/" + searchValue;
        getOneQuestion(url);

    }
    if (selectedSearch == "tags") {
        var url = "quizmaster/question/ByTag/" + searchValue;
        getMatchingQuestions(url);
    }
    if (selectedSearch == "words") {
        var url = "quizmaster/question/ByName/" + searchValue;
        getMatchingQuestions(url);
    }
}

function getMatchingQuestions(url) {

    var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== null) {
                console.log(resp);
                showMatchingQuestions(resp);
            } else {
                alert("Sorry, please check user name and password")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();

}
function showMatchingQuestions(resp) {

    searchQuestionResultsArr = [];
    var data = JSON.parse(resp);
    console.log(data);
    var html = "";
    for (var i = 0; i < data.length; i++) {

        var questionText = data[i].questionText;
        var questionId = data[i].id;
        var questionTags = data[i].tags;
        var description = data[i].description;
        var choices = data[i].choices;
        var answer = data[i].answer;
        console.log(choices);

        html += "<li id=\"selectQuestionSearchResult\">" + questionText + "</li>";

        searchQuestionResultsArr.push(data[i]);

    }
    document.querySelector("#highlightListQuestion").innerHTML = html;
    console.log(data[0]);

}


function getOneQuestion(url) {

    var method = "GET";
    console.log("entered method");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== "null") {
                console.log(resp);
                showOneQuestion(resp);
            } else {
                alert("Something went wrong")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}

function showOneQuestion(resp) {

    var data = JSON.parse(resp);
    var questionName = data.questionText;
    var html = "<li value=\"0\">" + questionName + "</li>";
    document.querySelector("#highlightListQuestion").innerHTML = html;
    searchQuestionResultsArr.push(data);

}

function addChoice() {
    //this adds what the user enters for choices into the unordered list, and in
    //the dropdown
    var addChoice = document.querySelector("#choiceToAdd").value;
    var el = document.createElement('li');
    el.innerHTML = addChoice;
    document.getElementById('highlightListChoice').appendChild(el);
    //qA
    var ul = document.getElementById("highlightListChoice");

    var option = document.createElement('option');
    option.innerHTML = addChoice;
    document.getElementById('qA').appendChild(option);
    choiceArray.push(el.innerHTML);
    document.querySelector("#choiceToAdd").value = "";
}

function saveQuestion() {
    document.querySelector("#questionError").innerHTML = "";
    document.querySelector("#tagError").innerHTML = "";
    document.querySelector("#descError").innerHTML = "";
    document.querySelector("#choiceError").innerHTML = "";
    var id;
    if (cameFromEdit == true) {
        id = questionBeingEdited.id;
    } else {
        id = "99999";
    }
    //Is called when used clicks on Question Editor, and then create new, and then clicks save
    //get the data from the editor page and checks to see if it is valid, and then build a question
    if (formIsValid()) {//check if everything is valid, then creates a question object and then make ajax call

        var questionObj = {
            "id": id,
            "questionText": document.querySelector("#questionText").value,
            "description": document.querySelector("#addquestionDescription").value,
            "choices": choiceArray.toString(),
            "answer": document.querySelector("#qA").value,
            "tags": document.querySelector("#questionTag").value


        };
//make an ajax call to add the question
        var url = "quizmaster/question";
        var method;
        if (cameFromEdit == true) {
            method = "PUT";
        } else {
            method = "POST";
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                
                clearQuestionFields();
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send(JSON.stringify(questionObj));
    }
    window.location = "editor.php";
}

function formIsValid() {
    document.querySelector("#questionError").innerHTML = "";
    document.querySelector("#tagError").innerHTML = "";
    document.querySelector("#descError").innerHTML = "";
    document.querySelector("#choiceError").innerHTML = "";

    var counter = 0;
    if (document.querySelector("#questionText").value == "") {
        document.querySelector("#questionError").innerHTML = "Please enter a user name";
        counter++;
    }
    if (document.querySelector("#questionTag").value == "") {
        document.querySelector("#tagError").innerHTML = "Please enter a tag";
        counter++;
    }
    if (document.querySelector("#addquestionDescription").value == "") {
        document.querySelector("#descError").innerHTML = "Please enter a description";
        counter++;
    }
    var ul = document.getElementById("highlightListChoice");
    var liNodes = [];

    for (var i = 0; i < ul.childNodes.length; i++) {
        if (ul.childNodes[i].nodeName == "LI") {
            liNodes.push(ul.childNodes[i]);
        }
    }

    if (liNodes.length < 2) {
        document.querySelector("#choiceError").innerHTML = "You must enter atleast two choices";
        counter++;
    }

    if (counter > 0) {
        return false;
    } else {
        return true;
    }
}

function clearQuestionFields() {
   document.querySelector("#searchbyQuestionFilter").value = "";
   document.querySelector("#searchTermQuestionInput").value = "";
   document.querySelector("#highlightListQuestion").value = "";
   document.querySelector("#questionID").value = "";
   document.querySelector("#questionName").value = "";
   document.querySelector("#questionDescription").value = "";
   document.querySelector("#questionTags").value = "";
 

    document.querySelector("#questionText").value = "";
    document.querySelector("#questionTag").value = "";
    document.querySelector("#addquestionDescription").value = "";
    document.querySelector("#choiceToAdd").value = "";
    document.querySelector("#highlightListChoice").innerHTML = "";
    document.querySelector("#qA").innerHTML = "";
}

function handleDisplayLogin() {
    if (document.querySelector("#loginOpt").innerHTML == "Log Out") {
        localStorage.clear();
        alert("Goodbye");
        window.location.href = 'index.php';
    }
}

function hideQuestion() {
    var radChecker = document.querySelector("#radQuiz");
    radChecker.checked = true;
    editMode = "quiz";
    loadAreas();
}

function hideQuiz() {
    var radChecker = document.querySelector("#radQuestion");
    radChecker.checked = true;
    editMode = "question";
    loadAreas();
}

function startOver() {
    if (editMode == "quiz") {
        startedQuizEdit = 0;
    } else {
        startedQuestionEdit = 0;
    }
    loadAreas();
}

function createNew() {
    if (editMode == "quiz") {
        startedQuizEdit = 1;
    } else {
        startedQuestionEdit = 1;
    }
    loadAreas();
}

function editExisting() {
    if (editMode == "quiz") {
        startedQuizEdit = 2;
    } else {
        startedQuestionEdit = 2;
    }
    loadAreas();
}

function sendQuestion() {
    //adds selected question to list of added questions
    var toSend = document.querySelector(".highlighted");
    if (toSend.parentNode.id == "highlightListAddToQuiz") {
        //alert("you try to pass the thing");
        var sending = document.querySelector("#highlightListAddToQuiz .highlighted").innerHTML;
        var placeHere = document.querySelector("#highlightListInQuiz");
        placeHere.innerHTML += "<li>" + sending + "</li>";
    }
}

function removeQuestion() {
    //removes selected question from list of added questions
    var toRemove = document.querySelector(".highlighted");
    if (toRemove.parentNode.id == "highlightListInQuiz") {
        //alert("you took out the thing");
        var removing = document.querySelector("#highlightListInQuiz .highlighted");
        removing.parentNode.removeChild(removing);
    }
}

function removeChoice() {
    var toRemove = document.querySelector(".highlighted");
    if (toRemove.parentNode.id == "highlightListChoice") {
        //alert("you took out the thing");
        var removing = document.querySelector("#highlightListChoice .highlighted");
        removing.parentNode.removeChild(removing);
    }
    for (var i = 0; i < choiceArray.length; i++) {
        if (choiceArray[i] === toRemove.innerHTML) {
            choiceArray.splice(i, 1);
        }
    }
    //repopulate the answers
    document.getElementById('qA').innerHTML = "";
    for (var i = 0; i < choiceArray.length; i++) {

        var option = document.createElement('option');
        option.innerHTML = choiceArray[i];
        document.getElementById('qA').appendChild(option);

    }
}

function deleteQuestion() {
    var id = document.querySelector("#questionID").value;

    var url = "quizmaster/question/" + id; // entity, not action
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            if (resp == "true") {
                clearQuestionEditInputs();

            } else {

            }


        }
    };
    xmlhttp.open("DELETE", url, true); // "DELETE" is the action, "url" is the entity
    xmlhttp.send();

}


function clearQuestionEditInputs() {

    document.querySelector("#searchTermQuestionInput").value = "";
    document.querySelector("#questionID").value = "";
    document.querySelector("#questionName").value = "";
    document.querySelector("#questionTags").value = "";
    document.querySelector("#questionDescription").value = "";
}
function clearSelections() {
    var rows = document.querySelectorAll("ul");
    for (var i = 0; i < rows.length; i++) {
        rows[i].classList.remove("highlighted");
    }

    var rows = document.querySelectorAll("li");
    for (var i = 0; i < rows.length; i++) {
        rows[i].classList.remove("highlighted");
    }
}

function handleRowClick(e) {
    clearSelections();
    e.target.classList.add("highlighted");

//    document.querySelector("#btnDel").removeAttribute("disabled");
//    document.querySelector("#btnUpd").removeAttribute("disabled");
}

function searchExistingQuiz() {

    var selectedSearch = document.querySelector("#searchByQuizFilter").value;
    var searchValue = document.getElementById("searchExistingQuizInput").value;
    console.log(searchValue);
    if (selectedSearch == "id") {
        var url = "quizmaster/quiz/" + searchValue;
        getOneQuiz(url);

    }
    if (selectedSearch == "tag") {
        var url = "quizmaster/quiz/byTag/" + searchValue;
        getMatchingQuizzes(url);
    }
    if (selectedSearch == "word") {
        var url = "quizmaster/quiz/byName/" + searchValue;
        getMatchingQuizzes(url);
    }

}

function getMatchingQuizzes(url) {
    var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== null) {
                console.log(resp);
                showMatchingQuizzes(resp);
            } else {
                alert("Sorry, please check user name and password");
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}

function showMatchingQuizzes(resp) {

    searchQuizResultsArr = [];
    var data = JSON.parse(resp);
    var html = "";
    for (var i = 0; i < data.length; i++) {

        var quizName = data[i].title;
        var quizId = data[i].id;
        var quizTags = data[i].tags;
        var description = data[i].description;
        html += "<li id=\"selectQuizSearchResult\">" + quizName + "</li>";

        searchQuizResultsArr.push(data[i]);

    }
    document.querySelector("#highlightListQuiz").innerHTML = html;
    console.log(data[0]);
}

function getOneQuiz(url) {
    var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== "null") {
                console.log(resp);
                console.log(JSON.parse(resp));
                showOneQuiz(resp);
            } else {
                alert("Sorry, please check user name and password");
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}
function showOneQuiz(resp) {
    var data = JSON.parse(resp);
    var quizName = data.title;

    var html = "<li value=\"0\">" + quizName + "</li>";


    document.querySelector("#highlightListQuiz").innerHTML = html;
    searchQuizResultsArr.push(data);
    console.log(data.id);
    //document.querySelector("#searchByQuizFilter").addEventListener("change", clearFields);
}


function loadQuizInfo() {
    var arrIndex = document.querySelector(".highlighted").innerHTML;
    //alert("loadQuizInfo");

    arrIndex = document.querySelector(".highlighted").innerHTML;
    for (var i = 0; i < searchQuizResultsArr.length; i++) {
        if (searchQuizResultsArr[i].title == arrIndex) {
            document.querySelector("#quizResultName").value = searchQuizResultsArr[i].title;
            document.querySelector("#quizResultId").value = searchQuizResultsArr[i].id;
            document.querySelector("#quizResultTags").value = searchQuizResultsArr[i].tags;
            document.querySelector("#quizResultDesc").value = searchQuizResultsArr[i].description;

            document.querySelector("#quizNewName").value = searchQuizResultsArr[i].title;
            document.querySelector("#quizNewTags").value = searchQuizResultsArr[i].tags;
            document.querySelector("#quizNewDesc").value = searchQuizResultsArr[i].description;
        }
        //console.log(searchQuizResultsArr[i].title);
    }
    console.log(searchQuizResultsArr[0].title);
    console.log(arrIndex);
}

function editSelectedQuiz() {
    startedQuizEdit = 1;
    loadAreas();
    loadQuestionsOnQuiz();
    
}

function loadQuestionsOnQuiz(){
    
    var url = "quizmaster/question/" + questionId;
    loadQuestionInfo(url);
    
    
}

function loadQuestionInfo(url) {

    var method = "GET";
    console.log("entered method");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== "null") {
                console.log(resp);
                loadOneQuestion(resp);
            } else {
                alert("Something went wrong");
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}

function loadOneQuestion(resp) {
   
       var data = JSON.parse(resp);
       var questionName=data.questionText;
       var questionID=data.id;
       var tags=data.tags;
       var description=data.description;
    document.querySelector("#questionName").value=questionName;
    document.querySelector("#questionID").value=questionID;
    document.querySelector("#questionTags").value=tags;
    
    document.querySelector("#questionDescription").value=description;
    
}

/***********************************************************************
 *  Keep everything below at bottom of file
 ***********************************************************************/
function hideAll() {
    //hides all divs, runs before unhiding the proper divs
    var selected = document.querySelector("#quizEditorAll");
    selected.classList.add("hidden");
    selected = document.querySelector("#quizCreate");
    selected.classList.add("hidden");
    selected = document.querySelector("#quizSearch");
    selected.classList.add("hidden");
    selected = document.querySelector("#questionEditorAll");
    selected.classList.add("hidden");
    selected = document.querySelector("#questionCreate");
    selected.classList.add("hidden");
    selected = document.querySelector("#questionSearch");
    selected.classList.add("hidden");
    selected = document.querySelector("#selectButtonEdit");
    selected.classList.add("hidden");
    selected = document.querySelector("#startOver");
    selected.classList.add("hidden");
}

function loadAreas() {
    hideAll();
    //Reads globals to determine which divs should be loaded or hidden
    if (editMode == "quiz" && startedQuizEdit == 0) {
        //when start over is clicked, hide all quiz editors, show buttons
        var selected = document.querySelector("#selectButtonEdit");
        selected.classList.remove("hidden");
    } else if (editMode == "question" && startedQuestionEdit == 0) {
        //when start over is clicked, hide all question editors, show buttons
        var selected = document.querySelector("#selectButtonEdit");
        selected.classList.remove("hidden");
    } else if (editMode == "quiz" && startedQuizEdit == 1) {
        //when create new is click while quiz is selected
        var selected = document.querySelector("#quizEditorAll");
        selected.classList.remove("hidden");
        selected = document.querySelector("#quizCreate");
        selected.classList.remove("hidden");
        selected = document.querySelector("#startOver");
        selected.classList.remove("hidden");
    } else if (editMode == "question" && startedQuestionEdit == 1) {
        //when create new is click while question is selected
        var selected = document.querySelector("#questionEditorAll");
        selected.classList.remove("hidden");
        selected = document.querySelector("#questionCreate");
        selected.classList.remove("hidden");
        selected = document.querySelector("#startOver");
        selected.classList.remove("hidden");
    } else if (editMode == "quiz" && startedQuizEdit == 2) {
        //when edit existing is clicked search quizzes to edit
        var selected = document.querySelector("#quizSearch");
        selected.classList.remove("hidden");
        selected = document.querySelector("#quizEditorAll");
        selected.classList.remove("hidden");
        selected = document.querySelector("#startOver");
        selected.classList.remove("hidden");

    } else if (editMode == "question" && startedQuestionEdit == 2) {
        //when edit existing is clicked search questions to edit
        var selected = document.querySelector("#questionSearch");
        selected.classList.remove("hidden");
        selected = document.querySelector("#questionEditorAll");
        selected.classList.remove("hidden");
        selected = document.querySelector("#startOver");
        selected.classList.remove("hidden");
    }
}
/***********************************************************************
 *  Keep everything above at bottom of file
 ***********************************************************************/