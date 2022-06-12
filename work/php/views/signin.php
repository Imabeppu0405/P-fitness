<?php
namespace view\signin;

function index() {
?>
<h1>signinページ</h1>
<div>
  <form action="<?php echo CURRENT_URI ?>" method="POST">
    <div>
      <label for="user_id">ユーザーID</label>
      <input id="user_id" name="user_id" type="text">
    </div>
    <div>
      <label for="password">パスワード</label>
      <input id="password" name="password" type="password">
    </div>
    <input type="submit" value="ログイン">
  </form>
</div>
<?php
}
?>