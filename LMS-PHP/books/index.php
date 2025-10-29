<?php

include_once("../config/config.php");
include_once("../config/database.php");
include_once("./include/middlewear.php");
include_once("../models/book.php");

// get Books
$books = getBooks($conn);
if (!isset($books->num_rows)) {
    $_SESSION['error'] = "Error:" . $conn->error;
}

// Delete Books
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $del =   deletebooks($conn, $_GET['id']);

    if ($del == true) {
        $_SESSION['success'] = "Book has been deleted succesfully";
    } else {
        $_SESSION['error'] = "Something went wrong" . $conn->error;
    }
    header("LOCATION:" . BASE_URL . "books");
    exit;
}

// status Update of  Books
if (isset($_GET['action']) && $_GET['action'] == 'status') {
    $del =   updateBooks($conn, $_GET['id'], $_GET['status']);

    if ($del == true) {
        if ($_GET['status'] == 1) {
            $msg = "Book has been successfully activated";
        } else {
            $msg = "Book has been successfully deactivated";
        }
        $_SESSION['success'] = $msg;
    } else {
        $_SESSION['error'] = "Something went wrong" . $conn->error;
    }
    header("LOCATION:" . BASE_URL . "books");
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
                <h4 class="fw-bold">Manage Books</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Books</div>
                    <div class="card-body">
                        <table id="example" class="table table-striped ">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Sr No</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Publication Year</th>
                                    <th scope="col">Author Date</th>
                                    <th scope="col">ISBN Number</th>
                                    <th scope="col">Cat Name</th>
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
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['publication_year']; ?></td>
                                            <td><?php echo $row['author']; ?></td>
                                            <td><?php echo $row['isbn']; ?></td>
                                            <td><?php echo $row['cat_name']; ?></td>
                                            <td>
                                                <?php
                                                if ($row['availability_status'] == 1) {
                                                    echo '<span class="badge text-bg-success">Active</span>';
                                                } else {
                                                    echo '<span class="badge text-bg-danger">Inactive</span>';
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo $row['created_at']; ?></td>
                                            <td>
                                                <a href="<?php echo BASE_URL ?>books/edit.php/?id=<?php echo $row['id'];  ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a href="<?php echo BASE_URL ?>books/?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm(' Are you sure you want to delete this record?'); ">Delete</a>

                                                <?php if ($row['availability_status'] == 1) { ?>
                                                    <a href=" <?php echo BASE_URL ?>books/?action=status&id=<?php echo $row['id']; ?>&status=0" class="btn btn-warning btn-sm">Inactive</a>
                                                <?php } ?>

                                                <?php if ($row['availability_status'] == 0) { ?>
                                                    <a href="<?php echo BASE_URL ?>books/?action=status&id=<?php echo $row['id']; ?>&status=1" class="btn btn-success btn-sm">Active</a>
                                                <?php } ?>

                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="9" class="text-center">No books found</td></tr>';
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