<?php
  use libs\Msg;
  $user_id = escape($user_id);
  $password = escape($password);
  $nickname = escape($nickname);
  Msg::flush();
?>
<div class="form-cont mx-auto bg-white py-4 mt-5 shadow-sm">
    <div class="text-center">
      <h2>新規登録</h2>
    </div>
    <form class="mt-5" action="<?php echo CURRENT_URI; ?>" method="post">
      <div class="mb-4 w-75 mx-auto">
        <label for="user_id" class="form-label">ユーザーID</label>
        <input type="text" class="form-control"  name="user_id" id="user_id" value="<?php echo $user_id ?>">
        <div id="id_help" class="form-text">10文字以下の英数字</div>
      </div>
      <div class="mb-4 w-75 mx-auto">
        <label for="password" class="form-label">パスワード</label>
        <input type="password" class="form-control" name="password" id="password" value="<?php echo $password ?>">
        <div id="pwd_help" class="form-text">英大文字・小文字と数字を含む10~20文字</div>
      </div>
      <div class="w-75 mx-auto">
        <label for="nickname" class="form-label">ニックネーム</label>
        <input type="text" class="form-control" name="nickname" id="nickname" value="<?php echo $nickname ?>">
        <div id="nick_help" class="form-text">10文字以下</div>
      </div>
      <div class="text-center mt-5">
        <button type="submit" class="btn btn-primary">新規登録</button>
        <a href="<?php the_url('signin') ?>" class="d-block mt-3">ログインはこちら</a>
      </div>
    </form>
  </div>