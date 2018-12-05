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
        <script src="scripts/login.js"></script>
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
        <div id="centerLogin" class="green">
            <div id="login">
                <div id="loginInnerTop">
                    <h2>Log in</h2>
                </div>
                <div id="loginInner">
                    <p>Username <input id="loginUser" type="text" name="loginUser"></p><span class="error" id="UseNameError"></span>
                    <p>Password <input id="loginPass" type="text" name="loginPass"></p><span class="error" id="passwordError"></span>
                    <div id="loginInnerBot">
                        <p><button id="loginBtn">Log in!</button></p>
                        <hr>
                        <p>Don't have an account?</p>
                        <p><button id="signUp">Sign up!</button></p>
                    </div>
                </div>
            </div>
            <div id="signup">
                <div id="loginInnerTop">
                    <h2>Sign up</h2>
                </div>
                <div id="loginInner">
                    <p>Username <input id="signUpUser" type="text" name="signUpUser"></p><span class="error" id="SignUpUseNameError"></span>
                    <p>Password <input id="signUpPass" type="text" name="signUpPass"></p><span class="error" id="signUppasswordError"></span>
                    <p>Confirm Password <input id="signUpConfirm" type="text" name="signUpConfirm"></p><span class="error" id="signUpconfirmPwdError"></span>
                    <div id="loginInnerBot">
                        <p><button id="createUser">Sign up!</button></p>
                        <hr>
                        <p>Already have an account?</p>
                        <p><button id="backtoLogin">Log in!</button></p>
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
