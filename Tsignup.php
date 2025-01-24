<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $_SESSION['registered_username'] = $username;
    $_SESSION['registered_password'] = $password;

   
    echo "<p>Registration Successful! Welcome, " . htmlspecialchars($fullname) . "</p>";
    header("Location: login_form.html");
    exit();
}
?>
