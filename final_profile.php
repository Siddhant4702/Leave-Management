<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "leave_mangt";

if (isset($_POST['faculty'])) {

  $un = $_POST["username"];
  $pw = $_POST["password"];

  $conn = mysqli_connect($servername, $username, $password, $db);
  $sql = "SELECT * FROM `profile` WHERE id='$un' && pass='$pw'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $_SESSION['username'] = $un;
    $_SESSION['password'] = $pw;
  } else {
    $_SESSION['result'] = "username or password invalid";
    $conn->close();
    header("location:home_page1.php");
  }
  $conn->close();
}

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
  $_SESSION['result'] = "please login";
  header("Location: ./home_page1.php");
}
$un = $_SESSION['username'];
$pw = $_SESSION['password'];
$conn = mysqli_connect($servername, $username, $password, $db);
if ($conn) {
  $sql = "SELECT * FROM `profile` WHERE id='$un' && pass='$pw'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
?>
    
    
    
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="icon" type=“image/png” href="/images/clg.png" />
      <link rel="stylesheet" href="CSS/final_profileStyle1.css">
      <link rel="icon" type=“image/png” href="./images/clg.png" />
      <title>Profile</title>
    </head>

    <body>
      <div  class="navbar navbar-fixed-top" id="myTopnav">
        <a href="#" style="font-size: 30px;padding-top: 20px;">Dashboard</a>
        <a href="./logout.php" id="logout_btn" style=" float: right;" >
        <input type="submit" id="logout" value="Logout" style="font-size: 30px;float: right; border: none;"></a>
        <!-- <a href="./logout.php" style="font-size: 30px;float: right;">Logout</a> -->
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
        
      </div>
    
      <div class="container-fluid" id="top" style="background-color:#f6f6fa;height: 490px;">
        <div class="row">
          <div class="col-sm-4 " style="padding-top:80px;">
          <img class="img-responsive" src="<?= $row["image"] ?> " style="float:left">
        </div>
          <div class="col-sm-8" style="padding-top:100px;"> 
            <h1 class="text-left" style="margin-top: 140px;margin-left:25px;font-size: 50px;"><b><?= $row["name"] ?> </b></h1>
            <p class="text-left"  style="font-size: 20px;margin-left: 30px;"><b>Designation :</b><?= $row["designation"] ?></p><br>
            <p class="text-left" style="font-size: 20px;margin-left: 30px;"><b>Qualification :</b><?= $row["qualification"] ?></p><br>
            <p class="text-left" style="font-size: 20px;margin-left: 30px;"><b>Experience :</b><?= $row["experience"] ?></p><br>
          </div>
        </div>
      </div>
      <div class="container-fluid" id="leave">
        <div class="row">
          <div class="col-sm-3 " style="padding-left: 50px;"> 
          <div id="t_c" class="card">
            <div class="card-container">
              <h4><b>Total Medical  Leave</b></h4><br>
              <p id="t_c_l"><?= $row["total_casual"] ?></p>
            </div>
          </div>
        </div>
        <div class="col-sm-3 " style="padding-left: 50px;">
          <div id="r_c" class="card">
            <div class="card-container">
              <h4><b>Remaining Medical Leave</b></h4>
              <p id="r_c_l"><?= $row["rem_casual"] ?></p>
            </div>
          </div>
        </div>
        <div class="col-sm-3 "  style="padding-left: 50px;">
          <div id="t_m" class="card">
            <div class="card-container">
              <h4><b>Total Casual  Leave</b></h4><br>
              <p id="t_m_l"><?= $row["total_medical"] ?></p>
            </div>
          </div>
        </div>
        <div class="col-sm-3 "  style="padding-left: 50px;">
          <div id="r_m" class="card">
            <div class="card-container">
              <h4><b>Remaining Casual Leave</b></h4>
              <p id="r_m_l"><?= $row["rem_medical"] ?></p>
            </div>
          </div>
        </div>
      </div>
      </div>

      <div class="container">
        <div class="center">
      <button class="dropdown-btn">Apply For Leave
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdown-container">
        <button class="button_leave" onclick='window.location.href="form_11.php";'>Medical Leave</button><br>
        <button class="button_leave1" onclick='window.location.href="form_22.php";'>Casual Leave</button><br>
      </div>
        </div>
      </div>
      <h2 class="text-center bg-info" style="font-size: 35px;margin-top: 100px;">Leave History </h2>
      <table>
        <tr>
          <th>sr.no.</th>
          <th>Name</th>
          <th>nature of leave</th>
          <th>From Date</th>
          <th>Till Date</th>
          <th>Reason</th>
          <th>Status</th>
        </tr>
        <!-- ************************************************************************************ -->
        <?php
        $stat = ["Pending", "Clerk Approved", "Approved", "Clerk Rejected", "Rejected"];
        // SELECT form1.staff_id,form1.name,form1.reason,form1.period_leave_req_p_s,profile.rem_casual,nature_leave, form1.status FROM `form1` INNER JOIN `profile` ON `profile`.id=`form1`.staff_id WHERE form1.status=0
        $sql = "SELECT form1.sr_no ,form1.staff_id,form1.name,form1.nature_leave,form1.leave_from,form1.leave_till,form1.reason, form1.status from form1 INNER JOIN `profile` ON `profile`.id=`form1`.`staff_id` WHERE form1.staff_id='$un';  ";
  
        $res = $conn->query($sql);
        $id = 1;
        if ($res->num_rows > 0) {
          while ($row1 = mysqli_fetch_assoc($res)) {
        ?>
            <tr>
              <td><?= $id ?></td>
              <td><?= $row1["name"] ?></td>
              <td><?=$row1["nature_leave"]?></td>
              <td><?= $row1["leave_from"] ?></td>
              <td><?= $row1["leave_till"] ?></td>
              <td><?= $row1["reason"] ?></td>
              <td><?=$stat[$row1["status"]]?></td>
            </tr>
          <?php
            $id = $id + 1;
          }
        }
        $sql = "SELECT form2.sr_no ,form2.id,form2.name,form2.leave_from,form2.leave_till,form2.reason, form2.status from form2 INNER JOIN `profile` ON `profile`.id=`form2`.id WHERE form2.id='$un';        ";
        // $sql = "select form2.sr_no,form2.id,form2.name,reason, DATEDIFF(leave_till, leave_from)+1 AS total_days,rem_medical,status from form2 INNER JOIN `profile` ON `profile`.id=`form2`.id WHERE form2.status=0";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
          while ($row1 = mysqli_fetch_assoc($res)) {
          ?>
            <tr>
              <td><?= $id ?></td>
              <td><?= $row1["name"] ?></td>
              <td>casual Leave</td>
              <td><?= $row1["leave_from"] ?></td>
              <td><?= $row1["leave_till"] ?></td>
              <td><?= $row1["reason"] ?></td>
              <td><?= $stat[$row1["status"]] ?></td>

              <td>
              </td>
            </tr>
        <?php
            $id = $id + 1;
          }
        }
        ?>
      </table>
      <!-- ********************************************************************************************** -->
      <div class="container-fluid" id="contact" style="background-color: rgb(232, 250, 232);margin-top: 100px;">
        <p style="font-size: 40px; text-align: center;margin-top: 10px;font-weight: 600;color: black;">Follow Us </p>
        <a href="#" class="fa fa-facebook "></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-linkedin"></a>
        <a href="#" class="fa fa-instagram"></a><br>
        <p style="font-size: 20px;margin-left: 50px;">Contact Us</p><i class="fa fa-phone"
          style="margin-left: 50px;margin-top: -15px; cursor: pointer;font-size: 15px">&nbsp7834056834</i><span
          style="margin-top: -15px;"></span>
        <br><i class="fa fa-envelope"
          style="margin-left: 50px;margin-top: -15px; cursor: pointer;font-size: 15px">&nbspLeavemanagement@gmail.com</i>
        <span style="margin-top: -15px;"> </span>
        <p class="text-center">© 2023 Copyright Leave Management System</p>
      </div>
      <script>
        /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
          dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
              dropdownContent.style.display = "none";
            } else {
              dropdownContent.style.display = "block";
            }
          });
        }
      </script>
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
    <?php
  }
} else {
  $_SESSION['result'] = "please login";
   echo "ERROR: $sql <br> "; // used to access key object from $con.
}
?>

