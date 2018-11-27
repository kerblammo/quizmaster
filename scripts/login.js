window.onload = function () {
    document.querySelector("#signup").classList.add("hidden");
    //alert("worked");
    document.querySelector("#loginBtn").addEventListener("click", handleLogin);

//test();
}

//this was just a test to make sure ajax call to get all the users was working
function test() {

    var url = "quizmaster/account"; // file name or server-side process name
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            var resp = xmlhttp.responseText;
            if (resp.search("ERROR") >= 0) {
                alert("oh no... see console for error");
                console.log(resp);
            } else {
                console.log(resp);
            }
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}

function handleLogin() {
    //  alert("worked");
if(document.querySelector("#loginOpt").innerHTML=="Login"){
    if (isFormValid()) {
        var userName = document.querySelector("#loginUser").value;
        var password = document.querySelector("#loginPass").value;
        var myObj = new Object();
        myObj.id = 999;
        myObj.username = userName;
        myObj.password = password;
        myObj.permissionId = 1;
        myObj.deactivated = 0;

        var url = "quizmaster/account/login/"+userName+"/"+password;

        var method = "GET";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                if (resp.search("ERROR") >= 0) {
                    alert(resp);
                } else {
                    console.log(resp);
                    enable(xmlhttp.responseText);
                  localStorage.setItem("user", myObj);

                }
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send(JSON.stringify(myObj));
    }
}
}

function enable(text) {
    if (text == "null") {
      alert("Please check user name and password");
    } else {
       //  window.location.href = "index.php";
        document.querySelector("#loginOpt").innerHTML="Log Out";
        //need to change everywhere       
        document.querySelector("#profile").innerHTML="Settings";
        
        document.querySelector("#centerLogin").classList.add("hidden");
        var data = JSON.parse(text);
        //now check what kind of user it ist
        //if its a super unhide the editor
        if (data.id == 1) {
            document.querySelector("#editor").classList.remove("hidden");
        }
        //if an admin
        if (data.id == 2) {
            alert("This is an admin");
        }
    }
}



//if its a user


function isFormValid() {
    if (document.querySelector("#loginUser").value == "") {
        alert('Please enter User Name');
        return false;
    } else if (document.querySelector("#loginPass").value == "") {
        alert('Please enter Password');
        return false;
    }
    return true;
}







