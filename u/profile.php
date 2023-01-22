<?php
session_start();
if (!isset($_COOKIE['loginfo']) != true || $_SESSION['loggedin'] != true) {
  header('Location: ../pages');
  exit();
}
require '../backend/database/db.inc.php';

// echo $_SESSION['email'];
$email = $_SESSION['email'];
$sql = "SELECT * FROM `sign_up` WHERE `email` = '$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// fetch user information
$query = "SELECT * FROM  `user_info` WHERE `email` = '$email'";
$result = $conn->query($query);
$profile = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <title> <?php echo $user['username']  ?> | Testing</title>
  <!-- favicon -->
  <link rel="shortcut icon" href="../favicon.ico" />
  <link rel="icon" type="image/png" href="../favicon-16x16.png" />
  <link rel="apple-touch-icon" href="../apple-touch-icon.png" />
  <!-- icons for web -->
  <script src="https://kit.fontawesome.com/4b2492399d.js" crossorigin="anonymous"></script>
  <link href="../assets/css/prof.css?key=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
</head>

<body>
  <div class="backBtn">
    <a href="../"><i class="fa-solid fa-arrow-left"></i> Go back </a>
  </div>
  <div class="main">
    <div class="cnt1">
      <div class="testing">

        <div class="testing-1 ">
          <div class="logout list">
            <a href="../logout">
          <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Logout</span>
          </a>
          </div>
          <div class="edit list" id="editp">
          <i class="fa-solid fa-pen-to-square"></i> <span>Edit profile</span>
          </div>
        </div>
      </div>
      <div class="cnt2">
        <img src="../curved0.jpg" alt="background image profile" />

        <span></span>
      </div>
      <div class="cnt3">
        <div class="">
          <div class="blurp">
            <div class="profilePic">
              <div class="mainPP">
                <img src="<?php if (isset($profile['img_name'])) {
                            echo "../backend/uploads/" . $profile['img_name'];
                          } else {
                            echo "../apple-touch-icon.png";
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
        <div class="social_profile">
          <div class="social_fb icons">
            <a href="https://facebook.com/<?php echo $profile['facebook'] ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
          </div>
          <div class="social_ig icons">
            <a href="https://instagram.com/<?php echo $profile['instagram'] ?>" target="_blank">
              <i class="fa-brands fa-instagram"></i>
            </a>
          </div>
          <div class="social_twt icons">
            <a href="https://twitter.com/<?php echo $profile['twitter'] ?>" target="_blank">
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
      $sql = "SELECT * FROM `posts` WHERE `email`= '$email'  ORDER BY `posts`.`post_id` DESC";
      $result = $conn->query($sql);
      if ($checkRow = $result->num_rows) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          echo ("
                        <div class='mainCnt1'>
                          <div class='author'>Author: ") . $row['author'] . ("</div>
                          <div class='title'>") . $row['title'] . ("</div>
                          <hr />
                          <div class='mainDet'>") . $row['postDet'] . ("</div>
                        </div>
                        ");
        }
      } else {
        # code...
        echo "No Post found";
      }
      ?>
    </div>
  </section>
    <!-- modal -->
    <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="head">Edit Profile!</span>
      <span class="close" id="closeMe">&times;</span>
      <form action="./profedit" id="myForm" onsubmit="return validateProfile()" method="POST">
        <div class="form-content">
          <span class="from-title fb">Facebook</span>
          <input type="text" id="facebook" maxlength="50" name="facebook" placeholder="Enter appropritate username of facebook" pattern="^[a-z0-9]+([.][a-z0-9]+)*$" title="only lowercase letters are allowed and no any space"  />
        </div>
        <div class="form-content">
        <span class="from-title ig">Instagram</span>
        <input type="text" id="instagram" maxlength="50" name="instagram" placeholder="Enter appropritate username of instagram" pattern="^[a-z0-9]+([.][a-z0-9]+)*$" title="only lowercase letters are allowed and no any space" />
        </div>
        <div class="form-content">
        <span class="from-title tweet ">Twitter</span>
        <input type="text" name="twitter" id="twitter" maxlength="50" placeholder="Enter appropritate username of twitter" />
        </div>
        <div class="form-error" id="formError">
        </div>
        <button type="submit" class="subBtn">Save</button>
      </form>
    </div>
  </div>
</body>
<script src="../assets/js/editProf.js"></script>
</html>