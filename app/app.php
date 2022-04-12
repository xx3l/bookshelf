<?php
class BookShelfApp {
  private $state;
  private $db;

  public function __construct() {
    require "db.php";
    $this->db = new Db();
  }

  public function run() : void {
    $this->dispatch();
    $this->render();
  }

  public function dispatch() : void {
//    print "dispatch";
  }

  public function render() : void {
    require "render_template.php";
    $data = ["app_name" => "BookShelf", "year" => date("Y")];
    Render::draw("index", $data);
  }
}