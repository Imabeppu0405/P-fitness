<?php
function get_param($key, $default_val, $is_post = true)
{
  $arry = $is_post ? $_POST : $_GET;
  return $arry[$key] ?? $default_val;
}

function redirect($path, $params = array())
{
  if($path === GO_HOME) {
    $path = get_url('');
  } else if($path === GO_REFERER) {
    $path = $_SERVER['HTTP_REFERER'];
  } else {
    $path = get_url($path);
  }

  $path = strstr($path, '?', true) ?? $path;

  if($params) {
    $get_param = '?';
    foreach($params as $key => $param) {
      $get_param .= "$key=$param&";
    }
    $path .= substr($get_param, 0, -1);
  }
  header("Location: {$path}");

  die();
}

function the_url($path)
{
  echo get_url($path);
}

function get_url($path)
{
  return '/' . trim($path, '/');
}