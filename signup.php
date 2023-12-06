<?php 
  require 'functions.php';

  if( isset($_POST["signup"]) ) {
    if( signup($_POST) > 0 ) {
      echo "<script>
              alert('Succes sign up');
            </script>";
    } else {
      mysqli_error($db);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
</head>
<body>
  
  <h1>Sign Up</h1>

  <form action="" method="post">
    <input type="text" name="username" id="" placeholder="Username..." required>
    <input type="text" name="password" id="" placeholder="Password..." required>
    <input type="text" name="password2" id="" placeholder="Confirm password..." required>
    <button type="submit" name="signup">Sign Up</button>
  </form>

</body>
</html>