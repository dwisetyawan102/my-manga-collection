<?php 
  require "functions.php";

  if( isset($_POST["submit"]) ) {
    if( add($_POST) > 0 ) {
      echo "
        <script>
          alert('Succes adding new manga!');
          document.location.href = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Error adding new manga!');
        </script>
      ";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add new manga</title>
</head>
<body>

  <h1>Input manga details</h1>

  <form action="" method="post">
    <ul>
      <li><input type="text" name="title" id="" placeholder="title"></li>
      <li><input type="text" name="mangaka" id="" placeholder="mangaka"></li>
      <li><input type="text" name="year" id="" placeholder="year"></li>
      <li><input type="text" name="cover" id="" placeholder="cover"></li>
    </ul>
    <button type="submit" name="submit">Add manga!</button>
  </form>

</body>
</html>