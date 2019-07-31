<?php
  class Database {
    //Database Parameters
    private $host = 'localhost';
    private $db_name = 'school';
    private $username = 'terry';
    private $password = 'terry12345';
    private $conn;

    //connect
    public function connect(){
      $this->conn = null;

      try {

        $this->conn = new PDO('pgsql:host=' . $this->host . ';dbname= ' . $this->db_name,
        $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      } catch (PDOException $e) {
        echo 'Connection error: ' .$e->getMessage();
      }
      return $this->conn;
    }
  }
