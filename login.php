<!DOCTYPE html>
<!--anna
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <script src="login.js"></script>
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
        <div id="centerLogin">
            <div id="login">
                <div id="loginInnerTop">
                    <h2>Log in</h2>
                </div>
                <div id="loginInner">
                    <p>Username <input id="loginUser" type="text" name="loginUser"></p>
                    <p>Password <input id="loginPass" type="text" name="loginPass"></p>
                    <div id="loginInnerBot">
                        <p><button id="loginBtn">Log in!</button></p>
                        <hr>
                        <p>Don't have an account?</p>
                        <p><button>Sign up!</button></p>
                    </div>
                </div>
            </div>
            <div id="signup">
                <div id="loginInnerTop">
                    <h2>Sign up</h2>
                </div>
                <div id="loginInner">
                    <p>Username <input type="text" name="loginUser"></p>
                    <p>Password <input type="text" name="loginPass"></p>
                    <p>Confirm Password <input type="text" name="loginConfirm"></p>
                    <div id="loginInnerBot">
                        <p><button>Sign up!</button></p>
                        <hr>
                        <p>Already have an account?</p>
                        <p><button>Log in!</button></p>
                    </div>
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
