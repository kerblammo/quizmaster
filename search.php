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
                    <a href="index.php"><button>Home</button></a><a href="search.php"><button>Search</button></a><a href="editor.php"><button>Editor</button></a>
                </div>
                <div class="navRight">
                    <a href="login.php"><button>Log</button></a><a href="index.php"><button>Profile</button></a>
                </div>
            </div>
            
        </div>
        <div id="center">
            <div id="searchBySelector">
                <div id="leftRadio"><input type="radio" name="searchBy" value="quizzes" checked>Search Quizzes</div><div id="rightRadio"><input type="radio" name="searchBy" value="results">Search Results</div>
            </div>
            <div id="displayQuiz">
                <div id="holderSmall">
                    <div id="searchByQuiz">
                        Search By:
                        <select>
                            <option>ID</option>
                            <option>Tag</option>
                            <option>Word</option>
                        </select>
                        <p>Search Term:<input type="text" name="searchTermInput"></p>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="emptySpacer">

                    </div>
                </div>
                <div id="holderLarge">
                    <div id="output">
                        <div id="outputData">
                            hello
                        </div>
                        
                        <div id="outputData">
                            hi
                        </div>
                        
                        <div id="outputData">
                            data
                        </div>
                        
                        <div id="outputData">
                            here
                        </div>
                    </div>
                </div>
            </div>
            <div id="displayResult">
                <div id="emptySpacer">
                    
                </div>
                <div id="searchByResults">
                    Search By:
                    <select>
                        <option>Quiz Tag</option>
                        <option>Question Tag</option>
                        <option>Date Range</option>
                        <option>Score Range</option>
                        <option>User</option>
                    </select>
                    <p>Search Term:<input type="text" name="searchTermInput"></p>
                </div>
                <div id="outputResults output">
                    Output here
                </div>
            </div>
            
        </div>
        <div id="botMenu">
            
        </div>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
