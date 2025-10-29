<?php

include_once("../config/database.php");
include_once("../config/config.php");


// Function to store subscription plans
function create($conn, $param)
{

    extract($param);
    // validation start
    if (empty($title)) {
        $result = array("error" => "Title is required");
        return $result;
    } elseif (empty($amount)) {
        $result = array("error" => "ISBN is required");
        return $result;
    } elseif (empty($duration)) {
        $result = array("error" => "Publication Year is required");
        return $result;
    }

    // validation end

    $datetime = DATE('y-m-d h:i:s');

    $sql = "INSERT INTO subscription_plans(title, amount, duration, created_at) 
            VALUES('$title', $amount, $duration, '$datetime')";

    $result['success'] =  $conn->query($sql);
    return $result;
}





// Function to get categories
function getCategories($conn)
{
    $sql = 'SELECT * FROM categories';
    $result = $conn->query($sql);
    return $result;
}




// function to get all Plans 
function getALLBooksSubscriptionData($conn)
{
    $sql  = "SELECT * FROM subscription_plans ORDER BY id DESC";
    $result = $conn->query($sql);
    return $result;
}

// function to delete a subscription_plans
function delete_subscription_plans($conn, $id)
{
    $sql = "DELETE FROM subscription_plans WHERE id= $id";
    $result = $conn->query($sql);
    return $result;
}



// function UpdatePlans status
function updatePlansStatus($conn, $id, $status)
{
    $sql = "Update subscription_plans SET status = $status WHERE id= $id";
    $result = $conn->query($sql);
    return $result;
}


// function to get book details
function getPlanById($conn, $id)
{
    $sql  = "SELECT * FROM subscription_plans where id = $id";
    $result = $conn->query($sql);
    return $result;
}



// Function to update Book
function updateSubscription($conn, $param)
{

    extract($param);

    // validation start
    if (empty($title)) {
        $result = array("error" => "Title is required");
        return $result;
    } elseif (empty($amount)) {
        $result = array("error" => "ISBN is required");
        return $result;
    } elseif (empty($duration)) {
        $result = array("error" => "Publication Year is required");
        return $result;
    }
    // validation end

    $datetime = DATE('y-m-d h:i:s');

    // echo $sql = "UPDATE subscription_plans SET title = '$title', amount = '$amount', duration = '$duration',  updated_at = '$datetime' where id=$id";
    echo $sql = "UPDATE subscription_plans SET title = '$title', amount = $amount, duration = '$duration', updated_at = '$datetime' WHERE id=$id";



    return $result['success'] =  $conn->query($sql);
}



// function to get studetn list 
function studentList($conn)
{
    $studentalldata  = "SELECT * From students WHERE status =1 ORDER BY name ASC ";
    $returndata  = $conn->query($studentalldata);
    return $returndata;
}



// function to get studetn list 
function planList($conn)
{
    $plandata  = "SELECT * From subscription_plans WHERE status =1 ORDER BY title ASC ";
    $returndata  = $conn->query($plandata);
    return $returndata;
}




// Function to store  Modal subscription Data
function createModelSubscription($conn, $param)
{

    extract($param);
    // validation start
    if (empty($student_id)) {
        $result = array("error" => "Pleaes Select student");
        return $result;
    } elseif (empty($plan_id)) {
        $result = array("error" => "Please Select Plan");
        return $result;
    }
    // validation end

    // start date end date calculation
    $res = getPlanById($conn, $plan_id);
    if ($res->num_rows > 0) {
        $data = mysqli_fetch_assoc($res);
        $dataamount  = $data['amount'];
        $duration  = $data['duration']; // e.g. "2 months" or "15 days"


        $start_date = date('Y-m-d H:i:s'); // current datetime
        $future_time = date('Y-m-d H:i:s', strtotime("+$duration months"));
        $datetime = DATE('Y-m-d H:i:s');

        $sql = "INSERT INTO subscriptions(student_id, plan_id, start_date, end_date ,  amount, created_at) 
            VALUES($student_id, $plan_id, '$start_date', '$future_time', $dataamount, '$datetime')";

        $result['success'] =  $conn->query($sql);
        return $result;
    } else {
        $result = array("error" => "Invalid Plan Selecrion");
        return $result;
    }
}





// // function to get all subscription Plan and Joining of Multiple Table
function getALSubscription($conn, $from = null, $to = null)
{
    $sql = "SELECT s.*, 
                   st.name AS student_name, 
                   sp.title AS subscription_name, 
                   sp.amount AS subscription_amount, 
                   sp.duration AS subscription_duration, 
                   sp.status 
            FROM subscriptions AS s
            LEFT JOIN subscription_plans AS sp ON s.plan_id = sp.id
            LEFT JOIN students AS st ON s.student_id = st.id";

    // Add conditions
    if (!empty($from) && !empty($to)) {
        $sql .= " WHERE s.start_date >= '$from' AND s.end_date <= '$to'";
    } elseif (!empty($from)) {
        $sql .= " WHERE s.start_date >= '$from'";
    } elseif (!empty($to)) {
        $sql .= " WHERE s.end_date <= '$to'";
    }

    $result = $conn->query($sql);

    return $result;
}
