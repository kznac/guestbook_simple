<?php
// $filename = 'messages.txt';

// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $name = htmlspecialchars($_POST['name']);
//     $message = htmlspecialchars($_POST['message']);
//     $entry = "<div>$name: $message<?div>\n";
//     file_put_contents($filename, $entry, FILE_APPEND);
// }

// $messages = file_exists($filename) ? file_get_contents($filename) : '';

//старый вариант, где я сохранял всё в текстовый документ.
session_start();
require_once 'functions.php';
$messages = messages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .register {
        position: absolute;
        margin: 0;
        padding: 0;
        top: 10px;
        left: 10px;
    }
</style>
<body>
    <header>
        <div class="register">
        <a href="register.php">register</a>
        </div>
    </header>
    <fieldset class="firstFieldset">
        <legend>Leave a message</legend>
        <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST">
            <textarea name="message" placeholder="Your message" maxlength="50" required></textarea><br><br>
            <button type="submit">Send</button>
        </form>
        <?php else: ?>
            <p>Чтобы оставлять сообщения, <a href="login.php">войдите</a> или <a href="register.php">зарегистрируйтесь</a></p>
        <?php endif;?>
        <fieldset class="secondFieldset">
            <legend>Messages</legend>
            <div class="messages">
                <?php foreach ($messages as $m): ?>
                    <strong><?= $m['username'] . "<br>" ?></strong>
                    <?= $m['message'] . "<br>" ?>
                    <em><?= $m['created_at'] ?></em><hr>
                <?php endforeach ?>
            </div>
        </fieldset>
    </fieldset>
</body>
</html>