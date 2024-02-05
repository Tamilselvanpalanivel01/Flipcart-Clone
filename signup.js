
function Signup() {
   var username = document.getElementById("snaam").value;
   var mobile = document.getElementById("sphone").value;
   var password = document.getElementById("spass").value;
   var cpassword = document.getElementById("cspass").value;
   var email = document.getElementById("sgmail").value;
   var DOB = document.getElementById("DOB").value;
   var gender = document.querySelector('input[name="gender"]:checked');
   var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
   var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;


   $("#nameerror").text("");
   $("#lastnameerror").text("");
   $("#mobileerror").text("");
   $("#emailerror").text("");
   $("#passworderror").text("");
   $("#DOBerror").text("");
   $("#gendererror").text("");
   $("#passworderror").text("");

   var existingUserData = JSON.parse(localStorage.getItem("usersdata")) || [];
   var existingUser = existingUserData.find(user => user.email === email || user.mobile === mobile || user.password === password);

   if (existingUser) {
      alert("You already have an account with the provided email, mobile, or password.");
      document.getElementById("snaam").value = "";
      document.getElementById("sphone").value = "";
      document.getElementById("spass").value = "";
      document.getElementById("sgmail").value = "";
      document.getElementById("DOB").value = "";
      document.getElementById("cspass").value = "";
      document.querySelector('input[name="gender"]:checked').checked = false;
      return;
   }

   if (username == "") {
      $("#nameerror").text("Please enter your name");
      $("#nameerror").css("color", "red");
      return;
   }
   else if (mobile === "" || !/^\d{10}$/.test(mobile)) {
      $("#mobileerror").text("Please enter a valid 10-digit mobile number");
      $("#mobileerror").css("color", "red");
      return;
   }

   else if (email == "") {
      $("#emailerror").text("Please enter email");
      $("#emailerror").css("color", "red");
      return;
   }
   else if (!emailPattern.test(email)) {
      $("#emailerror").text("Please enter a valid email");
      $("#emailerror").css("color", "red");
      return;
   }
   else if (password == "") {
      $("#passworderror").text("Please enter password");
      $("#passworderror").css("color", "red");
      return;
   }
   else if(!passwordPattern.test(password)){
      $("#passworderror").text("Please enter valid password");
      $("#passworderror").css("color", "red");
      return;
   }
   else if(cpassword==""){
      $("#rpassworderror").text("Please re-enter password");
      $("#rpassworderror").css("color", "red");
      return;
   }
   else if(cpassword!==password){
      $("#rpassworderror").text("Please re-enter password mismatch");
      $("#rpassworderror").css("color", "red");
      return;
   }
   
   else if (DOB == "") {
      $("#DOBerror").text("Please enter date of birth");
      $("#DOBerror").css("color", "red");
      return;
   }
   else if (!gender) {
      $("#gendererror").text("Please select gender");
      $("#gendererror").css("color", "red");
      return;
   }
   else {
      // var existingUserData = JSON.parse(localStorage.getItem("usersdata")) || [];
      var newUser = {
         username: username,
         email: email,
         mobile: mobile,
         password: password,
         cpassword:cpassword,
         DOB: DOB,
         gender: gender.value,
      };
      $.ajax({
         type:'post',
         url:'insert.php',
         data:newUser,
         cache:false,
         processData:false,
         contentType:false,
         success:function(response){
            console.log(response)
         }

      })












      // existingUserData.push(newUser);
      // localStorage.setItem("usersdata", JSON.stringify(existingUserData));


   }
   alert("Signup Successful");
   // document.getElementById("snaam").value = "";
   // document.getElementById("sphone").value = "";
   // document.getElementById("spass").value = "";
   // document.getElementById("rpassworderror")="";
   // document.getElementById("sgmail").value = "";
   // document.getElementById("DOB").value = "";
   // document.querySelector('input[name="gender"]:checked').checked = false;

   document.getElementById("snaam").value = "";
   document.getElementById("sphone").value = "";
   document.getElementById("spass").value = "";
   document.getElementById("sgmail").value = "";
   document.getElementById("DOB").value = "";
   document.getElementById("cspass").value = "";
   document.querySelector('input[name="gender"]:checked').checked = false;

   document.getElementById("outerbox").style.display = 'none';
   document.getElementById("outerboxsign").style.display = 'block';
}

