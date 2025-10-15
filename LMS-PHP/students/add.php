<?php

include_once("../config/config.php");
include_once("../models/student.php");


?>

<?php
if (isset($_POST['submit'])) {
  $res = storeStudents($conn, $_POST);


  if ($res === true) {
    $_SESSION['success'] = "student has been created successfully";
    header('Location:' . BASE_URL . "students");
    exit;
  } else {
    $_SESSION['error'] = $res['error'];
    header('Location:' . BASE_URL . "students/add.php");
    exit;
  }
}
?>


<?php
include_once(DIR_URL . 'include/header.php');
include_once(DIR_URL . 'include/topbar.php');
include_once(DIR_URL . 'include/sidebar.php');
?>

<!-- main content start -->
<main class="mt-2 pt-3">
  <div class="container-fluid">
    <div class="row dashboard-counts">
      <div class="col-md-12">
        <?php include_once(DIR_URL . "./include/alerts.php") ?>
        <h4 class="fw-bold">Add Student</h4>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Fill the Form</div>
          <div class="card-body">
            <form method="post" action="<?php echo  BASE_URL ?>students/add.php">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="bookName" class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="isbnNumber" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="publisherName" class="form-label">Phone No</label>
                    <input type="number" name="phone_no" class="form-control" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="authorName" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" required />
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <button type="submit" name="submit" type="submit" class="btn btn-success">Submit</button>
                <button type="submited" name="submited" class="btn btn-secondary">Reset</button>
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