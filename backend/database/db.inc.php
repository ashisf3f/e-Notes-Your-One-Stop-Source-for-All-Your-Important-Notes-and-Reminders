<?php

$serverName = "localhost";
$userName = "root";
$password = '';
$database = 'enotes';

$conn = new mysqli($serverName , $userName , $password , $database);

// check database connecion error
if($conn -> connect_error){
    die("Connection failed: ". $conn->connect_error);
}
