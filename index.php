<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script src="index.js"></script>
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
                    <a href="index.php"><button>Home</button></a><a href="search.php"><button>Quizzes</button></a><a href="search.php"><button>Results</button></a><a href="index.php"><button>Search</button></a><a href="editor.php"><button id="editor" class="hidden">Editor</button></a>
                </div>
                <div class="navRight">
                    <a href="login.php"><button id="loginOpt">Login</button></a><a href="index.php"><button id="profile">Profile</button></a>
                </div>
            </div>
            
        </div>
        <div id="center">
            <div id="greeting">
                <h2>Hey %USER%, check out these quizzes!</h2>
            </div>
        </div>
        <div id="botMenu">
            
        </div>
        
        <?php
        // put your code here
        ?>
    </body>
</html>
