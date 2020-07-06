<?php 
session_start();
$pageTitle = 'Activity';
include "init.php"; ?>
<?php 
$_SESSION['ActID']=(isset($_GET['act']))?$_GET['act']:0;
$do =isset($_GET['Type'])?$_GET['Type'] : 'All';
?>
<?php
echo '<section class="tabType">
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs">
  			<li class="all"><a href="activity.php?Type=All&act='.$_SESSION['ActID'].'">Top</a></li>';
		$stmt = $con->prepare("SELECT distinct city from activity where Type = ?");
		$stmt->execute(array($_SESSION['ActID']));
		$rows = $stmt->fetchAll();
		$count = $stmt->rowCount();
	  foreach($rows as $row)
	  {
		echo '<li class="Tourism"><a href="activity.php?Type='.$row['city'].'&act='.$_SESSION['ActID'].'">'.getCity($row['city']).'</a></li>';	  
	  }
  	echo '</ul>
		</div>
		</div>
	</section>';
	?>
	<?php
	if($do=="All")
{
	$type = $_SESSION['ActID'];
    $stmt = $con->prepare("SELECT * from activity WHERE Type = ?");
	$stmt->execute(array($_SESSION['ActID']));
	$rows = $stmt->fetchAll();
	$count = $stmt->rowCount();		  
	if($count > 0){
		echo '
	<!--Start Categories Section-->
	<section class="Activity">
	<div class="container">
		<div class="row">';
		foreach ($rows as $row) {
			# code...
			echo '	
			<!-- Category 1 -->
			<div class="col-md-4 col-sm-6 col-xs-12">
		   		<div class="Activity_box">
			 		<figure>
						<img src="'. getCoverImage($row["photo"]) .'" alt="Slider- Item 2">
          				<figcaption>
			 				<a href="displayActivity.php?id='.$row['aid'].'">'.$row['aName'].'</a>
			 			</figcaption>
        			</figure>
        		</div>
			</div>';
		}
			echo " </div>
				</div>
			</section>";
	}
	else
	{
		echo '<section class="NoResult">
				<div class="container">
					<div class="row">
						<P>Sorry !!, No Result Available.<br></P>
					</div>
				</div>
			</section>'	;
	}
}
else
{
	$type = $_SESSION['ActID'];
    $stmt = $con->prepare("SELECT * from activity WHERE Type = ? and city = ?");
	$stmt->execute(array($_SESSION['ActID'],$do));
	$rows = $stmt->fetchAll();
	$count = $stmt->rowCount();		  
	if($count > 0){
		echo '
	<!--Start Categories Section-->
	<section class="Activity">
	<div class="container">
		<div class="row">';
		foreach ($rows as $row) {
			# code...
			echo '	
			<!-- Category 1 -->
			<div class="col-md-4 col-sm-6 col-xs-12">
		   		<div class="Activity_box">
			 		<figure>
						<img src="'. getCoverImage($row["photo"]) .'" alt="Slider- Item 2">
	          				<figcaption>
			 				<a href="displayActivity.php?id='.$row['aid'].'">'.$row['aName'].'</a>
			 			</figcaption>
        			</figure>
        		</div>
			</div>';
		}
		echo " </div>
				</div>
			</section>";
	}
	else
	{
		echo '<section class="NoResult">
				<div class="container">
					<div class="row">
						<P>Sorry !!, No Result Available.<br></P>
					</div>
				</div>
			</section>'	;
	}
}
include $tpl . 'footer.php'; ?>