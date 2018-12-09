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
        <script src="scripts/settings.js"></script>
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
            <div id="searchBySelector" class="hidden">
                <div id="leftRadio"><input type="radio" name="settingsLevel" value="settingsUser" id="radSettingsUser" checked>Account Settings</div><div id="rightRadio"><input type="radio" name="settingsLevel" value="settingsAdmin" id="radSettingsAdmin">Admin Panel</div>
            </div>
            <div id="display">
                <div id="userSettings">
                    <div id="holderMedium">
                        <div id="sideLeft">
                            <div id="userSettingsDesign">
                                <select id="userSettingsSelect">
                                    <!--<option name="userOption" value="userSettingsUsername">View Your Username</option>-->
                                    <option name="userOption" value="userSettingsPassword">Change Your Password</option>
                                    <option name="userOption" value="userSettingsDelete">Delete Your Account</option>
                                </select>
                                <button id="btnUserGo">Go!</button>
                                <div id="userSettingsUsername" class="hidden">
                                    <h2>Username:</h2>
                                    <input id="txtUserUsername"><br>
                                </div>
                                <div id="userSettingsPassword" class="hidden">
                                    <h2>Change Password:</h2>
                                    New Password: <input id="userNewPassword"><br>
                                    Confirm Password: <input id="userNewPasswordConfirm"><br>
                                    <button id="btnUserPassword">Confirm</button>
                                </div>
                                <div id="userSettingsDelete" class="hidden">
                                    <h2>Warning, this cannot be undone</h2>
                                    <button id="btnUserDelete">Delete Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="superSettings" class="invisible">
                    <div id="holderMedium">
                        <div id="sideRight">
                        <select id="superSettingsSelect">
                            <option name="superOption" value="superSettingsCreate">Create an Account</option>
                            <option name="superOption" value="superSettingsPassword">Change Account Password</option>
                            <option name="superOption" value="superSettingsDelete">Delete an Account</option>
                        </select>
                        <button id="btnSuperGo">Go!</button>

                        <div id="superSettingsCreate" class="hidden">
                            <h2>Create New Account</h2>
                            <select id="permLevel">
                                <option>User</option>
                                <option>Admin</option>
                                <option>Super</option>
                            </select>
                            <p>Username <input id="signUpUser" type="text" name="signUpUser"></p><span class="error" id="SignUpUseNameError"></span>
                            <p>Password <input id="signUpPass" type="text" name="signUpPass"></p><span class="error" id="signUppasswordError"></span>
                            <p>Confirm Password <input id="signUpConfirm" type="text" name="signUpConfirm"></p><span class="error" id="signUpconfirmPwdError"></span>
                            <p><button id="btnSuperCreate">Create</button></p>
                        </div>
                        <div id="superSettingsPassword" class="hidden">
                            <div id="loadAllAccounts">
                                <h2>Change Account Password</h2>
                                <select id="allAccounts">
                                    <option>Username 1</option>
                                    <option>Username 2</option>
                                    <option>Username 3</option>
                                    <option>Username 4</option>
                                </select>
                                <br>
                                New Password: <input id="superNewPassword"><br>
                                Confirm Password: <input id="superNewPasswordConfirm"><br>
                            </div>
                            <button id="btnSuperPassword">Change Password</button>
                        </div>
                        <div id="superSettingsDelete" class="hidden">
                            <h2>Delete or Disable Account</h2>
                            <div id="loadAllAccounts">
                                <select id="allAccounts">
                                    <option>Username 1</option>
                                    <option>Username 2</option>
                                    <option>Username 3</option>
                                    <option>Username 4</option>
                                </select>
                            </div>
                            <button id="btnSuperDelete">Delete</button>
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
        
        
        
    </body>
</html>
