<?php

namespace Monitor\Import;

class Inserter
{

  protected $reader;

  public function __construct(Reader $reader)
  {
    $this->reader = $reader;
  }

  public function insert()
  {
    $pdo = \Monitor\Database::instance();

    $a = "INSERT INTO probes (`mac`, `datetime`, `station`) VALUES (:mac, :datetime, :station)";
    $stmt_probe = $pdo->prepare($a);

    $b = "INSERT IGNORE INTO networks (`mac`, `name`) VALUES (:mac, :name)";
    $stmt_network = $pdo->prepare($b);

    foreach ($this->reader as $probe) {  
      $stmt_probe->bindParam(':mac', $probe->macAsInt());
      $stmt_probe->bindParam(':datetime', $probe->lastSeen);
      $stmt_probe->bindParam(':station', $probe->stationAsInt());
      $stmt_probe->execute();
      foreach ($probe->networks as $name) {
        $stmt_network->bindParam(':mac', $probe->macAsInt());
        $stmt_network->bindParam(':name', $name);
        $stmt_network->execute();
      }
    }
  }

}