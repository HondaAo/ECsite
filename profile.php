<?php
 require 'function.php';
 $pdo = connectDB();
 $user_name=(string)$_GET['id'];
 $user_name2 = (string)$_GET['name'];
 $sql = 'SELECT * FROM edit WHERE name=:user_name ORDER BY id DESC  LIMIT 1';
 $stmt = $pdo->prepare($sql);
 $stmt->bindValue( ':user_name', $user_name, PDO::PARAM_STR);
 $stmt->execute();
 $profiles = $stmt->fetch();
 if (empty($_POST['btn-submit'])){
     $sql2 = 'SELECT * FROM profile_image WHERE user_name = :user_name';
     $stmt2 = $pdo->prepare($sql2);
     $stmt2 -> bindValue(':user_name', $user_name, PDO::PARAM_STR);
     $stmt2->execute();
     $profile_image = $stmt2->fetch();
 }else{
      if(!empty($_FILES['file']['name'])){
      $file = $_FILES['file'];
      $file_name = $file['name'];
      $file_size = $file['size'];
      $file_content = file_get_contents($file['tmp_name']);
      $sql = 'INSERT INTO profile_image(user_name,image_size,image_name,image_content) VALUES(:user_name,:image_size,:image_name,:image_content)';
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':user_name',$user_name,PDO::PARAM_STR);
      $stmt -> bindValue(':image_size',$file_size,PDO::PARAM_INT);
      $stmt -> bindValue(':image_name',$file_name,PDO::PARAM_STR);
      $stmt -> bindValue(':image_content',$file_content,PDO::PARAM_STR);
      $stmt -> execute();
      header('Location:profile.php?id='.$user_name.'&name='.$user_name2);
      }else{
      header('Location:profile.php?id='.$user_name);
      exit();
      } 
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>
     <style>
      .container{
          padding: 5%;
      }
     </style>
     <body>
     <nav class="navbar navbar-light bg-light" style="
    z-index: 100;
    width: 100%;
    top: 0;
    position: fixed;">
     <a class="navbar-brand">Board Practice</a>
     <form class="form-inline">
       <a href="list.php?id=<?php echo $user_name2; ?>" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Top</a>
       <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Signup</a>
       <a href="index.php" class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 10px;">Login</a>
       <a href="logout.php" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</a>
     </form>
     </nav>
     <div class="container">
             <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img src="profile_image.php?id=<?php echo $profile_image['user_name']; ?>" id="imgProfile"class="img-thumbnail" width="200px" height="auto" />
                                    <?php if( $user_name2 == $profiles['name']): ?>
                                    <form method="post" enctype="multipart/form-data"> 
                                    <div class="middle" >
                                        <input type="file"  id="profilePicture" name="file" required />
                                        <input type="submit" class="btn btn-secondary" id="btnChangePicture" value="Change" name="btn-submit"/>
                                    </div>
                                    </form>
                                    <?php endif ?>
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);"><?php echo $user_name ?></a></h2>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        
                                    
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Full Name</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $profiles['full_name']?>
                                            </div>
                                        </div>
                                        <hr />
                                        
                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Web site</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $profiles['url']?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Contact</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $profiles['contact'] ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Message</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $profiles['text'];?>
                                            </div>
                                        </div>
                                        <hr />

                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                        Facebook, Google, Twitter Account that are connected to this account
                                        </div>
                                    </div>
                                </div>
                            </div>
    
    
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
      </body>
     </html>