<?php

namespace Monitor\Import;

class Probe
{

  public $mac;
  public $station;
  public $firstSeen;
  public $lastSeen;
  public $networks = array();

  public function __construct(array $data)
  {
    $data = array_map('trim', $data);
    list($this->mac, $this->firstSeen, $this->lastSeen, , , $this->station) = $data;
    if ($this->station == '(not associated)') {
      $this->station = null;
    }
    $this->networks = array_filter(array_slice($data, 6));
  }

  public function macAsInt()
  {
    return base_convert($this->mac, 16, 10);
  }

  public function stationAsInt()
  {
    if ($this->station) {
      return base_convert($this->station, 16, 10);
    }
  }

}