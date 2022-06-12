<?php
namespace view\signup;

function index() {
?>
<h1>signupページ</h1>
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
    <div>
      <label for="nickname">ニックネーム</label>
      <input id="nickname" name="nickname" type="text">
    </div>
    <input type="submit" value="新規登録">
  </form>
</div>
<?php
}
?>