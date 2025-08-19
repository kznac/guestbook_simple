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
</head>
<body>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="log in">
        <input type="password" name="password" placeholder="password">
        <button type="submit">register</button>
    </form>
</body>
</html>
