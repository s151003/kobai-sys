<form action="menu_adder.php" method="post">
<input type="hidden" name= "mode" value="menu_adder" />

<title>メニュー管理ページ</title>
    <h2>メニュー追加</h2>
名前</br>
<input required type="text" name="product" maxlength="100"></br></br>
値段</br>
<input required type="number" name="value" maxlength="100"></br></br>
曜日割引</br>
<select name="discount">
<optgroup>
  <option value="7">割引なし</option>
  <option value="1">月曜日</option>
  <option value="2">火曜日</option>
  <option value="3">水曜日</option>
  <option value="4">木曜日</option>
  <option value="5">金曜日</option>
</optgroup>
</select></br></br>
いくら割引ますか（割引がない場合は空欄）</br>
<input type="number" name="dis_value" maxlength="100">
</br></br></br>
<input type="submit" name="submit" value="aaaa">
