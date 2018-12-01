window.onload = function () {
//user is saved in local storage as a user object
//{"id":1,"permissionId":1,"username":"PeterAdam","password":"quizzmaster","deactivated":0}


    if (localStorage.getItem("userLoggedIn") !== null) {

        document.querySelector("#loginOpt").innerHTML = "Log Out";
        document.querySelector("#profile").classList.remove("hidden");
        var user = localStorage.getItem('userLoggedIn');
        console.log(user);
        var userObj = JSON.parse(user);
        username = userObj.username;
        var html = "Hey " + username + ", check our these quizzes!";
        document.querySelector("#greeting").innerHTML = html;
        var userPermission = userObj.permissionId;
        console.log(userPermission);
        if (userPermission === 1 || userPermission === 2) {
            document.querySelector("#editor").classList.remove("hidden");
        }




    }
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);
}




