<?php

// check if login is true or not
session_start();
if (!isset($_COOKIE['loginfo']) != true || $_SESSION['loggedin'] != true) {
  header('Location: ./pages');
  exit();
} else if (!isset($_GET['id'])) {
  header('Location: ./');
  exit();
}

// Retrieve the user_id from the query string

$_GET['author'];
$user_id = $_GET['id'];
// echo $user_id;

if (isset($user_id) && !empty($user_id)) {
  require './backend/database/db.inc.php';
  //Sanitize the user_id
  $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
  // Connect to the database

  // Execute the SQL query to retrieve user information
  $query = "SELECT   `username`, `email` FROM `sign_up` WHERE `id` = $user_id";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
  } else {
    echo "No such user exist";
  };
  $email = $user['email'];
  // fetch user information
  $query = "SELECT * FROM  `user_info` WHERE `email` = '$email' ";
  $result = $conn->query($query);
  $profile = $result->fetch_assoc();
  $redirect = "http://localhost/testing/redirect?destination=";
}
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

  <title><?php echo $user['username']   ?> | e-Notes</title>
  <!-- icons for web -->
  <script src="https://kit.fontawesome.com/4b2492399d.js" crossorigin="anonymous"></script>
  <link href="./assets/css/prof.css?key=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
  <link href="./assets/css/navbar.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" />
</head>

<body>
  <!-- topnavbar -->
  <div class="body-template">
    <div class="topbar">
      <div class="logo"> <a href="./">e-Notes</a></div>
      <div class="profile-menu">
        <div class="user-name">
          <a href="u/profile">
            <?php echo $_SESSION['username'] ?></a>
        </div>
        <div class="profile-setting">
          <i class="fa-solid fa-gear" id="drop_active" onclick="showDrop()"></i>
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
      let options = document.getElementById("drop_list");
      if (options.style.display === "block") {
        options.style.display = "none";
      } else {
        options.style.display = "block";
      }
    };

    document.addEventListener("click", (event) => {
      let options = document.getElementById("drop_list");
      if (options.style.display === "block" && event.target.id !== "drop_active") {
        options.style.display = "none";
      }
    });
  </script>
<!-- user info -->
  <div class="main">
    <div class="cnt1">
      <div class="cnt3">
        <!-- profile -->
        <div class="">
          <div class="blurp">
            <div class="profilePic">
              <div class="mainPP">
                <img src="<?php if (isset($profile['img_name'])) {
                            echo "./backend/uploads/" . $profile['img_name'];
                          } else {
                            echo "./assets/img/customer-80.png";
                          } ?>" alt="profile_image" />
              </div>
            </div>
            <div class="profInfo">
              <div class="cnt4">
                <h5 class="mb-1">
                  <?php echo $user['username'] ?>
                </h5>
              </div>
            </div>
          </div>
        </div>
        <!-- social media -->
        <div class="social_profile">
          <div class="social_fb icons">
            <a href="<?php echo $redirect ?>https://facebook.com/<?php echo $profile['facebook'] ?>" target="_blank">
              <i class="fa-brands fa-facebook"></i></a>
          </div>
          <div class="social_ig icons">
            <a href="<?php echo $redirect ?>https://instagram.com/<?php echo $profile['instagram'] ?>" target="_blank">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
          <div class="social_twt icons">
            <a href="<?php echo $redirect ?>https://twitter.com/<?php echo $profile['twitter'] ?>" target="_blank">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <header>Author Posts:</header>
  <!-- author post -->
  <section>
    <div class="authPosts">
      <?php
      $email  = $user['email'];
      require './backend/database/db.inc.php';
      $sql = "SELECT * FROM `posts` WHERE `email`= '$email'  ORDER BY `posts`.`post_id` DESC";
      $result = $conn->query($sql);
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        echo ("
              <div class='mainCnt1'>
                <div class='author'>Author: ") . $row['author'] . ("</div>
                     <div class='title'>") . $row['title'] . ("</div>
                <hr />
                <div class='mainDet'>") . $row['postDet'] . ("</div>
            </div>
");
      }; ?>
    </div>
  </section>
  <!-- end here -->
</body>

</html>