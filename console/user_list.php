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
<thead><tr><th>#</th><th>ユーザー名</th><th>登録日時</th><th>管理権</th><th>切り替え</th><th>削除</th></tr></thead>
<?php
$result = mysqli_query($link,'SELECT id,user_id,time,admin FROM member');
$count = 0;
while ($row = mysqli_fetch_assoc($result)){
  $count ++;

  echo "<tr>";
  echo "<td>",$row['id'],"</td>"; //商品ID
  echo "<td>",$row["user_id"],"</td>";
  echo "<td>".$row["time"]."</td>";
  echo "<td>".$row["admin"]."</td>";
  echo "<td><button type=\"button\" class=\"btn btn-primary btn-xs\" data-toggle=\"modal\" data-target=\"#admin".$row["id"]."\"><span class=\"glyphicon glyphicon-pencil\"></span></button></td>";
  echo "<td><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#delete".$row["id"]."\"><span class=\"glyphicon glyphicon-trash\"></span></button></td>"; //checkbox
  echo "</tr>";
 }
 
  echo "</tbody>";
  echo "</table>";
  echo "<h4>商品数 $count</h4><hr>";