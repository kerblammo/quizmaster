/* 
 * Quiz Master Website
 * Created by: Anna Fields, Peter Adam, Zach MacKay
 * Date: 2018-12-01
 */

//globals used to determine which divs to hide / show
var editMode = "quiz";
var startedQuizEdit = 0;
var startedQuestionEdit = 0;

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
    document.querySelector("#btnSend").addEventListener("click", sendQuestion);
    document.querySelector("#btnRemove").addEventListener("click", removeQuestion);
    document.querySelector("#saveQuestion").addEventListener("click", saveQuestion);
    document.querySelector("#addChoice").addEventListener("click", addChoice);


    //first load, this will clear the proper divs, show buttons, and set default to quiz
    loadAreas();

    if (localStorage.getItem("userLoggedIn") !== null) {

        document.querySelector("#loginOpt").innerHTML = "Log Out";
        document.querySelector("#profile").classList.remove("hidden");
        var user = localStorage.getItem('userLoggedIn');
        console.log(user);
        var userObj = JSON.parse(user);
        username = userObj.username;
//        var html = "Hey " + username + ", check our these quizzes!";
//        document.querySelector("#greeting").innerHTML = html;
        var userPermission = userObj.permissionId;
        console.log(userPermission);

        if (userPermission === 1 || userPermission === 2) {
            document.querySelector("#editor").classList.remove("hidden");
        }

    }
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);

}
var choiceArray=[];
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
    option.innerHTML = addChoice
    document.getElementById('qA').appendChild(option);
  choiceArray.push(el.innerHTML);
  
}




function saveQuestion() {
    document.querySelector("#questionError").innerHTML = "";
    document.querySelector("#tagError").innerHTML = "";
    document.querySelector("#descError").innerHTML = "";
    document.querySelector("#choiceError").innerHTML = "";
    //Is called when used clicks on Question Editor, and then create new, and then clicks save
    //get the data from the editor page and checks to see if it is valid, and then build a question
    if (formIsValid()) {//check if everything is valid, then creates a question object and then make ajax call
      
    var questionObj = {
            "id":999,
            "questionText": document.querySelector("#questionText").value,
            "description": document.querySelector("#questionDescription").value,
            "choices": choiceArray.toString(),
            "answer": document.querySelector("#qA").value,
            "tags": document.querySelector("#questionTag").value
            
          
        };
//make an ajax call to add the question
      var url = "quizmaster/question";
  
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
        alert("added");
        clearQuestionFields();
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.send(JSON.stringify(questionObj));
    }
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
    if (document.querySelector("#questionDescription").value == "") {
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

function clearQuestionFields(){
     document.querySelector("#questionText").value = "";
    document.querySelector("#questionTag").value = "";
    document.querySelector("#questionDescription").value = "";
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
    } else if (editMode == "question" && startedQuestionEdit == 1) {
        //when create new is click while question is selected
        var selected = document.querySelector("#questionEditorAll");
        selected.classList.remove("hidden");
        selected = document.querySelector("#questionCreate");
        selected.classList.remove("hidden");
    } else if (editMode == "quiz" && startedQuizEdit == 2) {
        //when edit existing is clicked search quizzes to edit
        var selected = document.querySelector("#quizSearch");
        selected.classList.remove("hidden");
        selected = document.querySelector("#quizEditorAll");
        selected.classList.remove("hidden");

    } else if (editMode == "question" && startedQuestionEdit == 2) {
        //when edit existing is clicked search questions to edit
        var selected = document.querySelector("#questionSearch");
        selected.classList.remove("hidden");
        selected = document.querySelector("#questionEditorAll");
        selected.classList.remove("hidden");

    }
}