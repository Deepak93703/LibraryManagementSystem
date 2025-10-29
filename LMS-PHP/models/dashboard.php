<?php

// include_once("./config/config.php");
include_once("./config/database.php");



// Function to get Count
function counts($conn)
{
    $counts = array(

        'total_books' => 0,
        'total_students' => 0,
        'total_loans' => 0,
        'total_revenue' => 0

    );


    //Get Student Counts 
    $sql = 'SELECT count(*) as total_books FROM books';
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $books = mysqli_fetch_assoc($res);
        $counts['total_books'] = $books['total_books'];
    }


    //Get Student Counts 
    $sql = 'SELECT count(*)  as total_students FROM students';
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $student = mysqli_fetch_assoc($res);
        $counts['total_students'] = $student['total_students'];
    }

    //Get Loans Counts 
    $sql = 'SELECT count(*) as total_loans FROM books_loan';
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $loan = mysqli_fetch_assoc($res);
        $counts['total_loans'] = $loan['total_loans'];
    }

    //Get Loans Counts 
    $sql = 'SELECT sum(amount) as total_revenue FROM subscriptions';
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
        $revenue = mysqli_fetch_assoc($res);
        $counts['total_revenue'] = $revenue['total_revenue'];
    }

    return $counts;
}




//dashboard count details
function dashboardCountTabData($conn)
{
    $finalres = array(
        'students' => array(),
        'books_loan' => array(),
        'subscriptions' => array()
    );

    // Students data
    $sql = "SELECT * FROM students ORDER BY id DESC LIMIT 8";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tabs['students'][] = $row;
        }
    }

    // Books loan data
    $sql = "SELECT 
            b.title as book_name,
            s.name as student_name,
            bl.return_date as due_date,
            bl.loan_date as loan_date,
            bl.is_return  as status
            FROM books_loan as bl
            LEFT JOIN students as s 
            ON bl.book_id = s.id
            LEFT JOIN books as b
            ON b.id = bl.book_id
            ORDER BY bl.id DESC LIMIT 8";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tabs['books_loan'][] = $row;
        }
    }

    // Subscriptions data
    $sql = "SELECT 
            s.name as student_name,
            sbsp.title as plan_name,
            subs.amount,
            subs.start_date,
            subs.end_date
            FROM `subscriptions` as subs
            LEFT JOIN students as s
            ON subs.student_id = s.id
            LEFT JOIN subscription_plans as sbsp
            ON sbsp.id = subs.plan_id
            ORDER BY subs.id DESC LIMIT 8;";
    $res = $conn->query($sql);
    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $tabs['subscriptions'][] = $row;
        }
    }

    return $tabs;
}