document.getElementById("snaam").addEventListener("input", function () {
   $("#nameerror").text("");
});

document.getElementById("sphone").addEventListener("input", function () {
   $("#mobileerror").text("");
});

document.getElementById("sgmail").addEventListener("input", function () {
   $("#emailerror").text("");
});

document.getElementById("spass").addEventListener("input", function () {
   $("#passworderror").text("");
});

document.getElementById("DOB").addEventListener("input", function () {
   $("#DOBerror").text("");
});
document.getElementById("cspass").addEventListener("input", function () {
   $("#rpassworderror").text("");
});



function toggleSections() {
   var signupBox = document.getElementById('outerbox');
   var loginBox = document.getElementById('outerboxsign');

   if (signupBox.style.display === 'none') {
      signupBox.style.display = 'block';
      loginBox.style.display = 'none';
   } else {
      signupBox.style.display = 'none';
      loginBox.style.display = 'block';
   }
}



function Signin() {
   let lmobile = document.getElementById("lphone").value;
   let passwordElement = document.getElementById("lpass").value;
   var existingUserData = JSON.parse(localStorage.getItem("usersdata")) || [];
   var userFound = existingUserData.some(user => user.mobile === lmobile && user.password === passwordElement);



   if (lmobile.length !== 10) {
      $("#lmerror").text("Mobile number should be of 10 digits");
      $("#lmerror").css("color", "red")
   } else if (lmobile.length === 0) {
      $("#lmerror").text("Enter Mobile Number");
      $("#lmerror").css("color", "red")
   } else if (passwordElement === "") {
      $("#lperror").text("Enter password");
      $("#lperror").css("color", "red")
   } else if (userFound) {

      var userData = existingUserData.find(user => user.mobile === lmobile);
      var userName = userData.username;
      $(".navtab .sell").text(userName);
      localStorage.setItem("lastLoggedInUser", userName);
      window.location.href="index.php";
      $("#outerboxsign").hide();
    
      $("#sigin_button").hide();
      $("#signout").show();
   }
   else {
      alert("Invalid credentials and give correct mob or password")
   }

}


document.getElementById("lphone").addEventListener("input", function () {
   $("#lmerror").text("");
});

document.getElementById("lpass").addEventListener("input", function () {
   $("#lperror").text("");
});








document.addEventListener("DOMContentLoaded", function () {
   var lastLoggedInUser = localStorage.getItem("lastLoggedInUser");
   if (lastLoggedInUser) {
      $(".navtab .sell").text(lastLoggedInUser);
      $("#sigin_button").hide();
      $("#signout").show();
   }
});


document.getElementById("close").addEventListener("click", function (e) {
   var confirmClose = confirm("Are you sure you want to close?");
   e.preventDefault();
   if (confirmClose) {
      window.location.href="index.php";
      $("#outerboxsign").hide();     
   }
});



function signOut() {
   localStorage.removeItem("lastLoggedInUser");
   $(".navtab button#signout").hide();
   $("#sigin_button").show();
   $(".navtab .sell").hide();
}


  function eye(){
     var passwordInput = $("#spass");
     var eyeIcon = $("#eye");

     if (passwordInput.attr("type") === "password") {
       passwordInput.attr("type", "text");
       eyeIcon.removeClass("fa-eye").addClass("fa-eye-slash");
     } else {
       passwordInput.attr("type", "password");
       eyeIcon.removeClass("fa-eye-slash").addClass("fa-eye");
     }
   };

