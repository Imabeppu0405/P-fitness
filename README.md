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

## インスタンスの作成
- EC2でインスタンスの作成
- セキュリティグループのインバウントルールはsshとhttp、httpsからの接続を許可するように設定

## 環境構築
* Apacheをインストールして起動  
```
sudo yum install httpd -y  
sudo systemctl start httpd  
```

* ローカルからコードをコピー  
```
cd /var/www  
sudo chmod 777 www   
scp -r -i "PFitnessKey.pem" /Users/imabeppudaiki/Downloads/P-fitness/work   ec2-user@ec2-18-179-11-247.ap-northeast-1.compute.amazonaws.com:/var/www
```

* 不要ファイルやフォルダの削除  
```
cd /var/www/work  
rm .DS_Store    
rm -rf .git*  
```

* ドキュメントルートやメソッドの許可設定  
```
cd /etc/httpd/conf
vi httpd.conf

# httpd.confを下記に変更
DocumentRoot "/var/www/work/public"
<Directory "/var/www/work">
    Options Indexes FollowSymLinks
     <LimitExcept GET POST>
       Order deny,allow
       Deny from all
     </LimitExcept>
    Require all granted
</Directory>
```

* PHPのインストール  
```
sudo amazon-linux-extras install php7.4
```

* php.iniの時刻設定して再起動＆表示確認  
```
sudo systemctl restart httpd
```

* mysqlのインストール, 起動  
```
# 初期で入っているmariadbをアンインストール
sudo yum remove mariadb-*  

sudo yum localinstall https://dev.mysql.com/get/   mysql80-community-release-el7-6.noarch.rpm  
sudo yum install --enablerepo=mysql80-community mysql-community-server  
sudo touch /var/log/mysqld.log  
sudo systemctl start mysqld   
```
参考：https://qiita.com/miriwo/items/eb09c065ee9bb7e8fe06

*  mysqlのパスワード再設定  
```
# デフォルトのrootパスワードをログで確認
sudo less /var/log/mysqld.log  

mysql -uroot -p
ALTER USER 'root'@'localhost' identified BY '新しいrootユーザのパスワード';  
```
参考：https://qiita.com/miriwo/items/457d6dbf02864f3bf296  

* fitnessdbの作成とfitnessdb用のユーザー作成  
```
mysql -uroot -p
create database fitnessdb  
GRANT all on fitnessdb.* to 'fitnessdb'@'18.179.11.247' identified 'password';
```

*  テーブル作成  
```
source /var/www/work/table_create.sql;
```

*  mbstringが読み込まれていなかったためインストール  
```
yum list | grep "\-mbstring"  
sudo yum install php-mbstring.x86_64 
```

*  mbstringのextension有効化  
```
extension=mbstringをphp.iniに追記
```

*  Apacheとphp-fpmの再起動(Apacheの再起動だけではmbstringが有効化されなかった) 
``` 
sudo systemctl restart httpd  
sudo systemctl restart php-fpm
```

## 独自ドメインを作成
1. ドメイン名を購入(一番安いp-fitness.linkにしました)  
2. Router53にドメイン名を登録。IPv4アドレスを持つAレコードを追加する  
参考：https://qiita.com/ymzkjpx/items/ae115ed6d0fd2d383cec

## ssh化
1. ACMで証明書を作成する
2. ロードバランサーを作成し、証明書を紐付ける
3. ロードバランサーからの接続を許可するようにインスタンスのセキュリティグループのインバウントルールを変更  
参考：https://qiita.com/miyuki_samitani/items/1734dc13c6b7af601bd9

## tips
- Apacheのerror_logに出力されない場合のエラー確認方法  
```php
<?php
ini_set("display_errors", 'On');
error_reporting(E_ALL);
?>
```

## AWS構成図
![image](https://user-images.githubusercontent.com/72291454/188018863-d3718c03-bb6e-4384-9845-e846dfd1ddab.png)
