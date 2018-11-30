window.onload = function () {
    document.querySelector("#signup").classList.add("hidden");
    //alert("worked");
    document.querySelector("#loginBtn").addEventListener("click", handleLogin);
     document.querySelector("#loginOpt").addEventListener("click", handleDisplayLogin);


}

//if they are logged in the, the loginOpt will say Log Out, and if they click on this
//it will clear the local storage and display a goodbye Message

function handleDisplayLogin(){
    if(document.querySelector("#loginOpt").innerHTML=="Log Out"){
         localStorage.clear();
         alert("Goodbye");
         
         window.location.href = 'index.php';
          
    }
}

function handleLogin() {
    //if use clicks the login button

    if (isFormValid()) {
        var userName = document.querySelector("#loginUser").value;
        var password = document.querySelector("#loginPass").value;
       

        var url = "quizmaster/account/login/"+userName+"/"+password;

        var method = "GET";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                if (resp.search("ERROR") >= 0) {
                    alert(resp);
                } else {
                   // console.log(resp);
                    enable(resp);
                    //save to local storage, saves as string like this
                    //{"id":1,"permissionId":1,"username":"PeterAdam","password":"quizzmaster","deactivated":0}
               localStorage.setItem("userLoggedIn", resp);
               console.log(localStorage.getItem("userLoggedIn"));
               //once logged in redirect to index page
               window.location.href = 'index.php';
               
              

                }
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send();
    }

}

function enable(resp) {
  
       
        document.querySelector("#loginOpt").innerHTML="Log Out";
        //need to change everywhere       
        document.querySelector("#profile").innerHTML="Settings";
        
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







