<?php
require_once 'function.php';

$pdo = connectDB();

$sql = 'SELECT * FROM profile_image WHERE user_name=:user_name LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_name', (string)$_GET['id'], PDO::PARAM_STR);
$stmt->execute();
$image = $stmt->fetch();

echo $image['image_content'];

unset($pdo);
exit();
?>