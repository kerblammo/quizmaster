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
        <div id="center" class="yellow">
            <div id="searchBySelector">
                <div id="leftRadio"><input type="radio" name="settingsLevel" value="settingsUser" id="radSettingsUser" checked>Profile</div><div id="rightRadio"><input type="radio" name="settingsLevel" value="settingsAdmin" id="radSettingsAdmin">Admin Panel</div>
            </div>
            <div id="display">
                <div id="holderSmall">
                    Username:<br>
                    <input><br>
                    Change Password:<br>
                    Old Password: <input><br>
                    New Password: <input><br>
                    Confirm Password: <input><br>
                    <button>Delete Account</button>
                </div>
                <div id="holderSmall">
                    
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
