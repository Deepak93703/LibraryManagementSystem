<?php

include_once("../config/config.php");
include_once("../config/database.php");
include_once("./include/middlewear.php");
include_once("../models/loan.php");

// get ALL Books Loans Data
$books = getALLBooksLoansData($conn);
if (!isset($books->num_rows)) {
    $_SESSION['error'] = "Error:" . $conn->error;
}

// Delete Books Loans Data
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $del =   deletebooksloandata($conn, $_GET['id']);

    if ($del == true) {
        $_SESSION['success'] = "Book has been deleted succesfully";
    } else {
        $_SESSION['error'] = "Something went wrong" . $conn->error;
    }
    header("LOCATION:" . BASE_URL . "loans");
    exit;
}

// status Update of Books Loans Data
if (isset($_GET['action']) && $_GET['action'] == 'status') {
    $del =   updateBooksLoansStatus($conn, $_GET['id'], $_GET['status']);

    if ($del == true) {
        if ($_GET['status'] == 1) {
            $msg = "Book has been Returned successfully";
        } else {
            $msg = "Book has not been returned successfully";
        }
        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong" . $conn->error;
    }
    header("LOCATION:" . BASE_URL . "loans");
    exit;
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
                <h4 class="fw-bold">Manage Books Loan</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Books Loans</div>
                    <div class="card-body">
                        <table id="example" class="table table-striped ">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Student Year</th>
                                    <th scope="col">Loan Date</th>
                                    <th scope="col">Return Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($books->num_rows > 0) {
                                    $index = 1;
                                    while ($row = $books->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo $index++; ?></th>
                                            <td><?php echo $row['book_name']; ?></td>
                                            <td><?php echo $row['student_name']; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($row['book_loan_date'])); ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($row['book_return_date'])); ?></td>
                                            <td>
                                                <?php
                                                if ($row['book_return_or_not'] == 1) {
                                                    echo '<span class="badge text-bg-success">Returned</span>';
                                                } else {
                                                    echo '<span class="badge text-bg-warning">Active</span>';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo date("d-m-Y", strtotime($row['loan_creation_date'])); ?></td>
                                            <td>
                                                <a href="<?php echo BASE_URL ?>loans/edit.php/?id=<?php echo $row['id'];  ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="<?php echo BASE_URL ?>loans/?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm(' Are you sure you want to delete this record?'); ">Delete</a>

                                                <?php if ($row['book_return_or_not'] == 0) { ?>
                                                    <a href=" <?php echo BASE_URL ?>loans/?action=status&id=<?php echo $row['id']; ?>&status=1" class="btn btn-success btn-sm">Returned</a>
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
        </div>
    </div>
</main>
<!-- main content end -->
<?php include_once(DIR_URL . 'include/footer.php'); ?>