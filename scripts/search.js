window.onload = function () {
    document.querySelector('#searchbyQuizBtn').addEventListener('click', submitHandler);
    //    console.log('Handlers set');
    document.querySelector("#searchByResults").classList.add("invisible");
    document.querySelector("#leftRadio").addEventListener("click", searchByQuiz);
    document.querySelector("#rightRadio").addEventListener("click", searchByResults);
    document.querySelector("#searchByQuizFilter").addEventListener("change", clearFields);
    document.querySelector('#searchbyResultsBtn').addEventListener('click', searchForResults)


    //saveQuestion




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

      loadSearchChoices();

           
            var option4 = document.createElement('option');
            option4.innerHTML = "User";

            document.getElementById('searchByResultsFilter').appendChild(option4);

        }
          else{
        //hide the search results
        document.querySelector("#rightRadio").classList.add("hidden");
    }

    }
    if(userPermission === 3){
        loadSearchChoices();
    }
  
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);
}
function loadSearchChoices(){
          document.getElementById('searchByResultsFilter').innerHTML = "";
            var option = document.createElement('option');
            option.innerHTML = "Question Tag";

            document.getElementById('searchByResultsFilter').appendChild(option);
            var option2 = document.createElement('option');
            option2.innerHTML = "Date Range";

            document.getElementById('searchByResultsFilter').appendChild(option2);

            var option3 = document.createElement('option');
            option3.innerHTML = "Score Range";
             document.getElementById('searchByResultsFilter').appendChild(option3);
}

function searchForResults() {
    //if user is a user only show own results

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
        html += "<div id='btnTakeQuiz'><button>Take Quiz</button></div></div></div></div>";
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
    html += "<div id='btnTakeQuiz'><button>Take Quiz</button></div></div></div></div>";


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