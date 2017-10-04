<head>
  <title>メニュー管理ページ</title>
  <!-- bootstrapの準備 -->
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>

<form action="menu_adder.php" method="post">
<input type="hidden" name= "mode" value="menu_adder" />

<div class="container">
    <div class="col-md-6">
  <h2>メニュー追加</h2>
  <hr>

  <div class="form-froup">
    <label>名前</br></label>
    <input required type="text" name="product" maxlength="100" class="form-control"></br>
  </div>
  <div class="form-froup">
    <label>値段</label></br>
    <input required type="number" name="value" maxlength="100" class="form-control"></br>
  </div>
  <div class="form-froup">
    <label>曜日割引</label></br>
    <select name="discount" class="form-control">
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
    <input type="number" name="dis_value" maxlength="100" class="form-control"></br></br></br>
  </div>
    <input class="btn btn-primary" type="submit" name="submit" value="送信">
  </div>
    <div class="col-md-6"></div>
</div>
