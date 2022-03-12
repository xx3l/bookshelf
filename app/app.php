<?php
class BookShelfApp {
  private $state;
  private $db;

  public function __construct() {
    require "db.php";
    $this->db = new Db();
    $this->db->book->add($)
    $this->db->list->rate($)
    print "construct";
  }

  public function run() : void {
    $this->dispatch();
    $this->render();
  }

  public function dispatch() : void {
    print "dispatch";
  }

  public function render() : void {
    print "render";
  }
}