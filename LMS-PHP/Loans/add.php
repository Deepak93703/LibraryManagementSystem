<?php

include_once("../config/config.php");
include_once("../models/book.php");


?>

<?php
if (isset($_POST['publish'])) {
  $res = storeLoans($conn, $_POST);

  if ($res === true) {
    $_SESSION['success'] = "Loans has been created successfully";
    header('Location:' . BASE_URL . "Loans");
    exit;
  } else {
    $_SESSION['error'] = $res['error'];
    header('Location:' . BASE_URL . "Loans/add.php");
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
        <h4 class="fw-bold">Add Loan</h4>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Fill the Form</div>
          <div class="card-body">
            <form method="post" action="<?php echo  BASE_URL ?>Loans/add.php">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="category" class="form-label">Select Book</label>
                    <?php
                    $cats = getCategories($conn);

                    ?>
                    <select name="book_id" class="form-control" id="category" required>
                      <option value="">Please Select</option>
                      <?php while ($rows = $cats->fetch_assoc()) { ?>
                        <option value="<?= $rows['id']; ?>"><?= $rows['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="category" class="form-label">Select Student</label>
                    <?php
                    $cats = getCategories($conn);

                    ?>
                    <select name="student_id" class="form-control" id="" required>
                      <option value="">Please Select</option>
                      <?php while ($rows = $cats->fetch_assoc()) { ?>
                        <option value="<?= $rows['id']; ?>"><?= $rows['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="publisherName" class="form-label">Loan Date</label>
                    <input type="date" name="loan_date" class="form-control" id="publisherName" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="authorName" class="form-label">Return Date</label>
                    <input type="date" name="return_date" class="form-control" id="authorName" required />
                  </div>
                </div>
              </div>
           
              <div class="col-md-12">
                <button name="submit"  type="submit" class="btn btn-success">Save</button>
                <button type="submit" class="btn btn-secondary">Reset</button>

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