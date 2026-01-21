<?php
    // Database Configuration
    // Copy this file to config.php and fill in your own credentials
    
    $host = '127.0.0.1';
    $db = 'guestbook_simple';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
?>
