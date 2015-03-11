<?php

namespace Monitor\Import;

class Reader implements \Iterator
{

  protected $file;
  protected $handle;
  protected $line;
  protected $started = false;

  public function __construct($file)
  {
    $this->file = $file;
    if (!file_exists($file)) {
      throw new \Exception('Error reading file');
    }
  }

  public function current()
  {
    if (is_array($this->line)) {
      return new Probe($this->line);
    }
  }

  public function key()
  {
    return 0;
  }

  public function next()
  {
    if (!$this->handle) {
      return;
    }
    $this->line = fgetcsv($this->handle);

    while ($this->line !== false && count($this->line) < 3) {
      $this->next();
    }
  }

  public function rewind()
  {
    if ($this->handle) {
      fclose($this->handle);
    }
    $this->handle = fopen($this->file, 'r');
    for (; $this->valid(); $this->next()) {
      $current = $this->current();
      if ($current && reset($current) == 'Station MAC') {
        $this->next();
        break;
      }
    }
  }

  public function valid()
  {
    return $this->line !== false;
  }

}