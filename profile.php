<?php require('partials/head.php')?>
<?php require('partials/nav.php')?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

echo "Logged in successfuly!";
?>

<?php require('partials/footer.php')?>
