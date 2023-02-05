<?php
  require '../backend/database/db.inc.php';
  $showAlert = 0;
  $error = 0;

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $content = trim(file_get_contents("php://input"));
    $_arr = json_decode($content, true);
    // Get the form data
    $email = $_arr['email'];
    $username = $_arr['username'];
    $password = $_arr['password'];
    $conf_password = $_arr['password1'];

    // Validate the form data (optional)
    if (empty($username)) {
        $response["error"]  = 'Enter enter your fullname !';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } elseif (empty($email)) {
        $response["error"]  = 'Please enter an email !';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } elseif (empty($password)) {
        $response["error"]  = 'Set a password';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } elseif (empty($conf_password)) {
        $response["error"]  = 'Set a password';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } elseif (strlen($password) < 8) {
        $response["error"]  = 'Password must be at least of 8 character';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } elseif ($password !== $conf_password) {
        $response["error"]  = 'Passowrd didn\'t match';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
      
      // Check if email already exists in the database
      $existEmail = "SELECT * FROM `sign_up` WHERE Email = '$email'";
      $result = $conn->query($existEmail);
      $checkStatus = $result->num_rows;
      if ($checkStatus > 0) {
        $response["error"]  = 'Email aldready exist';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
      } else {
        // hash password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        // insert random number and submit form to sql database
        $sql = "INSERT INTO `sign_up`( `email`, `username`, `password`) VALUES ('$email','$username','$hashPassword') ";
        $query = "INSERT INTO `user_info`(`email`) VALUES ('$email')";
        $info = $conn->query($query);
        $result3 = $conn->query($sql);
        if ($result3) {
            $response["redirect"]  = './sign-in';
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();       
        }
      }
    }
  }
