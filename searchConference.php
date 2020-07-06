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
 <section class="tab-u">
        <div class="container">
        <div class="row">
            <ul class="nav nav-tabs" >
                    <a href="search.php?id='.$_SESSION['keyword'].'"><li role="presentation">Top</li></a>
                    <a href="searchServices.php?id='.$_SESSION['keyword'].'"><li role="presentation">Services</li></a>
                    <a href="searchActivity.php?id='.$_SESSION['keyword'].'"><li role="presentation">Activity</li></a>
                    <a href="searchPlaces.php?id='.$_SESSION['keyword'].'"><li role="presentation">Tourism Places</li></a>
                    <a href="searchConference.php?id='.$_SESSION['keyword'].'"><li role="presentation" class="ACT">Conference</li></a> 
            </ul>  
        </div>    
        </div>
    </section> ';
?>
      <!-- Start Tabs --> 
    <!-- End Tabs -->
    <!-- Start Searching Results -->
<?php
  $keySearch = $_SESSION['keyword'];
  $pag = "";
  if ($keySearch != "")
  { $perPages = 12;
    $stmt = $con->prepare("SELECT count(aid) as ResultCount from events  where eName like '%$keySearch%'");
    $stmt->execute();
    $rows = $stmt->fetch();
    $count = $rows['ResultCount'];
    $pages = ceil($count / $perPages);
     if(isset($_GET['page']))
    {
      $pag = $_GET['page'];
    }
    else
    {
      $pag =1;
    }
    $Start = (($pag - 1)*$perPages);
    $stmt2 = $con->prepare("SELECT * from events  where eName like '%$keySearch%' limit $Start,$perPages");
    $stmt2->execute();
    $rows2 = $stmt2->fetchAll();
    $count2 = $stmt2->rowCount();

     if($count2 > 0)
     {     echo '<section class="results">
          <div class="container">
          <div class="row">
          <div class="numberOfResult"><p>Showing '.$count.' Results for ' . $keySearch . ' - Page 1 of ' . $pages . '</p></div> ';
          if($count  > 12){
            echo ' <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <li>
                        <a href="#" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>';
                      for($page=1;$page <= $pages;$page++)
                      {
                        echo '<li><a href="searchActivity.php?id='.$_SESSION['keyword'].'&page='.$page .'">'.$page.'</a></li>';
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
              foreach ($rows2 as $row2) {
                   echo ' <div class="media col-lg-8 col-md-4">
                                <div class="media-left">
                                  <img class="media-object" src="' . $images . $row2["photo"] . '" alt="Item-seach">
                                </div>
                                <div class="media-body">
                                  <a href="#">
                                    <h4 class="media-heading">'. $row2["eName"] . '</h4>                       
                                  </a>
                                </div>
                          </div>';
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