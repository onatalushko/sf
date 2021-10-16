<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DefaultController {

  /**
   * @Route("/hello", name="app_hello")
   */
  public function hello()
  {
    return new Response("Simple hello!");
  }

  /**
   * @Route("/hello/{name}", name="app_hello_name")
   */
  public function index($name = NULL)
  {
    return new Response("Hello $name!");
  }

}