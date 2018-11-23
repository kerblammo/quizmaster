window.onload = function () {
 document.querySelector("#signup").classList.add("hidden");
 //alert("worked");
document.querySelector("#loginBtn").addEventListener("click", handleLogin);
}

function handleLogin(){
  //  alert("worked");
  
  if (isFormValid()) {
      var userName=querySelector("#loginUser").value;
      var password=querySelector("#loginPass").value;
        var obj = {
            "username": userName,
            "password": password
        };


        var url = "quizmaster/account/userName";
        var method = "POST";

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                var resp = xmlhttp.responseText;
                if (resp.search("ERROR") >= 0) {
                    alert(resp);
                } else {
                    enable();
                   
                }
            }
        };
        xmlhttp.open(method, url, true);
        xmlhttp.send(JSON.stringify(obj));
    }
}

function enable() {
     document.querySelector("#centerLogin").classList.add("hidden");
     
}
function isFormValid() {
    if (document.querySelector("#loginUser").value == "") {
        alert('Please enter User Name');
        return false;
    } else if (document.querySelector("#loginPass").value == "") {
        alert('Please enter Password');
        return false;
    } else if (isset(document.querySelector("#loginConfirm"))) {
        if((document.querySelector("#loginConfirm").value == ""))
        alert('Please confirm Password');
        return false;
    }
    return true;
}







