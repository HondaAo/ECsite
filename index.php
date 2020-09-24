<?php
 $page=0;
 if(isset($_POST['btn-login'])){
     $page=1;
 }

?>

<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 </head>
 <style>
     .container{
         padding-top: 20%;
         padding-left: 25%;
     }
     </style>
 <body>
<?php if($page == 0): ?>
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.5/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    Signup page
  </a>
</nav>
<div class="container">
 <form method="POST" action="signup.php">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="inputEmail3" name="name">
    </div>
  </div>
   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control" id="inputEmail3" name="email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" name="password">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Reenter Password</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" name="reenter-password">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">Checkbox</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Have you checked agreement?
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-7" style="padding-left: 30%;">
      <button type="submit" class="btn btn-primary" style="width: 100px;">Register</button>
    </div>
</div>
</form>
<form method="POST" action="index.php"> 
    <div class="col-sm-7" style="padding-left: 29%;">
      <button type="submit" class="btn btn-primary" name="btn-login"  style="width: 100px;">Login</button>
    </div>
  </div>
</form>
</div>
<?php endif ?>
<?php if($page==1): ?>
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="/docs/4.5/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
    Login page
  </a>
</nav>
 <div class="container">
 <form method="POST" action="login.php">
   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-4">
      <input type="email" class="form-control" id="inputEmail3" name="email">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-4">
      <input type="password" class="form-control" id="inputPassword3" name="password">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-2">Checkbox</div>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          Example checkbox
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-7" style="padding-left: 30%;">
      <button type="submit" class="btn btn-primary" style="width: 100px;">Login</button>
    </div>
</form>
<?php endif?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </body>
 </html>