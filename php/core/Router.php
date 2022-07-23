<?php 

namespace app\core;

use libs\Msg;
use RuntimeException;

class Router
{
  public Request $request;
  protected array $routes = [];

  public function __construct(Request $request)
  {
    $this->request = $request;
  }
  
  public function resolve()
  {
    try {

      $path = $this->request->getPath();
      $method = $this->request->getMethod();

      $targetFile = SOURCE_BASE . "controllers{$path}.php";

      if (!file_exists($targetFile)) {

        require_once SOURCE_BASE . "views/404.php";
        return;
      }

      # ログインしていない時はsignページ、ログインしている時はhomeページに飛ばす
      if (in_array($path, NOT_AUTHENTICATED_PAGES)) {
        if (Auth::isLogin()) {
          redirect('/');
        }
      } else {
        if (!Auth::isLogin()) {
          redirect('signin');
        }
      }

      require_once($targetFile);

      # 該当のコントローラファイルにおいて、メソッドに対応した関数を呼び出す
      $targetname = str_replace('/', '\\', $path);
      $fn = "\\controller{$targetname}\\{$method}";
      $fn();

    } catch(RuntimeException $e) {

      Msg::push(Msg::DEBUG, $e->getMessage());
      redirect('404');

    }
  }
}