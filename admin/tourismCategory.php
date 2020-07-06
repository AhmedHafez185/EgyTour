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
				<h2 class="text-center">Toursim Category Manage Page</h2>
				<div class="table-responsive">
					<table class="main-table text-center table table-bordered">
						<tr>
							<td>#ID</td>
							<td>Category Name</td>
							<td>NO. Of Places </td>
							<td>Control</td>
						</tr>
					<?php

					/* retrive User data and display*/
						//$sql = "select * from tourismCategory";
						$sql="select tourCatId, tourCatName,count(pid) as count from tourismcategory left outer join place on tourCatId = PCat group by tourCatId order by tourCatId";
						$stmt = $con->prepare($sql);
						$stmt->execute();
						$rows = $stmt->fetchAll();
						//$stmt2 = $con->prepare("select * from TourismCategory");
						//$stmt2->execute();
						//$rows2 = $stmt2->fetchAll();
						foreach ($rows as $row) {
							echo "<tr>";
							echo "<td>". $row['tourCatId'] ."</td>";
							echo "<td>". $row['tourCatName'] ."</td>";
						echo "<td>". $row['count'] ."</td>";
							

 							echo "<td>
							<a class='btn btn-success' href='?do=edit&CId=".$row['tourCatId']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a>
							<a class='btn btn-danger delete-btn' data-toggle='confirmation' href='tourismCategory.php?do=Delete&CId=". $row['tourCatId'] ."'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>
							</td>";
							echo "</tr>";
						}

					?>
					</table>
					<a class="btn btn-primary" href="?do=add"><i class="fa fa-plus"></i> New Category</a>

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
				<h2 class="text-center">Add Category</h2>
				<input class="form-control form-group" type="text" name="CategoryName" placeholder="Category Name" required="required" autocomplete="off">
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
					$category = $_POST['CategoryName'];
					$errors = array();
					$stmt = $con->prepare("select * from tourismCategory where tourCatName =? ");

		 	        $stmt->execute(array("$category"));
		 			$row = $stmt->fetch();
		 			$count = $stmt->rowCount();
		 			if($count > 0){
		 				$errors[] = "category Name is exist";
		 			}
					if(empty($category)){
						$errors[] = "category Name can't be empty";
					}
					if(strlen($category)<3){
						$errors[] = "category Name can't be less than 3 characters";
					}
					if(strlen($category)>30){
						$errors[] = "category Name can't be more than 30 characters";
					}
					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("insert into tourismCategory(tourCatName) values(?)");
						$stmt->execute(array($category));

						echo '<div class="alert alert-success">'.$stmt->rowCount().' New category Added Successfully..</div>';
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

			$CatId =(isset($_GET['CId'])&&is_numeric($_GET['CId']))? intval($_GET['CId']): 0 ;
			$stmt = $con->prepare("select * from tourismCategory where tourCatId =? ");

		 	$stmt->execute(array("$CatId"));
		 	$row = $stmt->fetch();
		 	$count = $stmt->rowCount();
		 	if($count > 0){?>

			 <div class="container">
				<h2 class="text-center">Edit Tourism Category</h2>
				<form class="form center-block City_form" action="?do=update" method="POST">
				<input type="hidden" value="<?php echo $row['tourCatId'] ?>=" name="ID">
				<h2 class="text-center">Edit Category</h2>
		         <input class="form-control form-group" type="text" name="CategoryName" required="required" placeholder="Category Name" autocomplete="off" 
		             value="<?php echo $row['tourCatName'] ?>">
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
					$category = $_POST['CategoryName'];
					$ID = $_POST['ID'];
					$errors = array();
					$stmt = $con->prepare("select * from tourismCategory where tourCatName =? ");

		 	        $stmt->execute(array("$category"));
		 			$row = $stmt->fetch();
		 			$count = $stmt->rowCount();
		 			if($count > 0){
		 				$errors[] = "category Name is exist";
		 			}
					if(empty($category)){
						$errors[] = "category Name can't be empty";
					}
					if(strlen($category)<3){
						$errors[] = "category Name can't be less than 3 characters";
					}
					if(strlen($category)>30){
						$errors[] = "category Name can't be more than 30 characters";
					}
					foreach ($errors as $value) {
						echo "<div class='alert alert-danger'>". $value  . "</div>";
					}

					if(empty($errors)){
						$stmt = $con->prepare("update tourismCategory set tourCatName =? where tourCatId =?");
						$stmt->execute(array($category,$ID));
						redirectHome("<div class='alert alert-info'>". $stmt->rowCount() ." Tourism Category updated Successfully. </div>",'back');
					}
					echo "</div>";	
				}else{
					redirectHome("You can't access this page!", 5);
				}

				echo "</div>";
			}
			
			elseif ($do == 'Delete') {
				$CId =(isset($_GET['CId'])&&is_numeric($_GET['CId']))? intval($_GET['CId']): 0 ;
				$stmt = $con->prepare("select * from TourismCategory where tourCatId =? ");
		 		$stmt->execute(array("$CId"));
		 		$row = $stmt->fetch();
		 		$count = $stmt->rowCount();
			 	if($count > 0){
			 		$stmt = $con->prepare("delete  from tourismCategory where tourCatId =?");
			 		$stmt->execute(array($CId));
			 	}
				echo "<div class='container text-center'>
					<h2>Delete Member</h2>";
					
					redirectHome("<div class='alert alert-primary'>".$stmt->rowCount()." Tourism Category deleted Successfully</div>",'back');
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