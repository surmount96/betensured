<?php

$dsn = "mysql:host=localhost; db_name=fleet_cruds";
$username = "root";


try {
    $db = new PDO($dsn,$username);
} catch(PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    echo "assdsad";
    // include './views/error.php';
    exit();
}