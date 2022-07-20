<?php 

namespace app\core;

class View
{
  public static function render($path, $variables = array(), $is_layout = false)
  {
    $file = SOURCE_BASE . 'views/' . $path . '.php';

    extract($variables);

    ob_start();
    ob_implicit_flush(false);

    require $file;

    $content = ob_get_clean();

    if ($is_layout) {
      $content = self::render('layout', array(
        'content' => $content,
      ));
    }

    echo $content;
  }
}