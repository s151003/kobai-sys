<?php
require("../connect_db.php");
require("../head.php");
output("予約確定ページ");
LoginVerify($_SESSION['sid']);

$userid = $_SESSION['sid'];
$query = "SELECT id FROM member WHERE user_id = '$userid'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$id = $row['id'];

if(isset($_SESSION['cart'][$userid])){
  foreach($_SESSION['cart'][$userid] as $key => $value){
    $datetime = date("Y-m-d H:i:s");
    $query = "INSERT INTO yoyaku (user_id, product, quantity, date) VALUES ('$id', '$value[0]', '$value[1]','$datetime')";
    $result = mysqli_query($link,$query);
  };
  unset($_SESSION['cart']);
}
