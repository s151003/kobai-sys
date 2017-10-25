<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("予約状況");
DataTable("list");
?>
<form action="yoyaku_list.php" method="GET">
<div class="container">
	<div class="row">
  <div class="col-sm-offset-0 col-sm-12 col-md-offset-7 col-md-5">
    <div class="input-daterange input-group" id="datepicker">
         <input required type="text" class="input-sm form-control" name="start" />
         <span class="input-group-addon">to</span>
         <input required type="text" class="input-sm form-control" name="end" />
    </div>
    <input class="btn btn-primary" type="submit">
  </div>
<script>
$('#datepicker').datepicker({
    maxViewMode: 2,
    language: "ja",
    todayHighlight: true
});
</script>

<table id="list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0">
<thead><tr><td>#</td><td>ユーザーID</td><td>商品名</td><td>個数</td><td>金額</td><td>日付</td></tr></thead>

<?php
if (isset($_GET['start'])){
  $start = $_GET['start'];
  $end = $_GET['end'];
  $query = "SELECT * FROM yoyaku WHERE date BETWEEN '$start 00:00:00' AND '$end 23:59:59'";
  $result = mysqli_query($link,$query);
}else{
  $result = mysqli_query($link,'SELECT * FROM yoyaku');
}

while ($row = mysqli_fetch_assoc($result)){
  $return = NameValue($row['product']);
  echo "<tr>";
  echo "<td>".$row["id"]."</td>";
  echo "<td>".$row["user_id"]."</td>"; //予約ID
  echo "<td>".$return[0]."</td>"; //商品名
  echo "<td>".$row['quantity']."</td>";
  echo "<td>".$return[1] * $row['quantity']."</td>"; //価格
  echo "<td>".$row["date"]."</td>";
  echo "</tr>";

  @$product[$row['product']] = $product[$row['product']] + $row['quantity'];

};
echo "</table>";

echo "<h2>";
if (isset($start) && isset($end)){
  if ($start == $end){
    echo $start."の予約一覧";
  }else{
    echo $start."から".$end."までの注文の合計";
  }
}else{
  echo "累計売上";
}
echo "</h2>";

if (isset($product)){
  foreach ($product as $key => $value) {
    $return = NameValue($key);
    echo $return[0] ." : ". $value."</br>";
  }
}else{
  echo "予約はありませんでした";
}

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
</div>
</div>
