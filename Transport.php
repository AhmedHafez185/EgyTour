<?php 
session_start();
$pageTitle = 'Transport';
include "init.php"; 
$_SESSION['from']='';
$_SESSION['to']='';

if($_SERVER['REQUEST_METHOD']=='POST'){
  $fromCity =$_POST['FromCity'];
  $toCity =$_POST['ToCity'];
  $_SESSION['from']=getCity($fromCity);
  $_SESSION['to']=getCity($toCity);

?>
<form class="transport" method="POST" action="Transport.php">
  	<div class="container">
    		<h2> Transport  </h2>
      		<div class="row">	
      			<!--Start Select List Section -->
        			<div class="form-group">
                      <label class="select_city">From</label>
                      <select class="form-control" name="FromCity">
                            <?php
                             echo "<option value=0>All</option>";
                             getCityFrom("FromCity",$_SESSION['from']);
                             ?>
                      </select>
                      <button type="submit" class="btn btn-primary ShowButton">Show</button>	  
                  	  <label class="select_city labelTo">To</label>
                      <select class="form-control" name="ToCity">
                              <?php
                               echo "<option value=0>All</option>";
                               getCityFrom("ToCity",$_SESSION['to']);
                              ?>
                    </select>
               </div>
      		</div>
    	</div>
</form>
<?php 
  echo '<div class="container transportResult" > <p> The Way from ' . getCity($toCity) . ' To ' . getCity($fromCity) . "</p></div>";   
  $stmt = $con->prepare("SELECT * from Transport where FromCity=? and ToCity=?");
  $stmt->execute(array($fromCity,$toCity));
  $rows = $stmt->fetchAll();
  $count = $stmt ->rowCount();
  if($count > 0){
   echo '
   <section class="transportSection">
    <div class="container">
      <div class="row">
        <table class="table">
          <thead class="thead-inverse">
              <tr>
                <th>Type</th>
                <th>From</th>
                <th>To</th>
                <th>Time</th>
              </tr>
          </thead>
          <tbody>';
              foreach( $rows as $row){
              echo '<tr>
              <td>'.$row["Type"].'</td>
              <td>'.getCity($row["FromCity"]).'</td>
              <td>'.getCity($row["ToCity"]).'</td>
              <td>'.$row["Time"].' Hours</td>
              </tr>';
              }
         echo '</tbody></table></div></div></section>';
  }
      else
      { 
       noResult();
     }
}
else
{
  ?>
  <form class="transport" method="POST" action="Transport.php">
    <div class="container">
        <h2> Transport  </h2>
          <div class="row"> 
            <!--Start Select List Section -->
              <div class="form-group">  
                      <label class="selectLabel">Select Ways</label>  
                      <label class="select_city">From</label>
                      <select class="form-control" name="FromCity">
                            <?php
                             echo "<option value=0>All</option>";
                             getCityFrom("FromCity",$_SESSION['from']);
                             ?>
                      </select>
                      <button type="submit" class="btn btn-primary ShowButton">Show</button>    
                      <label class="select_city labelTo">To</label>
                      <select class="form-control" name="ToCity">
                              <?php
                               echo "<option value=0>All</option>";
                               getCityFrom("ToCity");
                              ?>
                    </select>
               </div>
          </div>
      </div>
</form>
  <?php
$stmt = $con->prepare("SELECT * from Transport ");
  $stmt->execute(array());
  $rows = $stmt->fetchAll();
  $count = $stmt ->rowCount();
  if($count > 0){
   echo '
   <section class="transportSection">
  <div class="container">
  <div class="row">
  <table class="table">
    <thead class="thead-inverse">
    <tr>
      <th>Type</th>
      <th>From</th>
      <th>To</th>
      <th>Time</th>
    </tr>
    </thead>
    <tbody>';
  foreach( $rows as $row){
            $stmt1 = $con->prepare("SELECT cityName from city where cityId = ?");
            $stmt1->execute(array($row["FromCity"]));
            $rows1 = $stmt1->fetch();
            $stmt2 = $con->prepare("SELECT cityName from city where cityId = ?");
            $stmt2->execute(array($row['ToCity']));
            $rows2 = $stmt2->fetch();
  echo '<tr>
      <td>'.$row["Type"].'</td>
      <td>'.$rows1["cityName"].'</td>
      <td>'.$rows2["cityName"].'</td>
      <td>'.$row["Time"].'Hours</td>
      </tr>';
  }
      echo '</tbody></table></div></div></section>';
}
}
?>
<?php include $tpl . 'footer.php'; ?>

