<?php

require_once '../vendor/autoload.php';

$reader   = new \Monitor\Import\Reader('../test-01.csv');
$inserter = new \Monitor\Import\Inserter($reader);
$inserter->insert();
