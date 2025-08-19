<?php

namespace App\Core;

class Controller
{
  protected $view;

  public function __construct()
  {
    $this->view = new View(); // Instantiate the View class
  }

  protected function view($view, $data = [], $layout = 'layout')
  {
    echo $this->view->render($view, $data, $layout);
  }
}