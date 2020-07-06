<?php 
 session_start();
 if(isset($_SESSION['username'])){
 	$pageTitle = 'plan';
 	include "init.php";

	?>
	<section class="homePlan">
		<div class="container">
		    <p class="font_0">Choose way for your plan</p>
			<p class="font_5">There are more way to organize your plan in egypt choose your favorite</p>
		   	<hr>

		   	<div class="leftSection">
				<div class="rightSection">
				    <div id="map"></div>
				</div>
			      <div class="col-md-3">
				    <a href="PlanningCat.php">
					    <div class="planBox">
							  <div class="info">
							  	<p>Place Category</p>
							  </div>
						</div>
					</a>
			     </div>
			      <div class="col-md-3">
				    <a href="PlanningCity.php">
					    <div class="planBox">
							  <div class="info">
							  	<p>City</p>
							  </div>
						</div>
					</a>
			     </div>
			  </div>
				
		</div>
	</section>
	
 



<?php
}
else
{
	echo '<input type="hidden" value="FALSE">';
	header('location:login.php');
		exit();
}
 include $tpl . 'footer.php'; ?>
        
