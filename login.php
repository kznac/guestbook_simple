<?php
session_start();
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    login();
}
?>

<?php require('partials/head.php')?>
    <?php require('partials/nav.php')?>
    <form method="POST">
        <input type="text" name="username" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Log In</button>
    </form>
<?php require('partials/footer.php')?>