<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <title>Quiz Webpage</title>
    </head>
    <body>
        
        <div id="topMenu">
            <div id="topMenuLogo">
                <img src="images/Logo.png"><div id="name"><h1>Quiz Master</h1></div>
            </div>
            <div id="topMenuNav">
                <div class="navLeft">

                    <a href="index.php"><button>Home</button></a><a href="search.php"><button>Search</button></a><a href="editor.php"><button id="editor"class="hidden">Editor</button></a>

                </div>
                <div class="navRight">
                    <a href="login.php"><button>Log</button></a><a href="index.php"><button>Profile</button></a>
                </div>
            </div>
            
        </div>
        <div id="center">
            <div id="searchBySelector">
                <div id="leftRadio"><input type="radio" name="editBy" value="quizzes" checked>Search Quizzes</div><div id="rightRadio"><input type="radio" name="editBy" value="results">Search Results</div>
            </div>
            <div id="greeting">
                <h2>Welcome to the editor.</h2>

            <!--
            * Buttons here are shown initially
            -->
            <div id="selectButtonEdit">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <button id="createNew">Create New</button>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <button id="editExisting">Edit Existing</button>
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
                                <ul>
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
                                <p>
                                    Question: 
                                </p>
                                <p>
                                    <input type="text" value=""> 
                                </p>
                                <p>
                                    Add Choice:
                                    <input type="text" value=""><button>Add</button><button>Remove</button>
                                </p>
                            </div>
                            <div id="searchData">
                                <ul>
                                    <li>Choice1</li>
                                    <li>Choice2</li>
                                    <li>Choice3</li>
                                    <li>Choice4</li>
                                </ul>
                            </div>
                            <div id="questionAnswer">
                                Answer:
                                    <select name="qA">
                                        <option name="qA">Choice1</option>
                                        <option name="qA">Choice2</option>
                                        <option name="qA">Choice3</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="infoPanel">
                            <p>Question Name -- Question ID</p>
                            <p><input type="text" value=""><input type="text" value=""></p>
                            <p>Question Tags</p>
                            <p><input type="text" value=""></p>
                            <p>Question Description</p>
                            <p><input type="text" value=""></p>
                            <button>Save Question</button>
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
                                <ul>
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
            ****************** QUIZ EDITOR ONLY *******************
            * Shown if user hits create new, or chooses one to edit
            -->
            
            <div id="quizCreate">
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="searchPanel">
                            <div id="themeSelector">
                                <div id="colorChoice">
                                    
                                </div>
                            </div>
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
                            <p>Quiz Name -- Quiz ID</p>
                            <p><input type="text" value=""><input type="text" value=""></p>
                            <p>Quiz / Question Tags</p>
                            <p><input type="text" value=""></p>
                            <p>Quiz / Question Description</p>
                            <p><input type="text" value=""></p>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideLeft">
                        <div id="questionSearch">
                            <p>hi</p>
                        </div>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="sideRight">
                        <div id="questionAdded">
                            <p>hello</p>
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
        
        <?php
        // put your code here
        ?>
    </body>
</html>
