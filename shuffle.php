<?php

function cmp($a, $b) {
	if(strlen($a)==7){
		if($a[6]=='J'){
			$numa=11;
		}else if($a[6]=='Q'){
			$numa=12;
		}else if($a[6]=='K'){
			$numa=13;
		}else if($a[6]=='A'){
			$numa=1;
		}else{
			$numa=$a[6];
		}
	}else{
		$numa=10;
	}
        if(strlen($b)==7){
		if($b[6]=='J'){
                        $numb=11;
                }else if($b[6]=='Q'){
                        $numb=12;
                }else if($b[6]=='K'){
                        $numb=13;
                }else if($b[6]=='A'){
                        $numb=1;
                }else{
                        $numb=$b[6];
                }
        }else{
                $numb=10;
        }
	if($numa>$numb){
		return 1;
	}else{
		return 0;
	}
}

session_start();
if(isset($_SESSION["username"])==FALSE||$_SESSION["id"]!="1") {
	header('Location: play.php');
}else{
  	include("./dbconnect.php");
	$card_color=array("黑桃","愛心","菱型","梅花");
	foreach($card_color as $color => $icon){
		for($i=1;$i<=13;$i++){
			if($i==1){
				$num="A";
			}else if($i==11){
				$num="J";
			}else if($i==12){
				$num="Q";
			}else if($i==13){
				$num="K";
			}else{
				$num=$i;
			}
			$card[$color.$i]="{$icon}{$num}";
		}
	}
	srand(time());
	shuffle($card);
	$card=array_chunk($card,26);
	uasort($card[0], 'cmp');
	uasort($card[1], 'cmp');
	print_r($card);
	$player1=json_encode($card[0],JSON_UNESCAPED_UNICODE);
	$player2=json_encode($card[1],JSON_UNESCAPED_UNICODE);
	for($i=1;$i<=5;$i++){
	mysqli_query($conn,"UPDATE desk SET card='".json_encode(array(),JSON_UNESCAPED_UNICODE)."' WHERE id=".$i) or die(mysqli_error($conn));
	mysqli_query($conn,"UPDATE desk SET user='".json_encode(array(),JSON_UNESCAPED_UNICODE)."' WHERE id=".$i) or die(mysqli_error($conn));
	}
	mysqli_query($conn,"UPDATE card SET card='".$player1."' WHERE id=1") or die(mysqli_error($conn));
	mysqli_query($conn,"UPDATE card SET card='".$player2."' WHERE id=2") or die(mysqli_error($conn));
	mysqli_close($conn);
	header('Location: play.php');
}
?>
