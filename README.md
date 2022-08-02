# P-fitness

## 概要
- フィットネスをタスクとして追加し、完了するとアプリ内ポイントを獲得
- ご褒美を設定
- ポイントを消費してご褒美を獲得できる

## 実装予定の機能
- ログイン・ログアウト機能
- フィットネス登録・削除・更新機能
- ご褒美登録・削除・更新機能
- フィットネス完了やご褒美獲得に伴うポイントの増減処理

## 画面の種類
- ログインページ
- ログアウトページ
- ホームページ(フィットネスの登録や削除・更新・完了ができる)
- リワードページ(褒美の登録・更新・削除、獲得ができる)

## ディレクトリ構造
- public：公開ディレクトリ
  - css：CSSファイルを配置
  - js：jsファイルを配置
  - index.php
- php：非公開ディレクトリ
  - controllers：各ページのコントローラーを配置
  - core：認証処理やルーティング処理などコアとなる処理を配置
  - models：各modelを配置
  - sql：DB接続に関する処理を配置
  - partials：ページの部品を配置
  - views：ページの見た目を配置


## 環境構築
1. Apacheをインストールして起動

sudo yum install httpd -y
sudo systemctl start httpd

2. ローカルからコードをコピー
cd /var/www
sudo chmod 777 www 
scp -r -i "PFitnessKey.pem" /Users/imabeppudaiki/Downloads/P-fitness/work ec2-user@ec2-18-179-11-247.ap-northeast-1.compute.amazonaws.com:/var/www

3.不要ファイルやフォルダの削除
cd /var/www/work
rm .DS_Store
rm -rf .git*

4. ドキュメントルートやメソッドの許可設定
httpd.confの記載変更

5. PHPのインストール
sudo amazon-linux-extras install php7.4

6. php.iniの時刻設定して再起動＆表示確認
sudo systemctl restart httpd

7. mysqlのインストール, 起動
sudo yum remove mariadb-*
sudo yum localinstall https://dev.mysql.com/get/mysql80-community-release-el7-6.noarch.rpm
sudo yum install --enablerepo=mysql80-community mysql-community-server
sudo touch /var/log/mysqld.log
sudo systemctl start mysqld 
参考：https://qiita.com/miriwo/items/eb09c065ee9bb7e8fe06

1.  mysqlのパスワード再設定
sudo less /var/log/mysqld.log
ALTER USER 'root'@'localhost' identified BY '新しいrootユーザのパスワード';
参考：https://qiita.com/miriwo/items/457d6dbf02864f3bf296

1. fitnessdbの作成とfitnessdb用のユーザー作成
create database fitnessdb
GRANT all on fitnessdb.* to 'fitnessdb'@'18.179.11.247' identified 'password';

10. テーブル作成
source /var/www/work/table_create.sql;

11. mbstringが読み込まれていなかったためインストール
yum list | grep "\-mbstring"
sudo yum install php-mbstring.x86_64 

12. mbstringのextension有効化
php.ini 編集

13. Apacheとphp-fpmの再起動(Apacheの再起動だけではmbstringが有効化されなかった)
sudo systemctl restart httpd
sudo systemctl restart php-fpm

14. 

## tips
- Apacheのerror_logに出力されない場合のエラー確認方法
<?php
ini_set("display_errors", 'On');
error_reporting(E_ALL);
?>