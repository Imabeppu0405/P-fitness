<?php
namespace app\core\Message;

use model\AbstractModel;
use Throwable;

class Msg extends AbstractModel {
  public const ERROR = 'error';
  public const INFO = 'info';
  public const DEBUG = 'debug';
  
  protected static $SESSION_NAME = '_msg';

  public static function push($type, $msg) {
    if (!is_array(static::getSession())) {

      static::init();

    }

    $msgs = static::getSession();
    $msgs[$type][] = $msg;
    static::setSession($msgs);
  }

  public static function flush() {
    try {

      $msgs_with_types = static::getSessionAndFlush() ?? [];

      echo '<div id="messages">';

      foreach($msgs_with_types as $type => $msgs) {

        # 本番環境では、デバックエラーは表示させない
        if ($type === static::DEBUG && !DEBUG) {
          continue;
        }

        $color = $type === static::INFO ? 'alert-info' : 'alert-danger';

        foreach($msgs as $msg) {
          
          echo "<div class='alert {$color}'>{$msg}</div>";

        }
      }

      echo '</div>';
    } catch (Throwable $e) {

      Msg::push(Msg::DEBUG, $e->getMessage());
      Msg::push(Msg::DEBUG, 'Msg:flush()での例外です。');

    }
  }

  private static function init() {
    static::setSession([
      static::ERROR => [],
      static::INFO  => [],
      static::DEBUG => []
    ]);
  }
}