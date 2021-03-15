<?php

namespace core\classes;

use core\libs\NanoLog;
use Exception;

/*
 * DON'T DELETE THIS FILE!
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/9 22:02
 * File: Controller.php
 * Description: Base controller, needs to be inherited by the other controllers.
 * This controller contains generic controller functions
 *
 * Copyright (c) 2021 
 */

class BaseController
{

  /**
   * Object to NanoLog instance
   *
   * @var mixed
   */
  protected $nanoLog;

  public function __construct()
  {
    $this->nanoLog = new NanoLog(LOG_PATH . LOG_FILE_NAME);
  }

  /**
   * Store log from Exception object
   *
   * @param Exception $exception Object of Exception class
   * @return void
   */
  protected function nanoLogException(Exception $exception)
  {
    $this->nanoLog->exceptionHandler($exception);
  }

  /**
   * Basic function for record a log
   *
   * @param string $message
   * @param array $context Must have follow index code, file, line, trace and type as index. Eg:. ['type' => 'Warning','code' => 101, 'file' => 'class.php', 'line' => 2, 'trace' => 'foo bar']
   * @return void
   */
  protected function nanoLogCustom($message, $context = [])
  {
    $this->nanoLog->logBasic($message, $context);
  }

  protected function nanoLogManual($message, $type = null, $file = null, $line = null, $code = null, $trace = null)
  {
    $this->nanoLog->manual_log($message, $type = null, $file = null, $line = null, $code = null, $trace = null);
  }

  protected function nanoRedirect($pagePath){}

  /**
   * Simple function to load view file with suport to variables
   *
   * @param string $view Eg:. 'folder.filename' or 'filename';
   * @param array $data Array containing the variables to use in view file
   * @return void 
   */
  protected function nanoView($view, $data = [])
  {
    $viewFile = str_replace('.', '/', $view) . '.php';
    $viewPath = VIEWS . $viewFile;
    if (!$viewPath) {
      require_once ABSPATH . '/core/system/404.php';
      return;
    }
    header('Content-Type: text/html; charset=UTF8');
    (empty($data)) ?: extract($data);
    ob_get_clean();
    ob_start();
    include_once($viewPath);
    exit();
  }
}
