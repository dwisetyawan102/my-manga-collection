<?php 
  require "functions.php";
  $mangas = query("SELECT * FROM tbmanga");
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

  <a href="add.php">[+] Add new manga</a> <br><br>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th>No.</th>
      <th>Cover</th>
      <th>Title</th>
      <th>Mangaka</th>
      <th>Year</th>
      <th>Action</th>
    </tr>
    <?php $i = 1 ?>
    <?php foreach( $mangas as $manga ) { ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><img src="cover/<?php echo $manga["cover"] ?>" alt=""></td>
      <td><?php echo $manga["title"] ?><a href="detail.php?id=<?php echo $manga["id"] ?>">Detail</a></td>
      <td><?php echo $manga["mangaka"] ?></td>
      <td><?php echo $manga["year"] ?></td>
      <td>
        <a href="">Update</a> |
        <a href="delete.php?id=<?php echo $manga["id"] ?>" onclick="return confirm('Delete this manga?');">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>

</body>
</html>