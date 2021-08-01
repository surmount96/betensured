<?php

include "../config/database.php";

ob_start();
session_start();

    if(isset($_POST["form_submission"])){
        $username = mysqli_real_escape_string($db, $_POST["username"]);
        $password = md5(mysqli_real_escape_string($db, $_POST["password"]));
   
        $sql = "SELECT username,id FROM users WHERE username ='$username' and password='$password'";
        $auth = $db->query($sql);

        if($auth->num_rows != 1){
            $_SESSION['auth_message'] = 'Invalid credentials';
            $_SESSION['validation_time'] = time();
            header("Location: ../views/login.php");
        
        }
        $_SESSION['user_id'] = $auth->fetch_assoc()['username'];
        echo $auth->fetch_assoc()['username'];

        header('Location: ../views/fleet.php');
    }
    
?>