<?php
$link = mysql_connect('localhost','root','');
if(!$link){
	die('接続失敗'.mysql_error());
}
$select = mysql_select_db('kobai',$link);
if(!$select){
	die('データベース選択失敗'.mysql_error());
}

$a = $_GET['a'];
$b = 1;
while($b <= $a){
	if(isset($_GET[$b])){
		echo $b;
		$sql="delete from yoyaku where id = $b";
		if(!$res=mysql_query($sql)){
			echo "エラー";
			exit;
		}
		print('<br>');
	}else{
		echo $b;
		echo '削除';
		print ('<br>');
	}
	$b++;
}

?>