<?php

use core\classes\BaseApi;

class Api extends BaseApi{

  public function index()
  {
    $dados = $this->nanoParamsGet();

    // $this->nanoJsonResponse($dados);
    $this->nanoResponse($dados);
  }

  public function getparam()
  {
    $dado = $this->nanoGetParam('nome');

    $this->nanoJsonResponse($dado, 400);
  }

  public function postparam()
  {
    $dados = $this->nanoParamsPost();

    // $this->nanoJsonResponse($dados);
    $this->nanoResponse($dados);
  }
}