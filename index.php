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
    <style> 
    .messages {
        display: flex;
        flex-direction: column; 
        gap: 10px;
    }

    fieldset .main {
        width: 30%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        border-width: 3px;
    }

    body {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }

    textarea {
        resize: none;
        height: 50px;
    }
    
    .messages hr {
        width: 100%;
        border: none;
        border-top: 1.5px solid #888;
        margin: 8px 0;
    }
    </style>
</head>
<body>
    <fieldset class="main">
        <legend>Leave a message</legend>
        <form method="POST">
            <input type="text" name="name" placeholder="Your name" required><br><br>
            <textarea name="message" placeholder="Your message" maxlength="50" required></textarea><br><br>
            <button type="submit">Send</button>
        </form>
        <fieldset>
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