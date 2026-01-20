<?php
session_start();
require_once 'functions.php';
$messages = messages();
?>

<?php require('partials/head.php')?>
<?php require('partials/nav.php')?>

    <fieldset class="firstFieldset">
        <legend>Leave a message</legend>
        <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST">
            <textarea name="message" placeholder="Your message" maxlength="50" required></textarea><br><br>
            <button type="submit">Send</button>
        </form>
        <?php else: ?>
            <p>In order to leave a message <a href="login.php">Log In</a> or <a href="register.php">Register</a></p>
        <?php endif;?>
        <fieldset class="secondFieldset">
            <legend>Messages</legend>
            <div class="messages">
                <?php foreach ($messages as $m): ?>
                    <strong><?= $m['username'] . "<br>" ?></strong>
                    <?= $m['message'] . "<br>" ?>
                    <em class="left"><?= $m['created_at'] ?></em><hr>
                <?php endforeach ?>
            </div>
        </fieldset>
    </fieldset>

<?php require('partials/footer.php')?>