if(!localStorage.getItem("token")){
    window.location.href = './login.html';   
  }


  document.getElementById('logout').addEventListener('click',()=>{

    localStorage.clear()
    
    
    })




    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
    
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }

