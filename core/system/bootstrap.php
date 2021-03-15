<?php

require_once 'config/config.php';

// Avoid direct access
if (!defined('ABSPATH')) exit;

// Check debug mode
if (!defined('DEBUG') || DEBUG === false) {

  // Hide all errors
  error_reporting(0);
  ini_set("display_errors", 0);
} else {

  // Show all erros
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
}

/**
 * Check array key
 *
 * Check if array key exists and if has a value.
 * Obs: global escope function.
 * 
 * @param array  $array Array
 * @param string $key   Array key
 * @return string|null  Array key value or null
 */
function chk_array($array, $key)
{
  if (isset($array[$key]) && !empty($array[$key])) {
    return $array[$key];
  }

  return null;
}

/**
 * 
 * Autoload function
 */
spl_autoload_register(function ($class_name) {
  $file = ABSPATH . DIRECTORY_SEPARATOR . $class_name . '.php';
  if (DIRECTORY_SEPARATOR === '/') :
    $file = str_replace('\\', '/', $file);
  endif;

  if (!file_exists($file)) {
    require_once ABSPATH . '/core/system/404.php';
    return;
  }

  require_once $file;
});

/**
 * Load configs files from config folder on root folder.
 * OBS: Can be used globaly or local;
 *
 * @param string $config The file name without extension
 * @return bool
 */
function loadConfig($config = null)
{
  if (!$config || empty($config)) {
    return false;
  }

  if (!file_exists(ABSPATH . '/config/' . $config . '.php')) {
    return false;
  }
  
  require_once ABSPATH . '/config/' . $config . '.php';
  return false;
}

require_once ABSPATH . '/config/loader.php';
