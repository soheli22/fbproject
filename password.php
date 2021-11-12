<?php

require_once "autoload.php";

// chekc user login 
if (userLogin() == false) {
    header('location:index.php');
} else {
    $login_user = loginUserData('users', $_SESSION['id']);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $login_user-> name; ?></title>
    <!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>


    <?php include_once "templates/menu.php"; ?>

    <section class="user-profile">

    <?php 
    
    if(isset($_POST['cp'])){
        $old_pass = $_POST['old'];
        $new_pass = $_POST['new'];
        $c_pass = $_POST['cnew'];
    
        $hash_pass = getHash($new_pass);

        if(empty($old_pass) || empty($new_pass) || empty($c_pass)){
            echo $msg = validate('All fields are reqired !');
        }elseif($new_pass != $c_pass ){
            echo  $msg = validate('Password confirmation failed ');
        }else if (password_verify($old_pass, $login_user->password) == false) {
            echo $msg = validate('Old password not match');
        }else {
            update("UPDATE users SET password='$hash_pass' WHERE id='$login_user->id'");
            session_destroy();
            header('location:index.php');
        }
    

    
    }
    
    
    
    ?>

    <div class="card shadow">
     <div class="card-body">
         <form action="" method="POST">
             <div class="form-group">
              <input class="form-control" type="password" name="old" placeholder="Old Password">
             </div>
             
             <div class="form-group">
              <input class="form-control" type="password" name="new" placeholder="New Password">
             </div>

             <div class="form-group">
              <input class="form-control" type="password" name="cnew" placeholder="confirm Password">
             </div>

             <div class="form-group">
              <input class="btn btn-primary" type="submit" name="cp" value="change password">
             </div>

         </form>
     </div>   
    </div>



    </section>



<!-- JS FILES  -->
<script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>