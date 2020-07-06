<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="place.php">Places</a></li>
        <li><a href="service.php">Services</a></li>
        <li><a href="members.php">Members</a></li>
        <li><a href="comments.php">User Feedback</a></li>
        <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> More </a>
               <ul class="dropdown-menu">
                    <li><a href="tourismCategory.php">Tourism Categories</a></li>
                    <li><a href="historicalEra.php">Historical Era</a></li>
                    <li><a href="cities.php">City</a></li>
                    <li><a href="#">Activities</a></li>
                    <li><a href="#">conferences</a></li>
                    <li><a href="plans.php">Plans</a></li>
                    <li><a href="#">User Invitation</a></li>
                    <li><a href="#">Virtualization Video</a></li>
              </ul>
        </li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php  

      if(isset($_SESSION['username']))
      {
        echo $_SESSION['username']; 
      }
      else{
        echo 'Acount';
      }?>
       <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="members.php?do=edit&uid=<?php echo $_SESSION['id'] ?>">Edit profile</a></li>
            <li><a href="#">My Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
