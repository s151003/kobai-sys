<?php
  require("../connect_db.php");
  require("../head.php");
  output("予約履歴");

  $user_id="aki"; //dummy

  $query = "SELECT id FROM `member` WHERE `user_id` = '$user_id'";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_assoc($result);
  $id = $row["id"];
  $status = array("受付","受け取り済み","問題");
  DataTable("history");
  ?>

  <div class="container">
      <h1>あなたの予約履歴</h1>
      <hr>
  <table id="history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
  <thead><tr><td>#</td><td>商品名</td><td>合計金額</td><td>状態</td><td>日付</td></tr></thead>
<?php
  $query = "SELECT * FROM `yoyaku` WHERE `user_id`= '$id'";
  $result = mysqli_query($link, $query);
  while ($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    echo "<td>".$row["id"]."</td>"; //予約ID
    echo "<td>商品名</td>"; //商品名
    echo "<td>価格</td>"; //価格
    echo "<td>".$row["date"]."</td>"; //checkbox
    echo "<td>".$status[$row["status"]]."</td>";
    echo "</tr>";
  };
?>
  </table>
</div>
