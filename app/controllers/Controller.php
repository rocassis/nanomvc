<?php

namespace app\controllers;

use core\classes\BaseController;

/*
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/9 22:02
 * File: Controller.php
 * Description: General Controller, this controller can be customized 
 * to access control and other purposes.
 *
 * Copyright (c) 2021 
 */

class Controller extends BaseController
{

  protected $_viewData = [];

  public function __construct()
  {
    parent::__construct();
  }


}
