<?php
// database connecion

$server = "localhost";
$username = "root";
$password = "";
$database = "School_project";

$conn = new mysqli($server , $username , $password , $database);
if(!$conn){
  echo("Connecion failed");
}

// select data from databse

$sql = "SELECT * FROM `user_info`";
$result = $conn->query($sql);
$checkRows = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Php</title>
</head>
<body>
  <table>
    <tr>
    <th>Student Name</th>
    <th>Student Addres</th>
    <th>Grade</th>
    </tr>
    <?php 
    if($checkRows > 0){
      while( $row = $result->fetch_assoc() ){
        
        echo "<tr>";
        echo "<td>" . $row['facebook']."</td>";
        echo "<td>" . $row['instagram']."</td>";
        echo "<td>" . $row['twitter']."</td>";
        echo "</tr>";

      }
    } else{
      echo "no data found";
    };
    
?>
</table>
</body>
</html>