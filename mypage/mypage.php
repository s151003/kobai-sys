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
    	ProductCard("$name","$comment","$id","");
    }
    echo "</div>";
  ?>
  </div>
</body>
</html>
