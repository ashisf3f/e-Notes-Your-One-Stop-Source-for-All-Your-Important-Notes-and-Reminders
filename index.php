<?php
// check if login is true or not
session_start();
require './backend/database/db.inc.php';
$login = "SELECT * FROM `sign_up`";
$checkResult = $conn->query($login);
$logRow = $checkResult->num_rows;
if (!isset($_COOKIE['loginfo']) != true || $_SESSION['loggedin'] != true) {
  header('Location: ./pages');
  exit();
}
if ($logRow < 1) {
  session_unset();
  session_destroy();
  setcookie('loginfo', true, time() - 1);
  header('Location: ./pages');
  exit();
}

$email = $_SESSION['email'];
// gets profile image of cuurent logged in user
$query = "SELECT img_name FROM  `user_info` WHERE `email` = '$email'";
$result = $conn->query($query);
$profile = $result->fetch_assoc();
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
  <link rel="stylesheet" href="./assets/css/index.css?key=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/responsive.css?key=<?php echo time(); ?>" />
  <link rel="stylesheet" href="./assets/css/error.css?key=<?php echo time(); ?>" />
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

  <!-- notificaiton (success or error) -->
  <div class="not-info" id="notInfo">
    <div class="not-msg" id="notBox">
      <div class="not-close">
        <i class="fa-solid fa-xmark" id="notClose"></i>
      </div>
      <div class="not-text">
        <i class="fa-solid" id="notSymbol"></i> <span id="notMsg"></span>
      </div>
    </div>
  </div>
  <!-- mobilebtn to upload post -->
  <div class="fixed_btn" id="mobBtn">
    <i class="fa-solid fa-comment-medical"></i>
  </div>
  <!-- main page divison -->
  <div class="cols">
    <!-- left column -->
    <div class="col-1 left">
      <div class="actions">
        <div class="head">My Activity</div>
        <div class="actions1 log">
          <a href="./u/profile"><i class="fa-solid fa-user"></i> Profile</a>
        </div>
        <div class="actions2 log">
          <a href="./logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
        </div>
      </div>
      <div class="division">
        <div class="recent-activity">
          <div class="head">Recent Activity</div>
          <?php
          // Execute the SQL query to retrieve most frequent emails
          $checkStats = "SELECT `email`, COUNT(`email`) AS count FROM `posts` GROUP BY `email` ORDER BY posts.date ";
          $result = $conn->query($checkStats);
          $checkRow = $result->num_rows;
          if ($checkRow > 0) {
            while ($row = $result->fetch_assoc()) {
              $most_frequent_email = $row['email'];
              // Execute the SQL query to retrieve user information
              $query = "SELECT  `title`,`post_id` , `author` FROM `posts` WHERE `email` = '$most_frequent_email' ORDER BY post_id desc  LIMIT 1";
              $result2 = $conn->query($query);
              while ($post = $result2->fetch_assoc()) {
                echo ("
                    <form action='./posts'>
                    <div class='recent-details'>
                      <div class='recent-title'>
                      <input type='hidden' name='post_id' value='" . $post['post_id'] . "'>
                      <input type='hidden' name='author' value='" . $post['author'] . "'>
                        <button type='submit'  class='rt'>" . $post['title'] . "</button>
                      </div>
                      </button>
                      <div class='recent-author'>
                        <span class='ra'> author: </span>" . $post['author'] . "
                      </div>
                    </div>
                    </form>
                    ");
              }
            }
          } else {
            echo ("<div style='color:red; margin-top:12px;'>No any notes found! </div>");
          }
          ?>
        </div>
      </div>
    </div>
    <!-- center column -->
    <div class="col-2 center">
      <div class="meta">
        <div class="meta-upload">
          <div class="user-avatar">
            <img src="<?php if (isset($profile['img_name'])) {
                        echo "./backend/uploads/" . $profile['img_name'];
                      } else {
                        echo "./assets/img/customer-80.png";
                      } ?>" alt="" />
          </div>
          <div class="upload-details">
            <form id="myForm" method="post">
              <!-- <label for="input-title"></label> -->
              <div class="upload-content title">
                <input type="text" name="postTitle" maxlength="48" pattern="[a-zA-Z0-9 ]+" title="Only alphabets and numbers are allowed." placeholder="Title" id="postTitle" />
              </div>
              <div class="upload-content story">
                <textarea type="text" id="postDetails" name="postDetails" maxlength="420">
Say something about yourself!</textarea>
              </div>
              <div class="sub-btn">
                <button type="submit">Post</button>
              </div>
            </form>
          </div>
        </div>
        <div class="meta-body">
          <div id="postContainer"></div>
          <script src="./assets/js/fetchposts.js?key=<?php echo time() ?>"></script>
        </div>
      </div>
    </div>
    <!-- right column -->
    <div class="col-3 right">
      <div class="rank">
        <div class="icon-top"><i class="fa-solid fa-ranking-star"></i></div>
        <div class="head">Top Authors</div>
        <?php
        // Execute the SQL query to retrieve most frequent emails
        $checkStats = "SELECT `email`, COUNT(`email`) AS count FROM `posts` GROUP BY `email` ORDER BY count DESC";
        $result = $conn->query($checkStats);
        $checkRow = $result->num_rows;
        if ($checkRow > 0) {
          $threshold = 4;
          while ($row = $result->fetch_assoc()) {
            if ($row['count'] >= $threshold) {
              $most_frequent_email = $row['email'];
              $prof_email =   $row['email'];
              $query = "SELECT img_name FROM  `user_info` WHERE `email` = '$most_frequent_email' ";
              $result1 = $conn->query($query);
              $profile = $result1->fetch_assoc();
              // Execute the SQL query to retrieve user information
              $query = "SELECT `id`, `username` FROM `sign_up` WHERE `email` = '$most_frequent_email'";
              $result2 = $conn->query($query);
              while ($user = $result2->fetch_assoc()) {
                echo ("
                  <form action='./profile' method='get'>
                    <div class='topLfrm'>
                  <input type='hidden' name='id' value='" . $user['id'] . "'>
                </div>
                <div class='authors'>
                <img src='");
                if (isset($profile['img_name'])) {
                  echo './backend/uploads/' . $profile['img_name'];
                } else {
                  echo './assets/img/customer-80.png';
                }
                echo ("'/><input type='submit' name='author' value='" . $user['username'] . "'>
                </div>
                  </form>");
              }
            }
          }
        } else {
          echo ("<div style='margin-top: 12px;'> No any author found!</div>");
        }
        ?>
      </div>
    </div>
  </div>
  <!-- modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <span class="head">Upload Note!</span>
      <span class="close">&times;</span>
      <form id="myFormModal" method="POST">
        <div class="form-content">
          <input type="text" id="postTitle1" maxlength="48" name="postTitle1" placeholder="Title" required />
        </div>
        <div class="form-content">
          <textarea maxlength="420" name="postDetails1" id="postDetails1"></textarea>
        </div>
        <button type="submit" class="subBtn">Post</button>
      </form>
    </div>
  </div>
</body>
<script src="./assets/js/modalBox.js?key=<?php echo time() ?>"></script>
<script src="./assets/js/postValidate.js?key=<?php echo time() ?>"></script>
</html>