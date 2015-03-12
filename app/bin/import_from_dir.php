<?php

require_once '../vendor/autoload.php';

$options = getopt('d:h');
if(isset($options['h']) || !isset($options['d'])){
    echoHelp();
    exit;
}

foreach (new DirectoryIterator($options['d']) as $file) {
    if($file->getExtension() != 'csv'){
        continue;
    }
    echo $file->getPathname().PHP_EOL;
    $reader   = new \Monitor\Import\Reader($file->getPathname());
    $inserter = new \Monitor\Import\Inserter($reader);
    $inserter->insert();

    rename($file->getPathname(), $file->getPathname().".imported");

}


function echoHelp()
{
    echo 'imports all .csv files from a directory'.PHP_EOL;
    echo "\t All parsed files will be renamed to .csv.imported".PHP_EOL;
    echo "\t Get files from source location, e.g.".PHP_EOL;
    echo "\t\t rsync -avt --remove-source-files user@ip:path/*.csv path/".PHP_EOL;
    echo "\t\t note that this might remove a file that is still being written to!".PHP_EOL;
    echo "\t Usage: php import_from_dir.php -d <directory>".PHP_EOL;
}
