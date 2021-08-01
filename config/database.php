<?php 
    try{
        $db  = new mysqli();
     
        $db->connect('localhost','root','','fleet_crud');
        if($db) {
            //
        } 
    } catch(Exception $e){
        $error = 'Database Error: ';
        $error .= $e->getMessage();

        throw new Exception($error);
    }

?>