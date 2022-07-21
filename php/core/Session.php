<?php
namespace app\core;

class Session {

  public static function setAuthentication() 
  {
    $_SESSION['_isAutenticated'] = true;
  }

  public static function clearAuthentication() 
  {
    $_SESSION['_isAutenticated'] = false;
  }

  public static function isAuthenticated() 
  {
    return $_SESSION['_isAutenticated'];
  }
  
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