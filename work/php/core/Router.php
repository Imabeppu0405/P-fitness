<?php 

namespace app\core;

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
    $path = $this->request->getPath();
    $method = $this->request->getMethod();

    $targetFile = SOURCE_BASE . "controllers{$path}.php";
    require_once($targetFile);
    $targetname = str_replace('/', '\\', $path);
    $fn = "\\controller{$targetname}\\{$method}";
    $fn();
  }
}