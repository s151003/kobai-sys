<?php
  require("../head.php");
  output("マイページ");
  require("../connect_db.php");
  LoginVerify($_SESSION['sid']);

?>
<body>
  <div class="container">
  <h1>柏の葉高校購買部</h1>
  <hr>
  <h2> <?php echo $_SESSION['sid']; ?> さん 購買予約システムへようこそ</h2>
  <?php
    $result = mysqli_query($link,'SELECT * FROM category');
    echo "<div class=\"row\">";
    while ($row = mysqli_fetch_assoc($result)){
      $name = $row['name'];
      $comment = $row['comment'];
      $id = $row['id'];
    	CategoryCard("$name","$comment","$id");
    }
  ?>
  </div>
  </div>
</body>
</html>

<?php
function CategoryCard($name,$comment,$id){
  echo <<<EOM
	<div class="col-md-4">
  <div class="panel panel-primary">
    <div class="panel-heading">$name</div>
    <div class="panel-body">
    <div class="thumbnail">
			<div class="caption">
        <h3>$name</h3>
        <p></p>
        <p><a href="products_list.php?cat=$id" class="btn btn-primary" role="button">こちら</a></p>
      </div>
    </div>
    </div>
    <div class="panel-footer">$comment</div>
	</div>
  </div>
EOM;
}
?>
