<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

echo "Logged in successfuly! <a href='logout.php'>Log out.</a> <a href='index.php'>Homepage</a>";