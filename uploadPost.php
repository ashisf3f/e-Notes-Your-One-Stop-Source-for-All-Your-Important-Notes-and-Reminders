<?php
require './backend/database/db.inc.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    $response = array ();
    $content = trim(file_get_contents("php://input"));
    $_arr = json_decode($content, true);

    $postTitle = $_arr['postTitle'];
    $postDetails = $_arr['postDetails'];

    if (empty($postTitle)) {
        $response["error"]  = 'Give some title';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else  if (empty($postDetails)) {
        $response["error"]  = 'Enter some note';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
       
        $checkQuote = str_replace("'", "\'", $postDetails);
        $email = $_SESSION['email'];
        $author = $_SESSION['username'];
        // $userid = $_SESSION['userid'];

        $sql = "INSERT INTO `posts`(`date`,`title`, `postDet`,`author`, `email`) VALUES (DATE(NOW()),'$postTitle','$checkQuote','$author','$email')";

        $result = $conn->query($sql);

        if ($result) {
            $response["success"]  = 'Successfully uploaded note';
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        } else {
            $response["error"]  = 'Couldn\'t upload your note';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
        }
    }
} else {
    header("location: ./");
    exit();
}
