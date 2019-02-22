<?php
session_start();
if(isset($_SESSION["username"])==FALSE) {
	header('Location: index.php');
}else{
  	include("./dbconnect.php");
	ob_implicit_flush(true);
	$result=mysqli_query($conn,"SELECT * FROM card WHERE id=".$_SESSION["id"]);
	$row=mysqli_fetch_array($result);
	$card=json_decode($row["card"],true);
	if($_SESSION["id"]==1){
		echo "<form action=\"shuffle.php\" method=\"get\">";
		echo "</tr></table><input type=\"submit\" name=\"formSubmit\" value=\"洗牌\" />";
		echo "</form>";
	}
	echo "<form action=\"sendcard.php\" method=\"post\">";
	echo "<table border=1><tr>";
	foreach ($card as $icon) {
		echo "<td>";
		$color=substr($icon,0,6);
		if($color==="菱型" || $color==="愛心"){
			echo "<font color=\"red\">";
		}
		if($color==="菱型"){
			$unicodeChar = '&diams;';
		}else if($color==="愛心"){
			$unicodeChar = '&hearts;';
		}else if($color==="黑桃"){
			$unicodeChar = '&spades;';
		}else if($color==="梅花"){
			$unicodeChar = '&clubs;';
		}
		echo json_decode('"'.$unicodeChar.'"');
		echo "<br>";
		echo $icon[6];
    		echo $icon[7];
		echo "</td>";
	}
	echo "</tr><tr>";
	foreach ($card as $icon) {
                echo "<td>";
                echo "<input type=\"checkbox\" name=\"";
		echo $icon;
		echo " value=\"No\" />";
                echo "</td>";
        }
	echo "</tr></table><input type=\"submit\" name=\"formSubmit\" value=\"出牌\" />";
	echo "</form>";
	mysqli_close($conn);
}
?>

<iframe src="./desk.php"></iframe>
