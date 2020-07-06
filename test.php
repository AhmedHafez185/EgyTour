<?php
  session_start();
  $pageTitle = "Test";
  include 'init.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
  	if(!empty($_POST['check_list'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list'] as $selected)
		{
			echo $selected."</br>";
		}
	}
	else
	{
		$errors[] = 'you should select one of Whats Do You Like';
	}
	if(!empty($_POST['check_list2'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list2'] as $selected)
		{
			echo $selected."</br>";
		}
	}
	else
	{
		$errors[] = 'you should select  your Favorite Places';
	}
	if(!empty($_POST['check_list3'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list3'] as $selected)
		{
			echo $selected."</br>";
		}
	}
	else
	{
		$errors[] = 'you should select  one of Which One You Prefere';
	}
	if(!empty($_POST['check_list4'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list4'] as $selected)
		{
			echo $selected."</br>";
		}
	}
	else
	{
		$errors[] = 'you should select your religious';
	}
	if(!empty($_POST['check_list5'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list5'] as $selected)
		{
			echo $selected."</br>";
		}
	}
	else
	{
		$errors[] = 'you should select your Job';
	}

	if(!empty($_POST['check_list6'])){
		// Loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list6'] as $selected)
		{
			echo $selected."</br>";
		}
	}
	else
	{
		$errors[] = 'you should select your Relationship type';
	}


	if (!empty($errors)) {
		foreach ($errors as $value) {
			echo "<div class='alert alert-danger'>". $value  . "</div>";
		}
	}
	else
	{

	}
	

}
else
{

?>
<form  action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
	<div class="Personal">
		<div class="container">
			<div class="row">
				<h3>You Should answer these questions to complete registeration</h3>
				<p><span>*</span>What's  you like</p>
					<input type="checkbox" name="check_list[]" value="Relaxing" />Relaxing<br/>
					<input type="checkbox" name="check_list[]" value="Diving" />Diving<br />
					<input type="checkbox" name="check_list[]" value="Walking" />Walking<br />
					<input type="checkbox" name="check_list[]" value="Advanture" />Advanture<br />

				<p><span>*</span>whats your favorite type of places</p>
					<input type="checkbox" name="check_list2[]" value="Entertainment" />Entertainment<br />
					<input type="checkbox" name="check_list2[]" value="Natural" />Natural<br />
					<input type="checkbox" name="check_list2[]" value="Historic" />Historic<br />
				<p><span>*</span>which one you prefere </p>
					<input type="checkbox" name="check_list3[]" value="Culture" />Culture<br />
					<input type="checkbox" name="check_list3[]" value="History" />History<br />
					<input type="checkbox" name="check_list3[]" value="Science" />Science<br />
				<p><span>*</span>whats your religious </p>
					<input type="checkbox" name="check_list4[]" value="Muslium" />Muslium<br />
					<input type="checkbox" name="check_list4[]" value="christian" />christian<br />
					<input type="checkbox" name="check_list4[]" value="Others" />Others<br />
				<p><span>*</span>whats your job </p>
					<input type="checkbox" name="check_list5[]" value="Engineer" />Engineer<br/>
					<input type="checkbox" name="check_list5[]" value="Officer" />Officer<br />
					<input type="checkbox" name="check_list5[]" value="Doplomatic" />Doplomatic<br/>
					<input type="checkbox" name="check_list5[]" value="Doctor" />Doctor<br/>
					<input type="checkbox" name="check_list5[]" value="Teacher" />Teacher<br/>
					<input type="checkbox" name="check_list5[]" value="Artist" />Artist<br/>
					<input type="checkbox" name="check_list5[]" value="Other" />Other<br/>


				<p><span>*</span>Relationship</p>
					<input type="checkbox" name="check_list6[]" value="Single" />Single<br/>
					<input type="checkbox" name="check_list6[]" value="Married" />Married<br/>
					<input type="checkbox" name="check_list6[]" value="Married with sons" />Married with sons<br />
					<input  class="btn btn-primary btn-block" type="submit" value="submit"/>

			</div>
		</div>
	</div>
</form>
<?php
}
?>