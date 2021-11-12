<?php

require_once "autoload.php";

// chekc user login 
if (userLogin() == false) {
	header('location:index.php');
} else {

	if (isset($_GET['user_id'])) {
		$login_user = loginUserData('users', $_GET['user_id']);
	} else {
		$login_user = loginUserData('users', $_SESSION['id']);
	}
}










?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title><?php echo $login_user->name; ?></title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>


	<?php include_once "templates/menu.php"; ?>

	<section class="user-profile">

		<?php if (isset($login_user->photo)) : ?>
			<img class="shadow" src="media/users/<?php echo $login_user->photo; ?>" alt="">
		<?php elseif ($login_user->gender == 'Male') : ?>
			<img class="shadow" src="assets/media/m.jpg" alt="">
		<?php elseif ($login_user->gender == 'Female') : ?>
			<img class="shadow" src="assets/media/f.jpg" alt="">
		<?php endif; ?>





		<h3 class="text-center display-4 py-3"><?php echo $login_user->name; ?></h3>

		<div class="card shadow">
			<div class="card-body">
				<table class="table table-striped">
					<tr>
						<td>Name</td>
						<td><?php echo $login_user->name; ?></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><?php echo $login_user->email; ?></td>
					</tr>
					<tr>
						<td>Cell</td>
						<td><?php echo $login_user->cell; ?></td>
					</tr>
					<tr>
						<td>Gender</td>
						<td><?php echo $login_user->gender; ?></td>
					</tr>
                    <?php if($login_user -> age != NULL): ?>
					<tr>
						<td>Age</td>
						<td><?php echo $login_user->age; ?></td>
					</tr>
                    <?php endif; ?>

					<?php if($login_user -> edu != NULL): ?>
					<tr>
						<td>Education</td>
						<td><?php echo $login_user->edu; ?></td>
					</tr>
                    <?php endif; ?>
					
				</table>
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