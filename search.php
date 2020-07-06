    <?php
  session_start();
  $pageTitle = "Search";
  include 'init.php';
  
    if($_SERVER['REQUEST_METHOD']=='POST'){
      $_SESSION['keyword']=$_POST['search'];
    }elseif(isset($_GET['id']))
    {
      $_SESSION['keyword']=$_GET['id'];
    }
    else{
     $_SESSION['keyword']=""; 
    }
$do =isset($_GET['Type'])?$_GET['Type'] : 'Top';
echo'
       <div id="port" class="our-project">
        <div class="container">
          <div class="row">
            <ul>
                    <a href="search.php?id='.$_SESSION['keyword'].'"><li role="presentation" class="ACT">Top</li></a>
                    <a href="searchServices.php?id='.$_SESSION['keyword'].'"><li role="presentation" >Services</li></a>
                    <a href="searchActivity.php?id='.$_SESSION['keyword'].'"><li role="presentation">Activity</li></a>
                    <a href="searchPlaces.php?id='.$_SESSION['keyword'].'"><li role="presentation">Tourism Places</li></a>
            </ul>
          </div>
        </div>
      </div> ';
?>

      <!-- Start Tabs --> 
    <!-- End Tabs -->
    <!-- Start Searching Results -->
<?php
    $keySearch = $_SESSION['keyword'];
  if ($keySearch != "")
  {
    $stmt = $con->prepare("SELECT * from place where PName like '%$keySearch%' limit 5");
    $stmt->execute(array());
    $rows = $stmt->fetchAll();
    $count = $stmt->rowCount();


    $stmt1 = $con->prepare("SELECT * from service where sName like '%$keySearch%' limit 4 ");
    $stmt1->execute(array());
    $rows1 = $stmt1->fetchAll();
    $count1 = $stmt1->rowCount();


    $stmt2 = $con->prepare("SELECT * from activity where aName like '%$keySearch%' limit 4");
    $stmt2->execute(array());
    $rows2 = $stmt2->fetchAll();
    $count2 = $stmt2->rowCount();

     $sum = $count + $count1+$count2;
     $perPages = 13;
     $pages = ceil($sum / $perPages);
     if($sum > 0)
     { 
       echo '
       <section class="results">
                <div class="container">
                 <div class="row">
                 <div class="numberOfResult"><p>Showing '.$sum.' Results for "' . $keySearch . '" - Page 1 of ' . $pages . '</p></div> ';
        if($count > 0)
           {
            foreach ($rows as $row) {
                   echo ' <div class="media col-lg-8 col-md-4">
                                <div class="media-left">
                                  <img class="media-object" src="' . getCoverImage($row["photo"]) . '" alt="Item-seach">
                                </div>
                                <div class="media-body">
                                  <a href="displayPlace.php?id='.$row["pid"].'">
                                    <h4 class="media-heading">'. $row["PName"] . '</h4>                       
                                  </a>
                                  <p class="resultCat">'.getPlaceType($row["pid"]).' Place</p>
                                  <p class="resultCat">'.getCity($row["PCity"]).'</p>
                                </div>
                          </div>';
            }
        }
        if($count1 > 0)
        {
            foreach ($rows1 as $row1) {
                   echo ' <div class="media col-lg-8 col-md-4">
                                <div class="media-left">
                                  <img class="media-object" src="' . getCoverImage($row1["photo"]) . '" alt="Item-seach">
                                </div>
                                <div class="media-body">
                                  <a href="display.php?id='.$row1["sid"].'">
                                    <h4 class="media-heading">'. $row1["sName"] . '</h4>                       
                                  </a>
                                  <p class="resultCat">'.getServiceCatName($row1["Cat_id"]).'</p>
                                  <p class="resultCat">'.getCity($row1["CtId"]).'</p>
                                </div>
                                
                          </div>';
             }
        }
        if($count2 > 0)
        {
           foreach ($rows2 as $row2) {
                   echo ' <div class="media col-lg-8 col-md-4">
                                <div class="media-left">
                                  <img class="media-object" src="' . getCoverImage($row2["photo"]) . '" alt="Item-seach">
                                </div>
                                <div class="media-body">
                                  <a href="displayActivity.php?id='.$row2["aid"].'">
                                    <h4 class="media-heading">'. $row2["aName"] . '</h4>                       
                                  </a>
                                   <p class="resultCat">'.$row2["Type"].'</p>
                                  <p class="resultCat">'.getCity($row2["city"]).'</p>
                                </div>
                          </div>';
            }
        }

          echo '</div></div></section>';
      }
      else
      {
        echo '<section class="NoResult">
                  <div class="container">
                      <div class="row">
                          <P>Sorry !!, No Result Matching ,<br>Try again.</P>
                      </div>
                  </div></section>' ;
      } 
}
else
{
       echo '<section class="NoResult">
                  <div class="container">
                      <div class="row">
                          <P>you should type the keyword for searching.</P>
                      </div>
                  </div></section>' ;
      
      //header('refresh:index.php');
}

?>

<?php include $tpl . 'footer.php'; ?>