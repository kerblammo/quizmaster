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
                    <a href="login.php"><button id="loginOpt">Login</button></a><a href="index.php"><button id="profile" class="hidden">Profile</button></a>
                </div>
            </div>
            
        </div>
        <div id="center" class="purple">
            <div id="searchBySelector">
                <div id="leftRadio"><input type="radio" id="radQuiz" name="editBy" value="quizzes" checked>Quiz Editor</div><div id="rightRadio"><input type="radio" id="radQuestion" name="editBy" value="questions">Question Editor</div>
            </div>
            <div class="row">
                <button id="startOver">Start Over</button>
            </div>
            <!--
            * Buttons here are shown initially
            -->
            <div id="selectButtonEdit">
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
            <div id="questionSearch">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="searchPanel">
                            <div id="seachBox">
                                <p>
                                    Search By:
                                    <select name="seachBy">
                                        <option name="seachBy">ID</option>
                                        <option name="seachBy">Tags</option>
                                        <option name="seachBy">Words</option>
                                    </select>
                                </p>
                                <p>
                                    Search Term:
                                    <input type="text" value=""><button>Search</button>
                                </p>
                            </div>
                            <div id="searchData">
                                <ul id="highlightListQuestion">
                                    <li>Result1</li>
                                    <li>Result2</li>
                                    <li>Result3</li>
                                    <li>Result4</li>
                                </ul>
                            </div>
                            <div id="searchDataButtons">
                                <button>Remove</button><button>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="infoPanel">
                            <div id="seachBox">
                                <p>Question Name -- Question ID</p>
                                <p><input type="text" value=""><input type="text" value=""></p>
                            </div>
                            <div id="searchData">
                                <p>Question Tags</p>
                                <p><input type="text" value=""></p>
                            </div>
                            <div id="searchDataButtons">
                                <p>Question Description</p>
                                <p><input type="text" value=""></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--
            ************** QUESTION EDITOR ONLY *******************
            * Shown if user hits create new, or chooses one to edit
            -->
            
            <div id="questionCreate">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="searchPanel">
                            <div id="seachBox">
                              
                            <p>Question</p>
                            <p><input id="questionText" type="text" value=""><span class="error" id="questionError"></span>
                            <p>Question Tags</p>
                            <p><input id="questionTag"type="text" value=""></p><span class="error" id="tagError"></span>
                            <p>Question Description</p>
                            <p><input id="questionDescription" type="text" value=""></p><span class="error" id="descError"></span>
                             
                                <p>
                                    Add Choice:
                                    <input id="choiceToAdd" type="text" value=""><button id="addChoice">Add</button><button>Remove</button><span class="error" id="choiceError"></span>
                                </p>
                            </div>
                            <div id="searchData">
                                <ul id="highlightListChoice">
                                  
                                </ul>
                            </div>
                            <div id="questionAnswer">
                                Answer:
                                    <select id="qA">
                                      
                                    </select>
                            </div>
                             <button id="saveQuestion">Save Question</button>
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
            <div id="quizSearch">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="searchPanel">
                            <div id="seachBox">
                                <p>
                                    Search By:
                                    <select name="seachBy">
                                        <option name="seachBy">ID</option>
                                        <option name="seachBy">Tags</option>
                                        <option name="seachBy">Words</option>
                                    </select>
                                </p>
                                <p>
                                    Search Term:
                                    <input type="text" value=""><button>Search</button>
                                </p>
                            </div>
                            <div id="searchData">
                                <ul id="highlightListQuiz">
                                    <li>Result1</li>
                                    <li>Result2</li>
                                    <li>Result3</li>
                                    <li>Result4</li>
                                </ul>
                            </div>
                            <div id="searchDataButtons">
                                <button>Remove</button><button>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="infoPanel">
                            <div id="seachBox">
                                <p>Quiz Name -- Quiz ID</p>
                                <p><input type="text" value=""><input type="text" value=""></p>
                            </div>
                            <div id="searchData">
                                <p>Quiz Tags</p>
                                <p><input type="text" value=""></p>
                            </div>
                            <div id="searchDataButtons">
                                <p>Quiz Description</p>
                                <p><input type="text" value=""></p>
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
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="themeSelector">
                            <div id="colorChoice">
                                <button id="red">a</button><button id="red">b</button><button id="red">c</button><button id="red">d</button><button id="red">e</button><button id="red">f</button>
                            </div>
                        </div>
                        <div id="searchPanel">
                            <div id="seachBox">
                                <p>
                                    Search By:
                                    <select name="seachBy">
                                        <option name="seachBy">ID</option>
                                        <option name="seachBy">Tags</option>
                                        <option name="seachBy">Words</option>
                                    </select>
                                </p>
                                <p>
                                    Search Term:
                                    <input type="text" value="SearchTerm"><button>Search</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="infoPanel">
                            <p>Quiz Name</p>
                            <p><input type="text" value=""></p>
                            <p>Quiz ID</p>
                            <p><input type="text" value=""></p>
                            <p>Quiz / Question Tags</p>
                            <p><input type="text" value=""></p>
                            <p>Quiz / Question Description</p>
                            <p><input type="text" value=""></p>
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
                                <div id="seachBox">
                                    <p>
                                        Question List
                                    </p>
                                </div>
                                <div id="quizSearchData">
                                    <ul id="highlightListAddToQuiz">
                                        <li>Result1</li>
                                        <li>Result2</li>
                                        <li>Result3</li>
                                        <li>Result4</li>
                                    </ul>
                                </div>
                                <div id="searchDataButtons">
                                    <button>Create New Question</button>
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
                            <div id="questionAdded">
                                <div id="seachBox">
                                    <p>Questions on Quiz</p>
                                </div>
                                <div id="searchData">
                                    <ul id="highlightListInQuiz">
                                        <li>Result1</li>
                                        <li>Result2</li>
                                        <li>Result3</li>
                                        <li>Result4</li>
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
