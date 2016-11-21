<?php
/* MySQL接続 */
$link = mysqli_connect('localhost','root','','kobai');

/* MySQL接続チェック 接続成功ならconnected */
if(!$link){
	die('disconnected'. mysql_error());
}
echo 'connected</br>';

/* HTMLから入力してPOSTしたデータを受け取る */
if ($_POST){
	$id = $_POST['id'];
	$pass = $_POST['pass'];
}

echo "Your ID is $id";

/* MySQLへデータを追加 */
mysqli_query($link,"INSERT INTO member (id,password) VALUES('$id','$pass')");



mysqli_close($link);
?>