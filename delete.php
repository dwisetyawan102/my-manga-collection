<?php 
  session_start();

  if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
  }

  require "functions.php";

  $id = $_GET["id"];

  if( delete($id) > 0 ) {
    echo "
      <script>
        alert('Succes delete this manga!');
        document.location.href = 'index.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Error delete this manga!');
        document.location.href = 'index.php';
      </script>
    ";
  }
?>