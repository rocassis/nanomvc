<?php
/*
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/11 21:07
 * File: BaseApi.php
 * Description: 
 *
 * Copyright (c) 2021 
 */

namespace core\classes;

class BaseApi
{

  /**
   * Return the parameters from URL
   *
   * @return array Array containing the parameters received from get
   */
  protected function nanoParamsGet()
  {
    $params = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
    unset($params['path']);
    return $params;
  }

  /**
   * Return the specified param from URL, has a filter 
   *
   * @param string $paramName
   * @param mixed $filter Type of filter to sanitize de parameter, use PHP Filter Constants value
   * @return mixed The value from get parameters, value type depends of filter type
   */
  protected function nanoGetParam($paramName, $filter = FILTER_SANITIZE_STRING)
  {
    if (!$paramName || empty($paramName)) {
      return false;
    }

    $params = filter_input(INPUT_GET, $paramName, $filter);
    return $params;
  }

  /**
   * Return params received from a POST request
   *
   * @return array Array containing the parameters received from post
   */
  protected function nanoParamsPost()
  {
    $params = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    return $params;
  }

  /**
   * Returns the json received, can return as array or object
   *
   * @param boolean $array Default value 'true', returns array. To return object the value mest be 'false'.
   * @return mixed
   */
  protected function nanoParamsJson($array = true)
  {
    $params = json_decode(file_get_contents('php://input'), $array);
    return $params;
  }

  /**
   * Response Json function, suports Http Status Code indication. Return a response in json format for requests
   *
   * @param mixed $data Can be passed String, arrays, objects
   * @param integer $httpStatusCode The corresponding http status code, by default the value is 200
   * @return void
   */
  protected function nanoJsonResponse($data, $httpStatusCode = 200)
  {
    header('Content-Type: application/json; charset=UTF8');
    http_response_code($httpStatusCode);
    echo json_encode($data);
    die();
  }

  protected function nanoResponse()
  {
    // TODO
  }
}
