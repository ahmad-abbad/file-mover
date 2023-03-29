<?php

class FileMover {

  /**
   * The source path where the files exists
   *
   * @var String
   */
  protected $source;

  /**
   * The destination path where the new directory and files should be inserted
   *
   * @var String
   */
  protected $destination;

  /**
   * Keep the source files
   *
   * @var Boolean
   */
  protected $unlink;

  /**
   * FileMover Class constractor
   *
   * @param String $source
   * @param String $destination
   * @return void
   */
  public function __construct($source, $destination, $unlink) {
    $this->source = $source;
    $this->destination = $destination;
    $this->unlink = $unlink;
  }

  /**
   * Create new directory if not exists
   *
   * @return Boolean
   */
  public function createDir($lang){
    $newDir = $this->destination . '/' . $lang;

    if(is_dir($newDir)) {
      return TRUE;
    }else {
      return mkdir($newDir, 0777, TRUE);
    }
  }

  /**
   * Move the file to the destination
   *
   * @param String $filename
   * @return Boolean
   */
  public function move($filename) {
    $language = explode('-', basename($filename))[0];
    $oldFile = $this->source . '/' . $filename;
    $newFile = $this->destination . '/' . $language . '/' . $filename;
    if(copy($oldFile, $newFile)) {
      if($this->unlink) {
        unlink($oldFile);
      }
      return TRUE;
    }

  }

}