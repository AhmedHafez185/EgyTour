<?php 
session_start();
include 'conf.php';
 echo "string";

		$id = (int)$_GET['SID'];
		$type = $_GET['Type'];
		$rate = (int)$_GET['Rate'];
		$stmt = $con->prepare("insert into rating(rate,sid,PlaceType) values(?,?,?)");
		$stmt->execute(array($rate,$id, $type));
		$stmt2 = $con->prepare("SELECT sum(rate) as Rate  , count(id) as Num FROM rating WHERE sid = ? and PlaceType=? group by sid");
		$stmt2->execute(array($id,$type));
		$row2 = $stmt2->fetch();
		$count2 = $stmt2->rowCount();
		if($row2['Num'] > 0)
	  		if($row2['Rate']==0)
				$row2['votes']=1;
		 $cal = round(($row2['Rate']/$row2['Num']), 1);
				die(json_encode(array('average' => $cal, 'votes' => $row2['Num'])));
?>