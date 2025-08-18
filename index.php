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
require_once 'config.php';
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guestbook</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <fieldset class="firstFieldset">
        <legend>Leave a message</legend>
        <form method="POST">
            <input type="text" name="name" placeholder="Your name" required><br><br>
            <textarea name="message" placeholder="Your message" maxlength="50" required></textarea><br><br>
            <button type="submit">Send</button>
        </form>
        <fieldset class="secondFieldset">
            <legend>Messages</legend>
            <div class="messages">
                <?php foreach ($messages as $m): ?>
                    <strong><?= $m['name'] . "<br>" ?></strong>
                    <?= $m['message'] . "<br>" ?>
                    <em><?= $m['created_at'] ?></em><hr>
                <?php endforeach ?>
            </div>
        </fieldset>
    </fieldset>
</body>
</html>