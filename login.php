<?php
header('Content-type: text/html; charset=utf-8');

include("./dbconnect.php");

$result=mysqli_query($conn,"SELECT * FROM member");

while($row=mysqli_fetch_array($result)){
	if($row["username"]==$_POST["user"] && $row["password"]===md5($_POST["pass"])){
		session_start();
		$_SESSION["username"]=$row["username"];
		$_SESSION["id"]=$row["id"];
		header('Location: play.php');
		die();
	}
}

mysqli_close($conn);

header('Location: index.php');

?>
