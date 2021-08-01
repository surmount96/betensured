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

        return $items;
        return $statement->fetch_array();
    }

    function deleteCar($id)
    {
        global $db;

        $query = "DELETE from cars where id = '$id'";

        $statement = $db->query($query);

    
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
     
        if($db->error){
            $_SESSION['auth_message'] = $db->error;
            $_SESSION['validation_time'] = time();
        }

        if($db->query($sql) === true){
            $_SESSION['success'] = 'Item successfully created';
            $_SESSION['validation_time'] = time();
            header('Location: ../views/fleet.php');
        }
    }

?>