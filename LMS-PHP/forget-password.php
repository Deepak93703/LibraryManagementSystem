<?php
include_once("./config/config.php");
include_once("./config/database.php");
// include_once("./include/middlewear.php");
include_once('../LMS-PHP/models/auth.php');

// If already Logged  in
if (isset($_SESSION['is_user_login'])) {
  header("LOCATION:" . BASE_URL . 'dashboard.php');
  exit;
}


//Forget Password Functionlaity
if (isset($_POST['submit'])) {

  $res = forgotPassword($conn, $_POST);
  if ($res['status'] == true) {
    $_SESSION['success'] = "Reset Password Code has been sent on email";
    header("LOCATION:" . BASE_URL . 'reset-password.php');
  } else {
    $_SESSION['error'] = "No Email Found";
    header("LOCATION:" . BASE_URL . 'forget-password.php');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="./assets/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <script src="./assets/js/1c26fb5c51.js" crossorigin="anonymous"></script>
  <title>Forget Password Star Library</title>
  <style>
    /* Ensure the image fills left column */
    .login-form .col-md-5 img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  </style>
</head>

<body style="background-color: #212529">
  <div
    class="container d-flex align-items-center justify-content-center vh-100">
    <div class="row w-100">
      <div class="col-md-12 login-form">
        <!-- Wider card -->
        <div class="card mb-3 mx-auto w-100" style="max-width: 1200px">
          <div class="row g-0">
            <div class="col-md-5">
              <img
                src="./assets/images/LoginLeftImage.jpg"
                class="img-fluid rounded-start"
                alt="Login" />
            </div>
            <div class="col-md-7">
              <div class="card-body">
                <h1 class="card-title text-uppercase fw-bold">
                  Star Library
                </h1>
                <p class="card-text">Enter Email to reset Password</p>

                <?php include_once(DIR_URL . "include/alerts.php"); ?>
                <form action="<?php echo BASE_URL ?>forget-password.php" method="POST">
                  <div class="mb-3">
                    <label for="" class="form-label" >Email address</label>
                    <input
                      type="email"
                      class="form-control"
                      id=""
                      name="email"
                      aria-describedby="emailHelp" />
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary">submit</button>
                </form>
                <hr />
                <a
                  href="./index.php"
                  class="card-link link-underline-light">Login Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script
    src="./assets/js/b24a136d5d.js"
    crossorigin="anonymous"></script>
</body>

</html>