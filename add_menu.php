<form action="menu_adder.php" method="post">
<input type="hidden" name= "mode" value="menu_adder" />

<title>メニュー管理ページ</title>
    <h2>メニュー追加</h2>
名前</br>
<input type="text" name="product" maxlength="100"></br></br>
値段</br>
<input type="number" name="value" maxlength="100">
</br></br><input type="submit" name="submit" value="aaaa">

<?php



// $sql = "INSERT INTO products(id,products,value) VALUES($id,$products,$value)";