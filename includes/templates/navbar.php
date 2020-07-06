
  <!-- Start Nav Bar -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <!-- Start Container -->
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#Mynavbar" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">EgyTour</a>
    </div>
    <!-- End Brand and toggle get grouped for better mobile display -->
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="Mynavbar">
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php 
          $sql="SELECT * from tourismcategory";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $rows = $stmt->fetchAll();
          foreach ($rows as $row) {
            # code...
          echo '<li><a href="category.php?type=' . $row['tourCatName'] . '">' . $row["tourCatName"] . '</a></li>';
          }
          ?>
          </ul>
        </li>
              <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Where to go <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php 
          $sql="SELECT * from city";
          $stmt = $con->prepare($sql);
          $stmt->execute();
          $rows = $stmt->fetchAll();
          foreach ($rows as $row) {
            # code...
          echo '<li><a href="cities.php?id='.$row['cityId'].'">' . $row["cityName"] . '</a></li>';
          }
          ?>
          </ul>
        </li>
       <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Services <span class="caret"></span></a>
          <ul class="dropdown-menu">
         <?php 
            $sql="SELECT * from servicecategory";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach ($rows as $row) {
            # code...
            if ($row['Name']=='Transport')
                  echo '<li><a href="Transport.php?id='.$row['Cid'].'">' . $row["Name"] . '</a></li>';
                else
                  echo '<li><a href="Service.php?id='.$row['Cid'].'">' . $row["Name"] . '</a></li>';
          }
          ?>
          </ul>
        </li>
      <!-- Activities Menu -->
        <li class="dropdown">
           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">What to do <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="activity.php?act=Diving">Diving</a></li>
            <li><a href="activity.php?act=Safari">Safari</a></li>
            <li><a href="activity.php?act=Walking">Walking</a></li>
            <li><a href="activity.php?act=Sand Boarding">Sand Boarding</a></li>
          </ul>
        </li>
     <!-- Places  Menu
    <li><a href="about.php">About Egypt</a></li>
     -->
    <li><a href="Events.php">Events</a></li>
    <li><a href="plan.php">Plan Trip</a></li>
    <!-- Account button -->
  <li>
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?php
   if(isset($_SESSION['username']))
      {
        echo $_SESSION['username']; 
      }
      else{
        echo 'Acount';
      }
  ?>
     <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
  <?php
    if(isset($_SESSION['username']))
            {
              echo '<li><a href="logout.php">Logout</a></li>';
              echo '<li><a href="profile.php">My Profile</a></li>';

            }
            else
            {
            echo '<li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>';
            }
            ?>
  </ul>
  <div class="userImage">
  <?php
    if(isset($_SESSION['username']))
            {
              $sql="SELECT * from users where username = ?";
              $stmt = $con->prepare($sql);
              $stmt->execute(array($_SESSION['username']));
              $rows = $stmt->fetch();
              if($rows['image']=="")
               
                echo ' <a href="#"><img src="'.$images.'users/default.png" alt="..." class="img-rounded"></a>';
              else
               echo ' <a href="#"><img src="'.$images.'users/'.$rows['image'].'" alt="..." class="img-rounded"></a>';

            }
            
  ?>
</div>
</div></li>
      </ul>
    <!--  Searching Text Form -->
    
      <form class="navbar-form navbar-left" role="search" action="search.php" method="POST">
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="search" autocomplete="off" required="required">
               </div>
      </form>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
  <!-- End Nav Bar -->