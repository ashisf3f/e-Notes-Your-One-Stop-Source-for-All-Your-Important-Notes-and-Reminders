<?php


session_start();
session_unset();
session_destroy();
setcookie('loginfo' , true , time()-1);
header("location: ./");
?>