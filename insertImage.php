<?php
  // Create database connection
  $db = mysqli_connect("127.0.0.1", "zero", "1234567890-=", "test");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
    $image = $_FILES['image']['name'];
    
    $number = $_POST['number'];

    $name = $_POST['name'];

    $phone = $_POST['phone'];

    if ($_FILES['image']['type']=='image/png') {
      $photoName = $number. '.png';
    } else if ($_FILES['image']['type']=='image/jpg') {
      $photoName = $number. '.jpg';
    } else {
      $photoName = $number. '.jpeg';
    }
  	// Get text
  	// $image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target = "uploads/".basename($photoName);

  	$sql = "INSERT INTO tourist_guide (image, name, number, phone) VALUES ('$photoName', '$name', '$number', '$phone')";
    // execute query
    
    $db->query("SET NAMES utf8");

    $result = $db->query($sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/index.css">
  <script src="./js/jquery-3.5.1.min.js"></script>
  <title>Image Upload</title>
</head>
<body>
<div class="post-image">
  <form class="content" method="POST" action="insertImage.php" enctype="multipart/form-data">
  	<div class="content-head">
      <img id="preview" src="./image/head.jpeg" alt="" class="content-head__img">
      <label class="content-head__box">
        <input class="content-head__input" type="file" name="image" id="file" value="">
        <p class="content-head__button">上傳圖片</p>
      </label>
  	</div>
    <ul class="content-list">
      <li class="content-item">
        <p>學號：</p>
        <input type="text" name="number" class="content-item__textbox">
      </li>
      <li class="content-item">
        <p>姓名：</p>
        <input type="text" name="name" class="content-item__textbox">
      </li>
      <li class="content-item">
        <p>電話：</p>
        <input type="text" name="phone" class="content-item__textbox">
      </li>
    </ul>
  	</div>
  	<label class="content-submit">
      <button class="content-submit__button" type="submit" name="upload"></button>
      <p class="">送出</p>
  	</label>
  </form>
</div>
<script>
    $(function() {
    //預覽上傳圖片
      $('#file').change(function() {
        var f = document.getElementById('file').files[0];
        var src = window.URL.createObjectURL(f);
        document.getElementById('preview').src = src;
      });
    });
  </script>
</body>
</html>