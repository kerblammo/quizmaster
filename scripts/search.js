window.onload = function () {
    document.querySelector('#searchbyQuizBtn').addEventListener('click', submitHandler);
    //    console.log('Handlers set');
    document.querySelector("#searchByResults").classList.add("hidden");
    document.querySelector("#leftRadio").addEventListener("click", searchByQuiz);
    document.querySelector("#rightRadio").addEventListener("click", searchByResults);
     document.querySelector("#searchByQuizFilter").addEventListener("change", clearFields);




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
        }

    }
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);
}
function clearFields(){
    document.querySelector("#searchTermInput").value="";
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
            if (resp !== "null") {
                console.log(resp);
                showMatchinQuizzes(resp);
            } else {
                alert("Sorry, please check user name and password")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}
function showMatchinQuizzes(resp) {
    var data = JSON.parse(resp);
    var html = "";
    for (var i = 0; i < data.length; i++) {

        var quizName = data[i].title;
        var description = data[i].description;
        html += "<div id='outputData' class='column25'><div id='searchBox'><div id='quizName'>" + quizName + "</div>";
        html += "<div id='quizDescription'><p>" + description + "</p></div>";
        html += "<div id='btnTakeQuiz'><button>Take Quiz</button></div></div></div></div>";
    }

    document.querySelector("#output").innerHTML = html;
    console.log(data[0].id);
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
    html += "<div id='btnTakeQuiz'><button>Take Quiz</button></div></div></div></div>";


    document.querySelector("#output").innerHTML = html;
    console.log(data.id);
      document.querySelector("#searchByQuizFilter").addEventListener("change", clearFields);
}
function searchByQuiz() {
    var radChecker = document.querySelector("#radQuiz");
    radChecker.checked = true;
    document.querySelector("#searchByQuiz").classList.remove("hidden");
    document.querySelector("#searchByResults").classList.add("hidden");
}

function searchByResults() {
    var radChecker = document.querySelector("#radResult");
    radChecker.checked = true;
    document.querySelector("#searchByQuiz").classList.add("hidden");
    document.querySelector("#searchByResults").classList.remove("hidden");
}