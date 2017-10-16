<form action="menu_changer.php" method="post">
<?php
require("../head.php");
output("メニュー管理ページ");
  DataTable("products");
 ?>
<!-- 表生成開始 -->
<div class="container">
<table id="products" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
<thead><tr><th>#</th><th>商品名</th><th>価格</th><th>曜日割引</th><th>割引価格</th><th>削除</th><th></th><th>予約受付数</th><th>販売受付</th></tr></thead>
<?php
require("../connect_db.php");
$week = array("日", "月", "火", "水", "木", "金", "土","なし");
$query = mysqli_query($link,'SELECT id,name,value,dis_day,dis_value,day_limit FROM products');
$count = 0;
echo "<tbody>";
while ($row = mysqli_fetch_assoc($query)){
  $count ++;

  echo "<tr>";
  echo "<td>",$count,"</td>"; //商品ID
  echo "<td>",$row["name"],"</td>"; //商品名
  echo "<td>",$row["value"],"</td>"; //価格
  echo "<td>",$week[$row["dis_day"]],"</td>"; //割引曜日
  echo "<td>",$row["dis_value"],"</td>";
  echo "<td><button type=\"button\" class=\"btn btn-primary btn-lg\" data-toggle=\"modal\" data-target=\"#edit\"><span class=\"glyphicon glyphicon-pencil\"></span></button></td>";
  echo "<td>sakujo</tb>"; //checkbox
  echo "<td>",$row["day_limit"],"</td>";
  echo "<td>予約</td>";
  echo "</tr>";
  // <span class=\"glyphicon glyphicon-pencil\"></span>
  echo <<<EOM
  <div class="modal fade" id="edit" tabindex="-1">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
  				<h4 class="modal-title">修正</h4>
  			</div>
  			<div class="modal-body">
  				ここに修正
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
  				<button class=\"btn btn-default\" type='submit' name='del' value='",$row["name"],"'>削除</button>
  			</div>
  		</div>
  	</div>
  </div>
EOM;
}
  echo "<h4>商品数 $count</h4><hr>";
  echo "<tbody>";
  echo "</table>";
 //商品数
?>
<!-- 表ここまで -->
<!-- モーダルウィンドウを起動するボタン -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#MODAL1">MODAL</button><br>

<!-- ここからモーダル -->
<div class="modal fade" id="MODAL1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
          ヘッダ
      </div>
      <div class="modal-body">
          ボディ
      </div>
      <div class="modal-footer">
          フッター
      </div>

    </div> <!-- modal-content -->
  </div>  <!-- modal-dialog -->
</div>  <!-- modal fade -->


</br></br>
<input class="btn btn-default" type="submit" value="送信ボタン">
</form>
</div>
