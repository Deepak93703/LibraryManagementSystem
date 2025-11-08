<?php
include_once("../config/config.php");
include_once("../models/student.php");
include_once("../include/middlewear.php");

$error_message = "";
$form_data = ['name' => '', 'email' => '', 'phone_no' => '', 'address' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $res = storeStudents($conn, $_POST);

  if ($res === true) {
    $_SESSION['success'] = "Student has been created successfully";
    header('Location:' . BASE_URL . "students");
    exit;
  } else {
    $error_message = $res['error'];
    $form_data = $_POST;
  }
}

if (isset($_POST['reset'])) {
  $form_data = ['name' => '', 'email' => '', 'phone_no' => '', 'address' => ''];
}

include_once(DIR_URL . 'include/header.php');
include_once(DIR_URL . 'include/topbar.php');
include_once(DIR_URL . 'include/sidebar.php');
?>

<main class="mt-2 pt-3">
  <div class="container-fluid">
    <div class="row dashboard-counts">
      <div class="col-md-12">
        <?php include_once(DIR_URL . "./include/alerts.php"); ?>
        <h4 class="fw-bold">Add Student</h4>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Fill the Form</div>
          <div class="card-body">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($error_message)) : ?>
              <div id="popup" class="alert alert-danger mb-3">
                <?php echo htmlspecialchars($error_message); ?>
              </div>
            <?php endif; ?>

            <form id="studentForm" method="post" action="">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control"
                      value="<?php echo htmlspecialchars($form_data['name']); ?>" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                      value="<?php echo htmlspecialchars($form_data['email']); ?>" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Phone No</label>
                    <input type="text" name="phone_no" class="form-control"
                      pattern="[0-9]{10}" maxlength="10"
                      value="<?php echo htmlspecialchars($form_data['phone_no']); ?>" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control"
                      value="<?php echo htmlspecialchars($form_data['address']); ?>" required />
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <button type="submit" name="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include_once(DIR_URL . 'include/footer.php'); ?>
