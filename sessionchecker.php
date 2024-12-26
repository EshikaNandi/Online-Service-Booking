<?php
require 'sessionstart.php';
if (!isset($_SESSION['users'])){
    $_SESSION['message'] = "You must be logged in to access this page.";
    header("location:home.php");
    exit;
}
?>