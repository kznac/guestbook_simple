<?php

//function users to register new users

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
        $rpassword = $_POST['rpassword'] ?? '';
        $email = $_POST['email'] ?? '';

        $errors = array();
        $success;

            if (empty($username)) {
                $errors['username'] = "Username is required";
            }
            if (empty($email)) {
                $errors['email'] = "Email is required";
            }
            if (empty($password)) {
                $errors['password'] = "Password is required";
            }
            if (empty($rpassword)) {
                $errors['rpassword'] = "Please confirm your password";
            }
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email is not valid";
            }
            if (!empty($password) && strlen($password) < 8) {
                $errors['password'] = "Password must be at least 8 characters long";
            }
            if (!empty($password) && !empty($rpassword) && $password !== $rpassword) {
                $errors['rpassword'] = "Password does not match";
            }

            if (count($errors) > 0){
                return $errors;
            } else{

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt1 = $pdo1->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt1->execute([$username, $hash, $email]);

        return true;
        } 
    } else {
        return array();
    }
}

//function messages to save messages in database

function messages($page = 1) {

require 'config.php';

$messagesPerPage = 5; // messages to show per page
$page = max(1, intval($page)); // ensure page is at least 1
$offset = ($page - 1) * $messagesPerPage;

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

//get total count of messages
$countSql = "SELECT COUNT(*) as total FROM messages";
$countResult = $pdo->query($countSql)->fetch();
$totalMessages = $countResult['total'];
$totalPages = ceil($totalMessages / $messagesPerPage);

//get paginated messages
$sql = "SELECT messages.message, messages.created_at, users.username
        FROM messages
        JOIN users ON messages.user_id = users.id
        ORDER BY messages.created_at DESC
        LIMIT " . intval($messagesPerPage) . " OFFSET " . intval($offset);
$messageList = $pdo->query($sql)->fetchAll();

return [
    'messages' => $messageList,
    'currentPage' => $page,
    'totalPages' => $totalPages,
    'totalMessages' => $totalMessages
];
}
//function login to log the users in
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

        $errors = array();

        if(empty($username)) {
            $errors['username'] = "Think of your username";
        }
        if(empty($password)) {
            $errors['password'] = "Think of your password";
        }

        if (count($errors) > 0){
            return $errors;
        } else {

        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: profile.php");
            exit;
        } else {
            $errors['wrong'] = "Wrong Login or Password";
            return $errors;
        }
    }
    } else {
        return array();
    }
}

function dd($value) {
echo "<pre>";
var_dump($value);
echo "</pre>";

die();
}
?>