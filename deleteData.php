<?php
  $userId = $_GET['id'];

  include ('connMySql.php');

  $sql_query = "DELETE FROM tourist_guide WHERE tourist_guide.id = $userId";

  $connection->query($sql_query);

  header("Location: viewImage.php?page=1");
?>