<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/employees.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Employee($db);

    $data = $_REQUEST;

    $item->name = ( isset($data['name']) ) ? $data['name'] : "";
    $item->email = ( isset($data['email']) ) ? $data['email'] : "";
    $item->score = (isset($data['score'])) ? $data['score'] : "";
    $item->password = (isset($data['password'])) ? $data['password'] : "";
    
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createEmployee()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>