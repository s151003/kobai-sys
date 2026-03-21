<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
$product = $_POST['product'];
$value = $_POST['value'];
$discount = $_POST['discount'];
@$dis_value = $_POST['dis_value'];
$category = $_POST['category'];
$day_limit = $_POST['day_limit'];
$comment = $_POST['comment'];

$after_discount = $value - $dis_value;

require("../connect_db.php");
output("メニュー追加フォーム");

$week = array("日", "月", "火", "水", "木", "金", "土");
echo "<div class=\"container\">";
if(!$discount == 7 && $dis_value == ""){
			//$discountが"7"でないかつ、$dis_valueが空欄だった場合（7の場合は割引なしなので記入不要）
			echo "いくら割引するか書いてください。";
	}else{
		$stmt = mysqli_prepare($link, "INSERT INTO products (name,value,dis_day,dis_value,day_limit,category,comment) VALUES (?,?,?,?,?,?,?)");
		mysqli_stmt_bind_param($stmt, "siiiiss", $product, $value, $discount, $dis_value, $day_limit, $category, $comment);
		$result = mysqli_stmt_execute($stmt);
		if(!$result){
			echo "<div class=\"alert alert-danger\"><strong>Errormessage: ", mysqli_error($link),"</strong><br>";
			echo "データベース登録の際にエラーがおきました。</div><br>";
		}else{
			$product_escaped = htmlspecialchars($product, ENT_QUOTES, 'UTF-8');
			$value_escaped = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
			$dis_value_escaped = htmlspecialchars($dis_value, ENT_QUOTES, 'UTF-8');
			$after_discount_escaped = htmlspecialchars($after_discount, ENT_QUOTES, 'UTF-8');
			echo "<div class=\"alert alert-success\">商品名<b>「{$product_escaped}&shy;」</b>を価格<b>{$value_escaped}&shy;円</b>で登録しました";
			echo "<br>";
			if($discount == 7){
				echo "<b>割引曜日は設定されていません。</b></div>";
			}else{
				echo "<b>{$week[$discount]}曜日</b>に<b>{$dis_value_escaped}&shy;円</b>割引します。<br>割引後の価格は<b>{$after_discount_escaped} 円</b>です。</div>";
			}
		}
	}
echo "</div>";
