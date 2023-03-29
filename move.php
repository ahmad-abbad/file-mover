<?php

require('FileMover.php');

$file_mover = new FileMover($argv[1], $argv[2], $argv[3]);
$files = scandir('/home/abbad/Downloads/files/files');
array_shift($files);
array_shift($files);
$languages = [];

foreach ($files as $key => $file) {

  $language = explode('-', basename($file))[0];
  if($file_mover->createDir($language) && !in_array($language, $languages)) {
    $languages[] = $language;
    print "========================================\n";
    print 'Create directory: ' . $language . "\n";
    print "========================================\n";
  }
  if($file_mover->move($file)){
    print 'Moving file name: '. $file . "\n";
  }
}

