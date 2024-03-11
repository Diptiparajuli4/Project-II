<?php 
include('../config/constants.php');
//1 distroying the session 
session_destroy();//unset $_SESSION['username']

header('location:' . SITEURL . 'admin/login.php');
?>