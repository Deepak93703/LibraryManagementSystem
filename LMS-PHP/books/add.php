<?php

include_once("../config/config.php");
include_once("../models/book.php");
include_once("./include/middlewear.php");



?>

<?php
if (isset($_POST['publish'])) {
  $res = storeBooks($conn, $_POST);

  if ($res === true) {
    $_SESSION['success'] = "Books has been created successfully";
    header('Location:' . BASE_URL . "books");
    exit;
  } else {
    $_SESSION['error'] = $res['error'];
    header('Location:' . BASE_URL . "books/add.php");
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
        <h4 class="fw-bold">Add Books</h4>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Fill the Form</div>
          <div class="card-body">
            <form method="post" action="<?php echo  BASE_URL ?>books/add.php">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="bookName" class="form-label">Books Tile</label>
                    <input type="text" name="title" class="form-control" id="bookName" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="isbnNumber" class="form-label">ISBN Number</label>
                    <input type="number" name="isbn" class="form-control" id="isbnNumber" required />
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="publisherName" class="form-label">Publisher Year</label>
                    <input type="number" name="publication_year" class="form-control" id="publisherName" required />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="authorName" class="form-label">Author Name</label>
                    <input type="text" name="author" class="form-control" id="authorName" required />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <?php
                    $cats = getCategories($conn);

                    ?>
                    <select name="category_id" class="form-control" id="category" required>
                      <option value="">Please Select</option>
                      <?php while ($rows = $cats->fetch_assoc()) { ?>
                        <option value="<?= $rows['id']; ?>"><?= $rows['name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <button name="publish" type="submit" class="btn btn-success">Publish</button>
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