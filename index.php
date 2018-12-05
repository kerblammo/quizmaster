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
        <script src="scripts/index.js"></script>
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
        <div id="center" class="white">
            <div id="greeting">
                Hey Guest, check out these quizzes!
            </div>
            <div id="featured">
                <div id="featuredDataHolder">
                    <div id=title>Featured Quizzes</div>
                    <!-- 
                    * These are example boxes but can be (optionally)hard coded
                    -->
                    <div id="featuredData">
                        <div id="quizName">
                            This is where the quiz name goes.
                        </div>
                        <div id="quizDescription">
                            <p>This is where the quiz description goes.</p>
                        </div>
                        <div id="btnTakeQuiz">
                            <form action="quiz.php" id="takeQuiz" method="POST">
                                <button type="submit" >Take Quiz</button>
                            </form>
                        </div>
                    </div>
                    <div id="featuredData">
                        <div id="quizName">
                            This is where the quiz name goes.
                        </div>
                        <div id="quizDescription">
                            <p>This is where the quiz description goes.</p>
                        </div>
                        <div id="btnTakeQuiz">
                            <form action="quiz.php" id="takeQuiz" method="POST">
                                <button type="submit" >Take Quiz</button>
                            </form>
                        </div>
                    </div>
                    <!-- 
                    * End of a hardcoded boxes
                    -->
                    <form action="search.php" id="viewAll">
                        <button type="submit" >View All Quizzes</button>
                    </form>
                </div>
            </div>
            <div id="latest">
                
                <div id="latestDataHolder">
                    <div id=title>Latest Quizzes</div>
                    <!-- 
                    * These are example boxes and should be built in javascript and loaded into the "latestDataHolder" div
                    -->
                    <div id="latestData">
                        <div id="quizName">
                            This is where the quiz name goes.
                        </div>
                        <div id="quizDescription">
                            <p>This is where the quiz description goes.</p>
                        </div>
                        <div id="btnTakeQuiz">
                            <form action="quiz.php" id="takeQuiz" method="POST">
                                <button type="submit" >Take Quiz</button>
                            </form>
                        </div>
                    </div>
                    <!-- 
                    * End of a single example box
                    -->
                    <div id="latestData">
                        <div id="quizName">
                            This is where the quiz name goes.
                        </div>
                        <div id="quizDescription">
                            <p>This is where the quiz description goes.</p>
                        </div>
                        <div id="btnTakeQuiz">
                            <form action="quiz.php" id="takeQuiz" method="POST">
                                <button type="submit" >Take Quiz</button>
                            </form>
                        </div>
                    </div>
                    <div id="latestData">
                        <div id="quizName">
                            This is where the quiz name goes.
                        </div>
                        <div id="quizDescription">
                            <p>This is where the quiz description goes.</p>
                        </div>
                        <div id="btnTakeQuiz">
                            <form action="quiz.php" id="takeQuiz" method="POST">
                                <button type="submit" >Take Quiz</button>
                            </form>
                        </div>
                    </div>
                    <div id="latestData">
                        <div id="quizName">
                            This is where the quiz name goes.
                        </div>
                        <div id="quizDescription">
                            <p>This is where the quiz description goes.</p>
                        </div>
                        <div id="btnTakeQuiz">
                            <form action="quiz.php" id="takeQuiz" method="POST">
                                <button type="submit" >Take Quiz</button>
                            </form>
                        </div>
                    </div>
                    <!-- 
                    * End of full sample, there should always be 4 here
                    -->
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
