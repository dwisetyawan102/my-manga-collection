<?php 
  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

  require "functions.php";

  // pagination
  $numberOfDataPerPage = 2;
  $result = mysqli_query($db, "SELECT * FROM tbmanga");
  $numberOfData = mysqli_num_rows($result);
  $numberOfPages = ceil($numberOfData / $numberOfDataPerPage);
  if( isset($_GET["page"]) ) {
    $activePage = $_GET["page"];
  } else {
    $activePage = 1;
  }
  $beginningData = ( $numberOfDataPerPage * $activePage ) - $numberOfDataPerPage;
  
  $mangas = query("SELECT * FROM tbmanga ORDER BY id DESC LIMIT $beginningData, $numberOfDataPerPage");

  if( isset($_POST["search"]) ) {
    $mangas = search($_POST["keyword"]);
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
  
  <a href="logout.php">Logout</a>

  <h1>MyManga-Collection</h1>

  <a href="add.php">[+] Add new manga</a> <br><br>

  <form action="" method="post">
    <input type="text" name="keyword" size="50" autocomplete="off" autofocus placeholder="search by title / mangaka / year...">
    <button type="submit" name="search">Search</button>
  </form>
  <br>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr>
      <th>No.</th>
      <th>Cover</th>
      <th>Title</th>
      <th>Mangaka</th>
      <th>Release Year</th>
      <th>Action</th>
    </tr>
    <?php $i = 1 ?>
    <?php foreach( $mangas as $manga ) { ?>
    <tr>
      <td><?php echo $i++ ?></td>
      <td><img src="cover/<?php echo $manga["cover"] ?>" alt=""></td>
      <td><?php echo $manga["title"] ?><a href="detail.php?id=<?php echo $manga["id"] ?>">Detail</a></td>
      <td><?php echo $manga["mangaka"] ?></td>
      <td><?php echo $manga["releaseyear"] ?></td>
      <td>
        <a href="update.php?id=<?php echo $manga["id"] ?>">Update</a> |
        <a href="delete.php?id=<?php echo $manga["id"] ?>" onclick="return confirm('Delete this manga?');">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>
  <br>

  <?php if( $activePage > 1 ) : ?>
    <a href="?page=<?php echo $activePage - 1 ?>">&laquo;</a>
  <?php endif; ?>

  <?php for($i = 1; $i <= $numberOfPages; $i++) : ?>
    <?php if( $i == $activePage ) : ?>
      <a href="?page=<?php echo $i ?>" style="font-weight: bold; color: red;"><?php echo $i ?></a>
    <?php else : ?>
      <a href="?page=<?php echo $i ?>"><?php echo $i ?></a>
    <?php endif; ?>
  <?php endfor; ?>

  <?php if( $activePage < $numberOfPages ) : ?>
    <a href="?page=<?php echo $activePage + 1 ?>">&raquo;</a>
  <?php endif; ?>

</body>
</html>