window.onload = function () {
    document.querySelector("#signup").classList.add("hidden");
    //alert("worked");
    document.querySelector("#loginBtn").addEventListener("click", handleLogin);
    document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);
    document.querySelector("#signUp").addEventListener("click", displaySignUp);
    document.querySelector("#backtoLogin").addEventListener("click", backtoLogin);
    //signUp
    //backtoLogin


}
function backtoLogin() {
    document.querySelector("#signup").classList.add("hidden");
    document.querySelector("#login").classList.remove("hidden");
}
function displaySignUp() {
    document.querySelector("#signup").classList.remove("hidden");
    document.querySelector("#login").classList.add("hidden");
    document.querySelector("#createUser").addEventListener("click", createUser);

}

function createUser() {
    if (isFormValid("signup")) {
        var userName = document.querySelector("#signUpUser").value;
        var password = document.querySelector("#signUpPass").value;
    
//need to create a new user
        var newUser = new Object();
        newUser.id = 999;
        newUser.username = userName;
        newUser.password = password;
        newUser.permissionId = 3;
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
}
//if they are logged in the, the loginOpt will say Log Out, and if they click on this
//it will clear the local storage and display a goodbye Message

function handleDisplayLogin() {
    if (document.querySelector("#loginOpt").innerHTML == "Log Out") {
        localStorage.clear();
        alert("Goodbye");

         window.location.href="index.php";

    }
}

function handleLogin() {
    //if use clicks the login button

    if (isFormValid("login")) {
        var userName = document.querySelector("#loginUser").value;
        var password = document.querySelector("#loginPass").value;


        var url = "quizmaster/account/login/" + userName + "/" + password;

        var method = "GET";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                if (resp !== "null") {
                    console.log(resp);

                    //save to local storage, saves as string like this
                    //{"id":1,"permissionId":1,"username":"PeterAdam","password":"quizzmaster","deactivated":0}
                    localStorage.setItem("userLoggedIn", resp);
                    console.log(localStorage.getItem("userLoggedIn"));
                    //once logged in redirect to index page
                    window.location.href = 'index.php';



                } else {
                    alert("Sorry, please check user name and password")
                }
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send();
    }

}

function enable(resp) {


    document.querySelector("#loginOpt").innerHTML = "Log Out";
    //need to change everywhere       
    document.querySelector("#profile").innerHTML = "Settings";

    document.querySelector("#centerLogin").classList.add("hidden");
    var data = JSON.parse(resp);
    //now check what kind of user it ist
    //if its a super unhide the editor
    if (data.id === 1) {
        document.querySelector("#editor").classList.remove("hidden");
    }
    //if an admin
    if (data.id == 2) {
        alert("This is an admin");
    }

}



//if its a user

//need to add if page="signup"
function isFormValid(page) {
    if (page == "login") {


        document.querySelector("#UseNameError").innerHTML = "";
        document.querySelector("#passwordError").innerHTML = "";
        if (document.querySelector("#loginUser").value == "" && document.querySelector("#loginPass").value == "") {
            document.querySelector("#UseNameError").innerHTML = "Please enter a user name";
            document.querySelector("#passwordError").innerHTML = "Please enter a password";
            return false;
        }
        if (document.querySelector("#loginUser").value == "") {
            document.querySelector("#UseNameError").innerHTML = "Please enter a user name";
            return false;
        }
        if (document.querySelector("#loginPass").value == "") {
            //passwordError
            document.querySelector("#passwordError").innerHTML = "Please enter a password";
            return false;

        } else {
            return true;
        }
    } else {
        document.querySelector("#SignUpUseNameError").innerHTML = "";
        document.querySelector("#signUppasswordError").innerHTML = "";
        document.querySelector("#signUpconfirmPwdError").innerHTML = "";

        var counter = 0;
//  
        if (document.querySelector("#signUpUser").value == "") {
            document.querySelector("#SignUpUseNameError").innerHTML = "Please enter a user name";
            counter++;
        }
        if (document.querySelector("#signUpPass").value == "") {
            //passwordError
            document.querySelector("#signUppasswordError").innerHTML = "Please enter a password";
            counter++;

        }
        if (document.querySelector("#signUpConfirm").value == "") {
            //passwordError
            document.querySelector("#signUpconfirmPwdError").innerHTML = "Please re-enter a password";
            counter++;

        }
        if (document.querySelector("#signUpConfirm").value != document.querySelector("#signUpPass").value && document.querySelector("#signUpConfirm").value != "") {
            document.querySelector("#signUpconfirmPwdError").innerHTML = "Passwords dont match";
        }
        if (counter == 0) {
            return true;
        } else {
            return false;

        }
    }
}









