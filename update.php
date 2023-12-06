<?php 
  require "functions.php";

  $id = $_GET["id"];

  $manga = query("SELECT * FROM tbmanga WHERE id = $id")[0];
  
  if( isset($_POST["submit"]) ) {
    if( update($_POST) > 0 ) {
      echo "
        <script>
          alert('Succes updating new manga!');
          document.location.href = 'index.php';
        </script>
      ";
    } else {
      echo "
        <script>
          alert('Error updating new manga!');
        </script>
      ";
      echo mysqli_error($db);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update new manga</title>
</head>
<body>

  <h1>Input manga details</h1>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $manga["id"] ?>">
    <input type="hidden" name="oldCover" value="<?php echo $manga["cover"] ?>">
    <ul>
      <li><input type="text" name="title"  placeholder="title" value="<?php echo $manga["title"] ?>" require></li>
      <li><input type="text" name="mangaka"  placeholder="mangaka" value="<?php echo $manga["mangaka"] ?>" require></li>
      <li><input type="text" name="releaseyear"  placeholder="releaseyear" value="<?php echo $manga["releaseyear"] ?>" require></li>
      <li><img src="cover/<?php echo $manga["cover"] ?>" alt="" width="80"></li>
      <li><input type="file" name="cover"  placeholder="cover" value="<?php echo $manga["cover"] ?>" require></li>
    <button type="submit" name="submit">Update manga!</button>  
    </ul>
  </form>

</body>
</html>