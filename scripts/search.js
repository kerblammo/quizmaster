window.onload = function () {
    document.querySelector('#searchbyQuizBtn').addEventListener('click', submitHandler);
    //    console.log('Handlers set');
    document.querySelector("#searchByResults").classList.add("invisible");
    document.querySelector("#leftRadio").addEventListener("click", searchByQuiz);
    document.querySelector("#rightRadio").addEventListener("click", searchByResults);
    document.querySelector("#searchByQuizFilter").addEventListener("change", clearFields);
    document.querySelector('#searchbyResultsBtn').addEventListener('click', searchForResults)

    //saveQuestion <-- what's this comment referring to?

    if (localStorage.getItem("userLoggedIn") !== null) {
        console.log(localStorage.getItem('userLoggedIn'));
        document.querySelector("#loginOpt").innerHTML = "Log Out";
        document.querySelector("#profile").classList.remove("hidden");

        var user = localStorage.getItem('userLoggedIn');
        var userObj = JSON.parse(user);
        var userPermission = userObj.permissionId;
        console.log(userPermission);
        if (userPermission === 1 || userPermission === 2) {
            document.querySelector("#editor").classList.remove("hidden");

            var option4 = document.createElement('option');
            option4.innerHTML = "User";

            document.getElementById('searchByResultsFilter').appendChild(option4);

            document.getElementById('searchByResultsFilter').innerHTML = "";
            var option = document.createElement('option');
            option.innerHTML = "Question Tag";
            document.getElementById('searchByResultsFilter').appendChild(option);

            var option2 = document.createElement('option');
            option2.innerHTML = "Question Word";
            document.getElementById('searchByResultsFilter').appendChild(option2);

            loadSearchChoices();

        } else if (userPermission === 3) {
            loadSearchChoices();
        }


    } else {
        //hide the search results
        document.querySelector("#rightRadio").classList.add("hidden");
    }


    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);
}
function loadSearchChoices() {

    //Search for own quiz results by quiz title words or tags, by date range, or by score range.

    var option3 = document.createElement('option');
    option3.innerHTML = "Date Range";

    document.getElementById('searchByResultsFilter').appendChild(option3);

    var option4 = document.createElement('option');
    option4.innerHTML = "Score Range";
    document.getElementById('searchByResultsFilter').appendChild(option4);

    var option5 = document.createElement('option');
    option5.innerHTML = "Quiz Tag";
    document.getElementById('searchByResultsFilter').appendChild(option5);

    var option6 = document.createElement('option');
    option6.innerHTML = "Quiz Word";
    document.getElementById('searchByResultsFilter').appendChild(option6);

}

function searchForResults() {
    var selectedSearch = document.querySelector("#searchByResultsFilter").value;
    var searchValue = document.querySelector("#searchTermResultsInput").value;
    console.log(searchValue);
    var user = localStorage.getItem('userLoggedIn');
    console.log(user);
    var userObj = JSON.parse(user);
    var permission = userObj.permissionId;
    var id = userObj.id;
    console.log(permission);
    //if its a user level logged in
    if (selectedSearch == "Quiz Tag") {
        var url = "";
        if (permission == 3) {//this means if its a user
            url = "quizmaster/account/" + id + "/results/quiz/bytag/" + searchValue;

        } else {//this means its an admin or a super

            url = "quizmaster/results/quiz/bytag/" + searchValue;
        }
        getResults(url);

    }
    if (selectedSearch == "Date Range") {
        var url = "quizmaster/results/bydate/" + searchValue;
        getResults();
    }
    if (selectedSearch == "Score Range") {
        var url = "quizmaster/quiz/byName/" + searchValue;
        getResults();
    }

    if (selectedSearch == "User") {
        var url = "quizmaster/quiz/byName/" + searchValue;
        getResults();
    }

}

function getResults(url) {
    var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== null) {
                console.log(resp);
                showResults(resp);
            } else {
                alert("Sorry, please check user name and password")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}
