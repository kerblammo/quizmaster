window.onload = function () {
    document.querySelector('#searchQuiz').addEventListener('click', submitHandler);
    //    console.log('Handlers set');
    document.querySelector("#searchByResults").classList.add("hidden");
        document.querySelector("#leftRadio").addEventListener("click",searchByQuiz);//searchByQuiz
    document.querySelector("#rightRadio").addEventListener("click",searchByResults);//searchByResults


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

}
function searchByQuiz(){
    var radChecker = document.querySelector("#radQuiz");
    radChecker.checked = true;
  document.querySelector("#searchByQuiz").classList.remove("hidden");
    document.querySelector("#searchByResults").classList.add("hidden");
}

function searchByResults(){
    var radChecker = document.querySelector("#radResult");
    radChecker.checked = true;
    document.querySelector("#searchByQuiz").classList.add("hidden");
    document.querySelector("#searchByResults").classList.remove("hidden");
    
    
}