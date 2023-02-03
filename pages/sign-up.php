

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
  <link rel="icon" type="image/png" sizes="120x120" href="../notes-cloud-120.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../notes-cloud-96.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../notes-cloud-32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../notes-cloud-16.png">
   <title>Create An account | e-Notes</title>
   <!-- box Icons -->
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <!-- Main Styling -->
   <link rel="stylesheet" href="../assets/css/styles.css?key=<?php echo time(); ?>" />
 </head>

 <body>
   <div class="container">
     <div class="main">
       <div class="cnt1">
         <!-- Navbar -->
         <nav>
           <div class="cnt2">
             <a class="cname" href="../index.php"> e-Notes </a>
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
           <form role="form" name="myForm" id="myForm" method="POST">
             <label for="email">Email</label>
             <input type="email" id="email" name="email" placeholder="eg:(example@gmail.com)" required />
             <label for="username">Full Name</label>
             <input type="text" id="username" name="username" placeholder="ramesh_uncle" required />
             <label for="password">Password</label>
             <input type="Password" id="password" name="password" placeholder="Password(at least 8 characters)" required />
             <label for="conf-password">Confirm Password</label>
             <input type="Password" id="password1" name="password1" placeholder="Confirm Password" required />
             <p id="errorMessage" style="height: 12px; padding: 3px; width:100%; font-size:small;"></p>
             <button type="submit">Create Account</button>
            </form>
          </div>
          <div class="accInfo">
            <p>
              Aldready have an account?
              <a href="./sign-in">Sign In</a>
            </p>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script src="../assets/js/app.js"></script>
 </html>