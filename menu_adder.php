<?php
$product = $_POST['product'];
$value = $_POST['value'];
$discount = $_POST['discount'];
$dis_value = $_POST['dis_value'];
$after_discount = $value - $dis_value;

require("connect_sql.php");

$week = array("日", "月", "火", "水", "木", "金", "土");

if(!$discount == 7 || $dis_value == ""){  //もし$discountが"7"でないなら
			echo "いくら割引するか書いてください。";
	}else{
		$sql = mysqli_query($link,"INSERT INTO products (name,value,discount,dis_value) VALUES ('$product','$value','$discount','$dis_value')");
		if(!$sql){
			echo "データベース登録の際にエラー";
		}else{
			echo "$product を価格$value 円で登録しました";
			echo "</br>";
			if($discount == 7){
				echo "割引曜日は設定されていません。";
			}else{
				echo "$week[$discount]曜日に$dis_value 円割引します。</br>割引後の価格は$after_discount 円です。";
			}
		}
	}
