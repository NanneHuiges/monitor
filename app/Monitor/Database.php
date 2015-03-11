<?php

namespace Monitor;

class Database
{

  private static $instance;

  private function __construct()
  {
    // not used
  }

  public static function instance()
  {
    if (!static::$instance) {
      return static::$instance = new \PDO('mysql:host=localhost;port=3306;dbname=monitor', 'root', 'root', array(\PDO::ATTR_PERSISTENT => false));
    }
    return static::$instance;
  }

}