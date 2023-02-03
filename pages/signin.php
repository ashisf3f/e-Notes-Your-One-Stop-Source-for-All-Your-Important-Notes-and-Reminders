<?php
require '../backend/database/db.inc.php';

$showAlert = false;
$error  = '';
$loggedin = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $response = array();
    $content = trim(file_get_contents("php://input"));
    $_arr = json_decode($content, true);

    $userEmail = $_arr['email'];
    $userPass = $_arr['password'];

    if (empty($userEmail)) {
        $response["error"]  = 'Enter Your Email !';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else if (empty($userPass)) {
        $response["error"]  = 'Enter Your Password !';
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    } else {
        $userEmail = mysqli_real_escape_string($conn, $userEmail);
        $checkExist = "SELECT * from sign_up Where Email='$userEmail'";
        $result = $conn->query($checkExist);
        $checkStatus = $result->num_rows;

        if ($checkStatus == 1) {
            while ($row = $result->fetch_assoc()) {
                if (password_verify($userPass, $row['password'])) {
                    session_start();
                    setcookie('loginfo', true, time() + 60 * 60 * 30);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $userEmail;
                    $user = $row['username'];
                    $user_id = $row['id'];
                    $_SESSION['userid']  = $user_id;
                    $_SESSION['username'] = $user;

                   
                    $loggedin = true;
                    $response["redirect"]  = '../';
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit(); 
                
                } else {
                    $response["error"]  = 'Invalid Passowrd';
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }
            }
        } else {
            $response["error"]  = 'Invalid Credentails';
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }
}
