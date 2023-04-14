<?php

// check if login is true or not
session_start();
if (!isset($_COOKIE['loginfo']) != true || $_SESSION['loggedin'] != true) {
    header('Location: ./pages');
    exit();
} else if (!isset($_GET['post_id'])) {
    header('Location: ./');
    exit();
}

// Retrieve the user_id from the query string

$_GET['author'];
$post_id = $_GET['post_id'];
require './backend/database/db.inc.php';

$sql = "SELECT * FROM `posts` WHERE `post_id` = '$post_id' LIMIT 1";
$result = $conn->query($sql);
$checkrow = $result->num_rows;
if ($checkrow == 1) {
    $post = $result->fetch_assoc();

    $email = $_SESSION['email'];
    // gets profile image of cuurent logged in user
    $query = "SELECT img_name FROM  `user_info` WHERE `email` = '$email'";
    $result = $conn->query($query);
    $profile = $result->fetch_assoc();

    // fetch posts

    $sql = "SELECT * FROM `posts` WHERE `post_id` = '$post_id' LIMIT 1";
    $result = $conn->query($sql);
    $post = $result->fetch_assoc();
    $author = $post['email'];


    // fetch user image

    $query1 = "SELECT * FROM `user_info` WHERE `email` = '$author' LIMIT 1";
    $result = $conn->query($query1);
    $auth_details = $result->fetch_assoc();


    // fetch user

    $query = "SELECT * FROM `sign_up` where `email` = '$author'";
    $result3 = $conn->query($query);
    $auth = $result3->fetch_assoc();
} else {
    header("location: ./");
    exit;
}
// echo $user_id;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- favicon -->
    <link rel="icon" type="image/png" sizes="120x120" href="notes-cloud-120.png">
    <link rel="icon" type="image/png" sizes="96x96" href="notes-cloud-96.png">
    <link rel="icon" type="image/png" sizes="32x32" href="notes-cloud-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="notes-cloud-16.png">
    <title>e-Notes: Your One-Stop Source for All Your Important Notes and Reminders</title>
    <!-- icons for web -->
    <script src="https://kit.fontawesome.com/4b2492399d.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="./assets/css/index.css?key=<?php echo time(); ?>" type="text/css" rel="stylesheet" /> -->
    <link rel="stylesheet" href="./assets/css/posts.css?key=<?php echo time(); ?>" />
</head>

<body>
    <!-- topnarbar -->
    <div class="body-template">
        <div class="topbar">
            <div class="logo"> <a href="./">e-Notes </a></div>
            <div class="profile-menu">
                <div class="user-name">
                    <a href="u/profile">
                        <?php echo $_SESSION['username'] ?></a>
                </div>
                <div class="profile-image">
                    <a href="u/profile">
                        <img src="<?php if (isset($profile['img_name'])) {
                                        echo "./backend/uploads/" . $profile['img_name'];
                                    } else {
                                        echo "./assets/img/customer-80.png";
                                    } ?>" alt="profile_picture" />
                    </a>
                </div>
                <div class="profile-setting">
                    <i class="fa-solid fa-ellipsis-vertical" id="drop_active" onclick="showDrop()"></i>
                    <div class="drop-box" id="drop_list">
                        <div class="logout">
                            <div class="up-arrow"></div>
                            <a href="./logout"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const showDrop = () => {
            let courses = document.getElementById("drop_list");
            if (courses.style.display == "block") {
                courses.style.display = "none";
            } else {
                courses.style.display = "block";
            }
        };

        document.addEventListener("click", (event) => {
            let options = document.getElementById("drop_list");
            if (options.style.display === "block" && event.target.id !== "drop_active") {
                options.style.display = "none";
            }
        });
    </script>
    <main>

        <div class="meta-body">
            <div class="post">
                <div class="post-info">
                    <div class="auth-pic">
                        <img src="./backend/uploads/<?php echo $auth_details['img_name']; ?>" alt="" />
                        <div class="auth-details">
                            <form action="./profile" method="get">
                                <input type="hidden" name="id" value="<?php echo $auth['id']; ?>">
                                <span class="auth-name">
                                    <input type="submit" name="author" value="<?php echo $post['author']; ?>" />
                                </span>
                            </form>
                            <div class="post-time"><?php echo $post['date']; ?></div>
                        </div>
                    </div>
                    <div class="post-manager">
                        <div class="dwnld">
                            <a href="downloadpost?postId=<?php echo $post_id ?>">
                                <i class='fa-solid fa-cloud-arrow-down' id='downloadButton'></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="auth-title">
                    <?php echo $post['title']; ?>
                </div>
                <div class="auth-post">
                    <?php echo $post['postDet']; ?>
                </div>
            </div>
        </div>

    </main>