<?php
require_once 'function.php';
session_start();
$pdo = connectDB();
$post = 0;
$page=0;
$user_name = (string)$_GET['id'];
if(isset($_SESSION['name'])){
    $post = 1;
};
    if(isset($_GET['btn-search'])){
    if(!empty($_GET['research'])){
    $page=1;
    $research = $_GET['research'];
    $sql = "SELECT * FROM images WHERE image_title LIKE '%$research%'";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
    $_GET['research']= '';
    }else{
      header('Location:list.php?id='.$_SESSION['name']);
      exit();
    }
    }
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $sql = 'SELECT * FROM images ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll();
    
    $sql2 = 'SELECT * FROM edit ORDER BY created_at ASC LIMIT 1';
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();
    $edit = $stmt2->fetchAll();
    
    

} else {
    if(isset($_POST['btn-search'])){
        $page=1;
        $research = $_POST['research'];
        $sql = "SELECT * FROM images WHERE image_title LIKE '%$research%'";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();
        $posts = $stmt->fetchAll();
     }
    
    if (!empty($_FILES['image']['name'])) {
        $rest = substr($_FILES['image']['name'], -3);
        if( $rest == 'jpg'|| $rest == 'png'){
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];
        $text = $_POST['text'];
        $title= $_POST['title'];
        $sql = 'INSERT INTO images(image_name, image_type, image_content, image_size,user_name, image_title,image_text, created_at)
                VALUES (:image_name, :image_type, :image_content, :image_size,:user_name, :image_title,:image_text , now())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);
        $stmt->bindValue(':image_title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':image_text', $text, PDO::PARAM_STR);
        $stmt->execute();
        }
    }
    unset($pdo);
    header('Location:list.php?id='.$user_name);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Image Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light bg-light" style="
    z-index: 100;
    width: 100%;
    top: 0;
    position: fixed;">
  <a class="navbar-brand">Board Practice</a>
  <div class="form-inline">
  <form class="form-inline my-2 my-lg-0" method="get" action="">
      <input class="form-control mr-sm-2" type="search" name="research" placeholder="Search..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="btn-search">Search</button>
  </form>
  </div>
  <form class="form-inline">
    <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Signup</a>
    <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Login</a>
    <a href="logout.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</a>
  </form>
</nav>
<?php if($page==0): ?>
<div class="container mt-5" style="z-index: 12;">
    <div class="row">
        <div class="col-md-8 border-right">
            <ul class="list-unstyled">
                <?php for($i = 0; $i < count($images); $i++): ?>
                    <li class="media mt-5">
                        <a href="#lightbox" data-toggle="modal" data-slide-to="<?= $i; ?>">
                            <img src="image.php?id=<?php echo $images[$i]['image_id']?>" width="200px" height="auto" class="mr-3">
                        </a>
                        <div class="media-body">
                            <h5><?php echo $images[$i]['image_title']?><br><a href="profile.php?id=<?php echo $images[$i]['user_name'];?>&name=<?php echo $user_name ?>" style="font-weight: 200;"><?php echo $images[$i]['user_name'];?></a><br><a href="detail.php?id=<?php echo $images[$i]['image_id']?>&name=<?php echo $user_name?>">detail</a></h5>
                            </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
        <?php if($post==0):?>
        <div class="col-md-4 pt-4 pl-4 " style="text-align: center;">
         <div class="goLogin">
          <p>Please Log in to your account for post</p>
          <a class="btn btn-primary" href="index.php" role="button" style="width: 200px;">Login</a>
          <a class="btn btn-primary" href="index.php" role="button" style="width: 200px; margin-top: 30px;">Signup</a>
        </div>
        </div>
        <?php endif ?>
        <?php if($post==1):?>
        <div class="col-md-4 pt-4 pl-4">
         <div style="margin: 20px;">
         <h2><?php echo $user_name;?></h2>
         <a href="profile.php?id=<?php echo $user_name?>&name=<?php echo $user_name ?>" type="button" class="btn btn-light" style="margin-left: -8px;">profile</a>
         </div>
         <div>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Select image</label>
                    <input type="file" name="image" required>
                    <br>
                    <label for="exampleFormControlInput1">Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="title">
                    <label for="exampleFormControlTextarea1">Text</label>
                    <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3" placeholder="your comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Store</button>
            </form>
        </div>
        <?php endif ?>
    </div>
</div>

<div class="modal carousel slide" id="lightbox" tabindex="-1" role="dialog" data-ride="carousel">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <ol class="carousel-indicators">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <li data-target="#lightbox" data-slide-to="<?= $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>></li>
            <?php endfor; ?>
        </ol>

        <div class="carousel-inner">
            <?php for ($i = 0; $i < count($images); $i++): ?>
                <div class="carousel-item <?php if ($i == 0) echo 'active'; ?>">
                  <img src="image.php?id=<?= $images[$i]['image_id']; ?>" class="d-block w-100">
                </div>
            <?php endfor; ?>
        </div>

        <a class="carousel-control-prev" href="#lightbox" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#lightbox" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>
<?php endif ?>
<?php if($page==1): ?>
<div class="container" style="padding-top: 5%;">
 <ul style="list-style: none;">
  <?php for($i=0; $i<count($posts); $i++): ?>
   <li>
  <div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
     <img class="bd-placeholder-img" src="image.php?id=<?php echo $posts[$i]['image_id']?>" width="100%" height="auto"  preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Image"><title>Placeholder</title><rect fill="#868e96" width="100%" height="100%"/>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $posts[$i]['image_title']?></h5>
        <p class="card-text"><?php echo $posts[$i]['user_name']?></p>
        <p class="card-text"><?php echo $posts[$i]['image_text']?></p>
      </div>
    </div>
  </div>
</div>
 </li>
  <?php endfor?>
 </ul>
 <a href="list.php?id=<?php echo $_SESSION['name']?>" class="btn btn-primary" style="margin-left:20%;">TOP</a>
</div>
<?php endif ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>

</script>
</body>
</html>