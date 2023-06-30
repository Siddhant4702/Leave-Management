<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "leave_mangt";

$conn = mysqli_connect($servername, $username, $password, $db);
if ($conn){
    $id=$_POST['record'];

     $id=trim($id);
     echo "THe id is " . $id ."   " . strlen($id);
    $sql="DELETE FROM `profile` WHERE id='$id'";
    $res = $conn->query($sql);
    // if ($res == true) {
    //     echo "<script> alert('Remove Succesfully');</script>";
    // } else {
    //     echo "<script> alert('Error');</script>";
    // }

}
else{
  echo"Connection failed";
}
//  header("Location: ./removeFaculty.php");
header("Location: ./clerk_final.php");
?>

