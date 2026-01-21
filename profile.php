<?php
session_start();

require('partials/head.php');
require('partials/nav.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

echo "Logged in successfuly!";
?>

<?php require('partials/footer.php')?>
