<?php

use app\controllers\Controller;
use app\models\User;

/*
 * IF DELETE THIS FILE, ADJUSTE DEFINE VALUES OF 'INITIAL_CONTROLLER' AND 
 * 'INITIAL_FUNCTION', TO NOT CRASH THE SYSTEM.
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/9 22:35
 * File: Home.php
 * Description: 
 *
 * Copyright (c) 2021 
 */

class Home extends Controller
{
  
  public function index()
  {
    $user = new User();
    $data = ['title' => 'House of caralho'];
    $data['users'] = $user->all();
    
    $this->nanoView('home.home-view', $data);
  }



} 