<?php 
	session_start();
	$pageTitle = "City";
	include 'init.php';
	if(isset($_SESSION['username'])){
		$do = isset($_GET['do'])? $_GET['do']:'manage';
		# start manage page ... 
		if ($do == 'manage')
		{
			?>
			<div class="container">
				<h2 class="text-center">City Manage Page</h2>
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>City Name</td>
							<td>NO. Of Places </td>
							<td>NO. Of Services </td>
							<td>Control</td>
						</tr>
					<?php

					/* retrive User data and display*/
						$sql="select cityId, cityName,count(pid) as noOfPlace from city left outer join place  on cityId = PCity group by cityId order by cityId";
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$rows = $stmt->fetchAll();
					$sql2="select cityId, cityName,count(sid) as noOfService from city left outer join service on cityId= CtId group by cityId order by cityId";
						$stmt2 = $con->prepare($sql2);
						$stmt2->execute();
						$rows2 = $stmt2->fetchAll();

						foreach ($rows as $row) {
							echo "<tr>";
							echo "<td>". $row['cityId'] ."</td>";
							echo "<td>". $row['cityName'] ."</td>";
							echo "<td>". $row['noOfPlace'] ."</td>";
							foreach ($rows2 as $row2) {
								if($row['cityId'] == $row2['cityId'])
							echo "<td>". $row2['noOfService'] ."</td>"; 
 							 }
 							echo "<td>
							<a class='btn btn-success' href='?do=edit&cityId=".$row['cityId']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a>
							<a class='btn btn-danger delete-btn' data-toggle='confirmation' href='cities.php?do=Delete&cityId=". $row['cityId'] ."'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
							</td>";
							echo "</tr>";
						}

					?>
					</table>
					<a class="btn btn-primary" href="?do=add"><i class="fa fa-plus"></i> New City</a>
				</div>
			</div>
			
		<?php
    }

		# start add page ...
		elseif ($do == 'add'){
			?>
			<div class="container">
				<div class="form prodForm" action="" method="POST">
			<form class="form center-block City_form" action="?do=insert" method="POST">
				<h2 class="text-center">Add City</h2>
				<input class="form-control form-group" type="text" name="CityName" placeholder="City Name" required="required" autocomplete="off">
				<input class="btn btn-primary btn-block form-group" type="submit" value="Save">
		   </form>

				</div>
				</div>


		 	<?php

		}
		# end add page ...

		# start insert page ...
		elseif ($do == 'insert') {
				echo "<h2 class='text-center'>insert Place</h2>";
				echo "<div class='container'>";
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$City = $_POST['CityName'];
					$errors = array();
					$stmt = $con->prepare("select * from city where cityName =? ");

		 	        $stmt->execute(array("$City"));
		 			$row = $stmt->fetch();
		 			$count = $stmt->rowCount();
		 			if($count > 0){
		 				$errors[] = "City Name is exist";
		 			}
					if(empty($City)){
						$errors[] = "City Name can't be empty";
					}
					if(strlen($City)<3){
						$errors[] = "City Name can't be less than 3 characters";
					}
					if(strlen($City)>30){
						$errors[] = "City Name can't be more than 30 characters";
					}
					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("insert into city(cityName) values(?)");
						$stmt->execute(array($City));

						echo '<div class="alert alert-success">'.$stmt->rowCount().' New City Added Successfully..</div>';
						redirectHome("insert complated",'back', 5);
					}
					echo "</div>";	
				}else{
					redirectHome("You can't access this page!", 5);
				}

				echo "</div>";
			}



		# end insert page ...
		

		# start edit page ...
		elseif ($do == 'edit') {

			$cityId =(isset($_GET['cityId'])&&is_numeric($_GET['cityId']))? intval($_GET['cityId']): 0 ;
			$stmt = $con->prepare("select * from city where cityId =? ");

		 	$stmt->execute(array("$cityId"));
		 	$row = $stmt->fetch();
		 	$count = $stmt->rowCount();
		 	if($count > 0){?>

			 <div class="container">
				<h2 class="text-center">Edit Tourism City</h2>
				<form class="form center-block City_form" action="?do=update" method="POST">
				<input type="hidden" value="<?php echo $row['cityId'] ?>=" name="ID">
				<h2 class="text-center">Edit City</h2>
		         <input class="form-control form-group" type="text" name="CityName" required="required" placeholder="City Name" autocomplete="off" 
		             value="<?php echo $row['cityName'] ?>">
				<input class="btn btn-primary btn-block form-group" type="submit" value="Save">
		   		</form>
			</div>
		 	<?php

		 	}else{

		 		redirectHome("You can't access this page!", 5);

		 	}
		 	# end edit page ...


		 	# start update page ...
			}elseif ($do == 'update') {
				echo '<h2 class="text-center">update info</h2>';
				echo "<div class='container'>";
				

				if($_SERVER['REQUEST_METHOD']=='POST'){
					$City = $_POST['CityName'];
					$ID = $_POST['ID'];
					$errors = array();
					$stmt = $con->prepare("select * from city where cityName =? ");

		 	        $stmt->execute(array("$City"));
		 			$row = $stmt->fetch();
		 			$count = $stmt->rowCount();
		 			if($count > 0){
		 				$errors[] = "City Name is exist";
		 			}
					if(empty($City)){
						$errors[] = "City Name can't be empty";
					}
					if(strlen($City)<3){
						$errors[] = "City Name can't be less than 3 characters";
					}
					if(strlen($City)>30){
						$errors[] = "City Name can't be more than 30 characters";
					}
					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("update city set cityName =? where cityId =?");
						$stmt->execute(array($City,$ID));
						redirectHome("<div class='alert alert-info'>". $stmt->rowCount() ." Tourism City updated Successfully. </div>",'back');
					}
					echo "</div>";	
				}else{
					redirectHome("You can't access this page!", 5);
				}

				echo "</div>";
			}
			
			elseif ($do == 'Delete') {
				$cityId =(isset($_GET['cityId'])&&is_numeric($_GET['cityId']))? intval($_GET['cityId']): 0 ;
				$stmt = $con->prepare("select * from city where cityId =? ");
		 		$stmt->execute(array("$cityId"));
		 		$row = $stmt->fetch();
		 		$count = $stmt->rowCount();
			 	if($count > 0){
			 		$stmt = $con->prepare("delete  from city where cityId =?");
			 		$stmt->execute(array($cityId));
			 	}
				echo "<div class='container text-center'>
					<h2>Delete Member</h2>";
					
					redirectHome("<div class='alert alert-primary'>".$stmt->rowCount()." Tourism City deleted Successfully</div>",'back');
				echo "</div>";
			}


		else{
			header("location:?do=manage");
		}


		include $tml . 'footer.php';
	}

	else{
		redirectHome("<div class'alert alert-danger'>You can't access this page!</div>");
	}

	
?>