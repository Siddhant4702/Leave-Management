<?php
session_start();


// remove all session variables
session_unset();
// destroy the session
session_destroy();
// $_SESSION['result'] = "please login";
header("Location: ./home_page1.php");
