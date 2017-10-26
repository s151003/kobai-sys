<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("ユーザーリスト");
DataTable("users");
?>
<form action="user_list.php" method="post">
<!-- 表生成開始 -->
<div class="container">
<table id="users" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
<thead><tr><th>#</th><th>ユーザー名</th><th></th><th>曜日割引</th><th>割引価格</th><th>修正</th><th>削除</th><th>予約受付数</th><th>販売受付</th></tr></thead>
<?php
while ($row = mysqli_fetch_assoc($query)){
  $count ++;

  echo "<tr>";
  echo "<td>",$count,"</td>"; //商品ID
  echo "<td>",$row["name"],"</td>"; //商品名
  echo "<td>",$row["value"],"</td>"; //価格
  echo "<td>",$week[$row["dis_day"]],"</td>"; //割引曜日
  echo "<td>",$row["dis_value"],"</td>";
  echo "<td><button type=\"button\" class=\"btn btn-primary btn-xs\" data-toggle=\"modal\" data-target=\"#edit".$row["id"]."\"><span class=\"glyphicon glyphicon-pencil\"></span></button></td>";
  echo "<td><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#delete".$row["id"]."\"><span class=\"glyphicon glyphicon-trash\"></span></button></td>"; //checkbox
  echo "<td>".$row["day_limit"]."</td>";
  echo "<td>".$row["comment"]."</td>";
  echo "</tr>";