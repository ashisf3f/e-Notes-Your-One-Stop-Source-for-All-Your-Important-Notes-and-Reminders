<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require '../backend/database/db.inc.php';
    session_start();
    $email = $_SESSION['email'];

    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $twitter = $_POST['twitter'];
    // $pattern = '/^[a-z0-9]+([.][a-z0-9]+)*$/';

    // if (preg_match($pattern, $facebook) && preg_match($pattern, $instagram) && preg_match($pattern, $twitter)) {

    $query = "SELECT `facebook`, `instagram`, `twitter` FROM `user_info` WHERE `email`='$email'";
    $result = $conn->query($query);
    $checkStat = $result->fetch_assoc();


    if ($checkStat['facebook'] === null && $checkStat['instagram'] === null && $checkStat['twitter'] === null) {
        $sql = "UPDATE `user_info` SET `facebook`='$facebook',`instagram`='$instagram', `twitter` = '$twitter' WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: ./profile?success");
            exit();
        }
    }
    else if(empty($facebook) || empty($instagram) || empty($twitter)){
        
     if (empty($facebook)) {
        $sql = "UPDATE `user_info` SET `facebook` = null , `instagram`='$instagram' ,`twitter` = '$twitter' WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: ./profile?success");
            exit();
        }
    } 
     if (empty($twitter)) {
        $sql = "UPDATE `user_info` SET `facebook` = '$facebook' , `instagram`='$instagram' ,`twitter` = null WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: ./profile?success");
            exit();
        }
    } 
     if (empty($instagram)) {
        $sql = "UPDATE `user_info` SET `facebook` = '$facebook' , `instagram`=null ,`twitter` = '$twitter' WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: ./profile?success");
            exit();
        }
    } 
}else {
    $sql = "UPDATE `user_info` SET `facebook` = '$facebook' , `instagram`='$instagram' ,`twitter` = '$twitter' WHERE `email` = '$email'";
    $result = $conn->query($sql);
    if ($result) {
        header("location: ./profile?success");
        exit();
    }
    
}
} else{
    header('location: ./profile?server-error');
    exit();
}
