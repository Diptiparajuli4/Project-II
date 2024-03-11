<?php
session_start(); // Start the session for storing user information

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $username = $_POST["uname"];
    $password = $_POST["password"];

    // Hardcoded valid credentials for demonstration (replace with your actual authentication logic)
    $valid_username = "dipti";
    $valid_password = "12345";

    // Validate the username and password
    if ($username == $valid_username && $password == $valid_password) {
        // Authentication successful, set session variables and redirect to a dashboard or home page
        $_SESSION["username"] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Authentication failed, redirect back to the login page with an error message
        header("Location: login.html?error=1");
        exit();
    }
} else {
    // Redirect to the login page if accessed directly without a form submission
    header("Location: login.html");
    exit();
}
?>
s