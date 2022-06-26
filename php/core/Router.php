<?php 

namespace app\core;

use app\core\Message\Msg;
use Throwable;

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

      require_once($targetFile);

      # 該当のコントローラファイルにおいて、メソッドに対応した関数を呼び出す
      $targetname = str_replace('/', '\\', $path);
      $fn = "\\controller{$targetname}\\{$method}";
      $fn();

    } catch(Throwable $e) {

      Msg::push(Msg::DEBUG, $e->getMessage());
      redirect('404');

    }
  }
}