<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./js/jquery-3.5.1.min.js"></script>
  <title>Document</title>
</head>
<body>
  <?php
    $connection = new PDO('mysql:host=localhost;dbname=test; charset=utf8', 'zero', '1234567890-=');
    $statement = $connection->query('select * from tourist_guide');
    //print_r($statement);    
  ?>
  <ul>
    <li style="display: flex; align-items: center;">
      <p style="width: 100px; margin: 0 10px">照片</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">id</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">名字</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">學號</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">電話</p>
    <li>
    <?php foreach($statement as $row){?>
    <li style="display: flex; height: 150px; align-items: center;">
      <img  id="preview" style="height: 100px; width: 100px; margin: 0 10px" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/WebsiteProject/test/testUploadImage/uploads/'.$row['image']?>">
      <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['id']; ?></p>
      <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['name']; ?></p>
      <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['number']; ?></p>
      <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['phone']; ?></p>
      <!-- <form action="testViewImage.php" method="post" enctype="multipart/form-data">
        <input type="text" name="number" value="<?php echo $row['number']?>">
        <input type="file" name="file" id="file">
        <input type="submit" value="Upload Image" name="submit">
      </form> -->
    </li>
    <?php }?>
  </ul>
  <script>
    $(function() {
    //預覽上傳圖片
      $('#file').change(function() {
          var f = document.getElementById('file').files[0];
          console.log(f);
          var src = window.URL.createObjectURL(f);
          console.log(src);
          document.getElementById('preview').src = src;
      });
    });
  </script>
  <?php
    $db = mysqli_connect("127.0.0.1", "zero", "1234567890-=", "test");

    $msg = "";

    if (!isset($_FILES["file"]["name"])) {
      return;
    }

    if(is_uploaded_file($_FILES['file']['tmp_name'])){
      $image = $_FILES['file']['name'];
    
      $number = $_POST['number'];

      if ($_FILES['file']['type']=='image/png') {
        $photoName = $number. '.png';
      } else if ($_FILES['file']['type']=='image/jpg') {
        $photoName = $number. '.jpg';
      } else if ($_FILES['file']['type']=='image/jpeg') {
        $photoName = $number. '.jpeg';
      } else {
        echo '此副檔名需為jpg.jpge.png';
      }

      $target = "uploads/".basename($photoName);

      $sql = "INSERT INTO tourist_guide (image) VALUES ('$photoName')";

      mysqli_query($db, $sql);

      if(move_uploaded_file($_FILES['file']['tmp_name'], $target)){
        if($_FILES['file']['type']=='image/png' || $_FILES['file']['type']=='image/jpeg'){//判斷檔名是否為圖檔
          
          echo $target, '上傳成功。';
          // echo '<p><img src="',$file,'"></p>';
        }else{//如果不為圖檔的話
          echo '此副檔名需為jpg.jpge.png';
        }
      }else{
          echo '上傳失敗。';
      }
    }else{
        echo '請選擇檔案。';
    }
  ?>
</body>
</html>

