<!-- copyright 2023 -->




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

$redirect = "http://localhost/testing/redirect?destination="

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <title> <?php echo $user['username']  ?> | e-Notes</title>
  <!-- favicon -->
  <link rel="icon" type="image/png" sizes="120x120" href="../notes-cloud-120.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../notes-cloud-96.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../notes-cloud-32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../notes-cloud-16.png">
  <!-- icons for web -->
  <script src="https://kit.fontawesome.com/4b2492399d.js" crossorigin="anonymous"></script>
  <!-- styling -->
  <link href="../assets/css/prof.css?key=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
  <link href="../assets/css/profileModal.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" />
  <link href="../assets/css/navbar.css?<?php echo time(); ?>" type="text/css" rel="stylesheet" />

</head>


<body>
  <!-- topnavbar -->
  <div class="body-template">
    <div class="topbar">
      <div class="logo"> <a href="../">e-Notes</a></div>
      <div class="profile-menu">
        <div class="header-setting">
          <i class="fa-solid fa-gear" id="drop_active" onclick="showDrop()"></i>
        </div>
        <div class="profile-setting">
          <div class="drop-box" id="drop_list">
            <div class="edit list" id="openEdit">
              <i class="fa-solid fa-pen-to-square"></i> <span> Edit profile</span>
            </div>
            <hr>
            <div class="logout list">
              <a href="../logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> <span>Logout</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <script>
        const showDrop = () => {
          let options = document.getElementById("drop_list");
          if (options.style.display == "block") {
            options.style.display = "none";
          } else {
            options.style.display = "block";
          };
        };
        document.addEventListener("click", (event) => {
          let options = document.getElementById("drop_list");
          if (options.style.display === "block" && event.target.id !== "drop_active") {
            options.style.display = "none";
          }
        });
      </script>
    </div>
  </div>
  </div>
<!-- user info -->
  <div class="main">
    <div class="cnt1">
        <div class="cnt3">
          <!-- profile  -->
        <div class="">
          <div class="blurp">
            <div class="profilePic">
              <div class="mainPP">
                <img src="<?php if (isset($profile['img_name'])) {
                            echo "../backend/uploads/" . $profile['img_name'];
                          } else {
                            echo "../assets/img/customer-80.png";
                          } ?>" alt="profile_image" />
                <div class="editIcon">
                  <i class="fa-regular fa-pen-to-square" id="showEditBox"></i>
                </div>
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
            <a href="<?php echo $redirect ?>https://www.facebook.com/<?php echo $profile['facebook'] ?>" target="_blank"><i class="fa-brands fa-facebook"></i></a>
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
  <!-- post secion -->
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
        echo "No Post found";
      }
      ?>
    </div>
  </section>
  <!-- modal for photo upload-->
  <div class="editBox" id="myBoxedit">
    <div class="box-content">
      <div class="close1" id="boxClose">&times;</div>
      <div class="head">Change Profile Picture</div>
      <form action="../backend/upload" method="post" enctype="multipart/form-data" onsubmit="">
        <div class="form-content">
          <form id="imageForm">
            <div class="image-select">
              <label for="fileInput">Upload Photo <i class="fa-regular fa-image"></i></label>
              <input type="file" name="fileToUpload" id="fileInput" />
            </div>
            <div class="image-preview" id="imagePreview"></div>
            <div class="img-action">
              <button type="submit">Save</button>
              <span onclick="closeModal()">Cancel</span>
            </div>
          </form>
        </div>
      </form>
    </div>
  </div>
  <script>
    const fileInput = document.getElementById("fileInput");
    const imagePreview = document.getElementById("imagePreview");

    fileInput.onchange = function() {
      const file = this.files[0];
      const reader = new FileReader();
      reader.onload = function() {
        imagePreview.style.backgroundImage = `url(${this.result})`;
      };
      reader.readAsDataURL(file);
    };
  </script>

  <!-- modal for profile edit -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="head">Edit Profile!</span>
      <span class="close" id="closeMe">&times;</span>
      <form action="./profedit" id="myForm" onsubmit="return validateProfile()" method="POST">
        <div class="form-content">
          <span class="from-title fb">Facebook</span>
          <input type="text" id="facebook" maxlength="50" name="facebook" placeholder="Enter appropritate username of facebook" pattern="^[a-z0-9]+([.][a-z0-9]+)*$" title="only lowercase letters are allowed and no any space" value="<?php if(isset($profile['facebook'])){ echo $profile['facebook']; } ?>"/>
        </div>
        <div class="form-content">
          <span class="from-title ig">Instagram</span>
          <input type="text" id="instagram" maxlength="50" name="instagram" placeholder="Enter appropritate username of instagram" pattern="^[a-z0-9]+([.][a-z0-9]+)*$" title="only lowercase letters are allowed and no any space" value="<?php if(isset($profile['facebook'])){ echo $profile['instagram']; } ?>" />
        </div>
        <div class="form-content">
          <span class="from-title tweet ">Twitter</span>
          <input type="text" name="twitter" id="twitter" maxlength="50" placeholder="Enter appropritate username of twitter" pattern="^[a-z0-9]+([.][a-z0-9]+)*$" title="only lowercase letters are allowed and no any space" value="<?php if(isset($profile['facebook'])){ echo $profile['twitter']; } ?>" />
        </div>
        <div class="form-error" id="formError">
        </div>
        <button type="submit" class="subBtn">Save</button>
      </form>
    </div>
  </div>
</body>
<script src="../assets/js/editProf.js"></script>
<script src="../assets/js/profileImg.js"></script>

</html>