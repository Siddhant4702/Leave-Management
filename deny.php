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
    $sql = "update $table set status=$status WHERE sr_no=$sr_no";
    $res = $conn->query($sql);

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

    if ($res == true) {
        $mail->Subject = "Leave status"; //$_POST["subject"]; // add subject \
        $mail->Body = "<h1>leave permission rejected👎👎</h1>
            <p> Try again for another day </br>
            Leave is not granted </p>
        "; //$_POST["message"];  // message
        $mail->send();
      
        header("Location: ./clerk_final.php");
    } else {
      
        header("Location: ./clerk_final.php");
    }
    // }
    // else if ($status == 3) {
    //     $sql = "update $table set status=4 WHERE sr_no=$sr_no";
    //     $res = $conn->query($sql);
    //     if ($res == true) {
    //         echo "<script> alert('done');</script>";
    //         header("Location: ./final_hod.php");
    //     } else {
    //         echo "<script> alert('Error');</script>";
    //         header("Location: ./final_hod.php");
    //     }
    // }
}
