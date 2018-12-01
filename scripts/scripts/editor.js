/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

window.onload = function () {
    document.querySelector("#leftRadio").addEventListener("click",hideQuestion);
    document.querySelector("#rightRadio").addEventListener("click",hideQuiz);
    document.querySelector("#createNew").addEventListener("click",createNew);
    document.querySelector("#editExisting").addEventListener("click",editExisting);
    document.querySelector("#startOver").addEventListener("click",startOver);
    
    //first load, this will clear the proper divs, show buttons, and set default to quiz
    loadAreas();
    
}

var editMode = "quiz";
var startedQuizEdit = 0;
var startedQuestionEdit = 0;

function hideQuestion(){
    var radChecker = document.querySelector("#radQuiz");
    radChecker.checked = true;
    editMode = "quiz";
    loadAreas();
}

function hideQuiz(){
    var radChecker = document.querySelector("#radQuestion");
    radChecker.checked = true;
    editMode = "question";
    loadAreas();
}

function createNew(){
    if (editMode == "quiz") {
        startedQuizEdit = 1;
    } 
    else{
        startedQuestionEdit = 1;
    }
    loadAreas();
}

function editExisting(){
    if (editMode == "quiz") {
        startedQuizEdit = 2;
    } 
    else{
        startedQuestionEdit = 2;
    }
    loadAreas();
}

function startOver(){
    if (editMode == "quiz") {
        startedQuizEdit = 0;
    } 
    else{
        startedQuestionEdit = 0;
    }
    loadAreas();
    
}

function hideAll(){
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

function loadAreas(){
    hideAll();
    //Reads globals to determine which divs should be loaded or hidden
    if (editMode == "quiz" && startedQuizEdit == 0) {
        //when start over is clicked, hide all quiz editors, show buttons
        var selected = document.querySelector("#selectButtonEdit");
        selected.classList.remove("hidden");
    }
    else if (editMode == "question" && startedQuestionEdit == 0) {
        //when start over is clicked, hide all question editors, show buttons
        var selected = document.querySelector("#selectButtonEdit");
        selected.classList.remove("hidden");
    }
    else if (editMode == "quiz" && startedQuizEdit == 1) {
        //when create new is click while quiz is selected
        var selected = document.querySelector("#quizEditorAll");
        selected.classList.remove("hidden");
        selected = document.querySelector("#quizCreate");
        selected.classList.remove("hidden");
    }
    else if (editMode == "question" && startedQuestionEdit == 1){
        //when create new is click while question is selected
        var selected = document.querySelector("#questionEditorAll");
        selected.classList.remove("hidden");
        selected = document.querySelector("#questionCreate");
        selected.classList.remove("hidden");
    }
    else if (editMode == "quiz" && startedQuizEdit == 2) {
        //when edit existing is clicked search quizzes to edit
        var selected = document.querySelector("#quizSearch");
        selected.classList.remove("hidden");
        selected = document.querySelector("#quizEditorAll");
        selected.classList.remove("hidden");
        
    }
    else if (editMode == "question" && startedQuestionEdit == 2) {
        //when edit existing is clicked search questions to edit
        var selected = document.querySelector("#questionSearch");
        selected.classList.remove("hidden");
        selected = document.querySelector("#questionEditorAll");
        selected.classList.remove("hidden");
        
    }
}