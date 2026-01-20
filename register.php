<?php
require 'functions.php';
$errors = array();
$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = users();
    if ($result === true) {
        $success = true;
    } else {
        $errors = $result;
    }
}
?>

<?php require('partials/head.php')?>
<?php require('partials/nav.php')?>

    <fieldset>
        <legend>Register a new account</legend>
        <form method="POST" action="register.php">
            <div class="form-group">
                <input type="text" name="username" placeholder="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                <?php if (isset($errors['username'])): ?>
                    <span class="error"><?php echo "<br>".$errors['username']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="enter email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?php echo "<br>".$errors['email']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="password">
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?php echo "<br>".$errors['password']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="password" name="rpassword" placeholder="repeat password">
                <?php if (isset($errors['rpassword'])): ?>
                    <span class="error"><?php echo "<br>".$errors['rpassword']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <button type="submit">register</button>
                <?php if ($success==true): ?>
                    <span class="success"><?php echo "<br>user successfully registered. <a href='login.php'>log in</a>"; ?></span>
                <?php endif; ?>
            </div>
        </form>
    </fieldset>

<?php require('partials/footer.php')?>
