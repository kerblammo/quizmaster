window.onload = function () {
    document.querySelector('#searchbyQuizBtn').addEventListener('click', submitHandler);
    //    console.log('Handlers set');
    document.querySelector("#searchByResults").classList.add("invisible");
    document.querySelector("#leftRadio").addEventListener("click", searchByQuiz);
    document.querySelector("#rightRadio").addEventListener("click", searchByResults);
    document.querySelector("#searchByQuizFilter").addEventListener("change", clearFields);
    document.querySelector('#searchbyResultsBtn').addEventListener('click', searchForResults);
    document.querySelector("#searchByResultsFilter").addEventListener("change", showHideRangeSelector);

    //saveQuestion <-- what's this comment referring to?

    if (localStorage.getItem("userLoggedIn") !== null) {
        console.log(localStorage.getItem('userLoggedIn'));
        document.querySelector("#loginOpt").innerHTML = "Log Out";
        document.querySelector("#profile").classList.remove("hidden");

        var user = localStorage.getItem('userLoggedIn');
        var userObj = JSON.parse(user);
        var userPermission = userObj.permissionId;
        globalId = userObj.id;
        globalPermLevel = userPermission;
        console.log(userPermission);
        if (userPermission === 1 || userPermission === 2) {
            document.querySelector("#editor").classList.remove("hidden");

            var option4 = document.createElement('option');
            option4.innerHTML = "User";

            document.getElementById('searchByResultsFilter').appendChild(option4);

            document.getElementById('searchByResultsFilter').innerHTML = "";

            //I don't think these are editing the correct div...
            var option = document.createElement('option');
            option.innerHTML = "Question Tag";
            document.getElementById('searchByResultsFilter').appendChild(option);

            var option2 = document.createElement('option');
            option2.innerHTML = "Question Word";
            document.getElementById('searchByResultsFilter').appendChild(option2);

            var optionlast = document.createElement('option');
            optionlast.innerHTML = "User";
            document.getElementById('searchByResultsFilter').appendChild(optionlast);
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

var globalId = 0;
var globalPermLevel = 4;

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
    
    var option7 = document.createElement('option');
    option7.innerHTML = "View All";
    document.getElementById('searchByResultsFilter').appendChild(option7);

}

function showHideRangeSelector() {
    var isDate = document.querySelector("#searchByResultsFilter").value;
    console.log(isDate);
    var html = "";
    if (isDate == "Date Range") {
        html = "<p>Min: <input type=\"date\" id=\"minDate\"> \n\
                Max: <input type=\"date\" id=\"maxDate\">";
    } else if (isDate == "Score Range") {
        html = "<p>Min: <input type=\"number\" id=\"minScore\" min=0> \n\
                Max: <input type=\"number\" id=\"maxScore\" max=100>";
    } else {
        html = "<p>Search Term:<input type=\"text\" id=\"searchTermResultsInput\">";
    }

    document.querySelector("#searchRange").innerHTML = html;
}

function searchForResults() {
    var selectedSearch = document.querySelector("#searchByResultsFilter").value;
    var minValue = 0;
    var maxValue = 0;
    console.log(selectedSearch);
    if (selectedSearch == "Date Range") {
        minValue = document.querySelector("#minDate").value;
        maxValue = document.querySelector("#maxDate").value;
    } else if (selectedSearch == "Score Range") {
        minValue = document.querySelector("#minScore").value;
        minValue /= 100;
        maxValue = document.querySelector("#maxScore").value;
        maxValue /= 100;
    } else {
        var searchValue = document.querySelector("#searchTermResultsInput").value;
    }
    console.log(searchValue);
    var user = localStorage.getItem('userLoggedIn');
    console.log(user);
    var userObj = JSON.parse(user);
    var permission = userObj.permissionId;
    var id = userObj.id;
    console.log(permission);
    //if its a user level logged in
    var url = "";

    /////THIS IS WORKING
    if (selectedSearch == "Quiz Tag") {

        if (permission == 3) {//this means if its a user
            url = "quizmaster/account/" + id + "/results/quiz/bytag/" + searchValue;

        } else {//this means its an admin or a super

            url = "quizmaster/results/quiz/bytag/" + searchValue;
        }
        getResults(url);

    }
    ///THIS IS WORKING
    if (selectedSearch == "Question Tag") {
        var url = "";

//quizmaster/results/question/bytag/
        url = "quizmaster/results/question/bytag/" + searchValue;
        getResults(url);

    }
///THIS IS WORKING
    if (selectedSearch == "Quiz Word") {
        var url = "";
        if (permission == 3) {//this means if its a user
            url = "quizmaster/account/" + id + "/results/quiz/byname/" + searchValue;

        } else {//this means its an admin or a super

            url = "quizmaster/results/quiz/byname/" + searchValue;
        }
        getResults(url);

    }


    ///THIS IS WORKING
    if (selectedSearch == "Question Word") {
        var url = "";
//quizmaster/results/question/bytag/
        url = "quizmaster/results/question/byname/" + searchValue;
        getResults(url);
    }




    ///THIS SHOULD BE NOW WORKING
    if (selectedSearch == "Date Range") {
        url = "quizmaster/account/" + globalId + "/results/bydate/" + minValue + "/" + maxValue;
        getResults(url);
    }

    //THIS SHOULD BE NOW WORKING
    if (selectedSearch == "Score Range") {
        url = "quizmaster/account/" + globalId + "/results/byscore/" + minValue + "/" + maxValue;
        getResults(url);
    }
    if (selectedSearch == "View All") {
        url = "quizmaster/account/" + globalId + "/results";
        getResults(url);
    }
    
//THIS IS WORKING
    if (selectedSearch == "User") {

//    OLD STUFF HERE, not sure if either is working yet
//        url = "quizmaster/quiz/byName/" + searchValue;
//        getResults(url);

        //quizmaster/account/([0-9]+)/results$
        //need to get the id of the user
        var username = searchValue;
        console.log(username);
        var urlName = "quizmaster/account/byName/" + username;
        console.log(url);
        //var url = "quizmaster/quiz/byName/" + searchValue;
        var userToSearch = getUser(urlName);

    }

}

var userId = "";

function getUser(url) {
    var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;

            if (resp !== null) {

                var userObj = JSON.parse(resp);
                userId = userObj[0].id;
                console.log(userId);
                var urlResults = "quizmaster/account/" + userId + "/results";
                console.log(urlResults);
                getResults(urlResults);

            } else {
                alert("Sorry, please check user name and password")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();

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
    var totalAll = 0;
    var arrScores = new Array();

    for (var i = 0; i < data.length; i++) {

        var quizID = data[i].quizId;
        var userID = data[i].userId;
        var start = data[i].startTime;
        var end = data[i].endTime;
        var total = Number(data[i].total * 100);
        arrScores.push(total);
        totalAll = total + totalAll;

        html += "<div id='outputData' class='column25'><div id='outputPanel'><div id='quizID'><p>Quiz ID:" + quizID + "</p></div>";
        html += "<div id='userID'><p>UserID:" + userID + "</p></div>";
        html += "<div id='start'><p>Start Time:" + start + "</p></div>";
        html += "<div id='end'><p>End Time:" + end + "</p></div>";
        html += "<div id='score'><p>Score:" + total + "</p></div>";
        html += "</div></div></div>";
    }
    var average = totalAll / data.length;
    var arr = arrScores;
    var min = arr[0];
    var max = arr[0];
    for (var i = 0; i < arr.length; i++) {
        if (arr[i] < min) {
            min = arr[i];
        } else if (arr[i] > max) {
            max = arr[i];
        }
    }

    html += "<div id='outputData' class='column25'><div id='outputPanel'><p>Average: " + average + "</p>";
    html += "<p>Min: " + min + "</p>";
    html += "<p>Max: " + max + "</p>";
    html += "</div></div>";



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
    if (selectedSearch == "allQuizzes") {
        var url = "quizmaster/quiz";
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
        html += "<div id='outputData' class='column25'><div id='outputPanel'><div id='quizName'>" + quizName + "</div>";
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

    var html = "<div id='outputData' class='column25'><div id='outputPanel'><div id='quizName'>" + quizName + "</div>";
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