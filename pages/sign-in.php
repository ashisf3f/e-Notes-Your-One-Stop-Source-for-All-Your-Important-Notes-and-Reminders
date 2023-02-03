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
    <link rel="icon" type="image/png" sizes="120x120" href="../notes-cloud-120.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../notes-cloud-96.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../notes-cloud-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../notes-cloud-16.png">
    <title>SignIn | e-Notes</title>
    <!-- box Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <!-- Main Styling -->

    <link rel="stylesheet" href="../assets/css/styles.css?key=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../assets/css/footer.css?key=<?php echo time(); ?>" />
  </head>

  <body>
    <div class="alertbox">
    </div>
    <div class="container">
      <div class="main">
        <div class="cnt1">
          <!-- Navbar -->
          <nav class="absolute">

            <div class="cnt2">
              <a class="cname" href="../"> e-Notes </a>
              <div class="navbar-menu">
                <ul class="list">
                  <li>
                    <a href="./sign-up">
                      <i class="bx bxs-user "></i>
                      Sign Up
                    </a>
                  </li>
                  <li>
                    <a href="./sign-in">
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
            <form role="form" method="POST" id="signinForm">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Email Address" required />
              <label for="password">Password</label>
              <input type="Password" id="password" name="password" placeholder="Password" required />
              <p id="errorMessage" style=" height: 12px; padding: 3px; font-size:small;"></p>
              <button type="submit">Login</button>
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
        <div class="foot2">
          <div class="hehe">
            <p>
              Copyright © <span id="datecc"></span>
              <script>
                document.getElementById("datecc").innerHTML = (new Date().getFullYear());
              </script>
              | Ashis Kunwar
            </p>
          </div>
        </div>
      </div>
    </footer>

  </body>
<script src="../assets/js/validateSignin.js"></script>

  </html>