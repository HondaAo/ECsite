<?php 
 require 'function.php';
 $user_name= (string)$_GET['id'];
 $pdo = connectDB();

 if (!empty($_POST['btn-submit'])) {
     $sql = 'INSERT INTO edit(name,full_name,url,contact,text,created_at) VALUES(:simple_name,:name,:url,:contact,:text,now())';
     $stmt=$pdo->prepare($sql);
     $stmt->bindValue(':simple_name', $user_name, PDO::PARAM_STR);
     $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
     $stmt->bindValue(':url', $_POST['url'], PDO::PARAM_STR);
     $stmt->bindValue(':text', $_POST['text'], PDO::PARAM_STR);
     $stmt->bindValue(':contact', $_POST['contact'], PDO::PARAM_STR);
     $stmt->execute();
     header('Location:list.php?id='.$user_name);
     exit();
    }
  
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-light bg-light" style="
    z-index: 100;
    width: 100%;
    top: 0;
    position: fixed;">
  <a class="navbar-brand">Board Practice</a>
  <form class="form-inline">
    <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Signup</a>
    <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Login</a>
    <a href="logout.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</a>
  </form>
</nav>
  <div class="container" style="padding: 6%;">
   <div class="row" >
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
    <div class="edit-container" style="">
    <h2><?php echo $user_name; ?></h2>
    <form method="post">
    <div class="form-group">
    <label for="formGroupExampleInput">Full Name</label>
    <input type="text" class="form-control" id="formGroupExampleInput" name="name" >
     </div>
     <div class="form-group">
     <label for="formGroupExampleInput">Website</label>
     <input type="text" class="form-control" id="formGroupExampleInput" name="url" >
     </div>
     <div class="form-group">
     <label for="formGroupExampleInput">Contact</label>
     <input type="text" class="form-control" id="formGroupExampleInput" name="contact" >
     </div>
     <div class="form-group">
     <label for="formGroupExampleInput2">Comment</label>
     <textarea type="text" class="form-control"id="formGroupExampleInput2" placeholder="Another input" rows="5" name="text"></textarea>
     </div>
     <div class="form-group">
     <input type="submit" name="btn-submit" class="btn btn-primary" value="SEND">
     </div>
    </form>
    </div>
    </div>
   <div class="col-sm-2">
   </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
 