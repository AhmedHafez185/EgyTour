<?php 
session_start();
$noNavbar = '';
$pageTitle = 'Login';
include "init.php";
if(isset($_SESSION['username']))
	{
		header('location:index.php');
	}
	$hashedPass='';
// Check if user coming from http post request login form
if($_SERVER['REQUEST_METHOD']=='POST'){
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$hashedPass = sha1($password);
	// check If The User Exist in  Database
	 $stmt = $con->prepare("select userID, Username, Password from users where Username =? and Password = ?" );
	 $stmt->execute(array($username, $hashedPass));
	 $row = $stmt->fetch();
	 	print_r($row);
	 	if($stmt->rowCount()>0){
	 		$_SESSION['username'] = $username;
	 		$_SESSION['id'] = $row['userID'];
	 		header('location:index.php');
	 	}
	 	else
	 	{
	 		echo '<div class="alert alert-danger"> Sorry user name or password is not correct  </div>';
	 	}
}
?>
<section class="log">
<div class="form"> 
<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
	<ul class="tab-group">
        <li class="tab"><a href="signUp.php">Sign Up</a></li>
        <li class="tab active"><a href="login.php">Log In</a></li>
      </ul>	<input class="form-control" type="text" name ="user" placeholder="Username" autocomplete="off"/>
	<input  class="form-control" type="password" name ="pass" placeholder="Password" autocomplete="new-password"/>
	<input  class="btn btn-primary btn-block" type="submit" value="Login"/>
</form>
</section>
<?php include $tpl . 'FooterNoNav.php'?>