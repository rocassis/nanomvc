<?php
/*
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/14 21:52
 * File: Model.php
 * Description: 
 *
 * Copyright (c) 2021 
 */

namespace app\models;

use core\classes\BaseModel;
use core\libs\TutsupDB;
use Exception;

class Model extends BaseModel
{
  public $dataBase;
  public function __construct()
  {
    parent::__construct();

    $this->dataBase = new TutsupDB(DEFAULT_CONNECTION);
  }

  protected function nanoSelect($query, $bind_params = null)
  {
    $query = $this->dataBase->query($query, $bind_params);
    if (!$query) {
      throw new Exception($this->dataBase->error);
      return;
    }
    return $query->fetchAll();
  }

  protected function nanoInsert()
  {
  }

  protected function nanoUpdate()
  {
  }

  protected function nanoDelete()
  {
  }
}
