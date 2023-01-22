<?php

// check if login is true or not
session_start();
if (!isset($_COOKIE['loginfo']) != true || $_SESSION['loggedin'] != true) {
  header('Location: ./pages');
  exit();
}
else if(!isset($_GET['id'])){
  header('Location: ./');
  exit();
}

// Retrieve the user_id from the query string

$_GET['username'];
$user_id = $_GET['id'];
// echo $user_id;

if (isset($user_id) && !empty($user_id)) {
  require './backend/database/db.inc.php';
  //Sanitize the user_id
  $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
  // Connect to the database

  // Execute the SQL query to retrieve user information
  $query = "SELECT `username`, `email` FROM `sign_up` WHERE `id` = $user_id";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
  } else {
    echo "No such user exist";
  };
  $email = $user['email'];
  // fetch user information
$query = "SELECT * FROM  `user_info` WHERE `email` = '$email' ORDER BY user_info.id Desc";
$result = $conn->query($query);
$profile = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- <title><?php echo $user['username']   ?> | Testing</title> -->
  <title>Ashisf2f | Testing</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="icon" type="image/png" href="favicon-16x16.png" />
  <link rel="apple-touch-icon" href="apple-touch-icon.png" />
  <!-- icons for web -->
  <script src="https://kit.fontawesome.com/4b2492399d.js" crossorigin="anonymous"></script>
  <link href="./assets/css/prof.css?key=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
</head>

<body>
  <div class="backBtn">
    <a href="./"> <i class="fa-solid fa-arrow-left"></i>Go back </a>
  </div>
  <div class="main">
    <div class="cnt1">
      <div class="cnt2">
        <img src="curved0.jpg" alt="background image profile" />
        <span></span>
      </div>
      <div class="cnt3">
        <div class="">
          <div class="blurp">
            <div class="profilePic">
              <div class="mainPP">
                <img src="<?php if (isset($profile['img_name'])) {
                            echo "./backend/uploads/" . $profile['img_name'];
                          } else {
                            echo "./apple-touch-icon.png";
                          } ?>" alt="profile_image"/>
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
        <div class="social_profile">
          <div class="social_fb icons">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
          </div>
          <div class="social_ig icons">
            <a href="">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
          <div class="social_twt icons">
            <a href="">
              <i class="fa-brands fa-twitter"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <header>Author Posts:</header>
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
</body>

</html>