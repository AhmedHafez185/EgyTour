<?php
$pageTitle = "Home";
 ?>
 <div class="header">
  <div class="container">
    <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav">
      <?php 
            $Total = 0;
            if(isset($_SESSION['name']))
            {
              echo '<li><a href="logout.php">Logout</a></li>';
            }
            else
            {
            echo '<li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>';
            }
      echo ' </ul>';
 echo '<div class="cartIcon">
      <ul>
      <a href="Card.php"><li><i class="fa fa-shopping-cart card" aria-hidden="true"></i></li></a>';
       if(!empty($_SESSION['name'])) {
     $stmt = $conn->prepare("select countity from cart where uid=?");//select count(ID),SUM(Price) from cart
     $stmt->execute(array(myfun($_SESSION['name'])));
     $rows=$stmt->fetchAll();
     foreach ($rows as $row) {
       $Total+=$row['countity'];
     }   
          echo ' <p class="CardItem">'.$Total.'</p></ul></div>';
            }
            else
            {
              echo ' <p class="CardItem">0</p></ul></div>';
            }
            ?>
     

     


  </div>
  </div>