<!DOCTYPE html>
<!--
Quiz Master: 
Log into website to take quizzes. Higher permission levels can create quizzes and questions.
Created by: 
Anna Fields, Peter Adam, and Zach MacKay
Date:
2018-12-01
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="scripts/editor.js"></script>
        <title>Quiz Webpage</title>
    </head>
    <body>
        
        <div id="topMenu">
            <div id="topMenuLogo">
                <img src="images/Logo.png"><div id="name"><h1>Quiz Master</h1></div>
            </div>
            <div id="topMenuNav">
                <div class="navLeft">
                    <a href="index.php"><button>Home</button></a><a href="search.php"><button>Search</button></a><a href="editor.php"><button id="editor" class="hidden">Editor</button></a>
                </div>
                <div class="navRight">
                    <a href="login.php"><button id="loginOpt">Login</button></a><a href="profile.php"><button id="profile" class="hidden">Profile</button></a>
                </div>
            </div>
            
        </div>
        <div id="center" class="purple">
            <div id="searchBySelector">
                <div id="leftRadio"><input type="radio" id="radQuiz" name="editBy" value="quizzes" checked>Quiz Editor</div><div id="rightRadio"><input type="radio" id="radQuestion" name="editBy" value="questions">Question Editor</div>
            </div>
            <div id="startOver" class="row hidden">
                <button id="startOver">Start Over</button>
            </div>
            <!--
            * Buttons here are shown initially
            -->
            <div id="selectButtonEdit" class="row">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <button id="btnCreateNew">Create New</button>
                    </div>
                </div>
                
                <div id="holderSmall">
                    <div id="sideRight">
                        <button id="btnEditExisting">Edit Existing</button>
                    </div>
                </div>
            </div>
            
            <!--
            * Show if user chooses edit existing, this is to choose which to edit
            * This uses the same for BOTH quiz and question editor
            * THIS IS FOR QUESTIONS
            -->
            <div id="questionEditorAll">
            <div id="questionSearch" class="row">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="searchPanel">
                            <div id="searchBox">
                                <p>
                                    Search By:
                                    <select id="searchbyQuestionFilter" name="searchBy">
                                        <option value="id">ID</option>
                                        <option value="tags">Tags</option>
                                        <option value="words">Words</option>
                                        <option value="allQuestions">View All</option>
                                    </select>
                                </p>
                                <p>
                                    Search Term:
                                    <input id="searchTermQuestionInput"type="text" value=""><button id="editExistingSearch">Search</button>
                                </p>
                            
                            <div id="searchData">
                                <ul id="highlightListQuestion">
                                     
                                </ul>
                            </div>
                            <div id="searchDataButtons">
                                <button id="btnDeleteQuestion">Delete</button><button ID="btnLoadQuestionInfo">Load Question</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="infoPanel">
                            <div id="searchBox">
                                <p>Question ID -- Question Name</p>
                                <p><input id="questionID" type="text" value=""><input id="questionName" type="text" value=""></p>
                                <p>Question Tags (Comma Seperated)</p>
                                <p><input id="questionTags"type="text" value=""></p>
                                <p>Question Description</p>
                                <p><input id="questionDescription" type="text" value=""></p>
                            
                            <div id="searchDataButtons">
                                <button id="btnEditSelectedQuestion" disabled>Edit</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--
            ************** QUESTION EDITOR ONLY *******************
            * Shown if user hits create new, or chooses one to edit
            -->
            
            <div id="questionCreate" class="row">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="searchPanel">
                            <div id="searchBox">
                              
                            <p>Question
                                <input id="questionText" type="text" value=""><span class="error" id="questionError"></span></p>
                            
                             
                                <p>Add Choice:
                                   <input id="choiceToAdd" type="text" value=""></p>
                                <p><button id="btnAddChoice">Add</button>
                                   <button id="btnRemoveChoice">Remove</button><span class="error" id="choiceError"></span></p>
                            
                            <div id="searchData">
                                <ul id="highlightListChoice">
                                   
                                </ul>
                            </div>
                            <div id="questionAnswer">
                                Answer:
                                    <select id="qA">
                                    
                                    </select>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="infoPanel">
                            <div id="searchBox">
                                <p>Question Tags (Comma seperated)</p>
                                <p><input id="questionTag"type="text" value=""></p><span class="error" id="tagError"></span>
                                <p>Question Description</p>
                                <p><input id="addquestionDescription" type="text"></p><span class="error" id="descError"></span>
                                <button id="btnSaveQuestion">Save Question</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
            <!--
            * Show if user chooses edit existing, this is to choose which to edit
            * This uses the same for BOTH quiz and question editor
            * THIS IS FOR QUIZZES
            -->
            
            <div id="quizEditorAll">
            <div id="quizSearch" class="row">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="searchPanel">
                            <div id="searchBox">
                                <p>
                                    Search By:
                                    <select id="searchByQuizFilter" name="searchBy">
                                        <option value="id">ID</option>
                                        <option value="tag">Tag</option>
                                        <option value="word">Word</option>
                                        <option value="allQuizzes">View All</option>
                                    </select>
                                </p>
                                <p>Search Term:
                                   <input id="searchExistingQuizInput" type="text" value=""></p>
                                <p><button id="searchExistingQuiz">Search</button></p>
                            
                            <div id="searchData">
                                <ul id="highlightListQuiz">
                                  
                                </ul>
                            </div>
                            <div id="searchDataButtons">
                                <!-- Moved button
                                <button id="deleteQuiz">Delete Quiz</button>
                                -->
                                <button id="btnLoadQuizInfo">Load Quiz</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="infoPanel">
                            <div id="searchBox">
                                <p>Quiz Name -- Quiz ID</p>
                                <p><input id="quizResultName" type="text" value="" disabled><input id="quizResultId" type="text" value="" disabled></p>
                                <p>Quiz Tags (Comma Seperated)</p>
                                <p><input id="quizResultTags" type="text" value="" disabled></p>                            
                                <p>Quiz Description</p>
                                <p><input id="quizResultDesc" type="text" value="" disabled></p>
                                <div id="searchDataButtons">
                                    <button id="btnEditSelectedQuiz" disabled>Edit</button>
                                    <button id="btnDeleteQuiz">Delete Quiz</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--
            ****************** QUIZ EDITOR: SEARCH AND DESCRIPTION *******************
            * Shown if user hits create new, or chooses one to edit
            -->
            
            <div id="quizCreate">
                <div class="row">
                    <div id="holderSmall">
                        <div id="sideLeft">
                            <div id="themeSelector">
                                <!--<div id="colorChoice">
                                    <button id="red">a</button><button id="red">b</button><button id="red">c</button><button id="red">d</button><button id="red">e</button><button id="red">f</button>
                                </div>-->
                            </div>
                            <div id="searchPanel">
                                <div id="searchBox">
                                    <p>
                                        Search By:
                                        <select id="searchByQuestionsToAdd">
                                            <option value="id">ID</option>
                                            <option value="tag">Tag</option>
                                            <option value="word">Word</option>
                                            <option value="allQuestions">View All</option>
                                        </select>
                                    </p>
                                    <p>
                                        Search Term:
                                        <input type="text" value="SearchTerm"><button id="btnSearchQuestionsToAdd">Search</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="holderSmall">
                        <div id="sideRight">
                            <div id="infoPanel">
                                <div id="searchBox">
                                    <p>Quiz Name</p>
                                    <p><input id="quizNewName" type="text" value=""></p>
                                    <p>Quiz Tags (Comma Seperated)</p>
                                    <p><input id="quizNewTags" type="text" value=""></p>
                                    <p>Quiz Description</p>
                                    <p><input id="quizNewDesc" type="text" value=""></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                *************** QUIZ EDITOR: QUESTION ADD TO QUIZ ****************
                * Shown if user hits create new, or chooses a quiz to edit
                -->
                <div class="row">
                    <div id="holderSmall">
                        <div id="sideLeft">
                            <div id="quizQuestionSearch">
                                <div id="searchBox">
                                    <p>
                                        Question List
                                    </p>
                                    <div id="quizSearchData">
                                        <ul id="highlightListAddToQuiz">

                                        </ul>
                                    </div>
                                    <div id="searchDataButtons">
                                        <!--<button>Create New Question</button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="questionPassButtons">
                        <p><button id="btnSend"> > </button></p>
                        <p><button id="btnRemove"> < </button></p>
                    </div>

                    <div id="holderSmall">
                        <div id="sideRight">
                            <div id="quizQuestionAdded">
                                <div id="searchBox">
                                    <p>Questions on Quiz</p>
                                
                                <div id="searchData">
                                    <ul id="highlightListInQuiz">
                                       
                                    </ul>
                                </div>
                                <div id="searchDataButtons">
                                    <button>Save Quiz</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            
        </div>
        <div id="botMenu">
            <div class="navLeft">
                <a href="about.php"><button>About Us</button></a>
            </div>
            <div class="navRight">
                <a href="about.php#contact"><button>Contact Us</button></a><a href="profile.php"><button>Settings</button></a>
            </div>
        </div>
        
        
        
    </body>
</html>
