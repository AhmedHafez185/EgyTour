<?php 
	session_start();
    $pageTitle = 'Categories';
    include "init.php";
 ?>	
	 <section class="CategoriesList">
	 	<div class="sb-wrapper optiscroll vtrack-on">
		 <aside id="sidebar" class="sb-sidebar optiscroll-content-fixed" unselectable="on"
		  style="overflow-y: scroll; width: 260px; top: 0px; background-color:rgba(137,165,123,0.27);">
		         <h2>Categories</h2>
				  <ul class="sb-categories">          
					  <li  class="sb-lvl-1-cat -no-icon"><a href="category.php">See All</a></li>
					  <?php getCategoriesList(); ?>
			       </ul>
		 </aside>    
		</div>
	</section>
	<?php
	$type =isset($_GET['type'])?$_GET['type'] : 'All';
	if($type == "All")
	{
		$stmt = $con->prepare("SELECT * from place");
		$stmt->execute();
		$rows = $stmt->fetchAll();
		$count = $stmt ->rowCount();
		if($count > 0){
			echo '<section>
					<div class="our-work">
						<div class="container">
							<h2 class="upper">'.$type.'</span></h2>
							<div class="items-box">';
					foreach ($rows as $row) {
						echo '<div class="item">
								<img src="'.getCoverImage($row["photo"]).'" />
								<div class="over text-center  animated fadeIn">
									<h4 class="">'.$row['PName'].'</h4>
					        		<p>'. substr($row["Description"],0,200).'<a href="displayPlace.php?id='.$row['pid'].'"> More...</a></p>
									<a href="displayPlace.php?id='.$row['pid'].'"><button class="">Show</button></a>
								</div>
						     </div>';
					}
					echo '</div></div></div></section>';
		   }else {
		   	noResult();
		   }
			
	}
	else
	{
		
		$stmt = $con->prepare("SELECT * from place where PCat = ?");
		$stmt->execute(array(getCat($type)));
		$rows = $stmt->fetchAll();
		$count = $stmt ->rowCount();
		if($count > 0){
			echo '<section >
					<div class="our-work">
						<div class="container">
							<h2 class="upper">'.$type.'</h2>
							<div class="items-box">';
					foreach ($rows as $row) {
						echo '<div class="item">
								<img src="'.getCoverImage($row["photo"]).'" />
								<div class="over text-center">
									<h4 class="">'.$row['PName'].'</h4>
					        		<p>'. substr($row["Description"],0,200).'<a href="displayPlace.php?id='.$row['pid'].'"> More...</a></p>
									<a href="displayPlace.php?id='.$row['pid'].'"><button class="">Show</button></a>
								</div>
						     </div>';
					}
					echo '</div></div></div></section>';
		   }
		   else
		   {
		   	noResult();
		   }
			
	}

						
			
						?>

 	<?php include $tpl . 'FooterNoNav.php'; ?>





