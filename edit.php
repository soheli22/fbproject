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
    
    if(isset($_POST['update'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $cell = $_POST['cell'];
        $uname = $_POST['uname'];
        $age = $_POST['age'];
        $edu = $_POST['edu'];
        $gender = $_POST['gender'];
        $login_user_id = $login_user -> id ;
        $updated_at = date('y-m-d h:m:s');
    
        

        if(empty($name) || empty($email) || empty($cell) || empty($uname) || empty($gender)){
            echo validate('All fields are reqired !');
        }else{
            update("UPDATE users SET name='{$name}', email='{$email}', cell = '{$cell}', 
            username = '{$uname}' , gender = '{$gender}' , age = '{$age}' , edu = '{$edu}', updated_at= '{$updated_at}' WHERE id='{$login_user_id}'" );
            setMsg('sucess' , 'Data Update successful');
            header("location:edit.php");
        }
    

    
    }
    
    
    
    ?>

    <div class="card shadow">
     <div class="card-body">
         <form action="" method="POST">
             <div class="form-group">
                 <label for="">Name</label>
              <input class="form-control" type="text" name="name" value="<?php echo $login_user-> name; ?>">
             </div>
             
             <div class="form-group">
                 <label for="">Email</label>
              <input class="form-control" type="text" name="email" value="<?php echo $login_user-> email; ?>">
             </div>

             <div class="form-group">
                 <label for="">Cell</label>
              <input class="form-control" type="text" name="cell" value="<?php echo $login_user-> cell; ?>">
             </div>

             <div class="form-group">
                 <label for="">Username</label>
              <input class="form-control" type="text" name="uname" value="<?php echo $login_user-> Username; ?>">
             </div>

             <div class="form-group">
                 <label for="">Age</label>
              <input class="form-control" type="text" name="age" value="<?php echo $login_user-> age; ?>">
             </div>

             <div class="form-group">
                 <label for="">Education</label>
              <input class="form-control" type="text" name="edu" value="<?php echo $login_user-> edu; ?>">
             </div>

             <div class="form-group">
						<label for="">Gender</label>
						<input name="gender" type="radio" <?php echo ($login_user -> gender == 'Male') ? 'checked' : ''; ?> 
                        value="Male" id="Male"><label for="Male">Male</label>
						<input name="gender" type="radio" <?php echo ($login_user -> gender == 'Female') ? 'checked' : ''; ?> 
                        value="Female" id="Female"><label for="Female">Female</label>
					</div>

             <div class="form-group">
              <input class="btn btn-primary" type="submit" name="update" value="Update">
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