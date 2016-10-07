<?php

/**
*
*/
class Dbfixture extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    if (is_cli() === false) {
      exit();
    }
  }

  public function migrate() {
    $this->load->library('migration');
    if($this->migration->current() === false) {
      echo $this->migration->error_string() . PHP_EOL;
    }
  }
}