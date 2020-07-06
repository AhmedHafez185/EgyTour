<?php 
	session_start();
	if(isset($_SESSION['username'])){
		$pageTitle = "Dashboard";
		include 'init.php';
		include $tml . 'footer.php';
	}
	else{
		header('location:index.php');
		exit();
	}

?>
<section class="home-stats text-center">
	 <div class="container">
	   <h1>Dashboard </h1>
	   <div class="row">
	     <div class="col-md-3">
	     <a href="members.php">
		    <div class="stat st-members">
			  <i class="fa fa-users"></i>
			  <div class="info">
			  <?php 
			  $stmt = $con->prepare("select count(*) as noOfUser from users");
			  $stmt->execute();
			  $rows = $stmt->fetch();
			  echo 'Members  <span>'.$rows['noOfUser'].'</span>';
			 ?>
			  </div>
			</div>
			</a>
	     </div>
		 <div class="col-md-3">
		   <a href="activity.php">
		    <div class="stat st-pending">
			  <i class="fa fa-tag"></i>
			  <div class="info">
			   <?php 
			  $stmt = $con->prepare("select count(*) as noOfAct from activity");
			  $stmt->execute();
			  $rows = $stmt->fetch();
			  echo 'Activities  <span>'.$rows['noOfAct'].'</span>';
			 	?>
			  </div>
			</div>
			</a>
	     </div>
		 <div class="col-md-3">
		 <a href="service.php">
		    <div class="stat st-items">
			    <i class="fa fa-briefcase"></i>
			    <div class="info">
			     <?php 
			  $stmt = $con->prepare("select count(*) as noOfServ from service");
			  $stmt->execute();
			  $rows = $stmt->fetch();
			  echo 'Services  <span>'.$rows['noOfServ'].'</span>';
			 	?>
				</div>
			</div>
		 </a>
	     </div>
		 <div class="col-md-3">
		 <a href="place.php">
		    <div class="stat st-comments">
			    <i class="fa fa-globe"></i>
			    <div class="info">
			    <?php 
			  $stmt = $con->prepare("select count(*) as noOfPlaces from place");
			  $stmt->execute();
			  $rows = $stmt->fetch();
			  echo 'Tourism Places  <span>'.$rows['noOfPlaces'].'</span>';
			 	?>
				</div>
			</div>
			</a>
	     </div>
	   </div>
	 </div>
	 </section>
	 <?php
	 	$stmt = $con->prepare("select * from users order by AddedDate ASC limit 6");
		$stmt->execute();
		$rows = $stmt->fetchAll();

		$stmt2 = $con->prepare("select * from service order by Rate ASC limit 6");
		$stmt2->execute();
		$rows2 = $stmt2->fetchAll();
	 ?>
	 <section class="latest">
	 <div class="container">
	 	<div class="row">
	 		<div class="col-lg-6">
	 			<div class="panel panel-default">
			 		<div class="panel-heading">
				 		<i class="fa fa-users"></i>Last Registered User
			 		</div>
	 				<div class="panel-body">
	 					 <table class=" table table-bordered ">
	 				<?php 

	 					foreach ($rows as $row) {
	 				 echo "<tr>";
				     echo "<td>".$row['Username']."</td>";
				     echo "<td>".$row['AddedDate']."</td>";
					 echo "</tr>";
	 						# code...

	 					}
	 					echo '</table>';
	 				?>
	 				</div>
	 			</div>
	 		</div>

	 		<div class="col-lg-6">
	 			<div class="panel panel-default">
			 		<div class="panel-heading">
				 		<i class="fa fa-tags"></i>Lates Service
			 		</div>
	 			   <div class="panel-body">
	 					 <table class=" table table-bordered ">
	 				<?php 

	 					foreach ($rows2 as $row2) {
	 				 echo "<tr>";
				     echo "<td>".$row2['sName']."</td>";
				     echo "<td>".$row2['RegDate']."</td>";
					 echo "</tr>";
	 						# code...

	 					}
	 					echo '</table>';
	 				?>
	 			   </div>
	 			</div>
	 		</div>

	 	</div>
	 </div>
	 </section>


