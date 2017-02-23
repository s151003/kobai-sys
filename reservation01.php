<html lang = "ja">
<head>
<title>おばちゃん専用</title>
</head>
<body>

<form method="get"action="reservation02.php">
<table border="1">
<?php
$n = 1;
require("connect_sql.php");

$result = mysql_query('SELECT id,name,product FROM yoyaku');
$sql = 'select count(*) as cnt from .yoyaku';
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res);
echo  "予約数";
echo $row['cnt'];
print('<br>');
$aa = $row['cnt'];
$aa++;
print('<input type="hidden"name="a"value="'.$row['cnt'].'">');
print('<input type="hidden"name="b"value="'.$aa.'">');
if(!$result){
	die('クエリー失敗'.mysql_error());
}
print('<tr><th>名前</th><th>商品</th></tr>');

while($row = mysql_fetch_assoc($result)){
print('<p>');
print('<tr><th>'.$row['name'].'</th><th>'.$row['product'].'</th></tr>');
print('</p>');
$n++;
}

$close = mysql_close($link);
?>
</table>
<input type="submit"value="削除">
</form>
</body>
</html>
