<?php

  class Student{
    private $conn;
    private $table = 'students';

    public $id;
    public $name;
    public $course;

    //constructor
    public function __construct($db){
      $this->conn = $db;
    }
    //get all students
    public function getStudents(){
      $query = 'SELECT id, name, course FROM ' . $this->table . '';
      $stmt = $this->conn->prepare($query);
      //execute query
      $stmt->execute();
      return $stmt;
    }
    //Get single student
    public function getStudent(){
        $query = 'SELECT id, name, course FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //bind id to "?"
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH__ASSOC);
        //set properties
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->course = $row['course'];
    }
    //add student
    public function addStudent(){
      $query = 'INSERT INTO ' . $this->table . ' ( name, course) VALUES ( :name, :course);';
      $stmt = $this->conn->prepare($query);

      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->course = htmlspecialchars(strip_tags($this->course));

      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':course', $this->course);

      if($stmt->execute()){
        return true;
      }
      //print error
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
    //update a student
    public function updateStudent(){
      $query = 'UPDATE ' . $this->table . ' SET name = :name, course = :course WHERE id = :id;';
      $stmt = $this->conn->prepare($query);
      
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->course = htmlspecialchars(strip_tags($this->course));
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':name', $this->name);
      $stmt->bindParam(':course', $this->course);

      if($stmt->execute()){
        return true;
      }
      //print error
      printf("Error: %s.\n", $stmt->error);
      return false;
    }
    //Delete student
    public function deleteStudent(){
    
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    
    }

  }
