<?php 
 	session_start();
    $pageTitle = 'plan';
    include "init.php";
    $way =isset($_GET['way'])?$_GET['way'] : 'Category';
    $_SESSION['way']=$way;
    if($way=="Category")
    {
    	
    }
?>
	
<!--Start Categories Section-->
	<section class="places">
		<div class="container">
			<div class="row">
				<!-- Category 1 -->
				<div class="col-lg-4 col-md-6 col-sm-12">
			   		<div class="place_item">
				 		<figure>
							<img src="" alt="Slider- Item 2">
		          				<p>
				 					<a href="#">Ahmed Alaa</a>
				 		     	</p>
	        			</figure>
	        		</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
			   		<div class="place_item">
				 		<figure>
							<img src="" alt="Slider- Item 2">
		          				<p>
				 					<a href="#">Ahmed Alaa</a>
				 		     	</p>
	        			</figure>
	        		</div>
				</div>
				<div class="col-lg-4 col-md-6 col-ms-12">
			   		<div class="place_item">
				 		<figure>
							<img src="" alt="Slider- Item 2">
		          				<p>
				 					<a href="#">Ahmed Alaa</a>
				 		     	</p>
	        			</figure>
	        			  <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>

	        			
	        		</div>
				</div>
			</div>
		</div>
	</section>
<?php include $tpl . 'footer.php'; ?>
