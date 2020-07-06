<?php
	session_start();
	$pageTitle = "Home";
	include 'init.php';
	$slider=getImagesArray("slider");
	slider($slider);
?>
<?php 
	$sql="SELECT * from place   limit 6";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	$count = 1;
		if($count > 0){
		 echo '
			<section class="visited">
				<div class="container">
					<h2 class="text-center"> Most Rate Places </h2>
					<div class="row">';
						 foreach( $rows as $row){
							echo '
								<!-- Place 1 -->
					 			<div class="col-sm-6 col-md-4">
				    			 <div class="Most">
						 			<img src="'.getCoverImage($row["photo"]).'"/>
					        		<a href="displayPlace.php?id='.$row['pid'].'"><h3>' . $row["PName"]. '</h3></a>
					        		<p>'. substr($row["Description"],0,170).'<a href="displayPlace.php?id='.$row['pid'].'"> More...</a></p>
				 				 </div>
								</div>';
						 }
		 	echo '	 </div> </div> </section>';
		}

?>

<!--Start Categories Section-->
	<section  id="cat" class="category">
	<div class="container">
	<hr>
		<p class="font_0">Choose from this  Categories</p>
		<p class="font_5">There are more categories of tourism in egypt choose your favorite</p>
		<div class="row">
		<!-- Category 1 -->
			<div class="col-md-4 col-sm-6 col-xs-12">
				   <div class="category_box">
				   	  <a href="category.php?cat=Historical">
				   		<div class="over animated fadeIn">Historical</div>
							 <img src="<?php echo $images ?>/category/Historical.jpg"/>
						 </a>
					</div>
		</div>
		<!-- Category 2  Religious-->
		
		<div class="col-md-4 col-sm-6 col-xs-12">
		     <div class="category_box">
				   	  <a href="category.php?cat=Religious">
				   		<div class="over animated fadeIn">Religious</div>
							 <img src="<?php echo $images ?>/category/Religious.jpg"/>
						 </a>
					</div>
		</div>
		<!-- Category 3 -->
		<div class="col-md-4 col-sm-6 col-xs-12">
		   <div class="category_box">	
		   		<a href="category.php?cat=Entertainment">
		   		<div  class="over animated fadeIn">Entertainment</div>
					 <img src="<?php echo $images ?>/category/Entertainment.jpg"/>
					</a>
			</div>
		</div>
		</div>

				<!-- Category 4 -->
		<div class="row">
		<div class="col-md-4 col-sm-6 col-xs-12">
		   <div class="category_box">	
		   		<a href="category.php?cat=Conference">
		   		<div  class="over animated fadeIn">Conference</div>
					 <img src="<?php echo $images ?>/category/Conference.jpg"/>
					</a>
			</div>
		</div>
				<!-- Category 5 -->
			<div class="col-md-4 col-sm-6 col-xs-12">
		   <div class="category_box">	
		   		<a href="category.php?cat=Nature">
		   		<div  class="over animated fadeIn">Nature</div>
					 <img src="<?php echo $images ?>/category/Nature.jpg"/>
					</a>
			</div>
		</div>
				<!-- Category 6 -->
	    	<div class="col-md-4 col-sm-6 col-xs-12">
		   <div class="category_box">	
		   		<a href="category.php?cat=Culture">
		   		<div  class="over animated fadeIn">Culture</div>
					 <img src="<?php echo $images ?>/category/Culture.jpg"/>
					</a>
			</div>
		</div>
		
		</div>
		</div>
	</section>
	<!--End Categories Section-->
<?php include $tpl . 'footer.php'; ?>
