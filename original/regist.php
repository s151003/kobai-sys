<?php
/* MySQL�ڑ� */
$link = mysqli_connect('localhost','root','','kobai');

/* MySQL�ڑ��`�F�b�N �ڑ������Ȃ�connected */
if(!$link){
	die('disconnected'. mysql_error());
}
echo 'connected</br>';

/* HTML������͂���POST�����f�[�^���󂯎�� */
if ($_POST){
	$id = $_POST['id'];
	$pass = $_POST['pass'];
}

echo "Your ID is $id";

/* MySQL�փf�[�^��ǉ� */
mysqli_query($link,"INSERT INTO member (id,password) VALUES('$id','$pass')");



mysqli_close($link);
?>