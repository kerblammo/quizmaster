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
        <script src="scripts/search.js"></script>
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
                    <a href="login.php"><button id="loginOpt">Login</button></a><a href="index.php"><button>Profile</button></a>
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
                        <select id="searchQuix">
                            <option>ID</option>
                            <option>Tag</option>
                            <option>Word</option>
                        </select>
                        <p>Search Term:<input type="text" name="searchTermInput"><button>Seach</button></p>
                    </div>
                </div>
                <div id="holderSmall">
                    <div id="searchByResults">
                        Search By:
                        <select >
                            <option>Quiz Tag</option>
                            <option>Question Tag</option>
                            <option>Date Range</option>
                            <option>Score Range</option>
                            <option>User</option>
                        </select>
                        <p>Search Term:<input type="text" name="searchTermInput"><button id="searchQuiz">Seach</button></p>
                    </div>
                </div>
                <div id="holderLarge">
                    <div id="output">
                        <div class="row">
                            <div id="outputData" class="column">
                                hello
                            </div>

                            <div id="outputData" class="column">
                                hi
                            </div>

                            <div id="outputData" class="column">
                                data
                            </div>

                            <div id="outputData" class="column">
                                here
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="botMenu">
            <div class="navLeft">
                <a href="index.php"><button>About Us</button></a>
            </div>
            <div class="navRight">
                <a href="login.php"><button id="loginOpt">Contact Us</button></a><a href="index.php"><button>Settings</button></a>
            </div>
        </div>
        
        
        
    </body>
</html>
