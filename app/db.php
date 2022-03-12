<?php
class Db {
  public function __construct() {
//    $this->db = new SQLite3("../db/db.sqlite3");
    require_once "helpers.php" 
    $this->book = new helper_table("books");
    $this->tag = new helper_table("tags");
    $this->rates = new helper_table("rates");
  }


}