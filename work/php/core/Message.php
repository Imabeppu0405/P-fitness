<?php
namespace app\core\Message;

use Error;
use Throwable;

class Msg {
  public const ERROR = 'error';
  public const INFO = 'info';
  public const DEBUG = 'debug';

  # TODO: セッション処理はまとめる
  protected static $SESSION_NAME = '_msg';

  private static function setSession($val) {

    if(empty(static::$SESSION_NAME)) {
      throw new Error('$SESSION_NAMEを設定してください');
    }

    $_SESSION[static::$SESSION_NAME] = $val;
  }

  private static function getSession() {
    var_dump($_SESSION);
    return $_SESSION[static::$SESSION_NAME] ?? null;
  }

  public static function clearSession() {
    static::setSession(null);
  }

  private static function getSessionAndFlush() {
    try{
      return static::getSession();
    } 
    finally {
      return static::clearSession();
    }
  }

  public static function push($type, $msg) {
    if(!is_array(static::getSession())) {
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
        if($type === static::DEBUG && !DEBUG) {
          continue;
        }
        $color = $type === static::INFO ? 'allert-info' : 'alert-danger';

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