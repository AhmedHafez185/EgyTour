<?php 
	session_start();

	$pageTitle = "Tourism Places";

	include 'init.php';
	if(isset($_SESSION['username'])){
		$do = isset($_GET['do'])? $_GET['do']:'manage';
		# start manage page ... 
		if ($do == 'manage')
		{?>
			<div class="container">
				<h2 class="text-center">Toursim Place Manage Page</h2>
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>Place Name</td>
							<td>City</td>
							<td></i>Category</td>
							<td></i>Description</td>
							<td></i>Photos</td>
							<td>Control</td>
						</tr>
					<?php

					/* retrive User data and display*/
						$stmt = $con->prepare("select * from place");
						$stmt->execute();
						$rows = $stmt->fetchAll();

						$stmt2 = $con->prepare("select * from TourismCategory");
						$stmt2->execute();
						$rows2 = $stmt2->fetchAll();

						$stmt3 = $con->prepare("select * from City");
						$stmt3->execute();
						$rows3 = $stmt3->fetchAll();

						$stmt4 = $con->prepare("select * from eraperiod");
						$stmt4->execute();
						$rows4 = $stmt4->fetchAll();
						foreach ($rows as $row) {
							echo "<tr>";
							echo "<td>". $row['pid'] ."</td>";
							echo "<td>". $row['PName'] ."</td>";
							foreach ($rows3 as $row3){
 								if($row['PCity']===$row3['cityId']){
 									echo "<td>". $row3['cityName'] ."</td>";
 									break;
 								}
 							}
 							foreach ($rows2 as $row2){
 								if($row['PCat']===$row2['tourCatId']){
 									echo "<td>". $row2['tourCatName'] ."</td>";
 									break;
 								}
 							}
 							echo "<td>". $row['Description'] ."</td>";
 							echo "<td>". $row['photo'] ."</td>";
 						

 							echo "<td>
								<a class='btn btn-success' href='?do=edit&PId=".$row['pid']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a>
								<a class='btn btn-danger delete-btn' data-toggle='confirmation' href='place.php?do=Delete&PId=". $row['pid'] ."'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
							</td>";
							echo "</tr>";
						}

					?>
					</table>
					<a class="btn btn-primary" href="?do=add"><i class="fa fa-plus"></i> New Place</a>

				</div>

			</div>
			
		<?php
	}

		# start add page ...
		elseif ($do == 'add'){
			?>

			<h2 class="text-center">Add New Tourism Place</h2>
			<div class="container">
				<div class="form prodForm" action="" method="POST">
					<form class="form-horizontal " action="?do=insert" method="POST" enctype="multipart/form-data">

						<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label" >Place Name</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="PName" required="required">
							</div>
						</div>

							
						<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label" >Place Description</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="PDesc" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label">Place Category</label>
							<div class="col-sm-6">
								<select name="Ptype">
							<?php
							$stmt2 = $con->prepare("select * from tourismcategory");
								$stmt2->execute();
								$rows2 = $stmt2->fetchAll();
								foreach ($rows2 as $row) {
								  echo "<option value='".$row['tourCatId']."'>".$row['tourCatName']."</option>";
								}
								?>
								</select>
							</div>
						</div>

							<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label">City</label>
							<div class="col-sm-6">
							<div class="addCity">
								 <a class="btn btn-primary" href="city.php"><i class="fa fa-plus"></i> More City </a>
							</div>
								<select name="PCity">
							<?php
							$stmt2 = $con->prepare("select * from city");
								$stmt2->execute();
								$rows2 = $stmt2->fetchAll();
								foreach ($rows2 as $row) {
								  echo "<option value='".$row['cityId']."'>".$row['cityName']."</option>";
								}
								?>
								</select>
							</div>
						</div>

							<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label">Era</label>
							<div class="col-sm-6">
								<select name="PEra">
							<?php
							$stmt2 = $con->prepare("select * from eraperiod");
								$stmt2->execute();
								$rows2 = $stmt2->fetchAll();
								foreach ($rows2 as $row) {
								  echo "<option value='".$row['EId']."'>".$row['EName']."</option>";
								}
								?>
								</select>
							</div>
						</div>
						


						<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label" >Place Photo Folder</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="PPhoto" required="required">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-6">
								<input class="btn btn-primary btn-block btn-lg" type="submit" value="Add  Place">
							</div>
						</div>
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
					$PlaceName = $_POST['PName'];
					$PlaceDesc = $_POST['PDesc'];
					$category = $_POST['Ptype'];
					$city = $_POST['PCity'];
					$era = $_POST['PEra'];
					//photo cintent inserted in folder and phto path into database
					$dirPhoto = $_POST['PPhoto'];
					//move_uploaded_file($_FILES['PPhoto']['tmp_name'], $dirPhoto);
					$path = $dirPhoto;
					$errors = array();
					if(empty($PlaceName)){
						$errors[] = "Place Name can't be empty";
					}
					if(empty($PlaceDesc)){
						$errors[] = "Place Description can't be empty";
					}

					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("insert into place(PName, Description,PCat,PCity,PEra,photo) values(?,?,?,?,?,?)");
						$stmt->execute(array($PlaceName, $PlaceDesc,$category, $city,$era, $path));

						echo '<div class="alert alert-success">'.$stmt->rowCount().' New Places Added Successfully..</div>';
						redirectHome("insert complated",'place.php?do=manage', 5);
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

			$serId =(isset($_GET['PId'])&&is_numeric($_GET['PId']))? intval($_GET['PId']): 0 ;
			$stmt = $con->prepare("select * from place where pid =? ");

		 	$stmt->execute(array("$serId"));
		 	$row = $stmt->fetch();
		 	$count = $stmt->rowCount();
		 	if($count > 0){?>

			 <div class="container">
				<h2 class="text-center">Edit Tourism Place</h2>
				<form class="form-horizontal prodForm" action="?do=update" method="POST">
					<input type="hidden" value="<?php echo $row['pid'] ?>=" name="ID">
					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Place Name</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="PName" required="required" autocomplete="off" value="<?php echo $row['PName'] ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Description</label>
						<div class="col-sm-6">
						<input class="form-control" type="text" name="PDesc" required="required" autocomplete="off" value="<?php echo $row['Description'] ?>">
						</div>
					</div>

	

							<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label" >Place photo</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="PPhoto" value="<?php echo $row['photo'] ?>">
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

		 	}else{

		 		redirectHome("You can't access this page!", 5);

		 	}
		 	# end edit page ...


		 	# start update page ...
			}elseif ($do == 'update') {
				echo '<h2 class="text-center">update info</h2>';
				echo "<div class='container'>";
				

				if($_SERVER['REQUEST_METHOD']=='POST'){
					$ID = $_POST['ID'];
					$PlaceName = $_POST['PName'];
					$PlaceDesc = $_POST['PDesc'];
					$photo = $_POST['PPhoto'];
			
					$errors = array();
					if(empty($PlaceName)){
						$errors[] = "Place Name can't be empty";
					}
					if(empty($PlaceDesc)){
						$errors[] = "Place Description can't be empty";
					}
					if(empty($photo)){
						$errors[] = "Place photo  can't be empty";
					}

					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("update place set PName = ?, Description = ?, photo = ? where pid = ?");
						$stmt->execute(array($PlaceName, $PlaceDesc, $photo,$ID));
						redirectHome("<div class='alert alert-info'>". $stmt->rowCount() ." Tourism Place updated Successfully. </div>",'place.php');

					}
					echo "</div>";	
				}else{
					redirectHome("You can't access this page!", 5);
				}

				echo "</div>";
			}
			
			elseif ($do == 'Delete') {
				$serId =(isset($_GET['PId'])&&is_numeric($_GET['PId']))? intval($_GET['PId']): 0 ;
				$stmt = $con->prepare("select * from place where Pid =? ");
		 		$stmt->execute(array("$serId"));
		 		$row = $stmt->fetch();
		 		$count = $stmt->rowCount();
			 	if($count > 0){
			 		$stmt = $con->prepare("delete  from place where pid =?");
			 		$stmt->execute(array($serId));
			 	}
				echo "<div class='container text-center'>
					<h2>Delete Member</h2>";
					
					redirectHome("<div class='alert alert-primary'>".$stmt->rowCount()." Tourism Place deleted Successfully</div>",'back');
				echo "</div>";
			}


		else{
			header("location:?do=manage");
		}


		include $tml . 'footer.php';
	}else{
		redirectHome("<div class'alert alert-danger'>You can't access this page!</div>");
	}

	
?>