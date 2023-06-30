<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$db = "leave_mangt";

if (isset($_POST['clerk'])) {
  $cu = $_POST["username1"];
  $cp = $_POST["password1"];

  $conn = mysqli_connect($servername, $username, $password, $db);
  $sql = "SELECT * FROM `clerk` WHERE id_c='$cu' && pass_c ='$cp'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION['username1'] = $cu;
    $_SESSION['password1'] = $cp;
  } else {
    $_SESSION['result'] = "username or password invalid";
    $conn->close();
    header("location:home_page1.php");
  }
  $conn->close();
}
if (!isset($_SESSION['username1']) && !isset($_SESSION['password1'])) {
  $_SESSION['result'] = "please login";
  header("Location: ./home_page1.php");
}
$cu = $_SESSION['username1'];
$cp = $_SESSION['password1'];
$conn = mysqli_connect($servername, $username, $password, $db);
if ($conn) {
  $sql = "SELECT * FROM `clerk` WHERE id_c='$cu' && pass_c ='$cp'";
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
      <link rel="stylesheet" href="CSS/clerk.css">
      <link rel="icon" type=“image/png” href="./images/clg.png" />
      <title>Clerk</title>
    </head>

    <body>
    <div  class="navbar navbar-fixed-top" id="myTopnav">
        <a href="#" style="font-size: 30px;padding-top: 20px;">Dashboard</a>
        <a href="./logout.php" style="font-size: 30px;float: right;">
        <input type="submit" id="logout" value="Logout" style="font-size: 30px;float:left;">
         </a>
    <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
        
      </div>
      <div class="container-fluid" id="top" style="background-color:#f6f6fa;height: 490px;">
        <div class="row">
          <div class="col-sm-4 " style="padding-top:80px;">
            <img class="img-responsive" src="data:image/jpeg;base64,<?= base64_encode($row["img"]) ?>" style="float:left ">
          </div>
          <div class="col-sm-8" style="padding-top:100px;"> 
            <h1 class="text-left" style="margin-top: 140px;margin-left:25px;font-size: 50px;"><b><?= $row["name"] ?> </b></h1>
            <p class="text-left"  style="font-size: 20px;margin-left: 30px;"><b>Designation :</b><?= $row["designation"] ?></p><br>
            <p class="text-left" style="font-size: 20px;margin-left: 30px;"><b>Qualification :</b><?= $row["qualification"] ?></p><br>
            <p class="text-left" style="font-size: 20px;margin-left: 30px;"><b>Experience :</b><?= $row["experience"] ?></p><br>
          </div>
        </div>
      </div>
      <div class="editDatabase">
        <button class="addnewFaculty" onclick='window.location.href="addNewFaculty.php";'>Add new Faculty</button><br>
        <button class="removeFaculty" onclick='window.location.href="removeFaculty.php";'>Remove Faculty</button><br>
        </div>

      <h2 style="font-size: 30px;margin-top: 50px;margin-left: 20px;">Application :</h2>
      <table>
        <tr>
          <th>sr.no.</th>
          <th>Name</th>
          <th>Reason</th>
          <th>Leave Type</th>
          <th>Remaining Leave</th>
          <!-- <th>details</th> -->
          <th>Status</th>
        </tr>
        <?php
        // SELECT form1.staff_id,form1.name,form1.reason,form1.period_leave_req_p_s,profile.rem_casual,nature_leave, form1.status FROM `form1` INNER JOIN `profile` ON `profile`.id=`form1`.staff_id WHERE form1.status=0
        $sql = "SELECT form1.sr_no, form1.staff_id,form1.name,form1.reason,form1.period_leave_req_p_s,profile.rem_casual,nature_leave FROM `form1` INNER JOIN `profile` ON `profile`.id=`form1`.staff_id WHERE form1.status=0";
        $res = $conn->query($sql);
        $id = 1;
        if ($res->num_rows > 0) {
          while ($row1 = mysqli_fetch_assoc($res)) {
        ?>
            <tr>
              <td><?= $id ?></td>
              <td><?= $row1["name"] ?></td>
              <td><?= $row1["nature_leave"] ?></td>
              <td>Medical Leave</td>
              <td><?= $row1["rem_casual"] ?></td>
              <!-- <td>NONE..</td> -->
              <td>
                <div class="accept" style="display:flex;">
                  <form action="./approve.php" method="post">
                    <input type="hidden" value="<?= $row1["sr_no"] ?>" name="sr_no">
                    <input type="hidden" value="<?= $row1["staff_id"] ?>" name="staff_id">
                    <input type="hidden" value="<?= $row1["name"] ?>" name="name">
                    <input type="hidden" value="1" name="status">
                    <input type="hidden" value="form1" name="table">
                    <button class="btn_lower" type="submit" style=" cursor:pointer">Accept</button>
                  </form>
                  <br>
                  <span style="width:8px"></span>
                  <form action="./deny.php" method="post">
                    <input type="hidden" value="<?= $row1["sr_no"] ?>" name="sr_no">
                    <input type="hidden" value="<?= $row1["staff_id"] ?>" name="staff_id">
                    <input type="hidden" value="<?= $row1["name"] ?>" name="name">
                    <input type="hidden" value="3" name="status">
                    <input type="hidden" value="form1" name="table">
                    <button class="btn_lower1" type="submit" style=" cursor:pointer">Reject</button>
                  </form>
                </div>
              </td>
            </tr>
          <?php
            $id = $id + 1;
          }
        }

        $sql = "select form2.sr_no,form2.id,form2.name,reason, DATEDIFF(leave_till, leave_from)+1 AS total_days,rem_medical,status from form2 INNER JOIN `profile` ON `profile`.id=`form2`.id WHERE form2.status=0";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
          while ($row1 = mysqli_fetch_assoc($res)) {
          ?>
            <tr>
              <td><?= $id ?></td>
              <td><?= $row1["name"] ?></td>
              <td><?= $row1["reason"] ?></td>
              <td>Casual Leave</td>
              <td><?= $row1["rem_medical"] ?></td>
              <!-- <td>NONE..</td> -->
              <td>
                <div class="accept" style="display:flex;">
                  <form action="./approve.php" method="post">
                    <input type="hidden" value="<?= $row1["sr_no"] ?>" name="sr_no">
                    <input type="hidden" value="<?= $row1["id"] ?>" name="staff_id">
                    <input type="hidden" value="<?= $row1["name"] ?>" name="name">
                    <input type="hidden" value="1" name="status">
                    <input type="hidden" value="form2" name="table">
                    <button class="btn_lower" type="submit" style=" cursor:pointer">Accept</button>
                  </form>
                  <br>
                  <span style="width:8px"></span>
                  <form action="./deny.php" method="post">
                    <input type="hidden" value="<?= $row1["sr_no"] ?>" name="sr_no">
                    <input type="hidden" value="<?= $row1["id"] ?>" name="staff_id">
                    <input type="hidden" value="<?= $row1["name"] ?>" name="name">
                    <input type="hidden" value="3" name="status">
                    <input type="hidden" value="form2" name="table">
                    <button class="btn_lower1" type="submit" style=" cursor:pointer">Reject</button>
                  </form>
                </div>
              </td>
            </tr>
        <?php
            $id = $id + 1;
          }
        }
        ?>
      </table>
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
  } else {
    $_SESSION['result'] = "please login";
    echo "<script> alert('Failed !!!!!!');</script>";
    echo "ERROR: $sql <br> "; // used to access key object from $con.
    // echo "Can not logined";
    // header("Location: ./home_page1.php");
  }
}
?>


