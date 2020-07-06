<?php 
	session_start();

	$pageTitle = "Era";

	include 'init.php';
	if(isset($_SESSION['username'])){
		$do = isset($_GET['do'])? $_GET['do']:'manage';
		# start manage page ... 
		if ($do == 'manage')
		{?>
			<div class="container">
				<h2 class="text-center">Era Manage Page</h2>
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>Era Name</td>
							<td>NO. Of Places </td>
							<td>Control</td>
						</tr>
					<?php

					/* retrive User data and display*/
						$sql="select EId, EName,count(pid) as count from eraperiod left outer join place on EId = PEra group by EID order by EId";
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$rows = $stmt->fetchAll();
						foreach ($rows as $row) {
							echo "<tr>";
							echo "<td>". $row['EId'] ."</td>";
							echo "<td>". $row['EName'] ."</td>";
							echo "<td>". $row['count'] ."</td>"; 

 							echo "<td>
							<a class='btn btn-success' href='?do=edit&EId=".$row['EId']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a>
							<a class='btn btn-danger delete-btn' data-toggle='confirmation' href='historicalEra.php?do=Delete&EId=". $row['EId'] ."'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
							</td>";
							echo "</tr>";
						}

					?>
					</table>
					<a class="btn btn-primary" href="?do=add"><i class="fa fa-plus"></i> New Era</a>

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
				<h2 class="text-center">Add Era</h2>
				<input class="form-control form-group" type="text" name="EraName" placeholder="Era Name" required="required" autocomplete="off">
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
					$Era = $_POST['EraName'];
					$errors = array();
					$stmt = $con->prepare("select * from eraperiod where EName =? ");

		 	        $stmt->execute(array("$Era"));
		 			$row = $stmt->fetch();
		 			$count = $stmt->rowCount();
		 			if($count > 0){
		 				$errors[] = "Era Name is exist";
		 			}
					if(empty($Era)){
						$errors[] = "Era Name can't be empty";
					}
					if(strlen($Era)<3){
						$errors[] = "Era Name can't be less than 3 characters";
					}
					if(strlen($Era)>30){
						$errors[] = "Era Name can't be more than 30 characters";
					}
					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("insert into eraperiod(EName) values(?)");
						$stmt->execute(array($Era));

						echo '<div class="alert alert-success">'.$stmt->rowCount().' New Era Added Successfully..</div>';
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

			$EId =(isset($_GET['EId'])&&is_numeric($_GET['EId']))? intval($_GET['EId']): 0 ;
			$stmt = $con->prepare("select * from eraperiod where EId =? ");

		 	$stmt->execute(array("$EId"));
		 	$row = $stmt->fetch();
		 	$count = $stmt->rowCount();
		 	if($count > 0){?>

			 <div class="container">
				<h2 class="text-center">Edit Tourism Era</h2>
				<form class="form center-block City_form" action="?do=update" method="POST">
				<input type="hidden" value="<?php echo $row['EId'] ?>=" name="ID">
				<h2 class="text-center">Edit Era</h2>
		         <input class="form-control form-group" type="text" name="EraName" required="required" placeholder="Era Name" autocomplete="off" 
		             value="<?php echo $row['EName'] ?>">
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
					$Era = $_POST['EraName'];
					$ID = $_POST['ID'];
					$errors = array();
					$stmt = $con->prepare("select * from eraperiod where EName =? ");

		 	        $stmt->execute(array("$Era"));
		 			$row = $stmt->fetch();
		 			$count = $stmt->rowCount();
		 			if($count > 0){
		 				$errors[] = "Era Name is exist";
		 			}
					if(empty($Era)){
						$errors[] = "Era Name can't be empty";
					}
					if(strlen($Era)<3){
						$errors[] = "Era Name can't be less than 3 characters";
					}
					if(strlen($Era)>30){
						$errors[] = "Era Name can't be more than 30 characters";
					}
					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("update eraperiod set EName =? where EId =?");
						$stmt->execute(array($Era,$ID));
						redirectHome("<div class='alert alert-info'>". $stmt->rowCount() ." Tourism Era updated Successfully. </div>",'back');
					}
					echo "</div>";	
				}else{
					redirectHome("You can't access this page!", 5);
				}

				echo "</div>";
			}
			
			elseif ($do == 'Delete') {
				$EId =(isset($_GET['EId'])&&is_numeric($_GET['EId']))? intval($_GET['EId']): 0 ;
				$stmt = $con->prepare("select * from eraperiod where EId =? ");
		 		$stmt->execute(array("$EId"));
		 		$row = $stmt->fetch();
		 		$count = $stmt->rowCount();
			 	if($count > 0){
			 		$stmt = $con->prepare("delete  from eraperiod where EId =?");
			 		$stmt->execute(array($EId));
			 	}
				echo "<div class='container text-center'>
					<h2>Delete Member</h2>";
					
					redirectHome("<div class='alert alert-primary'>".$stmt->rowCount()." Tourism Era deleted Successfully</div>",'back');
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