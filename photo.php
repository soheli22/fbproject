<?php 

require_once "autoload.php"; 

// chekc user login 
if( userLogin() == false ){
	header('location:index.php');
}else {
	$login_user = loginUserData('users',$_SESSION['id']);
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


		<?php if ( isset($login_user -> photo)) : ?>
			<img class="shadow" src="media/users/<?php echo $login_user -> photo; ?>" alt="">
		<?php elseif ($login_user -> gender == 'Male') : ?>
			<img class="shadow" src="assets/media/m.jpg" alt="">
		<?php elseif($login_user -> gender == 'Female'): ?>
			<img class="shadow" src="assets/media/f.jpg" alt="">
		<?php endif; ?>



    

		<br>
		<br>
		<br>

		<?php 
		
			if(isset($_POST['upload'])){
				$user_id = $_SESSION['id'];

               if(empty($_FILES['photo']['name'])){
				   setMsg('warning', 'please select a photo');
				   header('location : photo.php');
			   }else{
				   $file = move($_FILES['photo'], 'media/users/');
				   update("UPDATE users SET photo = '$file' WHERE id = '$user_id'");
				   setMsg('success' , 'Profile photo uploaded');
			   }
			   


				//$file = move($_FILES['photo'], 'media/users/');

				//update("UPDATE users SET photo='$file' WHERE id='$user_id'");
				//header('location:photo.php');
			}	
		      getMsg('warning');
			  getMsg('Success');
		
		
		?>

		<div class="card shadow">
			<div class="card-body">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="file" name="photo">
					<input type="submit" name="upload" value="upload">
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