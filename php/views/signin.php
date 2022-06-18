<?php
namespace view\signin;

function index() {
?>
<div>
  <div class="form-cont mx-auto bg-white py-4 mt-5 shadow-sm">
    <div class="text-center">
      <h2>Login</h2>
    </div>
    <form class="mt-5" action="<?php echo CURRENT_URI; ?>" method="post">
      <div class="mb-4 w-75 mx-auto">
        <label for="user_id" class="form-label">ユーザーID</label>
        <input type="text" class="form-control" name="user_id" id="user_id">
      </div>
      <div class="w-75 mx-auto">
        <label for="password" class="form-label">パスワード</label>
        <input type="password" class="form-control" name="password" id="password">
      </div>
      <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary">ログイン</button>
        <a href="<?php the_url('signup') ?>" class="d-block mt-3">新規登録はこちら</a>
      </div>
    </form>
  </div>
</div>
<?php
}
?>