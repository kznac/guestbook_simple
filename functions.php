<?php
    function messages() {
    require 'config.php';
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        exit('DB connection failed: ' . $e->getMessage());
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if ($name && $message) {
            $stmt = $pdo->prepare("INSERT INTO messages (name, message) Values (?, ?)");
            $stmt->execute([$name, $message]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);    // не даёт заново загрузить
        exit;                                           // форму при перезагрузке
    }

    $messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchALL();
    return $messages;
}

$messages = messages();

    function dd($value) {
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
    }
?>