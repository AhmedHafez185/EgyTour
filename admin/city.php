	<?php 
	session_start();

	$pageTitle = "Service";

	include 'init.php';
	if(isset($_SESSION['username'])){
	?>
		<div class="container">
			<form class="form center-block City_form" action="?do=insert" method="POST">
				<h2 class="text-center">Add City</h2>
				<input class="form-control form-group" type="text" name="CityName" placeholder="City Name" autocomplete="off">
				<input class="btn btn-primary btn-block form-group" type="submit" value="Save">
		   </form>
		</div>
<?php
				$do = isset($_GET['do'])? $_GET['do']:'manage';
	 if($do == 'insert') {
				echo "<h2 class='text-center'>insert servicecategory</h2>";
				echo "<div class='container'>";
				if($_SERVER['REQUEST_METHOD']=='POST')
				{
					$city = $_POST['CityName'];
					$errors = array();
				 	if(empty($city)){
						$errors[] = "City Name can't be empty";
					}
					if(strlen($city)<3)
					{
						$errors[] = "City Name can't be Less 3 character";
					}
					if(strlen($city)>20)
					{
						$errors[] = "City Name can't be More Than 20 character";
					}

					foreach ($errors as $value)
					{
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors))
					{
						$stmt = $con->prepare("insert into city(cityName) values(?)");
						$stmt->execute(array($city));

						echo '<div class="alert alert-success">'.$stmt->rowCount().' New City Added Successfully..</div>';
						redirectHome("insert complated",'place.php?do=add',2);
					}
					echo "</div>";
				}
				else
				{
					redirectHome("You can't access this page!", 5);
				}
				echo "</div>";
	}
	else
	{
		header("refresh:?place.php?do=add");

	}

	include $tml . 'footer.php';

	}
	else{
		redirectHome("<div class'alert alert-danger'>You can't access this page!</div>");
	}
?>