<?php

// 0 =pending
// 1=approve by clerk
// 2=approve bye hod
// 3= deny from clerk
// 4=deny from hod
session_start();
if (isset($_SESSION['result'])) {
    $res = $_SESSION['result'];
    echo "<SCRIPT> alert('$res')</SCRIPT>";
    session_unset();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/homeStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" type=“image/png” href="./images/clg.png" />
    <title title="Leave Management">Leave Management</title>

</head>

<body>
<div  class="navbar navbar-fixed-top" id="myTopnav">
    <a href="#" >Leave Management System</a>
    <a href="#" class="act active" style="margin-left: 550px;">Home</a>
    <a href="#about" style="margin-left: 35px;" class="act" title="Leave Management" >About</a>
    <a href="#contact" style="margin-left: 35px;" class="act">Contact</a>
    <a href="#login_page" style="margin-left: 35px;" class="act">Login</a>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon act" onclick="myFunction()">&#9776;</a>
  </div>
  <script>
// Add active class to the current button (highlight it)
var header = document.getElementById("myTopnav");
var btns = header.getElementsByClassName("act");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(event) {
    for(let j=0;j<btns.length;j++){
      btns[j].classList.remove("active")
    };
    event.currentTarget.classList.add('active')
  });
}
</script>
  <div class="container-fluid" style="background-color:#f6f6fa;">
    <img class="img-responsive " src="images/img1.jpg" style="float:right;margin-top: 60px;">
    <h1 class="text-left" style="margin-top: 200px;color:green;font-size: 70px;">Time for a break ?</h1>
    <h1 class="text-center" style="color:green;font-size: 70px;">Leave it to us !</h1><br>
    <p style="margin-left: 50px;">Leave your leave management worries with us. For easy , smart and paperfree</p>
    <p style="margin-left: 100px;"> leave management. Leave smarter, not harder.</p><br>
    <button type="button" class="btn" style="border:1px solid black;font-size: 25px;height: 45px;width: 180px;"><a
        href="#about" style="color: green;"><b>Learn More</b></a></button>
  </div>

    <div class="container-fluid" id="about" style="background-color:#c6c6e3;">
      <div class="row" >
        <div class="col-sm-6">
          <img src="images/im3.jpg" class="img-responsive" style="height: 450px;width: 450px;margin-right: 140px;">
        </div>
        <div class="col-sm-6">
          <div style="height: 400px;width: 600px;">
            <h1 class="text-center" style="font-size: 40px;font-weight: bold;padding-top: 100px;">About</h1>
            <p  style="font-size: 17px;">A leave management system helps in recording,managing, and
              taracking employees time-off requests.Its main objective is to handle employees leave requests
              impartially while ensuring that employees absence from work doesn't adversely impact the business.Person can apply for
              leave from anywhere at anytime without any physical process which saves time and paper process.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <h1 class="text-center bg-success">BENEFITS FOR MANAGER</h1>
      <div class="row">
        <div class="col-sm-4 "><span class="glyphicon glyphicon-ok-circle"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp<span class="par">
            Improved Productivity and efficiency of managers and staff</span>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-file"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">Easy workflow that increases efficiency by eliminating paperwork</span><br>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-time"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">Saves time and money in complex leave balance, leave and reset calculations for HR
            staff.</span>
        </div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top: 20px;">
      <div class="row">
        <div class="col-sm-4 "><span class="glyphicon glyphicon-th-list"
            style="font-size: 25px;margin-top: 20px;margin-left: 25px;"></span>&nbsp<span class="par">
            Quick view of history of leave requests and helps in
            decision making for leave approvals</span>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-lock"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">Easy to use, secure and scalable.</span>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-question-sign"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">As the system is transparent to users, it avoids unnecessary questioning and leave disputes
            with HR staff.</span>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <br><br>
      <h1 class="text-center bg-success" style="margin-top: 20px;">BENEFITS FOR EMPLOYEES</h1>
      <div class="row">
        <div class="col-sm-4 "><span class="glyphicon glyphicon-ok-circle"
            style="font-size: 25px;margin-top: 20px;margin-left: 25px;"></span>&nbsp<span class="par">
            Empower employees to view their current leave balances
            on dashboard and apply for leave online. </span>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-check"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">Get leave requests and approvals done online – saves employee time and managers time.</span>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-ok-circle"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">View forward balances of leave which helps users plan their leave ahead.</span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4 "><span class="glyphicon glyphicon-list-alt"
            style="font-size: 25px;margin-top: 20px;margin-left: 25px;"></span>&nbsp<span class="par">
            View past leave history and current status of requests and leave requests.</span>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-question-sign"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">Transparency of leave entitlements avoids unnecessary questioning of leave balances.</span>
        </div>
        <div class="col-sm-4"><span class="glyphicon glyphicon-dashboard"
            style="font-size: 25px;margin-top: 20px;margin-left: 20px;"></span>&nbsp
          <span class="par">See users on leave in their dashboard – helps in planning.</span>
        </div>
      </div>
    </div>
  </div><br><br><br>
  <div id="login_page" style="margin-top: 50px;padding-top: 50px;">
  <div class="container"  style="background-color:white;border:1px solid blue;height: 500px;width:870px;box-shadow: 0 0 10px grey;margin-top:50px">
    <div class="left"><img src="images/login.jpg" class="img-responsive" style="float:left;height: 498px;width: 550px;margin-left: -15px;"></div>

            <div class="right_login">
                <div class="form-box">
                    <div class='button-box'>
                        <div id='btn'></div>
                        <b>
                            <button type='button' onclick='login()' class='toggle-btn'><b>Faculty</b></button>
                            <button type='button' onclick='register()' class='toggle-btn'><b>Clerk</b></button>
                            <button type='button' onclick='hod()' class='toggle-btn'><b>HOD</b></button>

                    </div>
                    <form id='login' class='input-group-login' action="./final_profile.php" method="post">
                        <input type='text' id="name" name="username" class='input-field' placeholder='user Id' required>
                        <input type='password' id="pass" name="password" class='input-field' placeholder='Enter Password' required>
                        <button type='submit' class='submit-btn' value="Login" name="faculty"><b>Login</b></button>
                    </form>
                    <form id='register' class='input-group-register' action="./clerk_final.php" method="post">
                        <input type='text' name="username1" class='input-field' placeholder='user Id' required>
                        <input type='password' name="password1" class='input-field' placeholder='Enter Password' required>
                        <button type='submit' class='submit-btn' value=" clerk_login" name="clerk"><b>Login</b></button>
                    </form>
                    <form id='hod' class='input-group-hod' action="./final_hod.php" method="POST">
                        <input type='text' name="hod_user" class='input-field' placeholder='user Id' required>
                        <input type='password' name="hod_pass" class='input-field' placeholder='Enter Password' required>
                        <button type='submit' name="HOD" value="hod_login" class='submit-btn'><b>Login</b></button>
                        </b>
                    </form>
                </div>

            </div>     
  </div>
  </div>
  <div class="container-fluid" id="contact" style="background-color: rgb(232, 250, 232);margin-top: 100px;">
    <p style="font-size: 40px; text-align: center;margin-top: 10px;font-weight: 600;color: black;">Follow Us </p>
    <a href="#" class="fa fa-facebook "></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-linkedin"></a>
    <a href="#" class="fa fa-instagram"></a><br>
    <p style="font-size: 20px;margin-left: 50px;">Contact Us</p><i class="fa fa-phone"
      style="margin-left: 50px;margin-top: -15px; cursor: pointer;">&nbsp7834056834</i><span
      style="margin-top: -15px;"></span>
    <br><i class="fa fa-envelope"
      style="margin-left: 50px;margin-top: -15px; cursor: pointer;">&nbspLeavemanagement@gmail.com</i>
    <span style="margin-top: -15px;"> </span>
    <p class="text-center">© 2023 Copyright Leave Management System</p>
  </div>
  <script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"></script>
    <script src="slider22.js"></script>
    <script>
    function myFunction() {
      var x = document.getElementById("myTopnav");
      if (x.className === "navbar") {
        x.className += " responsive";
      } else {
        x.className = "navbar";
      }
    }
    </script>
</body>
</html>