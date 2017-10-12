<?php
  require("../connect_db.php");
  require("../head.php");
  output("予約履歴");

  $user_id="aki"; //dummy

  //
  $query = "SELECT id FROM `member` WHERE `user_id` = '$user_id'";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_assoc($result);
  $id = $row["id"];
  $status = array("受付","受け取り済み","a","問題");
  ?>

  <div class="container">
      <h1>あなたの予約履歴</h1>
      <hr>
  <table class="table">
  <tr><td>#</td><td>商品名</td><td>合計金額</td><td>あ</td><td>日付</td><td>状態</td><td></td></tr>
<?php
  $query = "SELECT * FROM `yoyaku` WHERE `user_id`= '$id'";
  $result = mysqli_query($link, $query);
  while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>",$row["id"],"</td>"; //予約ID
    echo "<td>products_name</td>"; //商品名
    echo "<td>kakaku</td>"; //価格
    echo "<td><button class=\"btn btn-default\" type='submit' name='del' value='",$row["id"],"'>削除</button></td>";
    echo "<td><input type='checkbox' name='edit' value='",$row["id"],"'></td>"; //checkbox
    echo "<td>1日 個数</td>";
    echo "<td>予約</td>";
    echo "</tr>";
  };
?>
  </table>
</div>
<?php

?>
