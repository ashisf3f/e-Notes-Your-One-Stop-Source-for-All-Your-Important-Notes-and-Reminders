 <?php
  require '../backend/database/db.inc.php';
  $showAlert = 0;
  $error = 0;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get the form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conf_password = $_POST['password1'];

    // Validate the form data (optional)
    if (empty($username)) {
      $showAlert = true;
      $error = 'Please enter a username';
    } elseif (empty($email)) {
      $showAlert = true;
      $error = 'Please enter an email';
    } elseif (empty($password)) {
      $showAlert = true;
      $error = 'Please enter password';
    } elseif (empty($conf_password)) {
      $showAlert = true;
      $error = 'Please retype  password';
    } elseif (strlen($password) < 8) {
      $showAlert = true;
      $error = 'password must be at least 8 characters long.';
    } elseif ($password !== $conf_password) {
      $showAlert = true;
      $error = 'Password din\'t matched';
    } else {
      
      // Check if email already exists in the database
      $existEmail = "SELECT * FROM `sign_up` WHERE Email = '$email'";
      $result = $conn->query($existEmail);
      $checkStatus = $result->num_rows;
      if ($checkStatus > 0) {
        $showAlert = true;
        $error = "Email Aldready Exist";
      } else {
        // hash password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        // insert random number and submit form to sql database
        $sql = "INSERT INTO `sign_up`( `email`, `username`, `password`) VALUES ('$email','$username','$hashPassword') ";
        $query = "INSERT INTO `user_info`(`email`) VALUES ('$email')";
        $info = $conn->query($query);
        $result3 = $conn->query($sql);
        if ($result3) {
          header('location: ./sign-in.php');
        }
      }
    }
  }
  ?>

 <?php
  // check if aldready loggedin
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
   <title>ASK | Create An Account</title>
   <!-- box Icons -->
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <!-- Main Styling -->
   <link rel="stylesheet" href="../assets/css/alert.css">
   <link rel="stylesheet" href="../assets/css/styles.css" />
 </head>

 <body>
   <div class="alertbox">
     <!-- error bar -->

     <?php
      if ($showAlert == true) {
        echo "
      <div class='alert' id='alert'>
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
             <a class="cname" href="../index.php"> ASK </a>
             <div class="navbar-menu">
               <ul class="list">
                 <li>
                   <a href="./sign-up.php">
                     <u> <i class="bx bxs-user bx-flashing"></i>
                       Sign Up </u>
                   </a>
                 </li>
                 <li>
                   <a href="./sign-in.php">
                     <i class="bx bxs-key "></i>
                     Sign In
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
     <div class="box-form" style="margin-top: 30px;">
       <div>
         <div class="title1">
           <h3>Sign Up</h3>
           <p>It`s quick and easy</p>
         </div>
         <div class="contForm">
           <form role="form" name="myForm" onsubmit="return validateMe()" method="POST">
             <label for="email">Email</label>
             <input type="email" id="email" name="email" placeholder="eg:(example@gmail.com)" required />
             <label for="username">Username</label>
             <input type="text" id="username" name="username" placeholder="ramesh_uncle" required />
             <label for="password">Password</label>
             <input type="Password" id="password" name="password" placeholder="Password(at least 8 characters)" required />
             <label for="conf-password">Confirm Password</label>
             <input type="Password" id="password1" name="password1" placeholder="Confirm Password" required />
             <p id="passError" style="height: 12px; padding: 3px; width:100%; font-size:small;"></p>
             <button type="submit">Create Account</button>
             <script src="../assets/js/app.js"></script>
           </form>
         </div>
         <div class="accInfo">
           <p>
             Aldready have an account?
             <a href="./sign-in.php">Sign In</a>
           </p>
         </div>
       </div>
     </div>
   </section>
 </body>

 </html>