<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Student.php';

  //Inst DB and connect
  $database = new Database();
  $db = $database->connect();
  //inst student object
  $student = new Student($db);

  //get raw data
  $data = json_decode(file_get_contents("php://input"));

  $student->name = $data->name;
  $student->course = $data->course;

  //create student
  if($student->addStudent()){
    echo json_encode(array('message' => 'Student added'));
  }else{
    echo json_encode(array('message' => 'Failed to add student'));
  }
