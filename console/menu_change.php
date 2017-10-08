<form action="menu_changer.php" method="post">

<!-- 表生成開始 -->
<table border>
<tr><td>商品ID</td><td>商品名</td><td>価格</td><td>曜日割引</td><td>割引価格</td><td>削除</td><td></td></tr>";

<?php
require("../connect_db.php");
$week = array("日", "月", "火", "水", "木", "金", "土","なし");
$query = mysqli_query($link,'SELECT id,name,value,dis_day,dis_value FROM products');
$count = 0;

while ($row = mysqli_fetch_assoc($query)){
  $count ++;

  echo "<tr>";
  echo "<td>",$count,"</td>"; //商品ID
  echo "<td>",$row["name"],"</td>"; //商品名
  echo "<td>",$row["value"],"</td>"; //価格
  echo "<td>",$week[$row["dis_day"]],"</td>"; //割引曜日 $week→day.php
  echo "<td>",$row["dis_value"],"</td>";
  echo "<td><input type='submit' name='del$count' value='$count&shy削除'</td>";
  echo "<td><input type='checkbox' name='edit' value='".$count."'></td>"; //checkbox
  echo "</tr>";
}
  echo "商品数 $count"; //商品数
  echo "</table>";
?>
<!-- 表ここまで -->

<input type="submit" name="button1" value="送信する">

</form>
