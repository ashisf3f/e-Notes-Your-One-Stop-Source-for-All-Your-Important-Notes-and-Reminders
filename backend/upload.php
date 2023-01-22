<?php
require './database/db.inc.php';
session_start();

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$filename = $_FILES["fileToUpload"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$email = $_SESSION['email'];
$username = $_SESSION['username'];
if (empty($filename)) {
    header('location: ../?error=np-image-selected');
    exit();
} else {
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            header('location: ../?error=file-is-not-an-image');
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        header('location: ../?error=Sorry-file-already-exists.');
        //   echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        header('location: ../?error=Sorry-your-file-is-too-large. ');
        //   echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        header('location: ../?error=Sorry-only-JPG-JPEG-PNG-&-GIF-files-are-allowed ');
        //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header('location: ../?error=Sorry-your-file-was-not-uploaded');
        //   echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        // Rename file
        $newfilename = md5($file_basename) . $file_ext;
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
            // echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            $sql = "INSERT INTO `user_info`( `img_name` , `email` , `username`) VALUES ('$newfilename', '$email' , '$username')";
            $result = $conn->query($sql);
            if ($result) {
                header('Location: ../?upload success');
                exit();
            } else {
                header('Location: ../?error=upload-failed-to-database');
                exit();
            }
        } else {
            header('location: ../?error=Sorry-there-was-an-error-uploading-your-file.');
        }
    }
}
