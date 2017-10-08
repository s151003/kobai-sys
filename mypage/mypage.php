
<html>
<head>
    <meta charset=utf-8>
    <title>柏の葉高校購買部</title>

    <style>
h1 {color:#123456}
</style>
</head>
<body>
    <h1>柏の葉高校購買部</h1>
    <h2> <?php session_start(); echo $_SESSION['sid'];
        ?>
     さん 予約したい商品を選択してください</h2>
    <form name="yoyaku" action="check.php" method="post">
    <p>
    <select name="syohin1"required>
    <optgroup>
        <option value="1">商品1</option>
        <?php
        $link = mysql_connect("localhost","root","");
        if (!$link) {
            $sqlconect = "失敗";
            }else{
                $sqlconect = "connected to localhost <br>";
            }

        echo "$sqlconect";

        $db_selected = mysql_select_db(koubai,$link);
        if (!$db_selected) {
            die('データベースに接続失敗'.mysql_error());
        }

        echo "データベースに接続 <br>";

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
        $link = mysql_connect("localhost","root","");
        if (!$link) {
            $sqlconect = "失敗";
            }else{
                $sqlconect = "connected to localhost <br>";
            }

        echo "$sqlconect";

        $db_selected = mysql_select_db(koubai,$link);
        if (!$db_selected) {
            die('データベースに接続失敗'.mysql_error());
        }

        echo "データベースに接続 <br>";

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
</body>
</html>
