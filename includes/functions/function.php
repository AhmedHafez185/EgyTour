<?php
/**

* Tittle function that echo the page title
* in the case page has variable $pa geTitle 
*

*/

function getTitle(){
		global $pageTitle;

	if(isset($pageTitle))
	{
		echo $pageTitle;
	}  
	else
	{
		echo 'Default';
	}

}
function noResult()
{
	
            echo '<section class="NoResult">
                      <div class="container">
                          <div class="row">
                              <P>Sorry !!, No Result Matching ,<br>Try again.</P>
                          </div>
                      </div></section>' ;
}
function checkItem ($select , $from ,$value) {
	global $con;
	$stmt = $con->prepare("select $select from $from where $select = ?");
	$stmt->execute(array($value));
	$count = $stmt->rowCount();
	return $count;
}


/// User id using username
function userID($uname)
{
    
    global $con;
    $stmt=$con->prepare("select userId from users where Username=?");
    $stmt->execute(array($uname));
    $uid=$stmt->fetch()['userId'];
    return $uid;
}
// user name using id 
function userName($id)
{   
    global $con;
    $stmt=$con->prepare("select Username from users where userId=?");
    $stmt->execute(array($id));
    $row=$stmt->fetch();
    return $row['Username'];
}
function getUserImage($uid)
{
   global $images;
    global $con;
    $stmt=$con->prepare("select image from users where userid=?");
    $stmt->execute(array($uid));
    $rows=$stmt->fetch();
    if($rows['image']=='')
		return ($images.'users/default.png');
	else
		return ($images.'users/'.$rows['image']);
}
/***
*get the data of transport service
**/
function WriteIntoFile($keySearch){
$myfile = fopen("search.txt", "w") or die("Unable to open file!");
fwrite($myfile, $keySearch);
fclose($myfile);
}
function ReadFromFile(){
$myfile = fopen("search.txt", "r") or die("Unable to open file!");
$keySearch = fread($myfile,filesize("search.txt"));
fclose($myfile);
return $keySearch;
}
function numberOfImages($folderName)
{   global $images;
	$images_extension_array = array("jpg","jpeg","gif","png");

$dir = $images . $folderName;
$dir_resource = opendir($dir);

$file_count = 0;
while (($file = readdir($dir_resource)) !== false) { // scan directory
  $extension_from = strrpos($file,"."); // isolate extension index/offset
  if ($extension_from && in_array(substr($file,$extension_from+1), $images_extension_array))
    $file_count ++; //if has extension and that extension is "associated" with an image, count

}
return $file_count;
}

function getImagesArray($folderName)
{	$length = numberOfImages($folderName);
	for($x = 0;$x <$length ;$x++)
	{
		$ImagesArray[$x]=$folderName . '/' . ($x+1) .'.jpg';	
	}
	return $ImagesArray;
}
function slider($slides)
{	
	global $images;
	$flag = false;
	echo '
		   <!-- Start Slider -->
		  <div id="MySlider" class="carousel slide" data-ride="carousel">
		  <!-- Indicators point to move slide -->
			  <ol class="carousel-indicators">
			  <li data-target="#MySlider" data-slide-to="0" class="active"></li>';
			  	$arrlength = count($slides);
				for($x = 0; $x < $arrlength-1; $x++) {
					echo'
			    <li data-target="#MySlider" data-slide-to="'.($x+1).'"></li>';
			}
			 echo' </ol>	
			  <div class="carousel-inner" role="listbox">
	';
	$arrlength = sizeof($slides);
	for($x = 0; $x < $arrlength; $x++) {
		if ($flag==false){
			echo '	 <div class="item active">
				<img src="'. $images . $slides[$x] . '" alt="Slider-Item 1">
				<div class="carousel-caption">
				</div>
			 </div>';
			 $flag = true;
		}else{
			echo '	 <div class="item">
				<img src="'. $images . $slides[$x] . '" alt="Slider-Item 1">
				<div class="carousel-caption">
				</div>
			 </div>';
		}
    
	}
		echo '
					</div>
			    </div>
			';	
}

