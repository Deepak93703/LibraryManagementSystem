<?php

include_once("../config/config.php");
include_once("../config/database.php");
include_once("../models/subscription.php");
include_once("../include/middlewear.php");




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
            <div class="col-md-12">
                <?php include_once(DIR_URL . 'include/alerts.php'); ?>
                <h4 class="fw-bold">Subscription Plans</h4>
            </div>
            <div class="row  d-flex justify-content-between">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">All Books Loans</div>
                        <div class="card-body">
                            <table id="example" class="table table-striped ">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Sr No</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Month</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($plans->num_rows > 0) {
                                        $index = 1;
                                        while ($row = $plans->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <th scope="row"><?php echo $index++; ?></th>
                                                <td><?php echo $row['title']; ?></td>
                                                <td>₹<?php echo  $row['amount']; ?></td>
                                                <td><?php echo $row['duration']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($row['status'] == 1) {
                                                        echo '<span class="badge text-bg-success">Active</span>';
                                                    } else {
                                                        echo '<span class="badge text-bg-warning">Inactive</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?php echo BASE_URL ?>subscription/?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="<?php echo BASE_URL ?>subscription/?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm(' Are you sure you want to delete this record?'); ">Delete</a>

                                                    <?php if ($row['status'] == 1) { ?>
                                                        <a href=" <?php echo BASE_URL ?>subscription/?action=status&id=<?php echo $row['id']; ?>&status=0" class="btn btn-warning btn-sm">Inactive</a>
                                                    <?php } ?>

                                                    <?php if ($row['status'] == 0) { ?>
                                                        <a href="<?php echo BASE_URL ?>subscription/?action=status&id=<?php echo $row['id']; ?>&status=1" class="btn btn-success btn-sm">Active</a>
                                                    <?php } ?>


                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo '<tr><td colspan="9" class="text-center">No loans found</td></tr>';
                                    }
                                    ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add New Plan</div>
                        <div class="card-body">
                            <form method="post" action="<?php echo  BASE_URL ?>subscription/index.php">
                                <input type="hidden" name="id" value="<?php echo $plan['id']; ?>" />
                                <div class="row">
                                    <div class="col-md-12  mt-2">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" name="title" value="<?php echo $plan['title'] ?>" class="form-control" id="title" required />

                                        </div>
                                    </div>
                                    <div class="col-md-12  mt-2">
                                        <div class="mb-3">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input type="Number" name="amount" value="<?php echo $plan['amount'] ?>" class="form-control" id="amount" required />

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-2">
                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration</label>
                                            <select name="duration" class="form-control">
                                                <option value="">Please Select</option>
                                                <?php
                                                for ($i = 1; $i <= 60; $i++) {
                                                    $selected = ($i == $plan['duration']) ? 'selected' : '';
                                                    echo "<option value='$i' $selected>$i Month</option>";
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <button type="submit" name="submit" class="btn btn-success">Save</button>

                                    <?php if (empty($plan['id'])) { ?>
                                        <a href="<?= BASE_URL ?>subscription" class="btn btn-secondary">Cancel</a>
                                    <?php } else { ?>
                                        <a href="<?= BASE_URL ?>subscription" class="btn btn-warning"> Cancel</a>
                                    <?php } ?>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main content end -->
<?php include_once(DIR_URL . 'include/footer.php'); ?>