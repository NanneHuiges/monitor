<?php

namespace Monitor;

class Application
{

  public static function run()
  {
    $home = new Controller\Home;
    echo $home->render();
  }

}