function ActivitySlider($cityId){
	global $con;
	$flag=false;
	$stmt = $con->prepare("SELECT * from  activity where city = ?");
	$stmt->execute(array($cityId));
	$rows = $stmt->fetchAll();
	$count = $stmt ->rowCount();	
	$c=0;
	if($count > 0)
	{
	echo '<section class="ACtivityPlace">
			<div class="container">
    		<div class="col-md-12">
        	<div class="carousel slide" id="myCarousel">
          	<div class="carousel-inner">';
          foreach($rows as $row) {
					if ($flag==false){
						echo '<div class="item active">
              					   <div class="col-lg-4 col-xs-4 col-md-4 col-sm-4">
              							<a href="displayActivity.php?id='.$row['aid'].'"><img src="'.getCoverImage($row['photo']).'" class="img-responsive">
              							<div class="carousel-caption">'.$row['aName'].'</div>
              							</a>
              						</div>
                		 	  </div>';
						 $flag = true;
					}
					else
					{
					echo '<div class="item">
              					<div class="col-lg-4 col-xs-4 col-md-4 col-sm-4">
              						<a href="displayActivity.php?id='.$row['aid'].'"><img src="'.getCoverImage($row['photo']).'" class="img-responsive">
              						<div class="carousel-caption">'.$row['aName'].'</div>
              						</a>
              					</div>
                		   </div>';
				    }
			}
             echo '
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
          </div>
    	  </div>
		  </div>
	</section>';
	}
}
function sliderHome($slides)
{	
	global $images;
	$flag = false;
	echo '
		   <!-- Start Slider -->
		  <div id="MySlider" class="carousel slide" data-ride="carousel">
		  <!-- Indicators point to move slide -->
			  <ol class="carousel-indicators">
			  <li data-target="#MySlider" data-slide-to="0" class="active"></li>';
			  	$arrlength = count($slides);
				for($x = 0; $x < $arrlength-1; $x++) {
					echo'
			    <li data-target="#MySlider" data-slide-to="'.($x+1).'"></li>';
			}
			 echo' </ol>	
			  <div class="carousel-inner" role="listbox">
	';
	$arrlength = sizeof($slides);
	for($x = 0; $x < $arrlength; $x++) {
		if ($flag==false){
			echo '	 <div class="item active">
				<img src="'. $images . $slides[$x] . '" alt="Slider-Item 1">
				<div class="carousel-caption">
				Discover Tourism in Egypt
		<div class="startNow"> <a href="#">
				 <p>Start Now</p>
				</a> 
				</div>
				</div>
			 </div>';
			 $flag = true;
		}else{
			echo '	 <div class="item">
				<img src="'. $images . $slides[$x] . '" alt="Slider-Item 1">
				<div class="carousel-caption">
				 Discover Tourism in Egypt
				 <div class="startNow">
				<p><a href="#">Start Now</a></p>
				 </div>
				</div>
			 </div>';
		}
    
	}
		echo '
					</div>
			    </div>
			';	
}
// for index page

