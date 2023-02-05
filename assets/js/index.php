<?php
session_start();
if (isset($_SESSION['loggedin']) == true) {
    header('location: ../../');
    exit;
} else if (!isset($_SESSION['loggedin']) == true) {
    header('location: ../../');
    exit;
}
