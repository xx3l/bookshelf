<?php
class HelperTable {
  public $ids = [];
  public $exists = null;

  public function __construct(private $table, private $db) {
  }

  public function add($params) : HelperTable {
    foreach($params as $key => &$param) $param = '"'.$param.'"';
    $this->db->query("insert into $this->table 
      (".join(",", array_keys($params)).") values 
      (".join(",", $params).")");
    return $this;
  }

  public function get($id) : HelperTable {
    $results = $this->db->query("select id from $this->table where id=$id");
    if ($row = $results->fetchArray(SQLITE3_ASSOC)) {

      $this->ids[] = $row["id"];
      $this->ids = array_unique($this->ids);
      $this->exists = true;
    } else {
      $this->exists = false;
    }
    return $this;
  }

  public function remove() : HelperTable {
    $results = $this->db->query("delete from $this->table where id in (".join(",", $this->ids).")");
    $this->ids = [];
    return $this;
  }

  public function search($criteria) : HelperTable {
    $where = "and";
    foreach($criteria as $key => &$param) {
      $where .= ' '.$key.' like "%'.$param.'%"';
    }
    if ($where == "and") $where = "";

    $results = $this->db->query("select id from $this->table where 1=1 ".$where);
    $this->ids = [];
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
      $this->ids[] = $row["id"];
    }  
    return $this;
  }

  public function print() {
    $results = $this->db->query("select * from $this->table");
    $result = [];
    while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
      $result[] = $row;
    }  
    return json_encode($result)."\n";
  }
}