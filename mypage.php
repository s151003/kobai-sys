
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
    <form name="yoyaku" action="test04.php" method="post">
    <p>
    <select name="syohin1"required>
    <optgroup>
        <option value="1">選択してください</option>
        <option value="メロンパン">メロンパン</option>
        <option value="モチモチ">モチモチ</option>
        <option value="チョコリング">チョコリング</option>
        <option value="シュガートースト">シュガートースト</option>
    </optgroup> 
    </select>
    <select name="syohin2"required>
    <optgroup>
        <option value="1">選択してください</option>
        <option value="メロンパン">メロンパン</option>
        <option value="モチモチ">モチモチ</option>
        <option value="チョコリング">チョコリング</option>
        <option value="シュガートースト">シュガートースト</option>
    </optgroup> 
    </select>              
    </p>
    <p>
        ID<input type required></br>
        ＊例０１０９４２（１年９組４２番）
    </p>
    <p>
        <input <?php $_SESSION['sid']; ?> type="submit" value="予約する">
    </p>
    </form>
</body>
</html>



