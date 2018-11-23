window.onload = function () {
 document.querySelector("#signup").classList.add("hidden");
 //alert("worked");
document.querySelector("#loginBtn").addEventListener("click", handleLogin);
}

function handleLogin(){
  //  alert("worked");
  
  if (isFormValid()) {
      var userName=document.querySelector("#loginUser").value;
      var password=document.querySelector("#loginPass").value;
        var obj = {
            "username": userName,
            "password": password
        };
        var login=JSON.stringify(obj);
        var url = "quizmaster/account/login/"+login;
               
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
                   
                }
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send(JSON.stringify(login));
    }
}

function enable(text) {
    alert("yah!");
     document.querySelector("#centerLogin").classList.add("hidden");
     var data = JSON.parse(text);
     //now check what kind of user it ist
     //if its a super enable these
     if(data.id==1){
         
     }
     //if an admin
     if(data.id==2){
         
     }
     //if its a user
     if(data.id==3){
         
     }
}
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







