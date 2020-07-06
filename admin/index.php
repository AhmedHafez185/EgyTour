<!-- header -->
<?php
	session_start();
	$noNavbar = '';
	$pageTitle = "Login";
	if(isset($_SESSION['username']))
	{
		header('location:dashboard.php');
	}
	 include 'init.php';
	 // Check  if user comming from HTTP Request post
	 if($_SERVER['REQUEST_METHOD']=='POST'){
	 	$user = $_POST['user_name'];
	 	$pass = $_POST['password'];
	 	$hasedpass = sha1($pass);

	 	$stmt = $con->prepare("select userID, Username, Password from users where Username =? and Password = ? and GroupID = 1" );
	 	$stmt->execute(array($user, $hasedpass));
	 	$row = $stmt->fetch();
	 	print_r($row);
	 	if($stmt->rowCount()>0){
	 		$_SESSION['username'] = $user;
	 		$_SESSION['id'] = $row['userID'];
	 		header('location:dashboard.php');
	 	}
	 	else
	 	{
	 		echo '<div class="alert alert-danger"> Sorry user name or password is not correct</div>'.$hasedpass;
	 	}
	 }
 ?>

<!-- content -->
<form class="form center-block login_form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
	<h2 class="text-center">Admin Login</h2>
	<input class="form-control form-group" type="text" name="user_name" placeholder="Username" autocomplete="off">
	<input class="form-control form-group" type="password" name="password" placeholder="password" autocomplete="new-password">
	<input class="btn btn-primary btn-block form-group" type="submit" value="login">
</form>


<!-- footer -->
<?php include $tml.'footer.php'; ?>