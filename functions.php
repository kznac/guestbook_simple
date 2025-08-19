<?php
function users() {

require 'config.php';

try {
    $pdo1 = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('DB connection failed: ' . $e->getMessage());
}

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt1 = $pdo1->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt1->execute([$username, $hash]);

        echo "user successfully registered. <a href='login.php'>log in</a>";
    } else {
        echo "something went wrong...";
    }
}

// function messages() {

// require 'config.php';

// try {
//     $pdo = new PDO($dsn, $user, $pass, $options);
// } catch (PDOException $e) {
//     exit('DB connection failed: ' . $e->getMessage());
// }

//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $name = trim($_POST['name'] ?? '');
//         $message = trim($_POST['message'] ?? '');

//         if ($name && $message) {
//             $stmt = $pdo->prepare("INSERT INTO messages (name, message) Values (?, ?)");
//             $stmt->execute([$name, $message]);
//         }
//         header("Location: " . $_SERVER['PHP_SELF']);    // не даёт заново загрузить
//         exit;                                           // форму при перезагрузке
//     }

// $messages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC")->fetchALL();
// return $messages;
// }

function messages() {

require 'config.php';

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('DB connection failed: ' . $e->getMessage());
}

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $message = $_POST['message'] ?? '';

            $stmt = $pdo->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
            $stmt->execute([$userId, $message]);
            
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "please log in!";
            exit;
        }
    }

$sql = "SELECT messages.message, messages.created_at, users.username
        FROM messages
        JOIN users ON messages.user_id = users.id
        ORDER BY messages.created_at DESC";
$messages = $pdo->query($sql)->fetchAll();
return $messages;
}

function login() {
require 'config.php';

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('DB connection failed: ' . $e->getMessage());
}

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: profile.php");
            exit;
        } else {
            echo "Wrong login or password";
        }
    }
}

function dd($value) {
echo "<pre>";
var_dump($value);
echo "</pre>";

die();
}
?>