<!DOCTYPE html>

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
                    <a href="index.php"><button>Home</button></a><a href="search.php"><button>Search</button></a><a href="editor.php"><button id="editor" class="hidden">Editor</button></a>
                </div>
                <div class="navRight">
                    <a href="login.php"><button id="loginOpt">Login</button></a><a href="index.php"><button id="profile" class="hidden">Profile</button></a>
                </div>
            </div>
            
        </div>
        <div id="center" class="white">
            <div id="quizHolder">
                <div id="quizName">
                    <h1>Quiz Name</h1>
                </div>
                <div id="quizQuestionHolder">
                    <h2>Question goes here!</h2>
                </div>
                <div id="quizChoiceHolder">
                    <input type="radio" name="choice" value="">Choice 1<br>
                    <input type="radio" name="choice" value="">Choice 2<br>
                    <input type="radio" name="choice" value="">Choice 3<br>
                    <input type="radio" name="choice" value="">Choice 4<br>
                </div>
                <div id="buttonHolder">
                    <button>Back</button><button>Next</button><button>Submit</button>
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
