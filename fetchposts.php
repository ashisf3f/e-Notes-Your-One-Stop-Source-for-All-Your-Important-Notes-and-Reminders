<?php
// echo "hi";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require './backend/database/db.inc.php';

    $posts_query = "SELECT * FROM `posts` ORDER BY posts.post_id DESC";
    $posts_result = $conn->query($posts_query);
    $post_row = $posts_result->num_rows;
    $posts_data = array();
    $user_data = array();

    if ($post_row > 0) {

        while ($row = $posts_result->fetch_assoc()) {

            $email = $row['email'];
            $get_sql = "SELECT `user_id`, `img_name` , `email` FROM   `user_info` WHERE email = '$email'";
            $get_result = $conn->query($get_sql);
            $get_data = $get_result->fetch_assoc();
            $user_data[] = $get_data;
            $posts_data[] = $row;
        }
    }

    $final_data = array("posts_data" => $posts_data, "user_data" => $user_data);
    echo json_encode($final_data);
} else {
    header("location: ./");
    exit();
}
