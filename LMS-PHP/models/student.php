<?php

include_once("../config/database.php");
include_once("../config/config.php");


// Function to create student
function storeStudents($conn, $param)
{

    extract($param);
    // validation start
    if (empty($name)) {
        $result = array("error" => "name is required");
        return $result;
    } elseif (empty($email)) {
        $result = array("error" => "email is required");
        return $result;
    } elseif (empty($phone_no)) {
        $result = array("error" => "Phone Number is required");
        return $result;
    } elseif (empty($address)) {
        $result = array("error" => "address is required");
        return $result;
    } elseif (isphoneuniue($conn, $phone_no)) {
        $result = array("error" => "Phone Number is already registered");
        return $result;
    } elseif (UniqueEmail($conn,  $email)) {
        $result = array('error' => 'email is already registered');
        return $result;
    } elseif (mobilelegnthchecker($phone_no)) {
        $result = array('error' => 'Please enter a Valid Number');
        return $result;
    }
    // validation end

    $datetime = DATE('y-m-d h:i:s');

    $sql = "INSERT INTO students(name, phone_no, email, address, created_at) 
            VALUES('$name', '$phone_no', '$email', '$address', '$datetime')";

    return $result['success'] =  $conn->query($sql);
}





// Function to get categories
function getCategories($conn)
{
    $sql = 'SELECT * FROM categories';
    $result = $conn->query($sql);
    return $result;
}




// function to get all students
function getStudents($conn)
{
    $sql  = "SELECT * from students ORDER BY id DESC";
    $result = $conn->query($sql);
    return $result;
}

// function to delete a students
function deletestudent($conn, $id)
{
    $sql = "DELETE FROM students WHERE id= $id";
    $result = $conn->query($sql);
    return $result;
}



// function updatestudents status
function updatestudent($conn, $id, $status)
{
    $sql = "Update students SET status = $status WHERE id= $id";
    $result = $conn->query($sql);
    return $result;
}


// function to get Students details
function getStudentById($conn, $id)
{
    $sql  = "SELECT * from students WHERE id= $id ";
    $result = $conn->query($sql);
    return $result;
}



// Function to update Book
function updatingstudent($conn, $param)
{

    extract($param);
    // validation start
    if (empty($name)) {
        $result = array("error" => "name is required");
        return $result;
    } elseif (empty($email)) {
        $result = array("error" => "email is required");
        return $result;
    } elseif (empty($phone_no)) {
        $result = array("error" => "Phone Number is required");
        return $result;
    } elseif (empty($address)) {
        $result = array("error" => "address is required");
        return $result;
    } elseif (isphoneuniue($conn, $phone_no, $id)) {
        $result = array("error" => "Phone is already registered");
        return $result;
    } elseif (UniqueEmail($conn, $email, $id)) {
        $result = array("error" => "email is already registered");
        return $result;
    }
    // validation end

    $datetime = DATE('y-m-d h:i:s');

    $sql = "UPDATE students 
        SET name = '$name', 
            email = '$email', 
            phone_no = '$phone_no',
            updated_at = '$datetime' 
        WHERE id = $id";

    return $result['success'] =  $conn->query($sql);
}


// function to check Phone Number
function isphoneuniue($conn, $phone_no, $id = NULL)
{
    $checkisbnsql  = "SELECT id FROM students where phone_no = '$phone_no'";
    if ($id) {
        $checkisbnsql .= " AND id != $id";
    }

    $checkisbn = $conn->query($checkisbnsql);
    if ($checkisbn->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}


// function to check email
function UniqueEmail($conn,  $emailcheck, $id=null)
{

    $sql = "SELECT id FROM students WHERE email = '$emailcheck'";
    if ($id) {
        $sql .= " AND id != $id";
    }
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}


// Function Mobile length Cheker
function mobilelegnthchecker($phone_no)
{

    if (is_numeric($phone_no) && strlen($phone_no) == 10) {
        return false;
    } else {

        return true;
    }
}
