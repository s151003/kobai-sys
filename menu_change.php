<?php
require("connect_sql.php");

$query = mysqli_query($link,'SELECT id,name,value,discount,dis_value FROM products');
echo "<table border>";
$count = 0;
while ($row = mysqli_fetch_assoc($query)){
  $count ++;
  echo "<tr>";
  echo "<td>　",$row["id"],"　</td>"; //商品IDを表示
  echo "<td>",$row["name"],"</td>"; //商品名を表示
  echo "<td><input type='checkbox' name='del' value='".$count."'></td>"; //checkbox
  echo "</tr>";
}
echo "</table>";
echo "商品数 $count";　//商品数
?>
