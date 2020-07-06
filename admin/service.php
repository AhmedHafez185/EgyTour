<?php 
	session_start();

	$pageTitle = "Service";

	include 'init.php';
	if(isset($_SESSION['username'])){
		

		$do = isset($_GET['do'])? $_GET['do']:'manage';
		# start manage page ... 
		if ($do == 'manage')
		{?>
			<div class="container">
				<h2 class="text-center">Service Manage Page</h2>
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>Service Name</td>
							<td>City</td>
							<td></i>Type</td>
							<td></i>Description</td>
							<td></i>Photos</td>
							<td></i>Rates</td>
							<td>Control</td>
						</tr>
					<?php


					/* retrive User data and display*/
						$stmt = $con->prepare("select * from service");
						$stmt->execute();
						$rows = $stmt->fetchAll();

						$stmt2 = $con->prepare("select * from servicecategory");
						$stmt2->execute();
						$rows2 = $stmt2->fetchAll();

						$stmt3 = $con->prepare("select * from City");
						$stmt3->execute();
						$rows3 = $stmt3->fetchAll();
						foreach ($rows as $row) {
							echo "<tr>";
							echo "<td>". $row['sid'] ."</td>";
							echo "<td>". $row['sName'] ."</td>";
								foreach ($rows3 as $row3){
 								if($row['CtId']===$row3['cityId']){
 									echo "<td>". $row3['cityName'] ."</td>";
 									break;
 								}
 							}
 							foreach ($rows2 as $row2){
 								if($row['Cat_id']===$row2['Cid']){
 									echo "<td>". $row2['Name'] ."</td>";
 									break;
 								}
 							}
 							echo "<td>". $row['Description'] ."</td>";
 							echo "<td>". $row['photo'] ."</td>";
 							echo "<td>". $row['Rate'] ."</td>"; 							
 						

 							echo "<td>
								<a class='btn btn-success' href='?do=edit&SId=".$row['sid']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a>
								<a class='btn btn-danger delete-btn' data-toggle='confirmation' href='service.php?do=Delete&SId=". $row['sid'] ."'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
							</td>";
							echo "</tr>";
						}

					?>
					</table>
					<a class="btn btn-primary" href="?do=add"><i class="fa fa-plus"></i> New Service</a>

				</div>

			</div>
			
		<?php
	}

		# start add page ...
		elseif ($do == 'add'){
			?>

			<h2 class="text-center">Add New Service</h2>
			<div class="container">
				<div class="form prodForm" action="" method="POST">
					<form class="form-horizontal " action="?do=insert" method="POST" enctype="multipart/form-data">

						<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label" >Service Name</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="SerName" required="required">
							</div>
						</div>

							
						<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label" >Service Description</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="SerDesc" required="required">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label">Type</label>
							<div class="col-sm-6">
								<select name="Sertype">
							<?php
							$stmt2 = $con->prepare("select * from servicecategory");
								$stmt2->execute();
								$rows2 = $stmt2->fetchAll();
								foreach ($rows2 as $row) {
								  echo "<option value='".$row['Cid']."'>".$row['Name']."</option>";
								}
								?>
								</select>
							</div>
						</div>

							<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label">City</label>
							<div class="col-sm-6">
								<select name="serCity">
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
							<label class="col-sm-offset-2 col-sm-2 control-label" >Service Photo Folder</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="serPhoto" required="required">
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-offset-4 col-sm-6">
								<input class="btn btn-primary btn-block btn-lg" type="submit" value="Add  Service">
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
				echo "<h2 class='text-center'>insert servicecategory</h2>";
	echo "<div class='container'>";
				if($_SERVER['REQUEST_METHOD']=='POST'){
					$ServiceName = $_POST['SerName'];
					$SerDesc = $_POST['SerDesc'];
					$category = $_POST['Sertype'];
					$city = $_POST['serCity'];
					//photo cintent inserted in folder and phto path into database
					$dirPhoto = $_POST['serPhoto'];
					//move_uploaded_file($_FILES['serPhoto']['tmp_name'], $dirPhoto);
					$path = $dirPhoto;
					$errors = array();
					if(empty($ServiceName)){
						$errors[] = "Service Name can't be empty";
					}
					if(empty($SerDesc)){
						$errors[] = "Service Description can't be empty";
					}

					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("insert into service(sName, Description,CtId,Cat_id,Photo) values( ?,?, ?, ?, ?)");
						$stmt->execute(array($ServiceName, $SerDesc,$city, $category, $path));

						echo '<div class="alert alert-success">'.$stmt->rowCount().' New Service Added Successfully..</div>';
						redirectHome("insert complated",'service.php', 5);
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

			$serId =(isset($_GET['SId'])&&is_numeric($_GET['SId']))? intval($_GET['SId']): 0 ;
			$stmt = $con->prepare("select * from service where sid =? ");

		 	$stmt->execute(array("$serId"));
		 	$row = $stmt->fetch();
		 	$count = $stmt->rowCount();
		 	if($count > 0){?>

			 <div class="container">
				<h2 class="text-center">Edit Service</h2>
				<form class="form-horizontal prodForm" action="?do=update" method="POST">
					<input type="hidden" value="<?php echo $row['sid'] ?>=" name="ID">
					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Service Name</label>
						<div class="col-sm-6">
							<input class="form-control" type="text" name="SerName" required="required" autocomplete="off" value="<?php echo $row['sName'] ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-offset-2 col-sm-2 control-label">Description</label>
						<div class="col-sm-6">
						<input class="form-control" type="text" name="SerDesc" required="required" autocomplete="off" value="<?php echo $row['Description'] ?>">
						</div>
					</div>

	

							<div class="form-group">
							<label class="col-sm-offset-2 col-sm-2 control-label" >Service photo</label>
							<div class="col-sm-6">
								<input class="form-control input-lg" type="text" name="serPhoto" value="<?php echo $row['photo'] ?>">
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
					$ServiceName = $_POST['SerName'];
					$SerDesc = $_POST['SerDesc'];
					$photo = $_POST['serPhoto'];
			
					$errors = array();
					if(empty($ServiceName)){
						$errors[] = "Service Name can't be empty";
					}
					if(empty($SerDesc)){
						$errors[] = "Service Description can't be empty";
					}
					if(empty($photo)){
						$errors[] = "Service photo  can't be empty";
					}

					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("update service set sName = ?, Description = ?, Photo = ? where sid = ?");
						$stmt->execute(array($ServiceName, $SerDesc, $photo,$ID));
						redirectHome("<div class='alert alert-info'>". $stmt->rowCount() ." Service  updated Successfully. </div>",'service.php');

					}
					echo "</div>";	
				}else{
					redirectHome("You can't access this page!", 5);
				}

				echo "</div>";
			}
			
			elseif ($do == 'Delete') {
				$serId =(isset($_GET['SId'])&&is_numeric($_GET['SId']))? intval($_GET['SId']): 0 ;
				$stmt = $con->prepare("select * from service where sid =? ");
				echo $_GET['SId'];
		 		$stmt->execute(array("$serId"));
		 		$row = $stmt->fetch();
		 		$count = $stmt->rowCount();
			 	if($count > 0){
			 		$stmt = $con->prepare("delete  from service where sid =?");
			 		$stmt->execute(array($serId));
			 	}
				echo "<div class='container text-center'>
					<h2>Delete Member</h2>";
					
					redirectHome("<div class='alert alert-primary'>".$stmt->rowCount()." Service deleted Successfully</div>",'back');
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