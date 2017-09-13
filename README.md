Gitのコミットメッセージの書き方
http://qiita.com/itosho/items/9565c6ad2ffc24c09364

# 課題
## 
## メニューが手打ちである
予約画面のセレクトボックスが手打ち
DBからメニューを取得して表示する
## Passwordを平文で送信している（優先度低）
ログイン、レジスター 
パスワードを暗号化データベースに保存する

パスワードをDBに保存する時の基礎の基礎的なこと
http://qiita.com/ms2sato/items/6005eea50def287090d0

#フォルダ
* **console**
おばちゃん向け画面
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
```add_menu.php``` からデータを受け取り、SQLへ送る

# SQL
## member
- id
- password
- time 登録時刻

## products
- id 通し番号（付け方が分からない）
- name 商品名
- value 商品価格
- discount 割引する曜日（曜日番号）
- dis_value 曜日割引でいくら割り引くか

## yoyaku
- 後で
