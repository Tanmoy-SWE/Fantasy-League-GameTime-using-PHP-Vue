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

    $item = new Matches($db);

    $data = $_REQUEST;
    $item->date = $data['date']; 
    $item->user = $data['user']; 
    $item->league = $data['league'];
    $item->willWin = $data['willWin']; 
    $item->byGoals = $data['byGoals']; 
    $item->homeName = $data['homeName']; 
    $item->awayName = $data['awayName']; 
    $item->created = date('Y-m-d H:i:s');
    
    if($item->createEmployee()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
?>