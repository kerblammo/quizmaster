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
    
    //document.querySelector("#btnUserUsername").addEventListener("click", changeOwnName);
    document.querySelector("#btnUserPassword").addEventListener("click", changeOwnPassword);
    document.querySelector("#btnUserDelete").addEventListener("click", changeOwnDelete);
    document.querySelector("#btnSuperCreate").addEventListener("click", changeOtherCreate);
    document.querySelector("#btnSuperPassword").addEventListener("click", changeOtherPassword);
    document.querySelector("#btnSuperDelete").addEventListener("click", changeOtherDelete);
    

    if (localStorage.getItem("userLoggedIn") !== null) {

        document.querySelector("#loginOpt").innerHTML = "Log Out";
        document.querySelector("#profile").classList.remove("hidden");
        var user = localStorage.getItem('userLoggedIn');
        console.log(user);
        var userObj = JSON.parse(user);
        username = userObj.username;
        userID = userObj.id;
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

var userID = 0;
var username = "";
var method = "GET";
var userObj;

function changeOwnPassword(){
    console.log("Entering changeOwnPassword...");
    var newPassword = document.querySelector("#userNewPassword").value;
    var url = "quizmaster/account/" + userID + "/" + newPassword;
    method = "PUT";
    
    userObj = {
            "id": userID,
            "username": "0",
            "password": newPassword,
            "permissionId": 0,
            "deactivated": 0
    };
    
    changePassword(url);
    window.location = "profile.php";
}

function changeOwnDelete(){
    console.log("Entering changeOwnDelete...");
    var url = "quizmaster/account/" + userID;
    method = "DELETE";
    getMatchingAccounts(url);
    window.location = "login.php";
}

function changeOtherCreate(){
        var userName = document.querySelector("#signUpUser").value;
        var password = document.querySelector("#signUpPass").value;
        var permLevel = document.querySelector("#permLevel").value;
        if (permLevel == "User") {
            permLevel = 3;
            
        } else if (permLevel == "Admin") {
            permLevel = 2;
            
        } else if (permLevel == "Super") {
            permLevel = 1;
            
        }
    
        var newUser = new Object();
        newUser.id = 999;
        newUser.username = userName;
        newUser.password = password;
        newUser.permissionId = permLevel;
        newUser.deactivated = 0;
        var url = "quizmaster/account";

        var method = "POST";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                if (resp !== "null") {
                    console.log(resp);

                    //save to local storage, saves as string like this
                    //{"id":1,"permissionId":1,"username":"PeterAdam","password":"quizzmaster","deactivated":0}
                    localStorage.setItem("userLoggedIn", JSON.stringify(newUser));
                    console.log(localStorage.getItem("userLoggedIn"));
                    //once logged in redirect to index page
                    window.location.href = 'index.php';

                } else {
                    alert("Sorry, please check user name and password")
                }
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send(JSON.stringify(newUser));
    
}

function changeOtherPassword(){
    console.log("Entering changeOtherPassword...");
    var allAccountsArr = document.querySelectorAll("#allAccounts");
    var newPassword = document.querySelector("#superNewPassword").value;
    accountId = allAccountsArr[0].value;
    console.log(accountId);
    var url = "quizmaster/account/" + accountId + "/" + newPassword;
    method = "PUT";
    
    userObj = {
            "id": accountId,
            "username": "0",
            "password": newPassword,
            "permissionId": 0,
            "deactivated": 0
    };
    
    changePassword(url);
    window.location = "profile.php";
}

function changePassword(url) {
    
    console.log("Entering changePassword..." + url);
    //var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== null) {
                console.log(resp);
                //showMatchingAccounts(resp);
            } else {
                alert("Sorry, accounts not loaded. Check permission level.")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send(JSON.stringify(userObj));
}

function changeOtherDelete(){
    console.log("Entering changeOtherDelete...");
    var allAccountsArr = document.querySelectorAll("#allAccounts");
    accountId = allAccountsArr[1].value;
    var url = "quizmaster/account/" + accountId;
    method = "DELETE";
    getMatchingAccounts(url);
    window.location = "profile.php";
}

function loadAllAccounts() {
    console.log("Entering loadAllAccounts...");
    var url = "quizmaster/account";
    method = "GET";
    getMatchingAccounts(url);
}

function getMatchingAccounts(url) {
    
    console.log("Entering getMatchingAccounts..." + url);
    //var method = "GET";

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            console.log(resp);
            if (resp !== null) {
                console.log(resp);
                showMatchingAccounts(resp);
            } else {
                alert("Sorry, accounts not loaded. Check permission level.")
            }
        }
    };
    xmlhttp.open(method, url, true);
    xmlhttp.send();
}

function showMatchingAccounts(resp) {
    
    console.log("Entering showMatchingAccounts..." + resp);
    searchQuizResultsArr = [];
    var data = JSON.parse(resp);
    var html = "";
    for (var i = 0; i < data.length; i++) {

        var userName = data[i].username;
        var id = data[i].id;
        
        html += "<option id=\"loadedAccount\" value=\"" + id + "\">" + userName + "</option>";
        
        searchQuizResultsArr.push(data[i]);
        
    }
    console.log(html);
    var allAccountsArr = document.querySelectorAll("#allAccounts");
    for (var i = 0; i < allAccountsArr.length; i++) {
        allAccountsArr[i].innerHTML = html;
    }
    console.log(data[0] + " ***********************************");    
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
    loadAllAccounts();
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