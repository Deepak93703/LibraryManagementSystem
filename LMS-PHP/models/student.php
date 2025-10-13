<?php

include_once("../config/database.php");
include_once("../config/config.php");


// Function to create student
function storeStudents($conn, $param)
{

    extract($param);

    // echo '<pre>';
    // print_r($conn);
    // echo '</pre>';

    // echo '<pre>';
    // print_r($param);
    // echo '</pre>';
    // exit;

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
        $result = array('error' => 'email is alraedy registered');
        return $result;
    } elseif (mobilelegnthchecker($phone_no)) {
        $result = array('error' => 'Please enter only 10 digit Number');

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




// function to get all books 
function getBooks($conn)
{
    $sql  = "SELECT b.*, c.name as cat_name FROM books b LEFT JOIN categories c ON c.id = b.category_id ORDER BY id DESC";
    $result = $conn->query($sql);
    return $result;
}

// function to delete a books
function deletebooks($conn, $id)
{
    $sql = "DELETE FROM books WHERE id= $id";
    $result = $conn->query($sql);
    return $result;
}



// function updatebooks status
function updatebooks($conn, $id, $status)
{
    $sql = "Update books SET availability_status = $status WHERE id= $id";
    $result = $conn->query($sql);
    return $result;
}


// function to get book details
function getBookById($conn, $id)
{
    $sql  = "SELECT b.*, c.name as cat_name FROM books b LEFT JOIN categories c ON c.id = b.category_id WHERE b.id= $id ";
    $result = $conn->query($sql);
    return $result;
}



// Function to update Book
function updatingbook($conn, $param)
{

    extract($param);
    // validation start
    if (empty($title)) {
        $result = array("error" => "Title is required");
        return $result;
    } elseif (empty($isbn)) {
        $result = array("error" => "ISBN is required");
        return $result;
    } elseif (empty($publication_year)) {
        $result = array("error" => "Publication Year is required");
        return $result;
    } elseif (empty($author)) {
        $result = array("error" => "Author is required");
        return $result;
    } elseif (empty($category_id)) {
        $result = array("error" => "Author is required");
        return $result;
    } elseif (isphoneuniue($conn, $isbn, $id)) {
        $result = array("error" => "ISBN is already registered");
        return $result;
    }
    // validation end

    $datetime = DATE('y-m-d h:i:s');

    $sql = "UPDATE books SET title = '$title', author = '$author', publication_year = '$publication_year', isbn = $isbn, category_id = $category_id, updated_at = '$datetime' where id =$id";

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
function UniqueEmail($conn,  $emailcheck)
{

    $sql = "SELECT id FROM students WHERE email = '$emailcheck'";
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
    if(is_numeric($phone_no) && strlen($phone_no)) {
        return false;
    } else {
        return true;
    }
}
