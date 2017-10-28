<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("カテゴリー管理ページ");
DataTable("category");
?>
<form action="category_manager.php" method="post">
<div class="container">

  <?php ConsoleMenu(); ?>
  <div class="col-sm-10">
  <h2>カテゴリー追加</h2>
  <hr>
<div class="form-froup">
  <label>カテゴリー名</br></label>
  <input type="text" name="name" maxlength="100" class="form-control"></br>
</div>
<div class="form-froup">
  <label>コメント</br></label>
  <input type="text" name="comment" maxlength="100" class="form-control"></br>
</div>
  <input class="btn btn-primary" type="submit" name="submit" value="送信">
</br></br>

<table id="category" class="table table-striped table-bordered cellspacing="0"">
<thead><tr><td>#</td><td>カテゴリー</td><td>コメント</td><td>削除</td></tr></thead>
<?php
$query = "SELECT * FROM category";
$result = mysqli_query($link, $query);
while ($row = mysqli_fetch_assoc($result)){
  echo "<tr>";
  echo "<td>".$row["id"]."</td>"; //予約ID
  echo "<td>".$row["name"]."</td>"; //商品名
  echo "<td>".$row["comment"]."</td>"; //価格
  echo "<td><button class=\"btn btn-default\" type='submit' name='del' value='",$row["id"],"'>削除</button></td>";
  echo "</tr>";
};

?>
</div>
</div>
