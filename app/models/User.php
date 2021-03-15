<?php

namespace app\models;

use app\models\Model;

class User extends Model{

  public function all()
  {
    $q = $this->nanoSelect('SELECT * FROM users;');
    return $q;
  }
}