<?php 
  session_start();
  $pageTitle = "Service";
  include 'init.php';
    if(isset($_GET['id']))
    	$id=$_GET['id'];
    $stmt = $con->prepare("SELECT * FROM activity WHERE aid = ?");
	$stmt->execute(array($id));
	$rows = $stmt->fetch();
	$count = $stmt->rowCount();
    $slider=getImagesArray($rows['photo']);
	slider($slider);
	echo '<input type="hidden" class="sid" value="'.$id.'">';
			echo '<input type="hidden" class="PlaceType" value="Activity">';

    echo '<section class="container">
 
    <div class="gupnp_service_notify(service, name, type, value)">' ;
        
      echo '<section class="container">

    <div class="service">
    	<h2> '.$rows['aName'].'</h2>  
        
       <div class="serv">   
       '.$rows['Description'].'
       </div>
       <p class="rate">Rate : </p>
    </div>';



	//$id = $_GET['id'];
	//$count2 = (int)$rows2['votes'];
	$stmt2 = $con->prepare("SELECT sum(rate) as Rate  , count(id) as Num FROM rating WHERE sid = ? and PlaceType='Activity' group by sid");
	$stmt2->execute(array($id));
	$row2 = $stmt2->fetch();
	$count2 = $stmt2->rowCount();
	if($row2['Num'] > 0)
	  if($row2['Rate']==0)
		$row2['votes']=1;
	  	$cal = ($row2['Rate'] == 0) ? 0 : round(($row2['Rate']/$row2['Num']), 1);
	  
?>
<span class="ratingAverage" data-average="<?php echo $cal;?>"></span>
<span class="article" data-id="<?php echo $id ;?>"></span>
<div class="barra">
	<span class="bg"></span>
	<span class="stars">
<?php 
$starsVa=array('Poor','Fair','Good','VeryGood','Excelent');
for($i=1; $i<=5; $i++)
{
	echo'<span class="star" data-vote="'.$i.'">
			<span class="starAbsolute" title="'.$starsVa[$i-1].'"></span>
	   	</span>';
}
	echo '</span></div>
	<div class="displayComment">
	<p class="votos" id="progressShow"><span>'.$row2['Num'].'</span> review</p>
	<p class="votRate">'.$cal.'</p></div>';
 progressBar($id,"Activity",$row2['Num']);
		echo '<div class="wrapper">
			<div class="comment-wrapper">
				<h3 class="comment-title">User Feedback....</h3>
				<div class="comment-insert">';
				if(isset($_SESSION['username']))
					{?>
					 <button id="comment-post-btn" type="button" onclick="getAjax('comments.php?req=addComment','myfun',false)" class="btn btn-default">Post</button>
					 <?php echo '<h3 class="who-says">Your Comment: </h3>
					  <div class="comment-insert-container">
				       <textarea id="comment-post-text" class="comment-insert-text"></textarea>
					   </div>	';
					}
					else
					{
						echo '
						<div class="Warning">
							 <div class="alert alert-success"> Login for commenting!!  </div>
							<a class="btn btn-primary" href="login.php">Login</a>
							<a class="btn btn-success" href="signUp.php">SignUp</a>
						</div>
						';
					}
					
				
					echo '</div>
				</div>
				';
		$stmt = $con->prepare("SELECT * from comments where serviceId = ? and PlaceType='Activity' ");
		$stmt->execute(array($id));
		$rows = $stmt->fetchAll();
		$count = $stmt->rowCount();
		$page='displayActivity.php?id=' . $id;
		if($count >0 )
		{
			echo '<div class="comment-list">
				<ul class="comment-holder-ul">';
			  foreach($rows as $row)
	 		 {
	 		 	echo '
	 		 	<li class="comment-holder" id="_1">
								<div class="user-img">
									<img src="'.getUserImage($row['userid']).'" class="user-img-pic" />
								</div>
								<div class="comment-body">
										<h3 class="username-field">
											<a href="profile.php">'. userName($row['userid']).'</a>				
										</h3>
										<div class="comment-text">
										'.$row['comment'].'
										</div>
								</div>
								<div class="comment-button-holder">
									<ul>';
									if(isset($_SESSION['username']))
									if($row['userid'] == userID($_SESSION['username']))
									echo '<a href="comments.php?req=removeComment&cid='.$row['cid'].'&page='.$page.'"><li class="delete-btn">X</li></a>
									</ul>
									<input type="hidden" class="RemovedCom" value="'. $row['cid'].'">
								</div>
							</li> ';
	  			}
	  			echo '</ul></div>';
		}
		echo '</div></div></section>';
		relatedService($id);
?>
<section class="relatedService">
	<div class="container">
		<div class="row">

		</div>
	</div>
</section>
<?php include $tpl . 'footer.php'; ?>
        