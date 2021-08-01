<?php 
require('../config/database.php');

    function fetchAllCars()
    {
        global $db;

        $query = 'SELECT * FROM cars';

        $statement = $db->query($query);

        while($row = $statement->fetch_assoc()){
            $items[] = $row;
        }
        //All items 
        return $items;
    }

    function deleteCar($id)
    {
        global $db;

        $query = "DELETE from cars where id = '$id'";

        $statement = $db->query($query);

        //If delete is successful, return back a message to the user and redirect
        // According;y
        if($statement === true){
            $_SESSION['success'] = 'Item successfully deleted';
            $_SESSION['validation_time'] = time();
            header('Location: ../views/fleet.php');
        }

    }

    function createCar($request)
    {
        global $db;

        $brand = mysqli_real_escape_string($db,$request['brand']);
        $model = mysqli_real_escape_string($db,$request['model']);
        $seat_no = mysqli_real_escape_string($db,$request['seat_no']);
        $speed_limit = mysqli_real_escape_string($db,$request['speed_limit']);
        $color = mysqli_real_escape_string($db,$request['color']);
        $year = mysqli_real_escape_string($db,$request['year']);
       
        $timestamp = date('Y-m-d H:i:s');
        $sql = "INSERT INTO cars (`model`, `seat_no`, `speed_limit`,`color`,`brand`,`year`,`created_at`,`updated_at`) VALUES ('$model','$seat_no','$speed_limit','$color','$brand','$year','$timestamp','$timestamp')";
     
        //If an error while logging the details return back the error to the user
        if($db->error){
            $_SESSION['auth_message'] = $db->error;
            $_SESSION['validation_time'] = time();
        }

        //If successful, show a flash message and redirect
        if($db->query($sql) === true){
            $_SESSION['success'] = 'Item successfully created';
            $_SESSION['validation_time'] = time();
            header('Location: ../views/fleet.php');
        }
    }

    function updateCar($request)
    {
        global $db;
        //
    }

?>