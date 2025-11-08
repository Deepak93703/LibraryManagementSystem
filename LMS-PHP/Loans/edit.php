<?php

include_once("../config/config.php");
include_once("../models/loan.php");
include_once("../include/middlewear.php");



?>

<?php
// Upade Book function
if (isset($_POST['submit'])) {

    $res = updatingbook($conn, $_POST);

    if ($res === true) {
        $_SESSION['success'] = "Books has been Updated successfully";
        header('Location:' . BASE_URL . "Loans");
        exit;
    } else {
        $_SESSION['error'] = $res['error'] . $conn->error;
        header('Location:' . BASE_URL . "loans/?id=" . $_POST['id']);
        exit;
    }
}


// Read gets Parameter to get book loan data
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $bookloan = getBookById($conn, $_GET['id']);
    if ($bookloan->num_rows > 0) {
        $booksloandata = mysqli_fetch_assoc($bookloan);
    }
} else {
    header("LOCATION:" . BASE_URL . "Loans");
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
<main class="mt-2 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once(DIR_URL . "./include/alerts.php") ?>
                <h4 class="fw-bold">Add Loan</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fill the Form</div>
                    <div class="card-body">
                        <form method="post" action="<?php echo  BASE_URL ?>Loans/edit.php">
                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="loan" class="form-label">Select student</label>
                                        <?php $studentlist = studentList($conn);  ?>
                                        <!-- <select name="book_id" class="form-control" id="book_id"> -->
                                        <select name="student_id" class="form-control" id="student_id">

                                            <option value="">Please Select</option>
                                            <?php
                                            $selected = '';
                                            while ($rows = $studentlist->fetch_assoc()) {
                                                if ($rows['id'] === $booksloandata['student_id'])
                                                    $selected = "selected";
                                            ?>
                                                <!-- <option value="<?= $rows['id']; ?>"><?= $rows['name']; ?></option> -->
                                                <option value="<?= $rows['id']; ?>" <?= ($rows['id'] == $booksloandata['student_id']) ? 'selected' : '' ?>><?= $rows['name']; ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="loan" class="form-label">Select Book</label>
                                        <?php $res = getListBook($conn); ?>
                                        <select name="book_id" class="form-control" id="book_id">
                                            <option value="">Please Select</option>
                                            <?php
                                            $selected = '';
                                            while ($rows = $res->fetch_assoc()) {
                                                if ($rows['id'] === $booksloandata['book_id'])
                                                    $selected = "selected";
                                            ?>
                                                <option value="<?= $rows['id']; ?>" <?= ($rows['id'] == $booksloandata['book_id']) ? 'selected' : '' ?>><?= $rows['title']; ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="loan_date" class="form-label">Loan Date</label>
                                        <input type="date" name="loan_date" class="form-control" id="loan_date" value="<?php echo $booksloandata['loan_date'];   ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="return_date" class="form-label">Return Date</label>
                                        <input type="date" name="return_date" class="form-control" id="return_date" value="<?php echo $booksloandata['return_date'];   ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button name="submit" type="submit" class="btn btn-success">Save</button>
                                <a href="<?PHP echo  BASE_URL ?>Loans" type="submit" class="btn btn-secondary">Back</a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main content end -->

<?php include_once(DIR_URL . 'include/footer.php'); ?>