<?php

include_once("../config/config.php");
include_once("../config/database.php");
include_once("../include/middlewear.php");
include_once("../models/subscription.php");



// create/edit  plans Insert
if (isset($_POST['submit'])) {

    //create
    if ($_POST['id'] == '') {
        $res = create($conn, $_POST);

        if (isset($res['success'])) {
            $_SESSION['success'] = "Plans has been created successfully";
            header("LOCATION:" . BASE_URL . "subscription");
            exit;
        } else {
            $_SESSION['error'] = $res['error'];
            header("LOCATION:" . BASE_URL . "subscription");
            exit;
        }
    } else {

        //update
        $res = updateSubscription($conn, $_POST);

        if (isset($res['success'])) {
            $_SESSION['success'] = "Plan has been updated successfully";
            header("LOCATION:" . BASE_URL . "subscription");
            exit;
        } else {
            $_SESSION['error'] = $res['error'];
            header("LOCATION:" . BASE_URL . "subscription");
            exit;
        }
    }
}

// get ALL Plans Data
$plans = getALLBooksSubscriptionData($conn);
if (!isset($plans->num_rows)) {
    $_SESSION['error'] = "Error:" . $conn->error;
}


// Delete Books Loans Data
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $del =   delete_subscription_plans($conn, $_GET['id']);

    if ($del == true) {
        $_SESSION['success'] = "Plans has been deleted succesfully";
    } else {
        $_SESSION['error'] = "Something went wrong" . $conn->error;
    }
    header("LOCATION:" . BASE_URL . "subscription");
    exit;
}

// status Update of Subscription Data
if (isset($_GET['action']) && $_GET['action'] == 'status') {
    $del =   updatePlansStatus($conn, $_GET['id'], $_GET['status']);

    if ($del == true) {
        if ($_GET['status'] == 1) {
            $msg = "Plans has been successfully Activated";
        } else {
            $msg = "Plans has been successfully Deactivated";
        }
        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong" . $conn->error;
    }
    header("LOCATION:" . BASE_URL . "subscription");
    exit;
}






// Edit Plans Data

$plan = array('title' => '', 'amount' => '', 'duration' => '', 'id' => '');

if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id']) && $_GET['id'] > 0) {
    $plan = getPlanById($conn, $_GET['id']);
    if ($plan->num_rows > 0) {
        $plan = mysqli_fetch_assoc($plan);
    }
}


// create Modals Subscription Insert
if (isset($_POST['submitModellData'])) {

    //create
    $res = createModelSubscription($conn, $_POST);

    if (isset($res['success'])) {
        $_SESSION['success'] = "Plans has been created successfully";
        header("LOCATION:" . BASE_URL . "subscription/purchase-history.php");
        exit;
    } else {
        $_SESSION['error'] = $res['error'];
        header("LOCATION:" . BASE_URL . "subscription/purchase-history.php");
        exit;
    }
}



// function to fetch all subscription data

$from = '';
if (isset($_GET['from']))
    $from = $_GET['from'];


$to = '';
if (isset($_GET['to']))
    $to = $_GET['to'];

$res = getALSubscription($conn, $from, $to);
if (!isset($res->num_rows)) {
    $_SESSION['error'] = "Error:" . $conn->error;
}
?>


<?php


include_once(DIR_URL . 'include/header.php');
include_once(DIR_URL . 'include/topbar.php');
include_once(DIR_URL . 'include/footer.php');
include_once(DIR_URL . 'include/sidebar.php');

?>
<!-- main content start -->
<main class="mt-1 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12 ">
                <?php include_once(DIR_URL . 'include/alerts.php'); ?>
                <div class="d-flex justify-content-between align-items-center w-100 mb-3">
                    <h4 class="fw-bold mb-0">PURCHASE HISTORY</h4>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#subsModal">
                        Create Subscription
                    </button>

                </div>





                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Subscription Purchase History
                        </div>
                        <div class="card-body">
                            <!--Search form-->
                            <form method="get">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <h5 class="fw-bold text-uppercase">Search</h5>
                                    </div>
                                    <form action="" method="GET">

                                        <div class="col-md-3">
                                            <label class="form-label">From</label>
                                            <input type="date" class="form-control" name="from" value="<?php echo $from ?>" />
                                        </div>

                                        <div class="col-md-3">
                                            <label class="form-label">To</label>
                                            <input type="date" class="form-control" name="to" value="<?php echo $to ?>" />
                                        </div>

                                        <div class="col-md-3">
                                            <button type="submit" name="search" class="btn btn-primary btn-sm" style="margin-top:35px">
                                                Search
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </form>

                            <!--Table-->
                            <div class="table-responsive">
                                <table id="data-table" class="table table-responsive table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">Sr No</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($res->num_rows > 0) {
                                            $i = 1;
                                            while ($row = $res->fetch_assoc()) {


                                                // echo '<pre>';print_r($row);
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i++ ?></th>
                                                    <td><?php echo $row['student_name'] ?></td>
                                                    <td>
                                                        <span class="badge text-bg-info me-1"><?php echo $row['subscription_name'] ?></span>
                                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                                        <?php echo $row['amount'] ?>
                                                    </td>
                                                    <td><?php echo date("d-m-Y", strtotime($row['start_date'])) ?></td>
                                                    <td><?php echo date("d-m-Y", strtotime($row['end_date'])) ?></td>
                                                    <td>
                                                        <?php
                                                        $today = date("Y-m-d");
                                                        if ($row['end_date'] >= $today)
                                                            echo '<span class="badge text-bg-success">Active</span>';
                                                        else
                                                            echo  '<span class="badge text-bg-danger">Expired</span>';
                                                        ?>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main content end -->

<!-- Modal to create subscription -->
<div class="modal fade" id="subsModal" tabindex="-1" aria-labelledby="subsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="subsModalLabel">Subscription Creation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo  BASE_URL ?>subscription/purchase-history.php">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="loan" class="form-label">Select student</label>
                                <?php $studentlist = studentList($conn);  ?>
                                <select name="student_id" class="form-control" id="student_id">
                                    <option value="">Please Select</option>
                                    <?php while ($rows = $studentlist->fetch_assoc()) { ?>
                                        <option value="<?= $rows['id']; ?>"><?= $rows['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="loan" class="form-label">Select Plan</label>
                                <?php $plandata = planList($conn);  ?>
                                <select name="plan_id" class="form-control" id="plan_id">
                                    <option value="">Please Select Plan</option>
                                    <?php while ($rows = $plandata->fetch_assoc()) { ?>
                                        <option value="<?= $rows['id']; ?>"><?= $rows['title']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button name="submitModellData" type="submit" class="btn btn-success">Save</button>
                        <button type="submit" class="btn btn-secondary">Reset</button>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<?php include_once(DIR_URL . 'include/footer.php'); ?>