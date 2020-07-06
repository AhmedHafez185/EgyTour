<?php 
session_start();
$pageTitle = 'User Information';
include "init.php";
if(isset($_SESSION['username']))
{
	$do = isset($_GET['do'])? $_GET['do']:'manage';
		# start manage page ... 
		if ($do == 'manage')
		{
			$stmt = $con->prepare("select * from users where username = ?");
			$stmt->execute(array($_SESSION['username']));
			$row = $stmt->fetch();
		?>
		<section class="binfo">
			<div class="containter">
				<div class="col-lg-8">
			        <div class="panel panel-primary">
			          <div class="panel-heading">
			              	Basic Information  
			           </div>
			           <?php 
			           echo '
			          	<div class="panel-body">
			          	   	<div class="userinfo">
								<div class="left">';
								 if($rows['image']=='')
						                echo ' <a href="#"><img src="'.$images.'users/default.jpg" alt="..."></a>';
						              else
						               echo ' <a href="#"><img src="'.$images.'users/'.$rows['image'].'" alt="..."></a>';
								echo '
								</div>
								<div class="right">
									<div>
										<p>Full Name : <span>'.$row['FullName'].'</span></p> 
										<p>Email : <span>'.$row['Email'].'</span></p> 
										<p>Address : <span>'.$row['Address'].'</span></p> 
									</div>
									<a class="btn btn-success" href="Profile.php?do=edit">Edit My Information</a>
								</div>
							</div>
			          </div>';
			          ?>
			     	</div>          
			     </div>
		     </div>
        </section>
      	<section class="binfo">
			<div class="containter">
				<div class="col-lg-8">
			        <div class="panel panel-success">
			          <div class="panel-heading">
			              	Plans     
			           </div>
			          	<div class="panel-body">
			          	   	<div class="userinfo">
								<div class="left">
								</div>
								<div class="right">
									<div>
										<span>User Name : Mostafa</span>
										<span>E-mail : mostafa@gmail.com</span>
										<span>Password : aaa</span>
										<span>Adderss : asd</span>
									</div>
									<a href=""> <button class="btn btn-success"> Edit Info </button></a>
								</div>
							</div>
			           </div>
			     	</div>          
			     </div>
		     </div>
        </section>
    	<?php
    }
    elseif ($do == 'edit') {
			$stmt = $con->prepare("select * from users where username =? ");
		 	$stmt->execute(array($_SESSION['username']));
		 	$row = $stmt->fetch();
		 	$count = $stmt->rowCount();
		 	if($count > 0){?>
			 <div class="container">
				<h2 class="text-center">Edit Profile</h2>
				<form class="form-horizontal " action="?do=update" method="POST">
					<input type="hidden" value="<?php echo $row['Password'] ?>=" name="oldpass">
					<input type="hidden" value="<?php echo $row['userId'] ?>=" name="ID">
					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Username</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="user_name" required="required" autocomplete="off" value="<?php echo $row['Username'] ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Full Name</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="fullname" required="required" autocomplete="off" value="<?php echo $row['FullName'] ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label" >Password</label>
						<div class="col-sm-6">
							<input class="form-control" type="password" name="newpass" >
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Email</label>
						<div class="col-sm-6">
							<input class="form-control" type="email" name="email" value="<?php echo $row['Email'] ?>" required="required">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Address</label>
						<div class="col-sm-6">
						<input class="form-control" type="text" name="address" value="<?php echo $row['Address'] ?>" required="required">
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-6">
							<input class="btn btn-primary btn-block" type="submit" value="save">
						</div>
					</div>
				</form>
			</div>

		 	<?php

		 	}
		 	else{

		 		redirectHome("You can't access this page!",1);

		 	}
		 	# end edit page ...


		 	# start update page ...
			}
			elseif ($do == 'update') {
				echo '<h2 class="text-center">Information Updated</h2>';
				echo "<div class='container'>";
				if($_SERVER['REQUEST_METHOD']=='POST')
				{
					$ID = $_POST['ID'];
					$user_name = $_POST['user_name'];
					$email = $_POST['email'];
					$fullname = $_POST['fullname'];
					$address = $_POST['address'];
					$pass =empty($_POST['newpass']) ? $_POST['oldpass'] : sha1($_POST['newpass']);
					$errors = array();
					if(empty($user_name)){
						$errors[] = "Username can't be empty";
					}if(strlen($user_name) < 4){
						$errors[] = "Username must be more than 3 characters";
					}if(strlen($user_name) > 20){
						$errors[] = "Username can't be more than 20 characters";
					}if(empty($email)) {
						$errors[] = "Email can't be empty";

					}if(empty($fullname)) {
						$errors[] = "Fullname can't be empty";
					}
					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}
					if(empty($errors)){
						$stmt = $con->prepare("UPDATE users SET Username = ?,Password = ?, Email = ? ,FullName =?,Address =? WHERE userId = ?");
						$stmt->execute(array($user_name, $pass, $email , $fullname,$address,$ID));
						header("location:Profile.php");
					 }
				
				}
				echo "</div>";
			}
}
else
{
			header("location:login.php");
}

  ?>

 	<?php include $tpl . 'FooterNoNav.php'; ?>


