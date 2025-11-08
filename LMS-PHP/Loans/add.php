<?php
include_once("../config/config.php");
include_once("../models/loan.php");
include_once("../include/middlewear.php");
?>

<?php
if (isset($_POST['submit'])) {
  $res = storeLoans($conn, $_POST);

  if ($res === true) {
    $_SESSION['success'] = "Books Loans has been created successfully";
    header('Location:' . BASE_URL . "Loans");
    exit;
  } else {
    $_SESSION['error'] = $res['error'];

    $_SESSION['old'] = $_POST;

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
            <form method="post" action="<?php echo BASE_URL ?>Loans/add.php">
              <div class="row">

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="student_id" class="form-label">Select Student</label>
                    <?php $studentlist = studentList($conn); ?>
                    <select name="student_id" class="form-control" id="student_id">
                      <option value="">Please Select</option>
                      <?php while ($rows = $studentlist->fetch_assoc()) { ?>
                        <option value="<?= $rows['id']; ?>"
                          <?= (isset($_SESSION['old']['student_id']) && $_SESSION['old']['student_id'] == $rows['id']) ? 'selected' : ''; ?>> <!-- ✅ Keep selected -->
                          <?= $rows['name']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="book_id" class="form-label">Select Book</label>
                    <?php $res = getListBook($conn); ?>
                    <select name="book_id" class="form-control" id="book_id">
                      <option value="">Please Select</option>
                      <?php while ($rows = $res->fetch_assoc()) { ?>
                        <option value="<?= $rows['id']; ?>"
                          <?= (isset($_SESSION['old']['book_id']) && $_SESSION['old']['book_id'] == $rows['id']) ? 'selected' : ''; ?>> <!-- ✅ Keep selected -->
                          <?= $rows['title']; ?>
                        </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="loan_date" class="form-label">Loan Date</label>
                    <input type="date" name="loan_date" class="form-control" id="loan_date"
                      value="<?= isset($_SESSION['old']['loan_date']) ? $_SESSION['old']['loan_date'] : ''; ?>" /> <!-- ✅ Keep old value -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="return_date" class="form-label">Return Date</label>
                    <input type="date" name="return_date" class="form-control" id="return_date"
                      value="<?= isset($_SESSION['old']['return_date']) ? $_SESSION['old']['return_date'] : ''; ?>" /> <!-- ✅ Keep old value -->
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <button name="submit" type="submit" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- main content end -->

<?php unset($_SESSION['old']); ?>

<?php include_once(DIR_URL . 'include/footer.php'); ?>