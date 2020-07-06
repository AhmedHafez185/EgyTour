<?php 
/*manage comments page 
**you can approve|edit |delete commente here
*/
ob_start();
session_start();
if(isset($_SESSION['username'])) //if user is already registered before at session
{
	$pageTitle="Comments";
	include "init.php";
	 $do=isset($_GET['do'])?$_GET['do']:"manage";
	 //start manage page
	 if($do=='manage')
	 {
		//manage memper page 
		//select all comments
		$stmt=$con->prepare("select comments.*,service.sName as SerName,users.username as userName
		                      from comments join users
							  on comments.userid=users.userId
							  join service 
							  on comments.serviceid=service.sid");
		$stmt->execute();
		$rows=$stmt->fetchAll();
		?>
		 <h1 class="text-center">User Feedbacks</h1>
		  <div class="container manage-comments">
		   <div class="table-responsive">
		    <table class="main-table table table-bordered text-center">
			 <tr>
			  <td>ID</td>
			  <td>Comment</td>
			  <td>Place Name</td>
			  <td>User name</td>
			  <td>Adding date</td>
			  <td style="width:6cm">Control</td>
			 </tr>
			 <?php 
			 foreach($rows as $row)
			 {
				 echo "<tr>";
				     echo "<td>".$row['cid']."</td>";
					 echo "<td class='comment'>".$row['comment']."</td>";
					 echo "<td>".$row['SerName']."</td>";
					 echo "<td>".$row['userName']."</td>";
					 echo "<td>".$row['RegDate']."</td>";
					 echo "<td>";
					  echo "<div class='buttons'>";
					   // echo "<a href='comments.php?do=edit&ID=".$row['ID']."' class='btn btn-success'><i class='fa fa-edit'></i> $edit</a> ";
						echo "<a class='btn btn-danger delete-btn' data-toggle='confirmation' href='comments.php?do=Delete&CId=". $row['cid'] ."'><i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a>";
			          echo "</div>";
					 echo "</td>";
				 echo "</tr>";
			 }
			 
			 ?>
			 
			</table>
		   </div>
		  </div>
		<?php
	 }
	 elseif ($do == 'Delete') {
				$CId =(isset($_GET['CId'])&&is_numeric($_GET['CId']))? intval($_GET['CId']): 0 ;
				$stmt = $con->prepare("select * from comments where cid =? ");
		 		$stmt->execute(array("$CId"));
		 		$row = $stmt->fetch();
		 		$count = $stmt->rowCount();
			 	if($count > 0){
			 		$stmt = $con->prepare("delete  from comments where cid =?");
			 		$stmt->execute(array($CId));
			 	}
				echo "<div class='container text-center'>
					<h2>Delete Member</h2>";
					
					redirectHome("<div class='alert alert-primary'>".$stmt->rowCount()." Tourism Era deleted Successfully</div>",'back');
				echo "</div>";
			}


		else{
			header("location:?do=manage");
		}


		include $tml . 'footer.php';
	}else{
		redirectHome("<div class'alert alert-danger'>You can't access this page!</div>");
	}

	
?>