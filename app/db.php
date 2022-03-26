<?php
class Db {
  public function __construct() {
    unlink("../db/db.sqlite3"); // TODO remove line
    $this->db = new SQLite3("../db/db.sqlite3");
    require_once "db_helpers.php";
    $this->books = new HelperTable("books", $this->db);
    $this->tags = new HelperTable("tags", $this->db);
    $this->rates = new HelperTable("rates", $this->db);

    if (filesize("../db/db.sqlite3") == 0) $this->seed();
  }
  private function seed() {
    $table_defs = [
        "create table books (id integer primary key autoincrement, name text)",
        "create table tags (id integer primary key autoincrement, parent_id integer not null, name text)",
        "create table rates (id integer primary key autoincrement, book_id integer, score integer)",
    ];

    foreach($table_defs as $def) $this->db->query($def);
    $this->books
      ->add(["name" => "Буратино"])
      ->add(["name" => "Pinoccio"])
      ->add(["name" => "Понедельник начинается в субботу"]);

    $this->tags
      ->add(["id" => 1, "parent_id" => 0, "name" => "Программирование"])
      ->add(["id" => 2, "parent_id" => 1, "name" => "С++"])
      ->add(["id" => 3, "parent_id" => 1, "name" => "Java"])
      ->add(["id" => 4, "parent_id" => 0, "name" => "Дизайн"])
      ->add(["id" => 5, "parent_id" => 4, "name" => "Ландшафтный"]);

    $this->rates
      ->add(["book_id" => 1, "score" => 4])
      ->add(["book_id" => 2, "score" => 3])
      ->add(["book_id" => 1, "score" => 5]);

//    TODO: remove debug code
//    $results = $this->db->query("select * from rates");
//    while ($row = $results->fetchArray()) {
//      var_dump($row);
//    }  
  }


}