<?php

include_once("../config/database.php");
include_once("../config/config.php");


// Function to store book
function storeBooks($conn, $param)
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
    } elseif (isISBNUniue($conn, $isbn)) {
        $result = array("error" => "ISBN is already registered");
        return $result;
    }
    // validation end

    $datetime = DATE('y-m-d h:i:s');

    $sql = "INSERT INTO books(title, author, publication_year, isbn, category_id,created_at) 
            VALUES('$title', '$author', '$publication_year', '$isbn', $category_id, '$datetime')";

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
    } elseif (isISBNUniue($conn, $isbn, $id)) {
        $result = array("error" => "ISBN is already registered");
        return $result;
    }
    // validation end

    $datetime = DATE('y-m-d h:i:s');

    $sql = "UPDATE books SET title = '$title', author = '$author', publication_year = '$publication_year', isbn = $isbn, category_id = $category_id, updated_at = '$datetime' where id =$id";

    return $result['success'] =  $conn->query($sql);
    
}


// function to check isbn Number
function isISBNUniue($conn, $isbn, $id = NULL)
{
    $checkisbnsql  = "SELECT id FROM books where isbn = '$isbn'";
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
