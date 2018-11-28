window.onload = function () {
 
    
  //localStorage.clear();
    
if (localStorage.getItem("userLoggedIn") !== null) {
    console.log(localStorage.getItem('userLoggedIn'));
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

