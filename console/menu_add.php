<?php
  require("../head.php");
  AdminVerify($_SESSION['sid']);
  require("../connect_db.php");
  output("メニュー追加フォーム");
  ?>
<form action="menu_adder.php" method="post">
<input type="hidden" name= "mode" value="menu_adder" />
<div class="container">
  <?php ConsoleMenu(); ?>
  <div class="col-md-6">
  <h2>メニュー追加</h2>
  <hr>

  <div class="form-froup">
    <label>名前<br></label>
    <input required type="text" name="product" maxlength="100" class="form-control"><br>
  </div>
  <div class="form-froup">
    <label>値段</label><br>
    <input required type="number" name="value" maxlength="100" class="form-control"><br>
  </div>
  <div class="form-froup">
    <label>カテゴリー</label><br>
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
  </select><br>
  </div>
  <div class="form-froup">
    <label>曜日割引</label><br>
    <select required name="discount" id="dis_day" class="form-control" onChange="judgeDiscound()">
    <optgroup>
      <option value="" selected disable hidden>選択してください</option>
      <option value="7">割引なし</option>
      <option value="1">月曜日</option>
      <option value="2">火曜日</option>
      <option value="3">水曜日</option>
      <option value="4">木曜日</option>
      <option value="5">金曜日</option>
    </optgroup>
    </select><br>
  </div>
  <div class="form-froup">
    <label>いくら割引ますか</label><br>
    <input type="number" name="dis_value" id="dis_value" maxlength="100" class="form-control" value="0">
  </div><br>
  <div class="form-froup">
    <label>一日あたりの販売個数</label><br>
    <input required type="number" name="day_limit" maxlength="100" class="form-control"><br>
  </div>
  <div class="form-froup">
    <label>ひとことコメント<br></label>
    <input required type="text" name="comment" maxlength="100" class="form-control"><br>
  </div>
    <input class="btn btn-primary" type="submit" name="submit" value="送信">
  </div>
    <div class="col-md-6"></div>
</div>
<script>
function judgeDiscound(){
    if(document.getElementById("dis_day").value=="7"){
      document.getElementById("dis_value").disabled = true;
    }else{
      document.getElementById("dis_value").disabled = false;
    }

}
</script>