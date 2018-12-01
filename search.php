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
        <script src="scripts/search.js"></script>
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
        <div id="center" class="yellow">
            <div id="searchBySelector">
                <div id="leftRadio"><input type="radio" name="searchBy" value="quizzes" id="radQuiz" checked>Search Quizzes</div><div id="rightRadio"><input type="radio" name="searchBy" value="results" id="radResult">Search Results</div>
            </div>
            <div id="display">
                <div id="holderSmall">
                    <div id="searchByQuiz">
                        <h1>Quizzes</h1>
                        Search By:
                        <select id="searchByQuizFilter">
                            <option value="id">ID</option>
                            <option value="tag">Tag</option>
                            <option value="word">Word</option>
                        </select>
                        <p>Search Term:<input id="searchTermInput"type="text" name="searchTermInput"><button id="searchbyQuizBtn">Search</button></p>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="searchByResults">
                        <h1>Results</h1>
                        Search By:
                        <select id="searchByResultsFilter">
                            <option>Quiz Tag</option>
                            <option>Question Tag</option>
                            <option>Date Range</option>
                            <option>Score Range</option>
                            <option>User</option>
                        </select>
                        <p>Search Term:<input type="text" name="searchTermInput"><button id="searchQuiz">Search</button></p>
                    </div>
                </div>
                <div id="holderLarge">
                    <div id="output">
                        
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
