<?php 
session_start();
$pageTitle = 'Service';
include "init.php"; ?>
<?php 
$_SESSION['SID']=(isset($_GET['id']))?$_GET['id']:0;
$do =isset($_GET['Type'])?$_GET['Type'] : 'All';
?>
<div class="Hidden"><?php echo "3";?></div>
<?php
echo '<section class="tabType">
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs">
  			<li class="all"><a href="Service.php?Type=All&id='.$_SESSION['SID'].'">Top</a></li>';
		$stmt = $con->prepare("SELECT distinct CtId from service where Cat_id = ?");
		$stmt->execute(array($_SESSION['SID']));
		$rows = $stmt->fetchAll();
		$count = $stmt->rowCount();
	  foreach($rows as $row)
	  {
		echo '<li class="Tourism"><a href="Service.php?Type='.$row['CtId'].'&id='.$_SESSION['SID'].'">'.getCity($row['CtId']).'</a></li>';	  
	  }
  	echo '</ul>
		</div>
		</div>
	</section>';
if($do=="All")
{
	$stmt2 = $con->prepare("SELECT * from service  where Cat_id = ?" );
	    $stmt2->execute(array($_SESSION['SID']));
		$rows2 = $stmt2->fetchAll();
		$count2 = $stmt2 ->rowCount();
		$perPages = 18;
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
		$type = $_SESSION['SID'];
	    $stmt = $con->prepare("SELECT * from service WHERE  Cat_id = ? limit $Start,$perPages");
	    $stmt->execute(array($_SESSION['SID']));
		$rows = $stmt->fetchAll();
		$count = $stmt->rowCount();		  
	if($count > 0){
		   echo '<section class="hotelCategory">
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

					                        echo '<li><a href="service.php?Type='.$do.'&id='.$_SESSION['SID'].'&page='.$page .'">'.$page.'</a></li>';
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
			echo '<div class="col-lg-6">
					 	<div class="test">
							<div class="media">
								 	 <div class="media-left">
								    	 <img class="media-object" src="' . getCoverImage($row["photo"]) . '" alt="Image">
									 </div>
									 <div class="media-body service">
										<h4 class="media-heading"><a href="display.php?id='.$row['sid'].'">' . $row["sName"]. '</a></h4>';
										 
							
								echo '</div>
							</div>
						</div>
				 </div>';
		}
		 echo '	 </div> </div> </section>';
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
	    $stmt2 = $con->prepare("SELECT * from service  where CtId = ? and Cat_id = ?" );
	    $stmt2->execute(array($do,$_SESSION['SID']));
		$rows2 = $stmt2->fetchAll();
		$count2 = $stmt2 ->rowCount();
		$perPages = 18;
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
		$type = $_SESSION['SID'];
	    $stmt = $con->prepare("SELECT * from service WHERE CtId = ? and Cat_id = ? limit $Start,$perPages");
	    $stmt->execute(array($do,$_SESSION['SID']));
		$rows = $stmt->fetchAll();
		$count = $stmt->rowCount();		  
	if($count > 0){
		   echo '<section class="hotelCategory">
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

					                        echo '<li><a href="service.php?Type='.$do.'&id='.$_SESSION['SID'].'&page='.$page .'">'.$page.'</a></li>';
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
			$asd=str_replace('?', '', $row["sName"]);
					echo '<div class="col-lg-6">
					 	<div class="test">
							<div class="media">
								 	 <div class="media-left">
								    	 <img class="media-object" src="' . getCoverImage($row["photo"]) . '" alt="Image">
									 </div>
									 <div class="media-body service">
										<h4 class="media-heading"><a href="display.php?id='.$row['sid'].'">' .$asd. '</a></h4>';
										 
							
								echo '</div>
							</div>
						</div>
				 </div>';
		}
		 echo '	 </div> </div> </section>';
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
?>
<?php
include $tpl . 'footer.php'; ?>