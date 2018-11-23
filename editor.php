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
                    <a href="index.php"><button>Home</button></a><a href="search.php"><button>Quizzes</button></a><a href="search.php"><button>Results</button></a><a href="index.php"><button>Search</button></a><a href="editor.php"><button>Editor</button></a>
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
            </div>
        </div>
        <div id="botMenu">
            
        </div>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
