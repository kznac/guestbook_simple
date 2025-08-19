<?php
session_start();
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    login();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Log In</button>
    </form>
</body>
</html>