<?php
/*
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/8 21:58
 * File: Mvc.php
 *
 * Copyright (c) 2021 
 */
namespace core\system;

class NanoMVC
{

  /**
   * $controller
   *
   * Store the controller object
   *
   * @access private
   */
  private $controller;

  /**
   * $action
   *
   * Store the action from the url
   *
   * @access private
   */
  private $action;

  /**
   * $parameters
   *
   * Store the parameters get from the url
   *
   * @access private
   */
  private $parameters;

  /**
   * $not_found
   *
   * Path to 404 page
   *
   * @access private
   */
  private $not_found = '/core/system/404.php';

  public function __construct()
  {
    $this->getUrlData();
    $this->controllerLoad();
  }

  /**
   * Get the parameter from $_GET['path']  and set the properties
   * $this->controller, $this->action e $this->parameters
   *
   * URL format like:
   * http://www.example.com/controller/action/param1/param2/etc...
   */
  private function getUrlData()
  {
    if (isset($_GET['path'])) {

      $path = $_GET['path'];

      $path = rtrim($path, '/');
      $path = filter_var($path, FILTER_SANITIZE_URL);
      $path = explode('/', $path);

      $this->controller  = ucfirst(chk_array($path, 0));
      $this->action        = chk_array($path, 1);

      if (chk_array($path, 2)) {
        unset($path[0]);
        unset($path[1]);

        $this->parameters = array_values($path);
      }
    }
  }

  /**
   * Load the controller according with the data get in the url
   *
   * @return mixed
   */
  private function controllerLoad()
  {
    /**
     * Check if a controller was setted, if not add the inicital default controller
     * setted in config file
     */
    if (!$this->controller) {
      // Add the default controller
      require_once ABSPATH . '/app/controllers/' . INITIAL_CONTROLLER . '.php';
      // Cretae object with the instance of the controller setted to
      // home of the application
      $class = INITIAL_CONTROLLER;
      $this->controller = new $class();
      // Execute the index function or other function defined as initial
      $function = INITIAL_FUNCTION;
      $this->controller->$function();
      return;
    }

    // If the controller not exist, redirect to a 404 page
    if (!file_exists(ABSPATH . '/app/controllers/' . $this->controller . '.php')) {
      $this->fileNotFound();
    }

    // Inclui o arquivo do controller
    require_once ABSPATH . '/app/controllers/' . $this->controller . '.php';

    $this->controller = preg_replace('/[^a-zA-Z]/i', '', $this->controller);

    // If class not exists, redirect to a 404 page
    if (!class_exists($this->controller)) {
      $this->fileNotFound();
    }

    // Create the class object and send the parameters
    $this->controller = new $this->controller($this->parameters);

    // Remove special characters from the method/function name
    $this->action = preg_replace('/[^a-zA-Z]/i', '', $this->action);

    if (method_exists($this->controller, $this->action)) {
      $this->controller->{$this->action}($this->parameters);
      return;
    }

    if (!$this->action && method_exists($this->controller, 'index')) {
      $this->controller->index($this->parameters);

      return;
    }

    // By default send to 404 page
    $this->fileNotFound();
  }

  /**
   * Load the 404 file
   *
   * @return void
   */
  private function fileNotFound()
  {
    require_once ABSPATH . $this->not_found;
    die();
  }
}