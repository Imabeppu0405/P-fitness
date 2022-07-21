<?php
namespace app\core;

class Session {

  public static function set($name, $val) 
  {
    $_SESSION[$name] = $val;
  }

  public static function get($name, $default = null) 
  {
    return $_SESSION[$name] ?? $default;
  }

  public static function remove($name) 
  {
    static::set($name, null);
  }

  public static function getAndFlush($name) 
  {
    try{
      return static::get($name);
    } 
    finally {
      static::remove($name);
    }
  }
}