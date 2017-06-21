
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
        <option value="1">商品1</option>
        <option value="メロンパン">スペシャルメロンパン　
        <?php 
        $weekno = date('D');
        if ($weekno == "Mon") {
            echo "120円（20円割引）";
        } else {
            echo "140円";
        }  ?></option>

        <option value="カレーパン">カレーパン　
        <?php 
        $weekno = date('D');
        if ($weekno == "Tue") {
            echo "100円（20円割引）";
        } else {
            echo "120円";
        } ?></option>

        <option value="チョコリング">チョコリング
        <?php 
        $weekno = date('D');
        if ($weekno == "Wed") {
            echo "120円（20円割引）";
        } else {
            echo "140円";
        } ?></option>

        <option value="クリーミー大福">クリーミー大福
        <?php 
        $weekno = date('D');
        if ($weekno == "Thu") {
            echo "120円（20円割引）";
        } else {
            echo "140円";
        } ?></option>

        <option value="チリドッグ">チリドッグ
        <?php 
        $weekno = date('D');
        if ($weekno == "Fri") {
            echo "140円（20円割引）";
        } else {
            echo "160円";
        } ?></option>


        <option value="チョコシュガー">チョコシュガー 100円</option>
        <option value="モチモチココア">モチモチココア 100円</option>
        <option value="モチモチきなこ">モチモチきなこ 100円</option>
        <option value="モチモチ抹茶">モチモチ抹茶 100円</option>
    </optgroup> 
        </select>
    <select name="syohin2"required>
    <optgroup>
        <option value="1">商品2</option>
        <option value="メロンパン">スペシャルメロンパン　
        <?php 
        $weekno = date('D');
        if ($weekno == "Mon") {
            echo "120円（20円割引）";
        } else {
            echo "140円";
        }  ?></option>

        <option value="カレーパン">カレーパン　
        <?php 
        $weekno = date('D');
        if ($weekno == "Tue") {
            echo "100円（20円割引）";
        } else {
            echo "120円";
        } ?></option>

        <option value="チョコリング">チョコリング
        <?php 
        $weekno = date('D');
        if ($weekno == "Wed") {
            echo "120円（20円割引）";
        } else {
            echo "140円";
        } ?></option>

        <option value="クリーミー大福">クリーミー大福
        <?php 
        $weekno = date('D');
        if ($weekno == "Thu") {
            echo "120円（20円割引）";
        } else {
            echo "140円";
        } ?></option>

        <option value="チリドッグ">チリドッグ
        <?php 
        $weekno = date('D');
        if ($weekno == "Fri") {
            echo "140円（20円割引）";
        } else {
            echo "160円";
        } ?></option>

        <option value="チョコシュガー">チョコシュガー 100円</option>
        <option value="モチモチココア">モチモチココア 100円</option>
        <option value="モチモチきなこ">モチモチきなこ 100円</option>
        <option value="モチモチ抹茶">モチモチ抹茶 100円</option>
    </optgroup> 
    </select>              
    </p>

    <p>
        <input <?php $_SESSION['sid']; ?> type="submit" value="予約する">
    </p>
    </form>
</body>
</html>



