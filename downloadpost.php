<?php


if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
    require './backend/database/db.inc.php';

    $query = "SELECT `title`, `postDet` FROM `posts` WHERE `post_id` = '$postId'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $post = $result->fetch_assoc();
        $title = $post['title'];
        $description = $post['postDet'];
        $data = "Title:\n " . $title . "\nDescription: \n" . $description;
        header('Content-Disposition: attachment; filename=' . $title   . '.txt');
        header('Content-Type: text/plain');
        echo $data;
        exit();
    } else {
        header("location: ./");
        exit();
    }
} else {
    header("location: ./");
    exit();
}
