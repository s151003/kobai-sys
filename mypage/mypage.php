<?php
  require("../head.php");
  require("../connect_db.php");
  output("マイページ");

?>
<div class="container">

<body>
    <h1>柏の葉高校購買部</h1>
    <hr>
    <h2> <?php session_start(); echo $_SESSION['sid'];
        ?>
     さん 予約したい商品を選択してください</h2>
    <form name="yoyaku" action="check.php" method="post">
    <p>
    <select name="syohin1"required>
    <optgroup>
        <option value="1">商品1</option>
        <?php
        $result = mysql_query('SELECT id,name,value FROM menu');
        if (!$result) {
            die('クエリーが失敗しました。'.mysql_error());
        }

        while ($row = mysql_fetch_array($result)) {
           echo "<option>";
        echo "$row[0]. $row[1] .$row[2]円 <br>";
        echo"</option>";
        }
        mysql_close($link);
        ?>

    </optgroup>
        </select>
    <select name="syohin2"required>
    <optgroup>
        <option value="1">商品2</option>
        <?php
        $result = mysql_query('SELECT id,name,value FROM menu');
        if (!$result) {
            die('クエリーが失敗しました。'.mysql_error());
        }

        while ($row = mysql_fetch_array($result)) {
          echo "<option>";
          echo "$row[0]. $row[1] .$row[2]円 <br>";
          echo"</option>";
        }
        mysql_close($link);
        ?>

    </optgroup>
    </select>
    </p>

    <p>
        <input <?php $_SESSION['sid']; ?> type="submit" value="予約する">
    </p>
    </form>
  </div>
</body>
</html>
