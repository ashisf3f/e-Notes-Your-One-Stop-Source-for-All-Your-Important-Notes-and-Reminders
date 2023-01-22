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
    else if (empty($facebook) && empty($instagram)) {
        $sql = "UPDATE `user_info` SET `twitter` = '$twitter' WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: ./profile?success");
            exit();
        }
    } else if (empty($instagram) && empty($twitter)) {
        $sql = "UPDATE `user_info` SET `facebook` = '$facebook' WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: ./profile?success");
            exit();
        }
    } else if (empty($facebook) && empty($twitter)) {
        $sql = "UPDATE `user_info` SET `instagram` = '$instagram' WHERE `email` = '$email'";
        $result = $conn->query($sql);
        if ($result) {
            header("location: ./profile?success");
            exit();
        }
    }
}
