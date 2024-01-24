<?php

require 'connection.php';

//error message 

function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}


//delete student

function deleteStudent($studentparams){
 
    global $conn;

    if(!isset($studentparams['id'])){
        return error422("Student id not found in url ");
    }elseif($studentparams['id'] == null){
    return error422("Enter the student id");
    }

    $studentid = mysqli_real_escape_string($conn, $studentparams['id']);
    $query = "DELETE FROM `division_1` WHERE `id` = '$studentid' LIMIT 1";
    $result = mysqli_query($conn ,$query);

    if($result){

        $data = [
            'status' => 200,
            'messag' => 'Student deleted successfully',
        ];
        header("HTTP/1.0 200  success");
        return json_encode($data);

    }else{
        $data = [
            'status' => 404,
            'messag' => 'Student not found',
        ];
        header("HTTP/1.0 400  Not found");
        return json_encode($data);
    }


}

//Update Student list

function updateStudent($studentInput, $studentparams){

    global $conn;

    if(!isset($studentparams['id'])){
        return error422('student id not found in url');
    }elseif($studentparams['id'] == null){
        return error422('Enter the student id');
    }

    $studentid = mysqli_real_escape_string($conn, $studentparams['id']); 
    $studentname = mysqli_real_escape_string($conn, $studentInput['student_name']);
    $studentclass = mysqli_real_escape_string($conn, $studentInput['student_class']);
    $rollno = mysqli_real_escape_string($conn, $studentInput['roll_no']);
    $teachername = mysqli_real_escape_string($conn, $studentInput['teacher_name']);
    $parentname = mysqli_real_escape_string($conn, $studentInput['parent_name']);
    $parentph = mysqli_real_escape_string($conn, $studentInput['parent_ph']);

    if(empty(trim($studentname))){
     return error422('Enter the student name');
    }elseif(empty(trim($studentclass))){
        return error422('Enter the student class');
    }elseif(empty(trim($rollno))){
        return error422('Enter the rollno');
    }elseif(empty(trim($teachername))){
        return error422('Enter the teacher name');
    }elseif(empty(trim($parentname))){
        return error422('Enter the parent name');
    }elseif(empty(trim($parentph))){
        return error422('Enter the parent ph');
    }else{

       $query = "UPDATE `division_1` SET `student_name` = '$studentname', `student_class` ='$studentclass' , `roll_no` = '$rollno', `teacher_name` = '$teachername', `parent_name` = '$parentname', `parent_ph` ='$parentph' WHERE `id` = $studentid LIMIT 1";
       $result = mysqli_query($conn, $query);

     if($result){
  
        $data = [
            'status' => 200,
            'message' => 'Student Created Successfully',
        ];
        header("HTTP/1.0 200 Created");
        echo json_encode($data);
         

     }else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
     }

    }

}


//postFunction

function storeStudent($studentInput){

    global $conn;

    $studentname = mysqli_real_escape_string($conn, $studentInput['student_name']);
    $studentclass = mysqli_real_escape_string($conn, $studentInput['student_class']);
    $rollno = mysqli_real_escape_string($conn, $studentInput['roll_no']);
    $teachername = mysqli_real_escape_string($conn, $studentInput['teacher_name']);
    $parentname = mysqli_real_escape_string($conn, $studentInput['parent_name']);
    $parentph = mysqli_real_escape_string($conn, $studentInput['parent_ph']);

    if(empty(trim($studentname))){
     return error422('Enter the student name');
    }elseif(empty(trim($studentclass))){
        return error422('Enter the student class');
    }elseif(empty(trim($rollno))){
        return error422('Enter the rollno');
    }elseif(empty(trim($teachername))){
        return error422('Enter the teacher name');
    }elseif(empty(trim($parentname))){
        return error422('Enter the parent name');
    }elseif(empty(trim($parentph))){
        return error422('Enter the parent ph');
    }else{

       $query = "INSERT INTO `division_1`(`student_name`, `student_class`, `roll_no`, `teacher_name`, `parent_name`, `parent_ph`) VALUES ('$studentname','$studentclass','$rollno','$teachername','$parentname','$parentph')";
       $result = mysqli_query($conn, $query);

     if($result){
  
        $data = [
            'status' => 201,
            'message' => 'Student Created Successfully',
        ];
        header("HTTP/1.0 201 Created");
        echo json_encode($data);
         

     }else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
     }

    }

}


//getFunction

function getStudentList(){
 
global $conn;

$query = "SELECT * FROM `division_1`";
$query_run = mysqli_query($conn ,$query);

if($query_run){

if(mysqli_num_rows($query_run) > 0){

$res = mysqli_fetch_all($query_run,MYSQLI_ASSOC);

$data = [
    'status' => 200,
    'message' => 'Student List Fetched Successfully',
     'data' => $res
];
header("HTTP/1.0 200  Success");
return json_encode($data);

}else{
    $data = [
        'status' => 404,
        'messag' => 'No Student Found',
    ];
    header("HTTP/1.0 404  No Student Found");
    return json_encode($data);
}

}else{
    $data = [
        'status' => 500,
        'messag' => 'Internal Server Error',
    ];
    header("HTTP/1.0 500  Internal Server Error");
    return json_encode($data);
}

}

?>