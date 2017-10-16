<?php
// Here your code !
<form action="menu_changer.php" method="post">
<?php
require("../connect_db.php");
require("../head.php");
output("メニュー管理ページ");
DataTable("products");
?>
<!-- 表生成開始 -->
<div class="container">
<table id="products" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
<thead><tr><th>#</th><th>商品名</th><th>価格</th><th>曜日割引</th><th>割引価格</th><th>修正</th><th>削除</th><th>予約受付数</th><th>販売受付</th></tr></thead>
<?php
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
  echo "<td><button type=\"button\" class=\"btn btn-primary btn-xs\" data-toggle=\"modal\" data-target=\"#edit\"><span class=\"glyphicon glyphicon-pencil\"></span></button></td>";
  echo "<td><button type=\"button\" class=\"btn btn-danger btn-xs\" data-toggle=\"modal\" data-target=\"#delete\"><span class=\"glyphicon glyphicon-trash\"></span></button></td>"; //checkbox
  echo "<td>",$row["day_limit"],"</td>";
  echo "<td>予約</td>";
  echo "</tr>";
  
  //delete
?>
  <div class="modal fade" id="delete" tabindex="-1">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
  				<h4 class="modal-title">商品の削除</h4>
  			</div>
  			<div class="modal-body">
  				商品 <b><?php echo $row["name"]; ?></b> を本当に削除しますか？
  			</div>
  			<div class="modal-footer">
  				<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				<button type="submit" class="btn btn-danger" name='del' value='<?php echo $row["id"]; ?>'>削除</button>
  			</div>
  		</div>
  	</div>
  </div>
  <div class="modal fade" id="edit" tabindex="-1">
  	<div class="modal-dialog">
  		<div class="modal-content">
  			<div class="modal-header">
  				<button type="button" class="close" data-dismiss="modal"><span>×</span></button>
  				<h4 class="modal-title">商品の情報を修正</h4>
  			</div>
  			<div class="modal-body">
                <div class="form-group">
                    <input name="name" class="form-control" type="text" value="<?php echo $row["name"]; ?>">
                </div>
                <div class="form-group">
                    <input name="value" class="form-control" type="number" value="<?php echo $row["value"]; ?>">
                </div>
                <div class="form-froup">
                    <label>カテゴリー</label></br>
                    <select name="category" class="form-control">
                        <optgroup>
                            <?php
                            $query = mysqli_query($link,'SELECT id,name FROM category');
                            $count = 0;
                            while($row = mysqli_fetch_array($query)){
                                echo "<option value=",$row[0],">",$row[1],"</option>";
                            }
                            ?>
                        </optgroup>
                    </select></br>
                <div class="form-group">
                    <select name="dis_day" class="form-control">
                        <option value="7">割引なし</option>
                        <option value="1">月曜日</option>
                        <option value="2">火曜日</option>
                        <option value="3">水曜日</option>
                        <option value="4">木曜日</option>
                        <option value="5">金曜日</option>
                    </select>
                </div>
                <div class="form-froup">
                    <label>いくら割引ますか（割引がない場合は空欄）</label></br>
                    <input type="number" name="dis_value" maxlength="100" class="form-control" name=<?php echo $row["dis_value"]; ?>></br>
                </div>

                <div class="form-group">
                    <input name="day_limit" class="form-control" type="text" value="<?php echo $row["day_limit"]; ?> ">
                </div>
                <div class="form-group">
                    <input name="comment" class="form-control" type="text" value="<?php echo $row["comment"]; ?>">
                </div>
  			</div>
  			<div class="modal-footer">
                <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>?Update</button>
  			</div>
  		</div>
  	</div>
  </div>
<?php
}
  echo "<tbody>";
  echo "</table>";
  echo "<h4>商品数 $count</h4><hr>";
 //商品数
?>
<!-- 表ここまで -->

</br></br>
<input class="btn btn-default" type="submit" value="送信ボタン">
</form>
</div>
