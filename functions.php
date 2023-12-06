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

    $cover = upload();
    if( !$cover ) {
      return false;
    }

    $query = "INSERT INTO tbmanga VALUES('', '$title', '$mangaka', '$releaseyear', '$cover')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }

  function upload() {
    $fileName = $_FILES["cover"]["name"];
    $fileSize = $_FILES["cover"]["size"];
    $fileError = $_FILES["cover"]["error"];
    $fileTmpName = $_FILES["cover"]["tmp_name"];

    // cek apakah tidak ada gambar yang diupload
    if( $fileError === 4 ) {
      echo "<script>
              alert('Choose file image first!');
            </script>";
      return false;
    }

    // cek apakah yang diupload adalah gambar
    $extentionImageValid = ['jpg', 'jpeg', 'png'];
    $extentionImage = explode('.', $fileName);
    $extentionImage = strtolower(end($extentionImage));
    if( !in_array($extentionImage, $extentionImageValid) ) {
      echo "<script>
              alert('What you uploaded is not an image!');
            </script>";
      return false;
    }

    // cek jika ukuranya terlalu besar
    if( $fileSize > 1000000 ) {
      echo "<script>
              alert('Image size is too large!');
            </script>";
      return false;
    }

    // jika semua lolos pengecekan, generate nama gambar baru dan lakukan proses upload
    $fileNameNew = uniqid();
    $fileNameNew .= '.';
    $fileNameNew .= $extentionImage;
    move_uploaded_file($fileTmpName, 'cover/' . $fileNameNew);

    return $fileNameNew; 
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
    $oldCover = htmlspecialchars($data["oldCover"]);

    if( $_FILES["cover"]["error"] === 4 ) {
      $cover = $oldCover;
    } else {
      $cover = upload();
    }

    $query = "UPDATE tbmanga SET title = '$title', mangaka = '$mangaka', releaseyear = '$releaseyear', cover = '$cover' WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
  }

  function search($keyword) {
    $query = "SELECT * FROM tbmanga WHERE title LIKE '%$keyword%' OR mangaka LIKE '%$keyword%' OR releaseyear LIKE '%$keyword%'";

    return query($query);
  }
?>