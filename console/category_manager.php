<?php
require("../head.php");
AdminVerify($_SESSION['sid']);
require("../connect_db.php");
output("カテゴリー追加");

if (!$_POST['name']==""){
  $name = $_POST['name'];
  $comment = $_POST['comment'];
  $stmt = mysqli_prepare($link, "INSERT INTO category (name,comment) VALUES (?,?)");
  mysqli_stmt_bind_param($stmt, "ss", $name, $comment);
  $result = mysqli_stmt_execute($stmt);
  echo "<div class=\"container\">";

  if(!$result){
    echo "Errormessage: ", mysqli_error($link),"<br>";
  }else{
    echo "<div class=\"alert alert-success\" role=\"alert\"><strong>カテゴリー追加成功</strong><br>";
    echo "カテゴリー名：".$name."<br>";
    echo "コメント：".$comment."</div>";
  }
  echo "</div>";
}
if (isset($_POST['del'])){
  $id = $_POST['del'];
  echo $id;
  $stmt2 = mysqli_prepare($link, "DELETE FROM category WHERE id=?");
  mysqli_stmt_bind_param($stmt2, "i", $id);
  mysqli_stmt_execute($stmt2);
};

?>
