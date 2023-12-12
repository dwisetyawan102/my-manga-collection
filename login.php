<?php 
  session_start();

  if( isset($_COOKIE["login"]) ) {
    if( $_COOKIE["login"] == "true" ) {
      $_SESSION["login"] = true;
    }
  }

  if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
  }

  require 'functions.php';

  if( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {
      // cek password
      $row = mysqli_fetch_assoc($result);
      if( password_verify($password, $row["password"]) ) {
        // set session login 
        $_SESSION["login"] = true;

        // set cookie
        if( isset($_POST["remember"]) ) {
          setcookie("login", "true", time() + 60);
        }

        header("Location: index.php");
        exit;
      }
    }

    $error = true;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>
<body>
  
  <h1>Login</h1>

  <?php if( isset($error) ) { ?>
    <p style="color: red; font-style: italic;">username / password wrong</p>
  <?php } ?>

  <form action="" method="post">
    <input type="text" name="username" id="" placeholder="Username...">
    <input type="password" name="password" id="" placeholder="Password...">
    <input type="checkbox" name="remember" id="remember"> <label for="remember">Remember me</label>
    <button type="submit" name="login">Login</button>
  </form>

</body>
</html>