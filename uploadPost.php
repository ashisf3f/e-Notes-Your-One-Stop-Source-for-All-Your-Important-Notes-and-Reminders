<?php
session_start();

require './backend/database/db.inc.php';
$info = 0;
$showErr = 0;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $postTitle = $_POST['title'];
    $postDetails = $_POST['postDet'];
    // using string replace to escape the single quote error
    $checkQuote = str_replace("'","\'" ,$postDetails);
    $email = $_SESSION['email'];
    $author = $_SESSION['username'];
    // $userid = $_SESSION['userid'];

    $sql = "INSERT INTO `posts`(`date`,`title`, `postDet`,`author`, `email`) VALUES (DATE(NOW()),'$postTitle','$checkQuote','$author','$email')";
    $result = $conn->query($sql);
    if($result){
        $info = "Upload Success";
        header("location: ./?info=$info");
        exit();
    }
    else{
        $info = "Upload failed";
        header("location: ./?info=$info");
        exit();
    }
} else {
    header("location: ./pages");
    exit();
}
