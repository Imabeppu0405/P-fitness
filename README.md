# P-fitness

## 概要
- フィットネスをタスクとして追加し、完了するとアプリ内ポイントと経験値を獲得
- ご褒美を設定
- ポイントを消費してご褒美を獲得できる
- 経験値に応じてレベルアップ

## 実装予定の機能
- ログイン・ログアウト機能
- フィットネス登録・削除・更新機能
- ご褒美登録・削除・更新機能
- フィットネス完了やご褒美獲得に伴うポイントの増減処理

## 画面の種類
- ログインページ
- ログアウトページ
- アカウントページ(登録情報の確認)
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

## 実施済のテストケース

|項目|URL|前提|入力値|操作|期待する結果|
|:---|:---|:---|:---|:---|:---|
|画面遷移|/|未ログイン|なし|なし|/signinが表示|
|画面遷移|/reward/show|未ログイン|なし|なし|/signinが表示|
|画面遷移|/signin|未ログイン|なし|なし|/signinが表示|
|画面遷移|/signup|未ログイン|なし|なし|/signupが表示|
|画面遷移|/上記以外|未ログイン|なし|なし|/404が表示|
|画面遷移|/|ログイン済|なし|なし|/が表示|
|画面遷移|/signin|ログイン済|なし|なし|/が表示|
|画面遷移|/signup|ログイン済|なし|なし|/が表示|
|画面遷移|/reward/show|ログイン済|なし|なし|/reward/showが表示|
|画面遷移|/上記以外|ログイン済|なし|なし|/404が表示|
|画面遷移|指定なし|ログイン済|なし|ログアウトボタンを押す|/signinに遷移|
|入力チェック|/signup|パスワードとニックネームは正常値が入力済|ユーザーID:12345678901|新規登録ボタンを押す|文字数エラーが表示|
|入力チェック|/signup|パスワードとニックネームは正常値が入力済|ユーザーID:1234567890|新規登録ボタンを押す|新規登録が完了し、homeページへ遷移|
|入力チェック|/signup|パスワードとニックネームは正常値が入力済|ユーザーID:1|新規登録ボタンを押す|新規登録が完了し、homeページへ遷移|
|入力チェック|/signup|パスワードとニックネームは正常値が入力済|ユーザーID:未入力|新規登録ボタンを押す|未入力のエラーが表示|
|存在チェック|/signup|パスワードとニックネームは正常値が入力済、test1というユーザーIDを登録済|ユーザーID:test1|新規登録ボタンを押す|重複のエラーが表示|
|入力チェック|/signup|ユーザーIDとニックネームは正常値が入力済|パスワード:未入力|新規登録ボタンを押す|未入力のエラーが表示|
|入力チェック|/signup|ユーザーIDとニックネームは正常値が入力済|パスワード:pass1|新規登録ボタンを押す|文字数のエラーが表示|
|入力チェック|/signup|ユーザーIDとニックネームは正常値が入力済|パスワード:pass123456789|新規登録ボタンを押す|文字数のエラーが表示|
|入力チェック|/signup|ユーザーIDとニックネームは正常値が入力済|パスワード:pass12|新規登録ボタンを押す|新規登録が完了し、homeページへ遷移|
|入力チェック|/signup|ユーザーIDとニックネームは正常値が入力済|パスワード:pass12345678|新規登録ボタンを押す|新規登録が完了し、homeページへ遷移|
|入力チェック|/signup|ユーザーIDとニックネームは正常値が入力済|パスワード:123456|新規登録ボタンを押す|文字数のエラーが表示|
|入力チェック|/signup|ユーザーIDとニックネームは正常値が入力済|パスワード:passwo|新規登録ボタンを押す|文字数のエラーが表示|
|入力チェック|/signup|ユーザーIDとパスワードは正常値が入力済|ニックネーム:未入力|新規登録ボタンを押す|未入力のエラーが表示|
|入力チェック|/signup|ユーザーIDとパスワードは正常値が入力済|ニックネーム:あ阿々ｱープ|新規登録ボタンを押す|新規登録が完了し、homeページへ遷移|
|入力チェック|/signup|ユーザーIDとパスワードは正常値が入力済|ニックネーム:あああああああああああ|新規登録ボタンを押す|文字数のエラーが表示|
|入力チェック|/signup|ユーザーIDとパスワードは正常値が入力済|ニックネーム:ああああああああああ|新規登録ボタンを押す|新規登録が完了し、homeページへ遷移|
|入力チェック|/signup|ユーザーIDとパスワードは正常値が入力済|ニックネーム:あ|新規登録ボタンを押す|新規登録が完了し、homeページへ遷移|
|入力チェック|/signin|パスワードは正常値が入力済|ユーザーID:12345678901|ログインボタンを押す|文字数エラーが表示|
|入力チェック|/signin|パスワードは正常値が入力済|ユーザーID:未入力|ログインボタンを押す|未入力エラーが表示|
|入力チェック|/signin|ユーザーID:test1,パスワード:password1のユーザー登録済、パスワード入力済|ユーザーID:test1|ログインボタンを押す|ログインが完了し、homeページへ遷移|
|入力チェック|/signin|ユーザーID:test4でユーザー登録なし、パスワードは正常値入力済|ユーザーID:test4|ログインボタンを押す|ユーザが見つからないというエラーが表示|
|入力チェック|/signin|ユーザーIDは正常値が入力済|パスワード:未入力|ログインボタンを押す|未入力のエラーが表示|
|入力チェック|/signin|ユーザーIDは正常値が入力済|パスワード:pass1|ログインボタンを押す|文字数のエラーが表示|
|入力チェック|/signin|ユーザーIDは正常値が入力済|パスワード:pass123456789|ログインボタンを押す|文字数のエラーが表示|
|入力チェック|/signin|ユーザーIDは正常値が入力済|パスワード:123456|ログインボタンを押す|文字数のエラーが表示|
|入力チェック|/signin|ユーザーIDは正常値が入力済|パスワード:passwo|ログインボタンを押す|文字数のエラーが表示|
|入力チェック|/signin|ユーザーID:test1,パスワード:password1のユーザー登録済、ユーザーID入力済|パスワード:password1|ログインボタンを押す|ログインが完了し、homeページへ遷移|
|入力チェック|/signin|ユーザーID:test1,パスワード:password1のユーザー登録済、ユーザーID入力済|パスワード:password2|ログインボタンを押す|パスワードが一致しないというエラー表示|
|入力チェック|/|レベルとカテゴリは正常値が入力済|名前:未入力|追加ボタンを押して、入力し、登録ボタンを押す|新規作成のモーダルが開き、未入力のエラーが表示|
|存在チェック|/|レベルとカテゴリは正常値が入力済、tesという名前のフィットネスが登録済|名前:tes|追加ボタンを押して、入力し、登録ボタンを押す|新規作成のモーダルが開き、重複のエラーが表示|
|存在チェック|/|レベルとカテゴリは正常値が入力済、tesという名前のフィットネスを登録していたが削除済|名前:tes|追加ボタンを押して、入力し、登録ボタンを押す|フィットネスの登録が完了する|
|存在チェック|/|レベルとカテゴリは正常値が入力済、他のユーザーがtesというフィットネスを登録済|名前:tes|追加ボタンを押して、入力し、登録ボタンを押す|フィットネスの登録が完了する|
|入力チェック|/|1つ以上のフィットネスが登録済|名前:未入力|編集ボタンを押して、入力し、更新ボタンを押す|該当箇所の更新モーダルが開き、未入力のエラーが表示、変更後の値が保持され、他のフィットネスの更新ボタンを押してもエラーは表示されない|
|入力チェック|/|1つ以上のフィットネスが登録済|名前:123tesu///2|編集ボタンを押して、入力し、更新ボタンを押す|該当箇所の更新モーダルが開き、文字数のエラーが表示、変更後の値が保持され、他のフィットネスの更新ボタンを押してもエラーは表示されない|
|存在チェック|/|レベルとカテゴリは正常値が入力済、tesという名前のフィットネスが登録済、tes以外のフィットネスを編集|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|該当箇所の更新モーダルが開き、重複のエラーが表示|
|存在チェック|/|レベルとカテゴリは正常値が入力済、tesという名前のフィットネスが登録済、tesという名前のフィットネスを編集|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|フィットネスの更新が完了する|
|存在チェック|/|レベルとカテゴリは正常値が入力済、tesという名前のフィットネスを登録していたが削除済|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|フィットネスの更新が完了する|
|存在チェック|/|レベルとカテゴリは正常値が入力済、他のユーザーがtesというフィットネスを登録済|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|フィットネスの更新が完了する|
|入力チェック|/reward/show|値段は正常値が入力済|名前:123tesu///2|追加ボタンを押して、入力し、登録ボタンを押す|新規作成のモーダルが開き、文字数のエラーが表示|
|入力チェック|/reward/show|値段は正常値が入力済|名前:未入力|追加ボタンを押して、入力し、登録ボタンを押す|新規作成のモーダルが開き、未入力のエラーが表示|
|存在チェック|/reward/show|値段は正常値が入力済、tesという名前の報酬が登録済|名前:tes|追加ボタンを押して、入力し、登録ボタンを押す|新規作成のモーダルが開き、重複のエラーが表示|
|存在チェック|/reward/show|値段は正常値が入力済、tesという名前の報酬を登録していたが削除済|名前:tes|追加ボタンを押して、入力し、登録ボタンを押す|報酬の登録が完了する|
|存在チェック|/reward/show|値段は正常値が入力済、他のユーザーがtesという報酬を登録済|名前:tes|追加ボタンを押して、入力し、登録ボタンを押す|報酬の登録が完了する|
|入力チェック|/reward/show|1つ以上の報酬が登録済|名前:未入力|編集ボタンを押して、入力し、更新ボタンを押す|該当箇所の更新のモーダルが開き、未入力のエラーが表示、変更後の値が保持され、他の報酬の更新ボタンを押してもエラーは表示されない|
|入力チェック|/reward/show|1つ以上の報酬が登録済|名前:123tesu///2|編集ボタンを押して、入力し、更新ボタンを押す|該当箇所の更新のモーダルが開き、文字数のエラーが表示、変更後の値が保持され、他の報酬の更新ボタンを押してもエラーは表示されない|
|存在チェック|/reward/show|値段は正常値が入力済、tesという名前の報酬が登録済、tes以外の報酬を編集|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|該当箇所の更新モーダルが開き、重複のエラーが表示|
|存在チェック|/reward/show|値段は正常値が入力済、tesという名前の報酬が登録済、tesという名前の報酬を編集|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|報酬の更新が完了する|
|存在チェック|/reward/show|値段は正常値が入力済、tesという名前の報酬を登録していたが削除済|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|報酬の更新が完了する|
|存在チェック|/reward/show|値段は正常値が入力済、他のユーザーがtesという報酬を登録済|名前:tes|編集ボタンを押して、入力し、更新ボタンを押す|報酬の更新が完了する|
|削除チェック|/reward/show|ログイン済、報酬が１個以上登録済|なし|削除ボタンを押して、モーダル展開後、再度削除ボタンを押す|削除され、該当の報酬が表示されなくなる|
|削除チェック|/|ログイン済、フィットネスが１個以上登録済|なし|削除ボタンを押して、モーダル展開後、再度削除ボタンを押す|削除され、該当のフィットネスが表示されなくなる|
|所持金チェック|/|ログイン済、フィットネスが１個以上登録済|なし|Completeボタンを押す|現在の所持金に該当のフィットネスのポイントが加算される|
|所持金チェック|/reward/show|ログイン済、報酬が１個以上登録済|なし|Completeボタンを押す|現在のポイントから該当の報酬の価格が減算される|
