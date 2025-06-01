<?php
    //step 1- create connection to the database
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'unisphere';

    $connection = mysqli_connect($server,$user,$password,$database);
    if ($connection == false){
        die("Connection failed".mysqli_connect_error()) ;//Display the message and exit the code
    }

?>