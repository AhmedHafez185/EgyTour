<?php 
$noNavbar = '';
$_SESSION='';
$pageTitle = 'Signup';
include "init.php";
// Check if user coming from http post request login form
if($_SERVER['REQUEST_METHOD']=='POST'){
	$username   = $_POST['user'];
	$password   = $_POST['pass'];
	$rePassword = $_POST['rePass'];
	$email      = $_POST['email'];
    $hashedPass = sha1($password);

   	 $errors = array();
	if(empty($username)){
		$errors[] = "Username can't be empty";
	}if(strlen($username)<3){
		$errors[] = "<strong>Username</strong> must be large than <strong>3</strong> characters";
	}if(strlen($password)<3 || strlen($password)>20){
		$errors[] = "<strong>Password</strong> must be at least between <strong>3 to 20</strong> characters as maximum";
	}if(empty($email)) {
		$errors[] = "<strong>Email</strong> can't be empty";

	if(checkItem('Email', "users", $email) > 0) {
		$errors[] = "<strong>This Email is used</strong> ";

	}if(checkItem('Username', "users", $user_name) > 0) {
		$errors[] = "<strong>This UserName is used</strong> ";

	}
	foreach ($errors as $value) {
		echo "<div class='alert alert-danger'>". $value  . "</div>";
	}


	// check Where the two passwords is the same
	if($password == $rePassword)
	{
	$stmt = $con->prepare("SELECT email from users where email  = ?");
	$stmt->execute(array($email));
	$count = $stmt ->rowCount();
   // if Count > 0 the user is exits in Database
	if($count > 0)
	{
		$_SESSION = 'This email is used ';	
	}
	else {
	$stmt2 = $con->prepare("insert into users(userName,password,Email) values(?,?,?)");
	$stmt2->execute(array($username,$hashedPass,$email));
 		$_SESSION = 'Registered Succefully';
	 header('Location:test.php');
	 exit();
	}

	}
	else
	{
		$_SESSION = 'use should enter the same password';
	}
	}
	
	// check If The User Email  Exist in  Database

?>
<section class="log">
<form class="singup" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
	<ul class="tab-group">
        <li class="tab active"><a href="signUp.php">Sign Up</a></li>
        <li class="tab "><a href="login.php">Log In</a></li>
    </ul>
	<p><label name="fname">Full Name</label></p>
	<input class="form-control" type="text" name ="user" placeholder="Username" autocomplete="off" required/>
		<p><label name="fname">E-Mail</label></p>
	<input class="form-control" type="email" name ="email" placeholder="Email" autocomplete="off" required/>
			<p><label name="fname">Password</label></p>
	<input  class="form-control" type="password" name ="pass" placeholder="Password" autocomplete="off" required/>
			<p><label name="fname">Confirm Password</label></p>
	<input  class="form-control" type="password" name ="rePass" placeholder="Password" autocomplete="off" required/>
	<input  class="btn" type="submit" value="Sign up"/>
</form>
</section>
<p id="registerMessage"><?php echo $_SESSION ?></p>
<?php include $tpl . 'FooterNoNav.php'?>   