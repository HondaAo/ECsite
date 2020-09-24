<?php
require 'function.php';
session_start();
try{
$pdo = connectDB();
$sql = 'SELECT * FROM signup WHERE email= :email';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $_POST['email'],PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}
catch(PDOExceptio $e){
   echo 'your email was not registred.';
}
if($_COOKIE['email']!=''){
  $_POST['email']=$_COOKIE['email'];
  $_POST['password'] = $_COOKIE['password'];
  $_POST['save'] = 'on';
}
if(!isset($row['email'])){
    echo 'email was wrong</br>';
    echo '<a href="index.php">HOME</a>';
    return false;
}else{
 if (password_verify($_POST['password'],$row['password'])){
     session_regenerate_id(true);
     $_SESSION['name'] = $row['name'];
     if($_COOKIE['save']=='on'){
       setcookie('email',$_POST['email'],time()*60*60*24*7);
       setcookie('password',$_POST['password'],time()*60*60*24*7);
     }
     header("Location:list.php?id=".$row['name']);
     exit();
 }else{
   echo 'your password was wrong';
   echo $row['password'];
   return false;  
 }
}
?>