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
        $rpassword = $_POST['rpassword'] ?? '';
        $email = $_POST['email'] ?? '';

        $errors = array();

            if (empty($username) || empty($password) || empty($rpassword) || empty($email)) {
                array_push($errors, "Fill out missing fields");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password !== $rpassword) {
                array_push($errors, "Password does not match");
            }

            if (count($errors)>0){
                foreach ($errors as $error) {
                    echo $error."<br>";
                }
            } else{

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt1 = $pdo1->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $stmt1->execute([$username, $hash, $email]);

        echo "user successfully registered. <a href='login.php'>log in</a>";
        } 
    } else {
        echo "something went wrong...";
    }
}

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

        $errors = array();

        if(empty($username)) {
            array_push($errors, "think of your username");
        }
        if(empty($password)) {
            array_push($errors, "think of your password");
        }
        if (count($errors)>0){
            foreach ($errors as $error) {
                echo $error."<br>";
            }
        } else {

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
}

function dd($value) {
echo "<pre>";
var_dump($value);
echo "</pre>";

die();
}
?>