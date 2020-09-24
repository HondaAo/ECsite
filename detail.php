<?php
require_once 'function.php';
$pdo = connectDB();
$sql = 'SELECT * FROM images WHERE image_id = :image_id LIMIT 1';
$sql2 = 'SELECT * FROM comment WHERE picture_id=:picture_id ORDER BY created_at desc LIMIT 10';
$stmt = $pdo->prepare($sql);
$stmt2 = $pdo->prepare($sql2);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt2->bindValue(':picture_id',(int)$_GET['id'],PDO::PARAM_INT);
$stmt2->execute();
$stmt->execute();
$image = $stmt->fetch();
$comments = $stmt2->fetchAll();
$page = (int)$_GET['id'];
$name = (string)$_GET['name'];
 if(isset($_POST['btn_send'])){
   $sql3 = 'INSERT INTO comment(picture_id, user_name, comment,created_at) VALUES(:picture_id,:user_name,:comment,now())'; 
   $stmt3= $pdo->prepare($sql3);
   $stmt3->bindValue(':picture_id',(int)$_GET['id'],PDO::PARAM_INT);
   $stmt3->bindValue(':comment', $_POST['comment'],PDO::PARAM_STR);
   $stmt3->bindValue(':user_name', $_POST['user_name'],PDO::PARAM_STR);
   $stmt3->execute();
   header("Location: detail.php?id=$page&name=$name");
   exit();
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post.detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
 <style>
     body{
         text-align: center;
     }
     .row{
         margin-top: 100px;
     }
     .text{
         margin-bottom: 50px;
     }
     .comment{
         height:250px;
     }
     </style>
</head>
<body>
<nav class="navbar navbar-light bg-light" style="
    z-index: 100;
    width: 100%;
    top: 0;
    position: fixed;">
  <a class="navbar-brand">Board Practice</a>
  <form class="form-inline">
    <a href="list.php?id=<?php echo $name ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Top</a>
    <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Signup</a>
    <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Login</a>
    <a href="logout.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</a>
  </form>
</nav>
 <div class="container">
   <div class="row">
    <div class="col-sm-8 margin">
    <img src="image.php?id=<?php echo $image['image_id'];?>" width="600px" height="auto" class="card-img-top" alt="...">
    </div>
    <div class="col-sm-4">
    <p class="text"><span><?php echo $image['image_title'] ?><?php echo $name ;?></span><hr><div class="comment"><?php echo $image['image_text'];?></div></p>
    <hr>
    <div class="comment2">
    <ul class="list-unstyled"> 
     <?php for($i=0; $i< count($comments); $i++):?>
     <li>
      <p><?php echo $comments[$i]['user_name']?>:<span style="margin-left: 15px;"><?php echo $comments[$i]['comment']?></span></p>
      <p style="font-weight: 200;"><?php echo $comments[$i]['created_at']?></p>
      </li>
     <?php endfor; ?>
     </ul>
    </div>
    <hr>
    <form class="form-inline" method="POST" action="detail.php?id=<?php echo $image['image_id'];?>&name=<?php echo $name ?>">
    <div class="form-group mx-sm-3 mb-2">
      <input type="text" class="form-control" placeholder="your_name" name="user_name" style="width: 300px;">
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <input type="text" class="form-control" placeholder="Comment" name="comment"style="width: 300px;">
    </div>
    <div class="form-group mx-sm-3 mb-2">
    <button type="submit" class="btn btn-primary" name="btn_send" style="width: 300px; " >Send</button>
    </div>
   </form>
    </div>
  </div>
 </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>