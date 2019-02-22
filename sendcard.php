<?php
session_start();
if(isset($_SESSION["username"])==FALSE) {
	header('Location: index.php');
}else{
  	include("./dbconnect.php");
	for($x = 4; $x >= 1; $x--){
		$result=mysqli_query($conn,"SELECT * FROM desk WHERE id=".$x);
		$row=mysqli_fetch_array($result);
		//echo $row["card"];
		mysqli_query($conn,"UPDATE desk SET card='".$row["card"]."' WHERE id=".($x+1)) or die(mysqli_error($conn));
		mysqli_query($conn,"UPDATE desk SET user='".$row["user"]."' WHERE id=".($x+1)) or die(mysqli_error($conn));
	}
	$result=mysqli_query($conn,"SELECT * FROM card WHERE id=".$_SESSION["id"]);
	$row=mysqli_fetch_array($result);
	$card=json_decode($row["card"],true);
	$send_card=array();
	$left_card=array();
        foreach ($card as $key1 => $value1){
		$chk=1;
              	foreach ($_POST as $key => $value){
	                $match=substr($key,0,8);
	                if($match[7]==='_'){
        	                $match=substr($match, 0, -1);
               		}
                	if($value1===$match){
                        	echo $match;
                        	array_push($send_card,$value1);
				$chk=0;
                	}
		}
		if($chk===1){
			array_push($left_card,$value1);
		}
        }
	//echo var_dump($send_card).var_dump($left_card);
	$send_card=json_encode($send_card,JSON_UNESCAPED_UNICODE);
	$left_card=json_encode($left_card,JSON_UNESCAPED_UNICODE);
	mysqli_query($conn,"UPDATE card SET card='".$left_card."' WHERE id=".$_SESSION["id"]) or die(mysqli_error($conn));
	mysqli_query($conn,"UPDATE desk SET card='".$send_card."' WHERE id=1") or die(mysqli_error($conn));
	mysqli_query($conn,"UPDATE desk SET user='".$_SESSION["username"]."' WHERE id=1") or die(mysqli_error($conn));
	mysqli_close($conn);
	header('Location: play.php');
}
?>
