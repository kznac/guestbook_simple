<?php
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    users();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <fieldset>
        <legend>Register a new account</legend>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="log in">
            <input type="password" name="password" placeholder="password">
            <button type="submit">register</button>
        </form>
    </fieldset>
</body>
</html>
