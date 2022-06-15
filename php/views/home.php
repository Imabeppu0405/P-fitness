<?php
namespace view\home;

function index() {
?>
<h1>home</h1>
<a href="<?php the_url('logout') ?>">ログアウト</a>
<?php
}
?>