<?php 
session_start();
include 'conf.php';
include 'includes/functions/function.php';
if(isset($_GET['req']) && $_GET['req']=='addComment')
{
		
		$comment = $_GET['comm'];
		$sid = $_GET['sid'];
		$type=$_GET['PlaceType'];
		$uid = userID($_SESSION['username']);
		$stmt = $con->prepare("insert into comments(comment,userid,serviceId,PlaceType,RegDate) values(?,?,?,?,now())");
		$stmt->execute(array($comment,$uid,$sid,$type));
		$stmt2 = $con->prepare("select * from users where Username = ?");
		$stmt2->execute(array($_SESSION['username']));
		$rows=$stmt2->fetch();
    if($rows['image']=='')
		echo $_SESSION['username'] .'#data/uploaded/users/default.png';
	else
		echo $_SESSION['username'] .'#data/uploaded/users/'.$rows['image'];
}
if(isset($_GET['req']) && $_GET['req']=='removeComment')
{
	$stmt = $con->prepare("delete  from comments where cid =?");
	$stmt->execute(array($_GET['cid']));
	header ("Location:".$_GET['page']."");

}
	
?>