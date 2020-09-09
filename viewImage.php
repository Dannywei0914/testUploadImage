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
    $all = $statement-> rowCount(); //統計筆數
    
    $per = 5; //每頁顯示數量
    $start = 1;
 
    $pages = ceil($all/$per); //取得不小於值的下一個整數
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
      $page=1; //則在此設定起始頁數
    } else {
      $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
      $start = ($page-1)*$per; //每一頁開始的資料序號
    }
    $result = $connection->query('select * from tourist_guide order by tourist_guide.id DESC LIMIT ' . $start . ',' .$per);
  ?>
  <ul>
    <li style="display: flex; align-items: center;">
      <p style="width: 100px; margin: 0 10px">照片</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">id</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">名字</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">學號</p>
      <p style="padding: 0 5px; margin: 0; width: 100px">電話</p>
    <li>
    <?php foreach($result as $row){?>
      <li style="display: flex; height: 150px; align-items: center;">
        <img  id="preview" style="height: 100px; width: 100px; margin: 0 10px" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/WebsiteProject/test/testUploadImage/uploads/'.$row['image']?>">
        <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['id']; ?></p>
        <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['name']; ?></p>
        <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['number']; ?></p>
        <p style="padding: 0 5px; margin: 0; width: 100px"><?php echo $row['phone']; ?></p>
      </li>
    <?php }?>
  </ul>
  <?php
    //分頁頁碼
    echo '共 '.$all.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {
            echo "<a href=?page=".$i.">".$i."</a> ";
        }
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
  ?>
  <a href="./insertImage.php">新增單筆資料</a>
</body>
</html>

