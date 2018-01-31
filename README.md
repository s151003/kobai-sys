# 購買予約システム
---
高校の購買部での利用を想定して作成した「購買予約システム」です。  
生徒が商品を予約して、予約状況を業者の方が確認できます。  

![img](https://github.com/s151003/stuff/blob/master/img/system.png?raw=true)

# 使い方

* 導入方法  
[docs/導入方法.md](docs/導入方法.md)に記載してあります

* 利用方法  
[docs/利用ガイド.md](docs/利用ガイド.md)に記載してあります

# データベースの構成```kobai.sql```

## member
- id 通し番号（AUTO_INCREMENT）
- user_id ユーザー指定のユーザーID
- password password_hashで暗号化されたパスワード
- time 登録時刻

## products
- id 通し番号（AUTO_INCREMENT）
- name 商品名
- value 商品価格
- dis_day 割引する曜日（曜日番号）
- dis_value 曜日割引でいくら割り引くか
- day_limit 一日あたりの販売個数

## yoyaku
- id 通し番号（AUTO_INCREMENT 1000~)
- user_id ユーザーID
- products 予約した商品
- quantity 数量
- date 予約時刻

# フォルダ
* **console**
管理画面  
購買部の方が操作する

* **mypage**
ログインや登録する画面
その後の予約まで行う

# 解決した課題
今度からはissueで
## 予約情報と商品のデータベースに通し番号をつけたい
$row_cntの方法だと途中のレコードを消した後挿入すると番号がくるう  
MySQLにAUTO_INCREMENTという機能があったのでid列に適用した  


~~```SELECT ID FROM koubai.yoyaku ORDER BY ID```でID列だけのレコードを取得~~  
~~mysqli_num_rows();を使ってレコードの数を数え、$row_cntに数が入る~~  
~~$row_cntに1足す~~  
~~$row_cntをIDに入れる~~  
~~check.php Line19~~  


~~やり方がわからない~~  
~~今あるレコードの数を数えて、++した数字を通し番号として登録しようとしたがうまくいかず保留~~  

## 商品の選択画面
商品の選択画面には2つのセレクトボックスを用意し、商品をそれぞれひとつづつ選べるようにしてある（仮設置）  
いい商品の選び方はないか考える  
* ~~テーブルにチェックボックス+数量指定（スマートフォンだと操作しにくい？）~~
* ~~商品ページ→カート追加→予約（ショッピングサイトのような）~~
* カテゴリ選択→絞り込んでから商品リスト表示

## Passwordを平文で送信している（優先度低)
password_hashで暗号化してデータベースへ   
password_verifyで認証  

https://secure.php.net/manual/ja/function.password-hash.php  

サーバーで暗号化するからサーバーに届くまで平文  
盗聴されると見られる  

~~ログイン、レジスター~~  
~~パスワードを暗号化データベースに保存する~~--

## メニューが手打ちである

~~予約画面のセレクトボックスが手打ち~~
~~DBからメニューを取得して表示する~~
