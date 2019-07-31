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

  //student $query
  $result = $student->getStudents();

  //row Count
  $num = $result->rowCount();

  //check if there are students
  if ($num > 0) {
    $students_arr = array();
    $students_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $student_item = array(
          'id'=> $id,
          'name'=> $name,
          'course'=> $course
        );
        array_push($students_arr['data'], $student_item);
    }
    //convert to json
    echo json_encode($students_arr);
  }else {
    echo json_encode(array('message' => 'No Students Found'));
  }
