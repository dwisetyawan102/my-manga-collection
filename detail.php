<?php 
  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

  require "functions.php";

  // $db = mysqli_connect("localhost", "root", "", "dbmanga");

  $row = detail();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail manga</title>
</head>
<body>
  
  <h1>Detail manga</h1>

  <ul>
    <li><img src="cover/<?php echo $row["cover"] ?>" alt=""></li>
    <li>
      <h2><?php echo $row["title"] ?></h2>
    </li>
    <li><?php echo $row["mangaka"] ?></li>
    <li><?php echo $row["releaseyear"] ?></li>
  </ul>

</body>
</html>