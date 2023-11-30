<?php 
  $db = mysqli_connect("localhost", "root", "", "dbmanga");

  if( isset($_POST["submit"]) ) {
    $title = $_POST["title"];
    $mangaka = $_POST["mangaka"];
    $year = $_POST["year"];
    $cover = $_POST["cover"];

    $query = "INSERT INTO tbmanga VALUES('', '$title', '$mangaka', '$year', '$cover')";

    mysqli_query($db, $query);

    if( mysqli_affected_rows($db) > 0 ) {
      echo "Succes adding new manga!";
    } else {
      echo "Error adding new manga!";
      echo "<br>";
      echo mysqli_error($db);
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