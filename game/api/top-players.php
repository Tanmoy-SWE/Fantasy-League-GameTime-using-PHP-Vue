<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/employees.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Employee($db);

    $stmt = $items->getEmployees();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $employeeArr = array();
       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "score" => $score,
                "created" => $created
            );

            array_push($employeeArr, $e);
        }
        echo json_encode($employeeArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("messscore" => "No record found.")
        );
    }
?>