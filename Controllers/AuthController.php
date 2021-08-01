<?php

include "../config/database.php";

ob_start();
session_start();

    //Verify where the submit button name
    if(isset($_POST["form_submission"])){
        $username = mysqli_real_escape_string($db, $_POST["username"]);
        $password = md5(mysqli_real_escape_string($db, $_POST["password"]));
   
        //verify if the details exist
        $sql = "SELECT username,id FROM users WHERE username ='$username' and password='$password'";
        $auth = $db->query($sql);

        //If details does not exist display back to the user the message
        if($auth->num_rows != 1){
            $_SESSION['auth_message'] = 'Invalid credentials';
            $_SESSION['validation_time'] = time();

            //Redirect back to Login
            header("Location: ../views/login.php");
        
        }

        $_SESSION['user_id'] = $auth->fetch_assoc()['username'];
        // echo $auth->fetch_assoc()['username'];
        //Redirect to Auth page 
        header('Location: ../views/fleet.php');
    }
    
?>