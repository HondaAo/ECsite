<?php
 require 'function.php';
 $pdo = connectDB();
 $email = $_POST['email'];
 $name = $_POST['name'];
 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 if(empty($_POST['email'])||empty($_POST['password'])){
  echo 'you have to fill email and Password.';
  echo '<a href="index.php">BACK</a>';
  exit();
 }else{
 if($_POST['password'] != $_POST['reenter-password']){
   echo 'Please confirm password.';
   echo '<a href="index.php">BACK</a>';
 }else{
 if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo 'Your email was invalid.';
    return false; 
 }else{
 $sql = 'INSERT INTO signup(name,email, password , created_at) VALUES(:name,:email,:password,NOW()) ';
 $stmt = $pdo->prepare($sql);
 $stmt->bindValue(':name', $name, PDO::PARAM_STR);
 $stmt->bindValue(':email', $email, PDO::PARAM_STR);
 $stmt->bindValue(':password', $password, PDO::PARAM_STR);
 $stmt->execute();
 }
}
 }
 unset($pdo);
 header("Location:edit.php?id=".$name);
 exit();

 ?>

 