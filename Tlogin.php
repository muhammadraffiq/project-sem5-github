<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $registered_username = isset($_SESSION['registered_username']) ? $_SESSION['registered_username'] : null;
    $registered_password = isset($_SESSION['registered_password']) ? $_SESSION['registered_password'] : null;

    if ($username === $registered_username && $password === $registered_password) {
        
        $_SESSION['username'] = $username;
        header("Location: dash_board.php"); 
        exit();
    } else {
       
        echo "<p style='color: red; text-align: center;'>Invalid username or password. Please try again.</p>";
    }
}
?>
