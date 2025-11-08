<?php
include_once("../config/database.php");
include_once("../config/config.php");


// Function All Students
function studentList($conn)
{
    $studentalldata  = "SELECT * From students ORDER BY name ASC";
    $returndata  = $conn->query($studentalldata);
    return $returndata;
}


// function to get All Books
function getListBook($conn)
{
    $sql = "SELECT *  FROM books ORDER BY title";
    $res = $conn->query($sql);

    return $res;
}


// Function to stored/Insert Loans
function storeLoans($conn, $loans_data_post)
{
    extract($loans_data_post);
    if (empty($book_id)) {
        $result = array("error" => "Book Selection is Required");
        return $result;
    } elseif (empty($student_id)) {
        $result = array("error" => "Student Selection is Required");
        return $result;
    } elseif (empty($loan_date)) {
        $result = array("error" => "Loan Date Selection is Required");
    } elseif (empty($return_date)) {
        $result = array("error" => "Return Date Selection is Required");
    }

    $date = DATE('Y-m-d');
    $sql =  "INSERT INTO books_loan (book_id, student_id, loan_date, return_date, created_at) VALUES ($book_id, $student_id, '$loan_date', '$return_date', '$date')";
    $sqlprepared = $conn->query($sql);

    return $sqlprepared;
}


// Function to fetch All Books Loans
function getALLBooksLoansData($conn)
{
    $sql = "SELECT bl.id, s.name as student_name, b.title as book_name, bl.return_date as book_return_date, bl.loan_date as book_loan_date, bl.is_return as book_return_or_not, bl.created_at as loan_creation_date, bl.updated_at  FROM books_loan as bl LEFT JOIN books as b ON b.id=bl.book_id LEFT JOIN students as s ON s.id = bl.student_id ORDER BY bl.id desc";
    $res = $conn->query($sql);
    return $res;
}


// Function to delte Books Loans
function deletebooksloandata($conn, $id)
{
    $sql = "DELETE FROM books_loan WHERE id = $id";
    $res = $conn->query($sql);

    if ($res) {
        return true;
    } else {
        return "Failed to delete Books";
        exit;
    }
}


// Function to Upadte Books Loans Active or Deactive Status
function updateBooksLoansStatus($conn, $id, $status)
{
    $sql = "UPDATE books_loan SET is_return = $status WHERE id= $id";
    $res = $conn->query($sql);
    return $res;
}


// Function to get Book Loan data  for prefill purpose
function getBookById($conn, $id)
{
    $sql = "SELECT * from books_loan where id = $id ORDER by created_at";
    $res =  $conn->query($sql);
    return $res;
}

// Function to get edit fBooks Loans
function updatingbook($conn, $param_data )
{
    $deep =  extract($param_data);

    if (empty($book_id)) {
        $result = array("error" => "Book Selection is Required");
        return $result;
    } elseif (empty($student_id)) {

        $result = array("error" => "Student Selection is Required");
        return $result;
    } elseif (empty($loan_date)) {

        $result = array("error" => "Loan Date Selection is Required");
    } elseif (empty($return_date)) {

        $result = array("error" => "Return Date Selection is Required");
    }

    $datetime = DATE('y-m-d h:i:s');


    $sql = "UPDATE books_loan 
        SET book_id = $book_id, 
            student_id = $student_id, 
            loan_date = '$loan_date', 
            return_date = '$return_date',  
            updated_at = '$datetime' 
        WHERE id = $id";
    return $result['success'] =  $conn->query($sql);
}
