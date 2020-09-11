<?php
  $connection = new PDO('mysql:host=localhost;dbname=test; charset=utf8', 'zero', '1234567890-=');
  $statement = $connection->query('select * from tourist_guide');
?>