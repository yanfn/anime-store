<?php

require "../../includes/dbcon.php";

function error422 ($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    http_response_code(422);
    return json_encode($data);
    exit();
}

function storeCustomer ($customerInput) {
    
    global $conn;

    $role = 'customer';
    $email = mysqli_real_escape_string($conn, $customerInput['email']);
    $password = mysqli_real_escape_string($conn, $customerInput['password']);
    $fname = mysqli_real_escape_string($conn, $customerInput['fname']);
    $lname = mysqli_real_escape_string($conn, $customerInput['lname']);
    $sex = mysqli_real_escape_string($conn, $customerInput['sex']);
    $raw_date = mysqli_real_escape_string($conn, $customerInput['date']);
    $phone = mysqli_real_escape_string($conn, $customerInput['phone']);
    $region = mysqli_real_escape_string($conn, $customerInput['region']);
    $province = mysqli_real_escape_string($conn, $customerInput['province']);
    $city = mysqli_real_escape_string($conn, $customerInput['city']);
    $barangay = mysqli_real_escape_string($conn, $customerInput['barangay']);
    $zipcode = mysqli_real_escape_string($conn, $customerInput['zipcode']);
    
    $birthdate = date('Y-m-d', strtotime($raw_date));

    if (empty(trim($email))) {
        return error422('Enter your email');
    }elseif (empty(trim($password))) {
        return error422('Enter your password');
    }elseif (empty(trim($fname))) {
        return error422('Enter your first name');
    }elseif (empty(trim($lname))) {
        return error422('Enter your last name');
    }elseif (empty(trim($sex))) {
        return error422('Enter your sex');
    }elseif (empty(trim($birthdate))) {
        return error422('Enter your birthdate');
    }elseif (empty(trim($phone))) {
        return error422('Enter your phone');
    }elseif (empty(trim($region))) {
        return error422('Enter your region');
    }elseif (empty(trim($province))) {
        return error422('Enter your province');
    }elseif (empty(trim($city))) {
        return error422('Enter your city');
    }elseif (empty(trim($barangay))) {
        return error422('Enter your barangay');
    }elseif (empty(trim($zipcode))) {
        return error422('Enter your zipcode');
    }
    else {
        $user_query = "INSERT INTO users (email, password, fname, lname, sex, birthdate, role) VALUES ('$email', '$password', '$fname', '$lname', '$sex', '$birthdate', '$role')";
        $user_result = mysqli_query($conn, $user_query);


           if ($user_result) {

            $customer_id = mysqli_insert_id($conn);

            $address_query = "INSERT INTO customer_address (customer_id, phone_number, region, province, city, barangay, zip_code) VALUES ('$customer_id', '$phone', '$region', '$province', '$city', '$barangay', '$zipcode')";
            $address_result = mysqli_query($conn, $address_query);

            if ($address_result) {
                $data = [
                    'status' => 201,
                    'message' => 'Account created successfully',
                    'customer' => [
                        'id' => $customer_id,
                        'fname' => $fname,
                        'lname' => $lname,
                        'sex' => $sex,
                        'birthdate' => $birthdate,
                        'phone_number' => $phone,
                        'address' => [
                            'phone' => $phone,
                            'region' => $region,
                            'province' => $province,
                            'city' => $city,
                            'barangay' => $barangay,
                            'zip_code' => $zipcode
                        ]
                    ]
                ];
                http_response_code(201);
                return json_encode($data);
            }
            else {
                $data = [
                    'status' => 500,
                    'message' => 'Internal server error'
                ];
                http_response_code(500);
                return json_encode($data);
            }
        }
        
    }
}

?>