# 購買予約システム
---
## Description
高校の購買部での利用を想定して作成した「購買予約システム」です。  
生徒が商品を予約して、予約状況を業者の方が確認できます。


# 使い方


* 導入方法  
[導入方法.md](`導入方法.md`)に記載してあります

## 生徒が会員登録するまで

Gitのコミットメッセージの書き方
http://qiita.com/itosho/items/9565c6ad2ffc24c09364

Bootstrapやテーブルのソートを実装するために導入したDataTablesの読み込みにCDNを利用しているためインターネットに接続できない環境では正常に表示されません

# フォルダ
* **console**
管理画面

* **mypage**
ログインや登録する画面
その後の予約まで

# ファイルについて
## 会員登録  
* **regist_form.php**   
会員登録フォーム  

* **register.php**   
会員登録処理

## ログイン
- **login.php**   
ログインフォーム

* **auth.php**   
ログイン処理

## 予約

* **mypage.php**  
予約商品選択画面  
ここから注文状況の確認や注文履歴が確認できるようにしたら良いのではないでしょうか。


## 購買部側の管理画面
* **menu_manage.php**  
メニュー管理ページ（```add_menu.php```と```revision_menu.php```)へのリンク  


- **add_menu.php**  
入力フォーム
- **menu_adder.php**  
```add_menu.php```からデータを受け取り、SQLへ送る

# SQL ```koubai.sql```

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
- status 状況

# コミットコメント
#### Fix 🔧
動かない機能を修正
#### Clean :shower:
リファクタリング
#### Rename :bookmark:
改名
#### Move 🚧
ファイルを移動
#### Tada :tada:
盛大な機能追加
#### Add :sparkles:
ファイル追加
#### Update 📝
#### Remove :fire:
削除


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
