<?php
class BookShelfApp {
  private $state;
  private $db;

  public function __construct() {
    require "db.php";
    $this->db = new Db();
  }

  public function run() : void {
    print $this->db->books->print();
    $this->db->books->search(["name"=>"о"])->remove();
    print_r($this->db->books->ids);
    print $this->db->books->print();
//    print $this->db->tags->print();
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