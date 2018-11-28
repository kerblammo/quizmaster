window.onload = function () {
 
    
 //localStorage.clear();
   //trying to check if user was saved into local storage from login page 
if (localStorage.getItem("userLoggedIn") !== null) {
    console.log(localStorage.getItem('userLoggedIn'));
      document.querySelector("#loginOpt").innerHTML="Log Out";
        //need to change everywhere       
        document.querySelector("#profile").innerHTML="Settings";
        
   
       
      
    }
}

