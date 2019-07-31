<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Student.php';

  //Inst DB and connect
  $database = new Database();
  $db = $database->connect();
  //inst student object
  $student = new Student($db);
  //Get id
  $student->id = isset($_GET['id']) ? $_GET['id'] : die();
  $student->getStudent();

  $student_arr = array(
    'id' => $student->id,
    'name' => $student->name,
    'course' => $student->course
  );

  print_r(json_encode($student_arr));
