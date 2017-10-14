<?php
  require("../head.php");
  output("マイページ");
  require("../connect_db.php");
?>
<div class="container">
<body>
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
      echo "</div>";
     ?>
   </div>
</body>
</html>
