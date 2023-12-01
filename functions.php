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

    $title = $data["title"];
    $mangaka = $data["mangaka"];
    $year = $data["year"];
    $cover = $data["cover"];

    $query = "INSERT INTO tbmanga VALUES('', '$title', '$mangaka', '$year', '$cover')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }
?>