function showResults(resp) {
    var data = JSON.parse(resp);
    var html = "";
    for (var i = 0; i < data.length; i++) {

        var quizID = data[i].quizId;
        var userID = data[i].userId;
        var start = data[i].startTime;
        var end = data[i].endTime;
        var total = data[i].total * 100;

        html += "<div id='outputData' class='column25'><div id='searchBox'><div id='quizID'><p>Quiz ID:" + quizID + "</p></div>";
        html += "<div id='userID'><p>UserID:" + userID + "</p></div>";
        html += "<div id='start'><p>Start Time:" + start + "</p></div>";
        html += "<div id='end'><p>End Time:" + end + "</p></div>";
        html += "<div id='score'><p>Score:" + total + "</p></div>";
        html += "</div></div></div>";
    }

    document.querySelector("#output").innerHTML = html;
}
function clearFields() {
    document.querySelector("#searchTermInput").value = "";
}

function handleDisplayLogin() {
    if (document.querySelector("#loginOpt").innerHTML == "Log Out") {
        localStorage.clear();
        alert("Goodbye");
        window.location.href = 'index.php';
    }
}

function submitHandler() {

    var selectedSearch = document.querySelector("#searchByQuizFilter").value;
    var searchValue = document.getElementById("searchTermInput").value;
    console.log(searchValue);
    if (selectedSearch == "id") {
        var url = "quizmaster/quiz/" + searchValue;
        getOneQuiz(url);
    }
    if (selectedSearch == "tag") {
        var url = "quizmaster/quiz/byTag/" + searchValue;
        getMatchingQuizzes(url);
    }
    if (selectedSearch == "word") {
        var url = "quizmaster/quiz/byName/" + searchValue;
        getMatchingQuizzes(url);
    }
}

function getMatchingQuizzes(url) {
    var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== null) {
                console.log(resp);
                showMatchingQuizzes(resp);
            } else {
                alert("Sorry, please check user name and password")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}

function showMatchingQuizzes(resp) {
    var data = JSON.parse(resp);
    var html = "";
    for (var i = 0; i < data.length; i++) {

        var quizName = data[i].title;
        var description = data[i].description;
        html += "<div id='outputData' class='column25'><div id='searchBox'><div id='quizName'>" + quizName + "</div>";
        html += "<div id='quizDescription'><p>" + description + "</p></div>";
        html += "<div id='btnTakeQuiz'><a href='quiz.php?id=" + data[i].id + "'><button>Take Quiz</button></a></div></div></div></div>";
    }

    document.querySelector("#output").innerHTML = html;
    console.log(JSON.stringify(data[0]));
}
function getOneQuiz(url) {
    var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== "null") {
                console.log(resp);
                console.log(JSON.parse(resp));
                showOneQuiz(resp);
            } else {
                alert("Sorry, please check user name and password")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}
function showOneQuiz(resp) {
    var data = JSON.parse(resp);
    var quizName = data.title;
    var description = data.description;

    var html = "<div id='outputData' class='column25'><div id='searchBox'><div id='quizName'>" + quizName + "</div>";
    html += "<div id='quizDescription'><p>" + description + "</p></div>";
    html += "<div id='btnTakeQuiz'><a href='quiz.php?id=" + data.id + "'><button>Take Quiz</button></a></div></div></div></div>";

    document.querySelector("#output").innerHTML = html;
    console.log(data.id);
    document.querySelector("#searchByQuizFilter").addEventListener("change", clearFields);
}

function searchByQuiz() {
    var radChecker = document.querySelector("#radQuiz");
    radChecker.checked = true;
    document.querySelector("#searchByQuiz").classList.remove("invisible");
    document.querySelector("#searchByResults").classList.add("invisible");
}

function searchByResults() {
    var radChecker = document.querySelector("#radResult");
    radChecker.checked = true;
    document.querySelector("#searchByQuiz").classList.add("invisible");
    document.querySelector("#searchByResults").classList.remove("invisible");
}