function getCoverImage($row)
{
	global $images;
	$image=$images.$row.'/1.jpg';
	return $image;
}
function getCity($cityID)
{
	global $con;
    $stmt=$con->prepare("select cityName from city where cityID=?");
    $stmt->execute(array($cityID));
    $CName=$stmt->fetch()['cityName'];
    return $CName;
}
function getServiceId($Service)
{
	global $con;
    $stmt=$con->prepare("select Cid from servicecategory where Name=?");
    $stmt->execute(array($Service));
    $CatId=$stmt->fetch()['Cid'];
    return $CatId;
}
function getServiceCatName($id)
{
	global $con;
    $stmt=$con->prepare("select Name from servicecategory where Cid=?");
    $stmt->execute(array($id));
    $CatName=$stmt->fetch()['Name'];
    return $CatName;
}
function getPlaceCatId($Service)
{
	global $con;
    $stmt=$con->prepare("select tourCatId from tourismcategory where tourCatName=?");
    $stmt->execute(array($Service));
    $CatId=$stmt->fetch()['tourCatId'];
    return $CatId;
}
/* Get City */
function getCityFrom($type,$s)
{		global $con;
	    $select='';
	    if($s !='')
	    	$select='selected';
 
        if($type == 'FromCity')
        {
			        $stmt = $con->prepare("SELECT DISTINCT FromCity from transport order by Tid");
			        $stmt->execute();
			        $rows = $stmt->fetchAll();
			        $count = $stmt->rowCount();
			        foreach($rows as $row)
			        {
			          $cty = getCity($row['FromCity']);
			          if($cty == $s)
			         		 echo "<option ".$select." value='" .$row['FromCity'] . "'>" . $cty . "</option>";
			           else
			      			 echo "<option  value='" .$row['FromCity'] . "'>" . $cty . "</option>";

			        }
    	}
    	 if($type == 'ToCity')
		{
			        $stmt = $con->prepare("SELECT DISTINCT ToCity from transport order by Tid");
			        $stmt->execute();
			        $rows = $stmt->fetchAll();
			        $count = $stmt->rowCount();
			        foreach($rows as $row)
			        {
			        if(getCity($row['ToCity']) == $s)
				          echo "<option ".$select." value='" .$row['ToCity'] . "'>" . getCity($row['ToCity']) . "</option>";
				     else
				      	  echo "<option value='" .$row['ToCity'] . "'>" . getCity($row['ToCity']) . "</option>";

			        }
    	}
}
function getWay($way)
{
	$arrayName = array('1' =>'Plane' , '2' =>'Train' ,'3' =>'Bus','4' =>'Car');
	return $arrayName[$way]; 
}

