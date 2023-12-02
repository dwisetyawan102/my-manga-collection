<?php 
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