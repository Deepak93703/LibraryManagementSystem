<?php

include_once("../config/config.php");
include_once("../models/student.php");
include_once("./include/middlewear.php");



?>

<?php
// Upade Student function
if (isset($_POST['update'])) {
    $res = updatingstudent($conn, $_POST);

    if ($res === true) {
        $_SESSION['success'] = "studentshas been updated successfully";
        header('Location:' . BASE_URL . "students");
        exit;
    } else {
        $_SESSION['error'] = $res['error'] . $conn->error;
        header('Location:' . BASE_URL . "students/edit.php?id=" . $_POST['id']);
        exit;
    }
}


// Read gets Parameter to get student  data
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $student = getStudentById($conn, $_GET['id']);
    if ($student->num_rows > 0) {
        $students = mysqli_fetch_assoc($student);
    }
} else {
    header("LOCATION:" . BASE_URL . "students");
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
                <h4 class="fw-bold">Edit Students</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fill the Form</div>
                    <div class="card-body">
                        <form method="post" action="<?php echo  BASE_URL ?>students/edit.php">
                            <input type="hidden" name="id" value="<?php echo $students['id']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required value="<?php echo $students["name"]; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="email" required value="<?php echo $students["email"]; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_no" class="form-label">Phone Number</label>
                                        <input type="number" name="phone_no" class="form-control" id="phone_no" required value="<?php echo $students["phone_no"]; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" name="address" class="form-control" id="address" required value="<?php echo $students["address"]; ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button name="update" type="submit" class="btn btn-success">Update</button>
                                <a href="<?PHP echo  BASE_URL ?>students" type="submit" class="btn btn-secondary">Back</a>

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