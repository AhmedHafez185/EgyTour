<?php 
session_start();
$pageTitle = 'Events';
include "init.php"; 
$slider=getImagesArray("about");
slider($slider);
  $_SESSION['EType']='';
  $_SESSION['EDate']='';
   $month=array('January','February','March','April','May','June','July','August','September','October','November');
?>
	<section class="events">
	<div class="container">
		<div class="row">
		<div class="title">
		<h2>Find out about the events and festivals awaiting you on your trip to Egypt</h2>
			<p>
				Traditional celebrations, grape harvest festivities, sporting events, and world-class musicals; these are some of the sights that flood the streets and countryside of Chile with life. Enjoy the inviting activities, get to know the happiness of the Chileans who inhabit the country from north to south, and delight your senses with the explosion of colors, music, and flavors of the country.
                If you would like to search for a type of event, region in Chile, or specific date, use the following filters to find the events of your interest
			</p>
			</div>
		</div>
		</div>
	</section>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
  $EType =$_POST['EType'];
  $EDate =(int)$_POST['EDate'];
  $_SESSION['EType']=$EType;
  $_SESSION['EDate']=$EDate;
 
?>
	<!-- Start Section Event  Categories -->
		<!-- End Section Event  Categories -->
	<!-- Start Section Selected Month -->
	<section class="filterSection">
		<div class="container">
			<div class="row">
				<form class="form" method="POST" action="Events.php"> 
					<div class="col-lg-4 col-md-2">

					    <p><label>Choose Month</label></p>
					   <select class="controls_month"  required="required" name="EDate">
								   <option value="1">January</option>
								   <option value="2">February</option>
								   <option value="3">March</option>
								   <option value="4">April</option>
								   <option value="5">May</option>
								   <option value="6">June</option>
								   <option value="7">July</option>
								   <option value="8">August</option>
								   <option value="9">September</option>
								   <option value="10">October</option>
								   <option value="11">November</option>
								   <option value="12">December</option>									
					    </select>
					</div>
					<div class="col-lg-4 col-md-3">
						<p><label>Choose Type</label></p>
						<select class="controls_month"  required="required" name="EType">
						            <option value="select">All</option>
						            <?php  typeEvent($_SESSION['EType']); ?>
					    </select>
					</div>
					<div class="col-lg-4 col-md-3">
						<button class="ControlButton">Search</button>
					</div>
				</form>
			</div>
		</div>
	</section>
	 <?php
 $stmt = $con->prepare("SELECT * from events where type = ? and Month(eDate) = ?");
  $stmt->execute(array($EType,$EDate));
  $rows = $stmt->fetchAll();
  $count = $stmt ->rowCount();
	  if($count > 0){
	  	echo '
		<section class="EventsSection">
			<div class="container">
				<div class="row">';
					foreach ($rows as $row) {
					echo'
					<div class="col-lg-4 c0l-md-6 col-xs-12">
						<div class="Event_Box">
							<div class="thumbnail">
							    <img src="'.getCoverImage("category").'" alt="Event_1">
							    <div class="EventName">
							      <h4>'.$row['eName'].'</h4>
								</div>';
								if($row["noOfDay"] > 0)
								{
								echo'<p class="noOfDay">' . $row["noOfDay"] . ' Days</p>';
								}
								echo'<p class="noOfDay">' . $row["noOfDay"] . ' Days</p>';
								echo '<p class="description">'.substr($row["description"],0,200).' ...</p>
								<p><button class="MoreBt">more info</button></p>
								    <div class="dateType">
								    	<p class="date">'.$row['Eday'].' '.substr($month[$EDate-1],0,3).'</p>
								    	<p class="type">' . getEventCat($row['type']) . '</p>
								    </div>
							</div>
						</div>
					</div>';
				}
				echo '
				</div>
			</div>
		</section>';
	  }
	  else
	  {
	  	noResult();
	  }
}
else
{?>
	<section class="filterSection">
		<div class="container">
			<div class="row">
				<form class="form" method="POST" action="Events.php"> 
					<div class="col-lg-4 col-md-2">

					    <p><label>Choose Month</label></p>
					   <select class="controls_month"  required="required" name="EDate">
  								  <option value="1">January</option>
								   <option value="2">February</option>
								   <option value="3">March</option>
								   <option value="4">April</option>
								   <option value="5">May</option>
								   <option value="6">June</option>
								   <option value="7">July</option>
								   <option value="8">August</option>
								   <option value="9">September</option>
								   <option value="10">October</option>
								   <option value="11">November</option>
								   <option value="12">December</option>											
					    </select>
					</div>
					<div class="col-lg-4 col-md-3">
						<p><label>Choose Type</label></p>
						<select class="controls_month"  required="required" name="EType">
						            <option value="select">All</option>
						            <?php  typeEvent($_SESSION['EType']); ?>
					    </select>
					</div>
					<div class="col-lg-4 col-md-3">
						<button class="ControlButton">Search</button>
					</div>
				</form>
			</div>
		</div>
	</section>
	<?php
  $stmt = $con->prepare("SELECT eid,eName, Month(eDate) as EDat , Day(eDate) as Eday , description , noOfDay ,photo ,type from events order by eDate Desc limit 8");
  $stmt->execute(array());
  $rows = $stmt->fetchAll();
  $count = $stmt ->rowCount();
	  if($count > 0){
	  	echo '
		<section class="EventsSection">
			<div class="container">
				<div class="row">';
				foreach ($rows as $row) {
					echo'
					<div class="col-lg-4 c0l-md-6 col-xs-12">
						<div class="Event_Box">
							<div class="thumbnail">
							    <img src="'.getCoverImage("category").'" alt="Event_1">
							    <div class="EventName">
							      <h4>'.$row['eName'].'</h4>
								</div>';
								if($row["noOfDay"] > 0)
								{
								echo'<p class="noOfDay">' . $row["noOfDay"] . ' Days</p>';
								}
								echo'<p class="noOfDay">' . $row["noOfDay"] . ' Days</p>';
								echo '<p class="description">'.substr($row["description"],0,200).' ...</p>
								<p><button class="MoreBt">more info</button></p>
								    <div class="dateType">


								    		<p class="date">'.$row['Eday'].' '.substr($month[$row['EDat']-1],0,3).'</p>
								    	<p class="type">' . getEventCat($row['type']) . '</p>
								    </div>
							</div>
						</div>
					</div>';
				}
				echo '
				</div>
			</div>
		</section>';
	  }
	  else
	  {
	  	noResult();
	  }
}

include $tpl . 'footer.php'; ?>
