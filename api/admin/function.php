<?php
require '../../includes/dbcon.php';

function getCustomerList () {
    global $conn;

    $query = "SELECT * FROM customers";
    $result = mysqli_query($conn, $query);

    if ($result) {

        if (mysqli_num_rows($result) > 0) {

            $response = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'Customer List Fetch Successfully',
                'data' => $response
            ];

            http_response_code(200);
            echo json_encode($data);
        }
        else {

            $data = [
                'status' => 404,            
                'message' => 'No Customer found'
            ];
            http_response_code(404);
            echo json_encode($data);
        }
    }
    else {

        $data = [
            'status' => 500,
            'message' => 'Internal Server Error'
        ];
        http_response_code(500);
        echo json_encode($data);
    }
}




?>