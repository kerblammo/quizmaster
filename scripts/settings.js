/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
window.onload = function () {
    
    document.querySelector("#btnUserGo").addEventListener("click", showUserChoice);
    document.querySelector("#btnSuperGo").addEventListener("click", showSuperChoice);
    document.querySelector("#leftRadio").addEventListener("click", showUserSettings);
    document.querySelector("#rightRadio").addEventListener("click", showSuperSettings);
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);


    if (localStorage.getItem("userLoggedIn") !== null) {

        document.querySelector("#loginOpt").innerHTML = "Log Out";
        document.querySelector("#profile").classList.remove("hidden");
        var user = localStorage.getItem('userLoggedIn');
        console.log(user);
        var userObj = JSON.parse(user);
        username = userObj.username;
        var userPermission = userObj.permissionId;
        console.log(userPermission);
        if (userPermission === 1 || userPermission === 2) {
            document.querySelector("#editor").classList.remove("hidden");
        }
        if (userPermission === 1) {
            document.querySelector("#searchBySelector").classList.remove("hidden");
        }




    }
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);
}


function handleDisplayLogin() {
    if (document.querySelector("#loginOpt").innerHTML == "Log Out") {
        localStorage.clear();
        alert("Goodbye");
        window.location.href="index.php";
    }

}

function showUserSettings() {
    var radChecker = document.querySelector("#radSettingsUser");
    radChecker.checked = true;
    document.querySelector("#userSettings").classList.remove("invisible");
    document.querySelector("#superSettings").classList.add("invisible");
}

function showSuperSettings() {
    var radChecker = document.querySelector("#radSettingsAdmin");
    radChecker.checked = true;
    document.querySelector("#userSettings").classList.add("invisible");
    document.querySelector("#superSettings").classList.remove("invisible");
}

function showUserChoice(){
    var selected = document.querySelector("#userSettingsSelect").value;
    console.log(selected);
    hideAllSettings();
    document.getElementById(selected).classList.remove("hidden");
}

function showSuperChoice(){
    var selected = document.querySelector("#superSettingsSelect").value;
    console.log(selected);
    hideAllSettings();
    document.getElementById(selected).classList.remove("hidden");
}

function hideAllSettings(){
    document.querySelector("#userSettingsUsername").classList.add("hidden");
    document.querySelector("#userSettingsPassword").classList.add("hidden");
    document.querySelector("#userSettingsDelete").classList.add("hidden");
    document.querySelector("#superSettingsCreate").classList.add("hidden");
    document.querySelector("#superSettingsPassword").classList.add("hidden");
    document.querySelector("#superSettingsDelete").classList.add("hidden");
}