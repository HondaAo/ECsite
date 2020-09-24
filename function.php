<?php
function connectDB(){
  $DB_NAME= 'mysql:dbname=my_image;host=localhost';

  try{
      $pdo = new PDO( $DB_NAME , 'root', '');
      return $pdo;
  }
  catch(PDOException $e){
    echo $e->getMessage();
    exit();
  }

}