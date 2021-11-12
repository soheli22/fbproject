<?php

require_once "autoload.php";

if(userLogin() == true){
	header('location: profile.php');
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>FB Project</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>

	<?php

	/**
	 * Login Isset 
	 */
	if (isset($_POST['signup'])) {
		// get values 
		$login = $_POST['login'];
		$pass = $_POST['password'];


		if (empty($login) || empty($pass)) {
			$msg = validate('All fields are requirted ');
		} else {

			$login_user_data =  authCheck('users', 'email', $login);

			if ($login_user_data !== false) {

				if (passcheck($pass, $login_user_data->password)) {

					$_SESSION['id']	= $login_user_data->id;
					$_SESSION['name']	= $login_user_data->name;
					$_SESSION['email']	= $login_user_data->email;
					$_SESSION['username']	= $login_user_data->username;
					$_SESSION['cell']	= $login_user_data->cell;
					$_SESSION['gender']	= $login_user_data->gender;
					$_SESSION['photo']	= $login_user_data->photo;


					header('location:profile.php');
				} else {
					$msg = validate("Incorrect Password", 'warning');
				}
			} else {
				$msg = validate("Invalid login email address");
			}
		}
	}


	?>


	<div class="wrap shadow-sm">
		<div class="card">
			<div class="card-body">
				<h2>Log In</h2>
				<?php

				if (isset($msg)) {
					echo $msg;
				}

				?>
				<hr>
				<form action="" autocomplete="off" method="POST">

					<div class="form-group">
						<label for="">Login info</label>
						<input name="login" class="form-control" value="<?php old('login') ?>" type="text" placeholder="Email or Cell or Username">
					</div>
					<div class="form-group">
						<label for="">Password</label>
						<input name="password" class="form-control" type="password" placeholder="Password">
					</div>
					<div class="form-group">
						<input name="signup" class="btn btn-primary" type="submit" value="Log In">
					</div>
				</form>
				<hr>
				<a href="reg.php">Create an account</a>
			</div>
		</div>
	</div>


 <div class="wrap rlogin" style="cursor:pointer;">
	 <div class="row">

	 <?php  
	 
	 if(isset($_COOKIE['recent_login_id'])):
		$recent_login_user_arr= json_decode($_COOKIE['recent_login_id'], true);
		$users_id = implode(',' , $recent_login_user_arr);
		$sql = "SELECT * FORM users WHERE id IN ($users_id)";
		$data = connect()->query($sql);
		while($user = $data->fetch_object()):
	 
	 
	 ?>

      <div class="col-md-4">
		  <div class="card shadow">
			  <div class="card-body">
				  <img style="width: 100%; height:120px;" src="media/users/<?php echo $user-> photo; ?>" alt="">
				  <h4><?php echo $user-> name; ?></h4>
			  </div>
		  </div>
	  </div>
	 <?php endwhile; endif; ?>
	 </div>
 </div>







	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>

</html>