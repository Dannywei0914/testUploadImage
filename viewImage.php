<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./js/jquery-3.5.1.min.js"></script>
  <title>Document</title>
</head>
<style>
  li {
    display: flex;
    height: 150px;
    align-items: center;
  }

  p {
    padding: 0 5px;
    margin: 0; 
    width: 100px;
  }

  .img {
    height: 100px; 
    width: 100px; 
    margin: 0 10px;
    display: flex;
    align-items: center;
  }

  i {
    width: 30px;
    height: 30px;
    background-color: #636363;
  }
</style>
<body>
  <?php
    include('./connMySql.php');
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
    <li>
      <span class="img">照片</span>
      <p>id</p>
      <p>名字</p>
      <p>學號</p>
      <p>電話</p>
    </li>
    <?php foreach($result as $row){?>
      <li>
        <img id="preview" class="img" src="<?php echo 'http://'.$_SERVER['HTTP_HOST'].'/WebsiteProject/test/testUploadImage/uploads/'.$row['image']?>">
        <p><?php echo $row['id']; ?></p>
        <p><?php echo $row['name']; ?></p>
        <p><?php echo $row['number']; ?></p>
        <p><?php echo $row['phone']; ?></p>
        <?php echo "<a href='updateData.php?id=".$row['id']."'>編輯</a></td>";?>
        <?php echo "<a href='deleteData.php?id=".$row['id']."'>刪除</a></td>";?>
      </li>
    <?php }?>
  </ul>
  <?php
    //分頁頁碼
    echo '共 '.$all.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
    echo "<br /><a href=?page=1>首頁</a> ";
    echo "第 ";
    for( $i=1 ; $i<=$pages ; $i++ ) {
      echo "<a href=?page=".$i.">".$i."</a> ";
    } 
    echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
  ?>
  <a href="./insertImage.php">新增單筆資料</a>
</body>
</html>

