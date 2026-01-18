<?php
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    users();
}
?>
<?php require('partials/head.php')?>
    <?php require('partials/nav.php')?>
    <fieldset>
        <legend>Register a new account</legend>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="log in">
            <input type="password" name="password" placeholder="password">
            <button type="submit">register</button>
        </form>
    </fieldset>
<?php require('partials/footer.php')?>
