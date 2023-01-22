<?php
// check if login is true or not
session_start();
require './backend/database/db.inc.php';
if (!isset($_COOKIE['loginfo']) != true || $_SESSION['loggedin'] != true) {
  header('Location: ./pages');
  exit();
}
$email = $_SESSION['email'];
// gets profile image of cuurent logged in user
$query = "SELECT img_name FROM  `user_info` WHERE `email` = '$email' ORDER BY user_info.id Desc";
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
    <link rel="shortcut icon" href="favicon.ico" />
  <link rel="icon" type="image/png" href="favicon-16x16.png" />
  <link rel="apple-touch-icon" href="apple-touch-icon.png" />
  <title>On Test</title>
  <!-- icons for web -->
  <script src="https://kit.fontawesome.com/4b2492399d.js" crossorigin="anonymous"></script>
  <link href="./assets/css/test.css?key=<?php echo time(); ?>" type="text/css" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/responsive.css" />
</head>

<body>
  <div class="body-template">
    <!-- topnarbar -->
    <div class="topbar">
      <div class="logo">Ashis</div>
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
                        echo "./apple-touch-icon.png";
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
  <div class="fixed_btn" id="mobBtn">
    <i class="fa-solid fa-comment-medical"></i>
  </div>

  <div class="cols">
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
          $checkStats = "SELECT `email`, COUNT(`email`) AS count FROM `posts` GROUP BY `email` ORDER BY count  LIMIT 4";
          $result = $conn->query($checkStats);
          $checkRow = $result->num_rows;
          if ($checkRow > 0) {
            while ($row = $result->fetch_assoc()) {
              $most_frequent_email = $row['email'];
              // Execute the SQL query to retrieve user information
              $query = "SELECT  `title`, `author` FROM `posts` WHERE `email` = '$most_frequent_email' ORDER BY post_id  DESC  LIMIT 3";
              $result2 = $conn->query($query);
              while ($user = $result2->fetch_assoc()) {
                echo ("
                    <div class='recent-details'>
                      <div class='recent-title'>
                        <span class='side-border'></span>
                        Title:
                        <span class='rt'>") . $user['title'] . ("</span>
                      </div>
                      <div class='recent-author'>
                        <span class='ra'>author:</span>") . $user['author'] . ("
                      </div>
                    </div>
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
    <div class="col-2 center">
      <div class="meta">
        <div class="meta-upload">
          <div class="user-avatar">
            <img src="<?php if (isset($profile['img_name'])) {
                        echo "./backend/uploads/" . $profile['img_name'];
                      } else {
                        echo "./apple-touch-icon.png";
                      } ?>" alt="" srcset="" />
          </div>
          <div class="upload-details">
            <form action="./uploadPost" onsubmit="return postValidate()" method="post">
              <!-- <label for="input-title"></label> -->
              <div class="upload-content title">
                <input type="text" name="title" maxlength="30" pattern="[a-zA-Z0-9 ]+" title="Only alphabets and numbers are allowed." placeholder="Title" id="postTitle" />
              </div>
              <div class="upload-content story">
                <textarea type="text" id="postDet" name="postDet" maxlength="360">
Say something about yourself!</textarea>
              </div>
              <div class="sub-btn">
                <button type="submit">Post</button>
              </div>
            </form>
          </div>
        </div>
        <div class="meta-body">
          <?php
          $useremail = $_SESSION['email'];
          $sql = "SELECT * FROM `posts` ORDER BY `posts`.`post_id` DESC";
          $result = $conn->query($sql);
          if ($checkData = $result->num_rows) {
            while ($row =
              $result->fetch_array(MYSQLI_ASSOC)
            ) {
              $prof_email = $row['email'];
              $query = "SELECT img_name FROM  `user_info` WHERE `email` = '$prof_email' ORDER BY user_info.id Desc";
              $result1 = $conn->query($query);
              $profile = $result1->fetch_assoc();
              echo ("
              <div class='post'>
                <div class='auth-pic'>
                  <img src='");
              if (isset($profile['img_name'])) {
                echo './backend/uploads/' . $profile['img_name'];
              } else {
                echo './apple-touch-icon.png';
              }
              echo (" '/>
                  <div class='auth-details'>
                    <span class='auth-name'>") . $row['author'] .  (" </span>
                    <div class='post-time'>") . $row['date'] . ("</div>
                  </div>
                </div>
                <div class='auth-title post-details'>
                ") . $row['title'] . ("</div>
                <div class='auth-post post-details'>") .
                $row['postDet'] . ("
                </div>
              </div>
");
            }
          } else {
            echo ("<div class='post' style='color:red; text-align:center;'>No any notes Available, <span style='color:rgb(0, 102, 255);'> upload notes </span> to see </div>");
          }
          ?>
        </div>
      </div>
    </div>
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
          $threshold = 5;
          while ($row = $result->fetch_assoc()) {
            if ($row['count'] >= $threshold) {
              $most_frequent_email = $row['email'];
              $prof_email =   $row['email'];
              $query = "SELECT img_name FROM  `user_info` WHERE `email` = '$most_frequent_email' ORDER BY user_info.id Desc";
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
                  echo './apple-touch-icon.png';
                }
                echo ("'/><input type='submit' name='username' value='" . $user['username'] . "'>
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
      <form action="./uploadPost" id="myForm" onsubmit="return postValidate1()" method="POST">
        <div class="form-content">
          <input type="text" id="postTitle1" maxlength="30" name="title" placeholder="Title" required />
        </div>
        <div class="form-content">
          <textarea maxlength="360" name="postDet" id="postDet1"></textarea>
        </div>
        <button type="submit" class="subBtn">Post</button>
      </form>
    </div>
  </div>
</body>
<script src="./assets/js/dropbox.js"></script>
<script src="./assets/js/modalBox.js"></script>
<script src="./assets/js/postValidate.js"></script>

</html>