<?php
session_start();
require 'functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = login();
}
?>

<?php require('partials/head.php')?>
<?php require('partials/nav.php')?>

    <fieldset>
        <legend>Log in</legend>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="login" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                <?php if (isset($errors['username'])): ?>
                    <span class="error"><?php echo "<br>".$errors['username']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="password">
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?php echo "<br>".$errors['password']; ?></span>
                <?php endif; ?>
            </div>
            <button type="submit">Log In</button>
        </form>
    </fieldset>
    
<?php require('partials/footer.php')?>