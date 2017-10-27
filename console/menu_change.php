<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("メニュー管理ページ");
DataTable("products");
?>
<form action="menu_changer.php" method="post">
<!-- 表生成開始 -->
<div class="container">
<table id="products" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
<thead><tr><th>#</th><th>商品名</th><th>価格</th><th>曜日割引</th><th>割引価格</th><th>修正</th><th>削除</th><th>予約受付数</th><th>販売受付</th></tr></thead>
<?php
$week = array("日", "月", "火", "水", "木", "金", "土","なし");
$result = mysqli_query($link,'SELECT * FROM products');
$count = 0;
echo "<tbody>";
while ($row = mysqli_fetch_assoc($result)){
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

  ModalSet($row["name"],$row["id"],$row["value"],$row["dis_value"],$row["day_limit"],$row["comment"]);
}
  echo "</tbody>";
  echo "</table>";
  echo "<h4>商品数 $count</h4><hr>";
 //商品数
?>
<!-- 表ここまで -->

</br></br>
</div>
</form>
<?php
function ModalSet($name,$id,$value,$dis_value,$day_limit,$comment){
	echo <<<EOM
	 <div class="modal fade" id="delete{$id}" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
					<h4 class="modal-title">商品の削除</h4>
				</div>
					<div class="modal-body">
					商品 <b> {$name} </b> を本当に削除しますか？
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					<button type="submit" class="btn btn-danger" name='del' value='{$id}'>削除</button>
				</div>
			</div>
		</div>
	  </div>
	  <div class="modal fade" id="edit{$id}" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
					<h4 class="modal-title">商品の情報を修正</h4>
				</div>
				<div class="modal-body">
				  <div class="form-froup">
					<label>名前</br></label>
					<input required type="text" name="product{$id}" maxlength="100" class="form-control" value="{$name}"></br>
				  </div>
				  <div class="form-froup">
					<label>値段</label></br>
					<input required type="number" name="value{$id}" maxlength="100" class="form-control" value="{$value}"></br>
				  </div>
				  <div class="form-froup">
					<label>カテゴリー</label></br>
					<select name="category{$id}" class="form-control">
					<optgroup>
EOM;
			require("../connect_db.php");
			$result = mysqli_query($link,'SELECT id,name FROM category');
                while($row = mysqli_fetch_array($result)){
					echo "<option value=".$row[0].">".$row[1]."</option>";
                }
			echo <<<EOM
				</optgroup>
              </select></br>
              </div>
              <div class="form-froup">
                <label>曜日割引</label></br>
                <select name="dis_day{$id}" class="form-control">
                <optgroup>
                  <option value="7">割引なし</option>
                  <option value="1">月曜日</option>
                  <option value="2">火曜日</option>
                  <option value="3">水曜日</option>
                  <option value="4">木曜日</option>
                  <option value="5">金曜日</option>
                </optgroup>
                </select></br>
              </div>
              <div class="form-froup">
                <label>いくら割引ますか（割引がない場合は空欄）</label></br>
                <input type="number" name="dis_value{$id}" maxlength="100" class="form-control" value="{$dis_value}"></br>
              </div>
              <div class="form-froup">
                <label>一日あたりの販売個数</label></br>
                <input required type="number" name="day_limit{$id}" maxlength="100" class="form-control" value="{$day_limit}"></br>
              </div>
              <div class="form-froup">
                <label>ひとことコメント</br></label>
                <input required type="text" name="comment{$id}" maxlength="100" class="form-control" value="{$comment}"></br>
              </div>
  			</div>
  			<div class="modal-footer">
                <button type="submit" name="id" value="{$id}" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
  			</div>
  		</div>
  	</div>
  </div>
EOM;
}
?>
