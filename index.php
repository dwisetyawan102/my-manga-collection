<?php 
  $db = mysqli_connect("localhost", "root", "", "dbmanga");
  $result = mysqli_query($db, "SELECT * FROM tbmanga");
  if( !$result ) {
    echo mysqli_error($db);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Manga Collection</title>
</head>
<body>
  
  <h1>MyManga-Collection</h1>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th>No.</th>
      <th>Cover</th>
      <th>Title</th>
      <th>Mangaka</th>
      <th>Year</th>
    </tr>
    <?php $i = 1 ?>
    <?php while($manga = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><img src="cover/<?php echo $manga["cover"] ?>" alt=""></td>
      <td><?php echo $manga["title"] ?></td>
      <td><?php echo $manga["mangaka"] ?></td>
      <td><?php echo $manga["year"] ?></td>
    </tr>
    <?php } ?>
  </table>

</body>
</html>