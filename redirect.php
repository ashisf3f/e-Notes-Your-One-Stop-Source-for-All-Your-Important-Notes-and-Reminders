<?php
  // Get the destination URL from the query string
  $destination = $_GET['destination'];

  // Check if a destination URL is provided
  if (isset($destination)) {
    // Redirect the user to the specified URL
    header("Location: $destination");
    exit();
  } else {
    // If no destination URL is provided, show an error message
    header("Location: ./u/profile");
    exit();
  }
?>