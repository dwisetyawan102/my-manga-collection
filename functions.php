<?php 
  $db = mysqli_connect("localhost", "root", "", "dbmanga");

  function query($query) {
    global $db;
    $result = mysqli_query($db, $query);

    // mengecek apakah koneksi ke database dan tabel berhasil atau tidak
    if( !$result ) {
      echo mysqli_error($db);
    }

    // fetching data 
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
      $rows[] = $row;
    }
    return $rows;
  }

  function add($data) {
    global $db;

    $title = htmlspecialchars($data["title"]);
    $mangaka = htmlspecialchars($data["mangaka"]);
    $releaseyear = htmlspecialchars($data["releaseyear"]);
    $cover = htmlspecialchars($data["cover"]);

    $query = "INSERT INTO tbmanga VALUES('', '$title', '$mangaka', '$releaseyear', '$cover')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }

  function delete($id) {
    global $db;

    mysqli_query($db, "DELETE FROM tbmanga WHERE id = $id");
    return mysqli_affected_rows($db);
  }

  function detail() {
    global $db;

    $id = $_GET["id"];
    $result = mysqli_query($db, "SELECT * FROM tbmanga WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    return $row;
  }

  function update($data) {
    global $db;

    $id = $data["id"];
    $title = htmlspecialchars($data["title"]);
    $mangaka = htmlspecialchars($data["mangaka"]);
    $releaseyear = htmlspecialchars($data["releaseyear"]);
    $cover = htmlspecialchars($data["cover"]);

    $query = "UPDATE tbmanga SET title = '$title', mangaka = '$mangaka', releaseyear = '$releaseyear', cover = '$cover' WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }
?>