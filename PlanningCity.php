<?php 
session_start();
$pageTitle = 'City';
include "init.php"; ?>
<!-- Start Cities Places Type Section -->

<!-- End Cities Places Type Section -->
<!-- Start Displaying Places -->
<?php 
$cityId=0;
if(isset($_GET['cityId']))
	$cityId =$_GET['cityId'];
?>
<?php
$sql="SELECT distinct PCity from place";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $rows = $stmt->fetchAll();
echo '
 <section class="tab-u">
    <div class="container">
	    <div class="row">
	        <ul class="nav nav-tabs">';
	        		echo '<li><a href="PlanningCity.php?cityId=0">All</a></li>';
			   foreach ($rows as $row) {
            		# code...
          			echo '<li><a href="PlanningCity.php?cityId='.$row['PCity'].'">' . getCity($row["PCity"]) . '</a></li>';
         		 }
	echo'	</ul>
		</div>
	</div>
</section>';
	?>
	<section class="PlanPlaces">
				<div class="container">
					<div class="row">
						<a href="#">
							<div class="PlaceNum">
								<span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
								 <p class="Num">2</p>
							</div>
						</a>
					</div>
				</div>
	</section>
	<?php

 $pag=1;
if($cityId == "0" )
{
		$stmt2 = $con->prepare("SELECT * from place" );
		$stmt2->execute(array());
		$rows2 = $stmt2->fetchAll();
		$count2 = $stmt2 ->rowCount();
		$perPages = 21;
		$pages = ceil($count2 / $perPages);
		
		 if(isset($_GET['page']))
		{
		  $pag = $_GET['page'];
		}
		else
		{
		  $pag =1;
		}
		$Start = (($pag - 1)*$perPages);
		$stmt = $con->prepare("SELECT * from place  limit $Start,$perPages" );
		$stmt->execute(array());
		$rows = $stmt->fetchAll();
		$count = $stmt ->rowCount();
		   if($count > 0){
			   echo '
				<section class="CitiesPlaces">
				<div class="container">
					<div class="row">
					<div class="numberOfResult"><p>Showing '.$count2.' Results  - Page '.$pag.' of ' . $pages . '</p></div> ';
					          if($count2  > $perPages){
					            echo ' <nav aria-label="Page navigation">
					                    <ul class="pagination">
					                      <li>
					                        <a href="#" aria-label="Previous">
					                          <span aria-hidden="true">&laquo;</span>
					                        </a>
					                      </li>';
					                      for($page=1;$page <= $pages;$page++)
					                      {
					                        echo '<li><a href="PlanningCity.php?cityId='.$cityId.'&page='.$page .'">'.$page.'</a></li>';
					                      }
					                      echo'<li>
					                        <a href="#" aria-label="Next">
					                          <span aria-hidden="true">&raquo;</span>
					                        </a>
					                      </li>
					                    </ul>
					            </nav>
                              ';
                           } 
					foreach( $rows as $row){
				echo '
					<div class="col-sm-6 col-md-4">
			    <div class="thumbnail">
			      <img src="' . getCoverImage($row["photo"]) . '" alt="place1">
			      <div class="caption">';
			      ?>
				 <button class="btn btn-primary" onclick="getPlan('processing?req=addPlace',myfun,false)">Add</button>
			      <?php
			      echo '		      
			        <h3><a href="displayPlace.php?id='.$row['pid'].'">' . $row["PName"]. '</a></h3>
					 <p>'. substr($row["Description"],0,170).'<a href="displayPlace.php?id='.$row['pid'].'"> More...</a></p>
					</div>
					</div>
						</div>';
					}
		 		echo '	 </div> </div> </section>';
		   }
		   else
		   {
		   	  	noResult()	;
		   }

}
else
{
		$stmt2 = $con->prepare("SELECT * from place where PCity = ?" );
		$stmt2->execute(array($cityId));
		$rows2 = $stmt2->fetchAll();
		$count2 = $stmt2 ->rowCount();
		$perPages = 21;
		$pages = ceil($count2 / $perPages);
		
		 if(isset($_GET['page']))
		{
		  $pag = $_GET['page'];
		}
		else
		{
		  $pag =1;
		}
		$Start = (($pag - 1)*$perPages);
		$stmt = $con->prepare("SELECT * from place where PCity = ? limit $Start,$perPages" );
		$stmt->execute(array($cityId));
		$rows = $stmt->fetchAll();
		$count = $stmt ->rowCount();
		   if($count > 0){
			   echo '
				<section class="CitiesPlaces">
				<div class="container">
					<div class="row">
					<div class="numberOfResult"><p>Showing '.$count2.' Results  - Page '.$pag.' of ' . $pages . '</p></div> ';
					          if($count2  > $perPages){
					            echo ' <nav aria-label="Page navigation">
					                    <ul class="pagination">
					                      <li>
					                        <a href="#" aria-label="Previous">
					                          <span aria-hidden="true">&laquo;</span>
					                        </a>
					                      </li>';
					                      for($page=1;$page <= $pages;$page++)
					                      {
					                      echo '<li><a href="PlanningCity.php?cityId='.$row['PCity'].'&page='.$page .'">'.$page.'</a></li>';
					                      }
					                      echo'<li>
					                        <a href="#" aria-label="Next">
					                          <span aria-hidden="true">&raquo;</span>
					                        </a>
					                      </li>
					                    </ul>
					            </nav>
                              ';
                           } 
					foreach( $rows as $row){
				echo '
					<div class="col-sm-6 col-md-4">
			    <div class="thumbnail">
			      <img src="' . getCoverImage($row["photo"]) . '" alt="place1">
			      <div class="caption">
				 <p><button class="btn btn-primary" id="AddBtn" role="button">Add</button></p>
			        <h3><a href="displayPlace.php?id='.$row['pid'].'">' . $row["PName"]. '</a></h3>
					 <p>'. substr($row["Description"],0,170).'<a href="displayPlace.php?id='.$row['pid'].'"> More...</a></p>
					</div>
					</div>
						</div>';
					}
		 		echo '	 </div> </div> </section>';
		   }
		   else
		   {
		   	  	noResult()	;
		   }

}

?>

<?php include $tpl . 'footer.php'; ?>
