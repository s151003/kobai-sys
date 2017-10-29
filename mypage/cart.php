<?php
require("../head.php");
require('../connect_db.php');
output("カート");
LoginVerify($_SESSION['sid']);

$userid = $_SESSION['sid'];
$uri_root = preg_replace('/(.*kobai-sys\/).*/i', '${1}', $_SERVER["REQUEST_URI"]);
?>
  <div class="container">
<?php
if(isset($_POST['add'])){
  $add = $_POST['add'].",".$_POST[$_POST['add']];
  @$count = count($_SESSION['cart'][$userid]);
  $_SESSION['cart'][$userid][$count] = explode(',',$add);
  $post = $_POST['add'];
  $query = "SELECT * FROM products WHERE id = '$post'";
  $result = mysqli_query($link,$query);
  $row = mysqli_fetch_array($result);
?>
  <div class="panel panel-default">
     <div class="panel-heading">
       カートに追加しました
     </div>
     <div class="panel-body">
       <?php echo $row['name']; ?>
     </div>
     </div>
<?php
}
?>

<h2><?php echo $userid ?>さんのカート</h2><hr>
<table class="table table-condensed">
  <thead><th>#</th><th>商品</th><th>数量</th><th>価格</th><th>割引適用</th><thead>
    <?php
    if(isset($_SESSION['cart'][$userid])){
    ?>
    <?php
    $total = 0;
    foreach($_SESSION['cart'][$userid] as $key => $value){
      $query = "SELECT * FROM products WHERE id = '$value[0]'";
      $result = mysqli_query($link,$query);
      $row = mysqli_fetch_array($result);
      $weekno = date('w');

      if ($row['dis_day'] == $weekno) {
        $_SESSION['cart']['discount'][$row['id']] = 1;
        $sum = "<font color=\"red\">".($row['value']-$row['dis_value']) * $value[1]."<font>";

      }else{
        $_SESSION['cart']['discount'][$row['id']] = 0;
        $sum = $row['value'] * $value[1];
      }
      $discount = $_SESSION['cart']['discount'][$row['id']];

      echo "<tr><td>".$key."</td><td>".$row['name']."</td><td>".$value[1]."</td><td>";
      echo $sum;
      echo "</td><td>".$discount ."</td></tr>";
      $total = $total + $sum;
    }
    $key = $key + 1;

    echo <<<EOM
    </table>
    <div class="row">
    <div class="col-md-12">
    <hr>
        <h3>計 {$key} 点</h3>
        <div style="text-align:right;"><h2>{$total}円</h2></div>
        <br>
EOM;
    echo "<a class=\"btn btn-info btn-lg btn-block\" href=\"" . $uri_root ."mypage/checkout.php\"><span class=\"glyphicon glyphicon-send\" aria-hidden=\"true\"></span> 予約確定！</a>";
    echo "</div>";
    echo "</div>";
    }else{
      echo "</table>";
      echo "<center><h3>カートは空です</h3></center>";
    }

//カート全削除
if(@$_GET["del"] == 1){
  unset($_SESSION['cart']);
}
