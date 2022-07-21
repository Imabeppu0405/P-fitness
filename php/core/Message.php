<?php
namespace app\core\Message;

use app\core\Session;
use Throwable;

class Msg  {
  public const ERROR = 'error';
  public const INFO = 'info';
  public const DEBUG = 'debug';

  public static function push($type, $msg) {
    if (!is_array(Session::get('_msg'))) {

      static::init();

    }

    $msgs = Session::get('_msg');
    $msgs[$type][] = $msg;
    Session::set('_msg', $msgs);
  }

  public static function flush() {
    try {

      $msgs_with_types = Session::getAndFlush('_msg') ?? [];

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
    Session::set('_msg', [
      static::ERROR => [],
      static::INFO  => [],
      static::DEBUG => []
    ]);
  }
}