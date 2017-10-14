<form action="menu_changer.php" method="post">
<?php
require("../head.php");
output("メニュー管理ページ");
 ?>
<!-- 表生成開始 -->
<div class="container">
<table class="table">
<tr><td>#</td><td>商品名</td><td>価格</td><td>曜日割引</td><td>割引価格</td><td>削除</td><td></td><td>予約受付数</td><td>販売受付</td></tr>

<?php
session_start();
require("../connect_db.php");
$week = array("日", "月", "火", "水", "木", "金", "土","なし");
$query = mysqli_query($link,'SELECT id,name,value,dis_day,dis_value,day_limit FROM products');
$count = 0;

while ($row = mysqli_fetch_assoc($query)){
  $count ++;

  echo "<tr>";
  echo "<td>",$count,"</td>"; //商品ID
  echo "<td>",$row["name"],"</td>"; //商品名
  echo "<td>",$row["value"],"</td>"; //価格
  echo "<td>",$week[$row["dis_day"]],"</td>"; //割引曜日
  echo "<td>",$row["dis_value"],"</td>";
  echo "<td><button class=\"btn btn-default\" type='submit' name='del' value='",$row["id"],"'>削除</button></td>";
  echo "<td><input type='checkbox' name='edit' value='".$count."'></td>"; //checkbox
  echo "<td>",$row["day_limit"],"</td>";
  echo "<td>予約</td>";
  echo "</tr>";
}
  echo "<h4>商品数 $count</h4><hr>";
  echo "</table>";
 //商品数
?>
<!-- 表ここまで -->
</br></br>
<input class="btn btn-default" type="submit" value="送信ボタン">
</form>
</div>
