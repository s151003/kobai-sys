
<?php
$link = mysql_connect("localhost","root","");
if (!$link) {
	$sqlconect = "失敗";
  echo "$sqlconect";
}

$db_selected = mysql_select_db("koubai",$link);
if (!$db_selected) {
	die('データベースに接続失敗'.mysql_error());
}

$result = mysql_query('SELECT id,name,value FROM menu');
if (!$result) {
    die('クエリーが失敗しました。'.mysql_error());
}

while ($row = mysql_fetch_array($result)) {
	echo "<tr>$row[0]</tr> $row[1] .$row[2] <br>";
}

mysql_close($link);
