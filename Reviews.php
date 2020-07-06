<?php
  session_start();
  $pageTitle = "Test";
  include 'init.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
  		$id = (int)$_POST['placeId'];
  		$type = $_POST['Sertype'];
  		$s1 = (int)$_POST['Star1'];
  		$s2 = (int)$_POST['Star2'];
  		$s3 = (int)$_POST['Star3'];
  		$s4 = (int)$_POST['Star4'];
  		$s5 = (int)$_POST['Star5'];
  		$c1 = $_POST['Comment1'];
  		$c2 = $_POST['Comment2'];
  		$c3 = $_POST['Comment3'];
  		$c4 = $_POST['Comment4'];
  		$c5 = $_POST['Comment5'];
  		$c6 = $_POST['Comment6'];
  		$user1=rand(1,6);
  		$user2=rand(1,6);
  		$user3=rand(1,6);
  		$user4=rand(1,6);
  		$user5=rand(1,6);
  		$user6=rand(1,6);
		for ($x = 0; $x < $s1; $x++) {
			$stmt = $con->prepare("insert into  rating(sid,rate,PlaceType) values(?,?,?)");
			$stmt->execute(array($id,1,$type));
		}
		for ($x = 0; $x < $s2; $x++) {
			$stmt = $con->prepare("insert into  rating(sid,rate,PlaceType) values(?,?,?)");
			$stmt->execute(array($id,2,$type));
		}
		for ($x = 0; $x < $s3; $x++) {
			$stmt = $con->prepare("insert into  rating(sid,rate,PlaceType) values(?,?,?)");
			$stmt->execute(array($id,3,$type));
		}
		for ($x = 0; $x < $s4; $x++) {
			$stmt = $con->prepare("insert into  rating(sid,rate,PlaceType) values(?,?,?)");
			$stmt->execute(array($id,4,$type));
		}
		for ($x = 0; $x < $s5; $x++) {
			$stmt = $con->prepare("insert into  rating(sid,rate,PlaceType) values(?,?,?)");
			$stmt->execute(array($id,5,$type));
		}
		$stmt1 = $con->prepare("insert into  comments(comment,userid,serviceId,PlaceType) values(?,?,?,?)");
		$stmt1->execute(array($c1,$user1,$id,$type));

		$stmt1 = $con->prepare("insert into  comments(comment,userid,serviceId,PlaceType) values(?,?,?,?)");
		$stmt1->execute(array($c2,$user2,$id,$type));

		$stmt1 = $con->prepare("insert into  comments(comment,userid,serviceId,PlaceType) values(?,?,?,?)");
		$stmt1->execute(array($c3,$user3,$id,$type));

		$stmt1 = $con->prepare("insert into  comments(comment,userid,serviceId,PlaceType) values(?,?,?,?)");
		$stmt1->execute(array($c1,$user4,$id,$type));

		$stmt1 = $con->prepare("insert into  comments(comment,userid,serviceId,PlaceType) values(?,?,?,?)");
		$stmt1->execute(array($c5,$user5,$id,$type));

		$stmt1 = $con->prepare("insert into  comments(comment,userid,serviceId,PlaceType) values(?,?,?,?)");
		$stmt1->execute(array($c6,$user6,$id,$type));

}
else
{

?>
<form  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
	<div class="Personal Reviews">
		<div class="container">
			<div class="row">
				<h3>You Should Enter All  Element</h3>
				<p><span>*</span>Place ID</p>
				<input class="form-control" type="text" name ="placeId" placeholder="placeId" autocomplete="off" required/>
				<p><span>*</span>Place Type (Service / Tourism place)</p>
					<div class="form-group">
								<select name="Sertype">
									<option value='Service'>Service</option>
									<option value='Place'>Place</option>
								</select>
						</div>
				<p><span>*</span>Rate </p>
				<p>1 Stars </p>				
				<input class="form-control" type="text" name ="Star1" placeholder="Number of starts" autocomplete="off" required/>
				<p>2 Stars </p>
				<input class="form-control" type="text" name ="Star2" placeholder="Number of starts" autocomplete="off" required/>
				<p>3 Stars </p>
				<input class="form-control" type="text" name ="Star3" placeholder="Number of starts" autocomplete="off" required/>
				<p>4 Stars </p>
				<input class="form-control" type="text" name ="Star4" placeholder="Number of starts" autocomplete="off" required/>
				<p>5 Stars </p>
				<input class="form-control" type="text" name ="Star5" placeholder="Number of starts" autocomplete="off" required/>
				<p><span>*</span>Comments </p>
				<textarea  class="form-control" type="textarea" name ="Comment1" placeholder="Number of starts" autocomplete="off" required>
				</textarea>
				<textarea  class="form-control" type="textarea" name ="Comment2" placeholder="Number of starts" autocomplete="off" required>
				</textarea>
				<textarea  class="form-control" type="textarea" name ="Comment3" placeholder="Number of starts" autocomplete="off" required>
				</textarea>
				<textarea  class="form-control" type="textarea" name ="Comment4" placeholder="Number of starts" autocomplete="off" required>
				</textarea>
				<textarea  class="form-control" type="textarea" name ="Comment5" placeholder="Number of starts" autocomplete="off" required>
				</textarea>
				<textarea  class="form-control" type="textarea" name ="Comment6" placeholder="Number of starts" autocomplete="off" required>
				</textarea>

				<input  class="btn btn-primary btn-block" type="submit" value="submit"/>
			</div>
		</div>
	</div>
</form>
<?php
}

?>