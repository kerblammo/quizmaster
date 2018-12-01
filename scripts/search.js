window.onload = function () {
    document.querySelector('#searchbyQuizBtn').addEventListener('click', submitHandler);
    //    console.log('Handlers set');
    document.querySelector("#searchByResults").classList.add("hidden");
    document.querySelector("#leftRadio").addEventListener("click", searchByQuiz);
    document.querySelector("#rightRadio").addEventListener("click", searchByResults);
    
         


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

function handleDisplayLogin() {
    if (document.querySelector("#loginOpt").innerHTML == "Log Out") {
        localStorage.clear();
        alert("Goodbye");
        window.location.href = 'index.php';
    }

}


function submitHandler() {
   
   var selectedSearch=document.querySelector("#searchByQuizFilter").value;
  var searchValue=document.getElementById("searchTermInput").value;
   console.log(searchValue);
    if (selectedSearch=="id") {
         var url = "quizmaster/quiz/" + searchValue;
    }
    if (selectedSearch=="tag") {
        var url = "quizmaster/quiz/byTag" + searchValue;
    }
    if (selectedSearch=="tag") {
        var url = "quizmaster/quiz/byName" + searchValue;
    }
 

        var method = "GET";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                  console.log(resp);
                if (resp !== "null") {
                    console.log(resp);

                 
                 



                } else {
                    alert("Sorry, please check user name and password")
                }
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send();

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