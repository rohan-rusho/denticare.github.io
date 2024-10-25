<?php 
	include '../components/connect.php';

	$warning_msg = [];
	$success_msg = [];

	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$email = filter_var($email, FILTER_SANITIZE_STRING);

		$pass = sha1($_POST['pass']);
		$pass = filter_var($pass, FILTER_SANITIZE_STRING);

		$select_admin = $conn->prepare("SELECT * FROM `admin` WHERE email = ? AND password = ? LIMIT 1");
		$select_admin->execute([$email, $pass]);
		$row = $select_admin->fetch(Pdo::FETCH_ASSOC);

		if($select_admin->rowCount() > 0) {
			setcookie('admin_id', $row['id'], time() + 60*60*24*30, '/');
			header('location:dashboard.php');
		}else{
			$warning_msg[] = 'incorrect email or password';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE-edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DentiCare - dental clinic website template</title>

	<!-- font awesome cdn link -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0.css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/admin_style.css?v=<?php echo "time"; ?>">
	<link rel="icon" href="../image/favicon.ico" type="image/x-icon">
	<script>
		function togglePasswordVisibility(id) {
			const passwordField = document.getElementById(id);
			passwordField.type = passwordField.type === "password" ? "text" : "password";
		}
	</script>
</head>
<body style="padding-left: 0;">
<!-- register section starts -->

<div class="form-container form">
	<form action="" method="post" enctype="multipart/form-data" class="login">
		<h3>login now</h3>

		<div class="input-field">
			<p>your email <span>*</span></p>
			<input type="email" name="email" placeholder="enter your email" maxlength="50" required class="box">
		</div>
		<div class="input-field">
			<p>your password <span>*</span></p>
			<input type="password" id="loginPass" name="pass" placeholder="enter your password" maxlength="50" required class="box">
			<label>
				<input type="checkbox" onclick="togglePasswordVisibility('loginPass')"> Show Password
			</label>
		</div>

		<p class="link">do not have an account <a href="register.php">register now</a></p>
		<button type="submit" name="login" class="btn">login now</button>
	</form>
</div>	

<!-- register section ends -->

<!-- sweetalert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js link -->
<script type="text/javascript" src="../js/admin_script.js"></script>

<?php include '../components/alert.php'; ?>

</body>
</html>
