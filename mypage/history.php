<?php
  require("../connect_db.php");
  require("../head.php");
  output("予約履歴");
  LoginVerify($_SESSION['sid']);

  $user_id = $_SESSION['sid'];

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
  <thead><tr><td>#</td><td>商品名</td><td>金額</td><td>個数</td><td>日付</td></tr></thead>
<?php
  $query = "SELECT * FROM `yoyaku` WHERE `user_id`= '$id'";
  $result = mysqli_query($link, $query);

  while ($row = mysqli_fetch_assoc($result)){
    $return = NameValue($row['product']);
    echo "<tr>";
    echo "<td>".$row["id"]."</td>"; //予約ID
    echo "<td>".$return[0]."</td>"; //商品名
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$return[1] * $row['quantity']."</td>"; //価格
    echo "<td>".$row["date"]."</td>";
    echo "</tr>";
  };

  function NameValue($id){
    require("../connect_db.php");
    $query = "SELECT name,value FROM products WHERE id = '$id'";
    $result = mysqli_query($link,$query);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $value = $row['value'];

    return array($row['name'],$row['value']);
  }
?>
  </table>
</div>
