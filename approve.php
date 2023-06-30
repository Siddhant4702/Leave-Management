<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$servername = "localhost";
$username = "root";
$password = "";
$db = "leave_mangt";


$conn = mysqli_connect($servername, $username, $password, $db);
if ($conn) {
    $sr_no = $_POST["sr_no"];
    $status = $_POST["status"];
    $table = $_POST["table"];
    $id = $_POST["staff_id"];
    $sql = "SELECT email FROM `profile` where id= '$id'";
    $send = $conn->query($sql);
    $row1 = mysqli_fetch_assoc($send);
    $email = $row1['email'];

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'siddhantproject47@gmail.com'; //your email
    $mail->Password = 'erpribxhtlfyqbym'; //your password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('siddhantproject47@gmail.com'); //your gmail
    $mail->addAddress($email);
    $mail->isHTML(true);



    if ($status == 1) {
        $sql = "update $table set status=1 WHERE sr_no=$sr_no";
        $res = $conn->query($sql);
        $staff_id = $_POST["staff_id"];
        $name=$_POST['name'];
      
        $mail->Subject = "Leave status from Clerk "; //$_POST["subject"]; // add subject \
        $mail->Body = "<h1>Leave permission granted 👍👍</h1> </br>
        <h4><b> $name</b></h4>
        <p>Computer Science Department</hp>
        <br>
        <p> $name</p>
        <p>We have received your leave request..</p>
        <p> your leave request is approved from Clerk.</p>
        <p>Per your request, this time off will be marked as holiday.</p>
        <p>Thanks,</p><br>
        <p>Mr. Padmakar A. Patil, Senior Clerk in Computer Sc. & Engineering Department
        </br>
        <b>Wait for Final Approvel ...</b>
        </p> 
        "; //$_POST["message"];  // message
        $mail->send();
        if ($res == true) {
           
            header("Location: ./clerk_final.php");
        } else {
         
            header("Location: ./clerk_final.php");
        }
    } else if ($status == 2) {
        $sql = "update $table set status=2 WHERE sr_no=$sr_no";
        $res = $conn->query($sql);
        $total_days = $_POST["total_days"];
        $staff_id = $_POST["staff_id"];
        $name=$_POST['name'];
        if (isset($_POST["rem_casual"])) {
            $rem_casual = $_POST["rem_casual"];
            $days = $rem_casual - $total_days;
            $mail->Subject = "Leave status from HOD"; //$_POST["subject"]; // add subject \
            $mail->Body = "<h1>casual Leave permission granted👍👍</h1> </br>
            <h4><b> $name</b></h4>
            <p>Computer Science Department</hp>
            <br>
            <p> $name</p>
            <p>We have received your leave request</p>
            <p> your leave request is approved from HOD .</p>
            <p>Per your request, this time off will be marked as holiday.</p>
            <p>Thanks,</p><br>
            <p>PROF.(Dr.). DATTATRAYA V. KODAVADE, Head of Department
                </br>
                <b>Enjoy Your Leave...</b>
            </p>  
            "; //$_POST["message"];  // message
            $mail->send();
            if ($res == true) {
                $sql = "update profile set rem_casual=$days WHERE id='$staff_id'";
                $res = $conn->query($sql);
                
            }
        }
        if (isset($_POST["rem_medical"])){
            $rem_medical = $_POST["rem_medical"];
            $days = $rem_medical - $total_days;
            $mail->Subject = "Leave status from HOD"; //$_POST["subject"]; // add subject \
            $mail->Body = "<h1>medical Leave permission granted 👍👍</h1> </br>
            <h4><b> $name</b></h4>
            <p>Computer Science Department</hp>
            <br>
            <p> $name</p>
            <p>We have received your leave request for these dates: $rem_casual days.</p>
            <p> your leave request is approved.</p>
            <p>Per your request, this time off will be marked as holiday.</p>
            <p>Thanks,</p><br>
            <p>PROF.(Dr.). DATTATRAYA V. KODAVADE, Head of Department</p>
            
            
            "; //$_POST["message"];  // message
            $mail->send();
            if ($res == true) {
                $sql = "update profile set rem_medical=$days WHERE id='$staff_id'";
                $res_medical = $conn->query($sql);
                
            }
        }
        header("Location: ./final_hod.php");
    }
}
