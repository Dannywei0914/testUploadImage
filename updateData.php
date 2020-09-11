<?php
  $userID = $_GET['id'];

  include ('connMySql.php');
  
  $sql_getDataQuery = "SELECT * FROM tourist_guide WHERE id = $userID";

  $result = $connection->query($sql_getDataQuery);

  foreach($result as $row_result){
    $name = $row_result['name'];
    $number = $row_result['number'];
    $phone = $row_result['phone'];
    $image = $row_result['image'];
  }

  if (isset($_POST['action'])) {
    $newName = $_POST['name'];
    $newNumber = $_POST['number'];
    $newPhone = $_POST['phone'];
    $id = $_SERVER['QUERY_STRING'];

    $sql_query = "UPDATE tourist_guide SET name = '$newName' , number = '$newNumber', phone = '$newPhone' WHERE tourist_guide.id = $id";

    $connection->query($sql_query);

    // header('Location: viewImage.php?page=1');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/index.css">
  <script src="./js/jquery-3.5.1.min.js"></script>
  <title>update</title>
</head>
<body>
<div class="post-image">
  <form class="content" method="POST" action="updateData.php" enctype="multipart/form-data">
  	<div class="content-head">
      <img id="preview" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/WebsiteProject/test/testUploadImage/uploads/'.$image?>" alt="" class="content-head__img">
      <label class="content-head__box">
        <input class="content-head__input" type="file" name="image" id="file" value="">
        <p class="content-head__button">上傳圖片</p>
      </label>
  	</div>
    <ul class="content-list">
      <li class="content-item">
        <p>學號：</p>
        <input type="text" name="number" class="content-item__textbox" value="<?php echo $number?>">
      </li>
      <li class="content-item">
        <p>姓名：</p>
        <input type="text" name="name" class="content-item__textbox" value="<?php echo $name?>">
      </li>
      <li class="content-item">
        <p>電話：</p>
        <input type="text" name="phone" class="content-item__textbox" value="<?php echo $phone?>">
      </li>
    </ul>
  	</div>
  	<label class="content-submit">
      <input class="content-submit__button" type="submit" name="action" value='<?php $id?>'>
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