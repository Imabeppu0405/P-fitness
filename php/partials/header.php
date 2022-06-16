<?php
namespace partials;

use app\core\Message\Msg;
use app\core\Auth;

function header() {
?>
  <!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P-fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <header>
      <nav class="d-flex align-items-center justify-content-between py-2 px-5">
          <a class="h2 font-weight-bold" href="<?php the_url('/') ?>">P-fitness</a>
          <div>
            <?php if(Auth::isLogin()): ?>
            <a href="<?php the_url('/') ?>" class="mx-3 h5 pt-2">Home</a>
            <a href="<?php the_url('logout') ?>" class="btn btn-danger" >ログアウト</a>
            <?php else: ?>
            <a href="<?php the_url('signup') ?>" class="btn btn-primary mx-3">登録</a>
            <a href="<?php the_url('signin') ?>" >ログイン</a>
            <?php endif; ?>
          </div>
      </nav>
    </header>
<?php
Msg::flush(); 
}
?>