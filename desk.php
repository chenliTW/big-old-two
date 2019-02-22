<meta http-equiv="refresh" content="1" />
<?php
	include("./dbconnect.php");
	$result=mysqli_query($conn,"SELECT * FROM card WHERE id=1");
	$row=mysqli_fetch_array($result);
	echo "lee剩".count(json_decode($row["card"],true))."張;";
	$result=mysqli_query($conn,"SELECT * FROM card WHERE id=2");
	$row=mysqli_fetch_array($result);
	echo "ben剩".count(json_decode($row["card"],true))."張;";
	echo "<h4>桌面狀況:</h4>";
	for($x=1;$x<6;$x++){
	$result=mysqli_query($conn,"SELECT * FROM desk WHERE id=".$x);
        $row=mysqli_fetch_array($result);
        $card=json_decode($row["card"],true);
	echo "出牌者：".$row["user"];
        echo "<br><table border=1><tr>";
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
        echo "</tr></table>";
	}
        mysqli_close($conn);
?>
