 <?php
      require '../backend/database/db.inc.php';

      $showAlert = 0;
      $error  = 0;
      $loggedin = 0;

      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userEmail = $_POST['email'];
        $userPass = $_POST['password'];

        if (empty($userEmail)) {
          $showAlert = true;
          $error = "Enter Your Email !";
        } else if (empty($userPass)) {
          $showAlert = true;
          $error = "Enter Your Password";
        } else {

          // check if user is available or not
          $checkExist = "SELECT * from sign_up Where   Email='$userEmail'";
          $result = $conn->query($checkExist);
          $checkStatus = $result-> num_rows;

          if ($checkStatus == 1) {
            while ($row = $result-> fetch_assoc()) {
              if (password_verify($userPass, $row['password'])) {
                session_start();
                setcookie('loginfo', true, time() + 60 * 60 * 30);
                setcookie('email', $reqEmail, time() + 60 * 60 * 30);
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $userEmail;
                $user = $row['username'];
                $user_id = $row['user_id'];
                $_SESSION['userid']  = $user_id;
                $_SESSION['username'] = $user;
                $loggedin = true;
                header('location: ../');
              } else {
                $showAlert = true;
                $error = "Invalid Password";
              }
            }
          } else {
            $showAlert = true;
            $error = "Invalid Credentials!";
          }
        }
      }
      ?>

<?php
// check if aldready logged in or not
session_start();
if (isset($_SESSION['loggedin']) == true) {
  header('location: ../');
  exit;
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width,initial-scale=2,maximum-scale=1" />
  <meta name="description" content="School project for college, college project for school, school project for high school and school project for university.">
  <!-- favicon -->
  <link rel="shortcut icon" href="../favicon.ico">
  <link rel="icon" type="image/png" href="../favicon-16x16.png">
  <link rel="apple-touch-icon" href="../apple-touch-icon.png">
  <title>SignIn | School Project</title>
  <!-- box Icons -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <!-- Main Styling -->

  <link rel="stylesheet" href="../assets/css/styles.css" />
  <link rel="stylesheet" href="../assets/css/footer.css" />
  <link rel="stylesheet" href="../assets/css/alert.css">
</head>

<body>
  <div class="alertbox">
    <!-- error bar -->
     <?php
          if ($showAlert == true) {
            echo "<div class='alert' id='alert'>
  <span class='closebtn' onclick='myFun()'>&times;</span>
  <strong>Warning!  </strong> ";
            echo $error;
            echo "
</div>";
          }
          ?> 
    <!-- for auto dismissal of alert bar or manual close -->
    <script src="../assets/js/alert.js"></script>
  </div>
  <div class="container">
    <div class="main">
      <div class="cnt1">
        <!-- Navbar -->
        <nav class="absolute">

          <div class="cnt2">
            <a class="cname" href="../"> ASK </a>
            <div class="navbar-menu">
              <ul class="list">
                <li>
                  <a href="./sign-up.php">
                    <i class="bx bxs-user "></i>
                    Sign Up
                  </a>
                </li>
                <li>
                  <a href="./sign-in.php">
                    <u> <i class="bx bxs-key bx-flashing "></i>
                      Sign In </u>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>

  <section>
    <div class="box-form" style="margin-top: 80px;">
      <div>
        <div class="title1">
          <h3>Welcome Back!</h3>
          <p>Enter your email and password to sign in
          </p>
        </div>
        <div class="contForm">
          <form role="form" method="POST" onsubmit="return validateSys()">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Email Address" required />
            <label for="password">Password</label>
            <input type="Password" id="password" name="password" placeholder="Password" required />
            <p id="passError" style="height: 12px; padding: 3px; font-size:small;"></p>
            <button type="submit">Login</button>
            <script src="../assets/js/validateSignin.js"></script>
          </form>
        </div>
        <div class="accInfo">
          <p>
            Create a new account ?
            <a href="./sign-up.php">Sign Up</a>
          </p>
        </div>
      </div>
    </div>
  </section>
  <footer class="py-12">
    <div class="container3">
      <div>
        <div class="foot1">
          <a href="https://ashiskunwar.com.np" target="_blank"> About Us </a>
          <a href="https://ashiskunwar.com.np" target="_blank"> Team </a>
          <a href="https://ashiskunwar.com.np" target="_blank"> Docs </a>
        </div>
      </div>
      <div class="foot2">
        <div class="hehe">
          <p>
            Copyright ©
            <script>
              document.write(new Date().getFullYear());
            </script>
            <!-- . Ashisf2f -->
          </p>
        </div>
      </div>
    </div>
  </footer>
</body>


</html>