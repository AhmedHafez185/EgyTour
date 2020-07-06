<?php 
session_start();
$pageTitle = 'WhereToGo';
include "init.php"; ?>
<?php 
    $_SESSION['cID']=(isset($_GET['id']))?$_GET['id']:0;
	$cityName = "";
	$stmt = $con->prepare("SELECT * from city  where cityId = ?" );
	$stmt->execute(array($_SESSION['cID']));
	$rows= $stmt->fetch();
	$cityName = $rows['cityName'];
	$count = $stmt ->rowCount();
	if($count > 0)
	{
		echo '
		<div class="containerCities">
			<div class="cityImage">
				<img src="' . $images .'city/' . $rows['photo'] . '">
		   </div>
	   </div>';
	} 
	echo '
		<div class="cityName">
		     <div class="container">
			    <p class="font_0">Discover '.$rows['cityName'].' city</p>
				<p class="font_5">There are more place to visit choose your favorite</p>';
			   	if($rows['description']!="")
			   	 echo'<p class="CityDesc">' . $rows['description'] . '</p>';
			     echo '</div></div>';
	    $stmt = $con->prepare("SELECT * from place  where PCity =? ");
		$stmt->execute(array($_SESSION['cID']));
		$rows = $stmt->fetchAll();
		$count = $stmt ->rowCount();	
		if($count > 0)
		{
			echo '
			<section class="cityPlaces">
				 <div class="container">
				 	<div class="row">
						<h3>WHAT YOU CAN SEE IN '. $cityName .'</h3>
							';
							foreach( $rows as $row){
							echo '
								<div class="col-lg-3 col-md-6 col-sm-12">
								   	<div class="place_item">
								   		<a href="displayPlace.php?id='.$row['pid'].'">
									 		<figure>
										      <img src="' . getCoverImage($row["photo"]) . '" alt="' . $row["PName"]. ' - Image">
							          		  <p>' . $row["PName"]. '</p>
						        			</figure>
						        		</a>
						        	</div>
								</div>';
							}
					echo '
					</div>';
				if(PlacesPerCity($_SESSION['cID']) >16)
					echo '<div class="MorePlace"><a href="#">See More</a></div>';
				    echo '</div></section>';
		}
	    $stmt = $con->prepare("SELECT * from activity  where city = ?");
		$stmt->execute(array($_SESSION['cID']));
		$rows = $stmt->fetchAll();
		$count = $stmt ->rowCount();	
		if($count > 0)
		{
			echo '
			<section class="cityPlaces">
				<div class="container">
				 	<div class="row">
						<h3>There Are more Thing To do in '. $cityName .'</h3>
				   </div>
				</div>
			</section>';
		}
		
		ActivitySlider($_SESSION['cID']);
		$stmt = $con->prepare("SELECT * from service where CtId = ? ");
		$stmt->execute(array($_SESSION['cID']));
  		$rows = $stmt->fetchAll();
		$count = $stmt ->rowCount();
			  if($count > 0){
			  	echo '
				<section class="ServiceCity">
					<div class="container">
						<h3 class="AboutService">What About service In '. $cityName .'</h3>
						<div class="row">';
				echo'
					<ul class="cityServiceType">
					<li id="Hotel"><i class="fa fa-bed" aria-hidden="true"></i>Hotel</li>
					<li id="Resturant"><i class="glyphicon glyphicon-cutlery"></i>Resturant</li>
				    <li id="Hospital"><i class="fa fa-hospital-o" aria-hidden="true"></i>Hospital</li>
					</ul>';
						foreach ($rows as $row) {
							echo'
							<div class="col-lg-4 c0l-md-6 col-xs-12" id="'.getServiceCatName($row['Cat_id']).'">
								<div class="Service_Box">
									<div class="thumbnail">
										<a href="display.php?id='.$row['sid'].'">
											<img src="'.getCoverImage($row['photo']).'" alt="service_1">
											<div class="ServiceName">
											      <h4>'.$row['sName'].'</h4>
										    </div>
										</a>
									</div>
								</div>
							</div>';
						}
						echo '</div>';
					if(ServicePerCity($_SESSION['cID']) > 6)
					echo '<div class="MorePlace"><a href="">See More</a></div>';
				    echo '</div></section>';
			  }
		?>

			    
			  
<?php include $tpl . 'footer.php'; ?>