function typeEvent($s)
{	
	 $select='';
	    if($s !='')
	    	$select='selected';
	global $con;
	$stmt = $con->prepare("SELECT * from eventtype");
	$stmt->execute();
	$rows = $stmt->fetchAll();
	$count = $stmt->rowCount();
	if($count > 0)
	{
			foreach($rows as $row)
			{
				if($row['tid'] == $s)
					echo '<option '.$select.' value="' . $row['tid'] . '">' . $row['tName'] . '</option>';
				else
					echo '<option  value="' . $row['tid'] . '">' . $row['tName'] . '</option>';
			}
	}
}
function redirectHome ($theMsg, $url=null, $seconds = 1) {
		$seconds = 1;
		$link = '';
		if($url === null)
		{
			$url='index.php';
			$link = 'Dashboard';
		}
		elseif($url== 'back'){

			if(isset($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']!==''){
				$url = $_SERVER['HTTP_REFERER'];
			
			}else{

				$url = 'index.php';
				$link = 'Dashboard';
			}
		}else{
			$link = $url;
		}
		echo $theMsg;
		echo "<div class='alert alert-info'>You Will Direct to <strong>$link</strong> Direct In $seconds s...</div>";
		echo "</div>";
		header("refresh:$seconds;url=$url");
		exit();
}
function getEventCat($eid)
{
	global $con;
	$stmt = $con->prepare("SELECT * from eventtype where tid = ?");
	$stmt->execute(array($eid));
	$row = $stmt->fetch();
	$count = $stmt->rowCount();
	if($count > 0)
	{
		return $row['tName'];
	}
}
function getCategoriesList()
{	
	 
	global $con;
	$stmt = $con->prepare("SELECT * from tourismcategory");
	$stmt->execute();
	$rows = $stmt->fetchAll();
	$count = $stmt->rowCount();
	if($count > 0)
	{
		foreach($rows as $row)
		{
	echo '<li  class="sb-lvl-1-cat -no-icon"><a href="category.php?type=' . $row['tourCatName'] . '">' . $row['tourCatName'] . '</a></li>';
		}
	}
}
function getCat($catName)
{
	global $con;
	$stmt = $con->prepare("SELECT * from tourismcategory where tourCatName = ?");
	$stmt->execute(array($catName));
	$rows = $stmt->fetch();
	$count = $stmt->rowCount();
	if($count > 0)
	{
	 return $rows['tourCatId'];
	}
}
function getCatName($catID)
{
	global $con;
	$stmt = $con->prepare("SELECT * from tourismcategory where tourCatId = ?");
	$stmt->execute(array($catID));
	$rows = $stmt->fetch();
	$count = $stmt->rowCount();
	if($count > 0)
	{
	 return $rows['tourCatName'];
	}
}
function getPlaceType($pid){
	global $con;
	$stmt = $con->prepare("SELECT * from place where pid = ?");
	$stmt->execute(array($pid));
	$rows = $stmt->fetch();
	$count = $stmt->rowCount();
	if($count > 0)
	{
	 return getCatName($rows['PCat']);
	}
}
function PlacesPerCity($cid){
	global $con;
	$stmt = $con->prepare("SELECT * from place where PCity = ?");
	$stmt->execute(array($cid));
	$rows = $stmt->fetch();
	$count = $stmt->rowCount();
	return $count;
}
function ServicePerCity($cid){
	global $con;
	$stmt = $con->prepare("SELECT * from service where CtId = ?");
	$stmt->execute(array($cid));
	$rows = $stmt->fetch();
	$count = $stmt->rowCount();
	return $count;
}
function progressBar($id,$type,$allCount)
{   if ($allCount==0)
	$allCount=1;
	$progressBar=array(0,0,0,0,0);

	global $con;
	$stmt = $con->prepare("SELECT rate ,count(rate) as RateCount from rating where sid = ? and 
		PlaceType= ? group by rate");
	$stmt->execute(array($id,$type));
	$rows = $stmt->fetchAll();
	$count = $stmt->rowCount();
	foreach ($rows as $row) {
		# code...
		$progressBar[$row['rate']-1]=$row['RateCount'];
	}

	
	echo '
	<div class="progressBar animated fadeInDown">
	'.$progressBar[0].' Poor<div class="progress">
		  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" 	style="width:'.(($progressBar[0]/$allCount)*100).'%">
		    <span class="sr-only">60% Complete (warning)</span>
		  </div>
	</div>
	'.$progressBar[1].' Fair<div class="progress">
		  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:'.(($progressBar[1]/$allCount)*100).'%">
		    <span class="sr-only">80% Complete (danger)</span>
		  </div>
	</div>
	'.$progressBar[2].' Good<div class="progress">
		  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:'.(($progressBar[2]/$allCount)*100).'%">
		    <span class="sr-only">40% Complete (success)</span>
		  </div>
	</div>
		'.$progressBar[3].' VeryGood<div class="progress">
		  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:'.(($progressBar[3]/$allCount)*100).'%">
		    <span class="sr-only">20% Complete</span>
		  </div>
	</div>
	'.$progressBar[4].' Excellent<div class="progress">
		  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:'.(($progressBar[4]/$allCount)*100).'%">

		    <span class="sr-only">80% Complete (danger)</span>
		  </div>
	</div>
</div>';
}
function relatedServiceCity($place)
{
	global $con;
	$stmt = $con->prepare("SELECT PCity from place where pid = ?");
	$stmt->execute(array($place));
	$row = $stmt->fetch();
	return $row['PCity'];

}

function relatedService($place)
{	$id=relatedServiceCity($place);
	global $con;
	$stmt = $con->prepare("SELECT * from service where CtId = ? limit 12");
	$stmt->execute(array($id));
	$rows = $stmt->fetchAll();
	$count = $stmt ->rowCount();
	if($count > 0)
	{
			 
		   
			   echo '
				<section class="relatedServ">
				<div class="container">
					<div class="row">
					<h2 class="relatedSer text-center"> Related Services </h2>

					';
					foreach( $rows as $row){
				echo '<div class="col-lg-4">	
				       <div class="searchminiresult">
					              <div class="media">
					                <div class="media-left">
							                  <a href="display.php?id='.$row['sid'].'">
							                    <img class="media-object" src="' . getCoverImage($row["photo"]) . '" alt="">
							                  </a>
					               	 </div>
					                  <div class="media-body">
					                  <a href="display.php?id='.$row['sid'].'"><h4 class="media-heading">' . $row["sName"]. '</h4></a>
					                       	<span>'.getServiceCatName($row['Cat_id']).'</span>
					                  </div>
					              </div>
					    </div>
					    </div>';
					}
		 		echo '	 </div> </div> </section>';
	}


}