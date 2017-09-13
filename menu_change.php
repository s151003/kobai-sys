<?php
require("connect_sql.php");
require("day.php");

$query = mysqli_query($link,'SELECT id,name,value,discount,dis_value FROM products');


echo "<table border>";

// 表の一番上
echo "<tr><td>商品ID</td><td>商品名</td><td>価格</td><td>曜日割引</td><td>割引価格</td><td></td></tr>";

$count = 0;
while ($row = mysqli_fetch_assoc($query)){
  $count ++;
  $discount = $row["discount"];

  echo "<tr>";
  echo "<td>　",$row["id"],"　</td>"; //商品ID
  echo "<td>",$row["name"],"</td>"; //商品名
  echo "<td>",$row["value"],"</td>"; //価格
  echo "<td>",$week[$discount],"</td>"; //割引曜日 $week→day.php
  echo "<td>",$row["dis_value"],"</td>";
  echo "<td><input type='checkbox' name='del' value='".$count."'></td>"; //checkbox
  echo "</tr>";
}

echo "</table>";
echo "商品数 $count"; //商品数
?>