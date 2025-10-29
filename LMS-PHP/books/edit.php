<?php

include_once("../config/config.php");
include_once("../models/book.php");
include_once("./include/middlewear.php");



?>

<?php
// Upade Book function
if (isset($_POST['update'])) {
    $res = updatingbook($conn, $_POST);

    if ($res === true) {
        $_SESSION['success'] = "Books has been updated successfully";
        header('Location:' . BASE_URL . "books");
        exit;
    } else {
        $_SESSION['error'] = $res['error'] . $conn->error;
        header('Location:' . BASE_URL . "books/?id=" . $_POST['id']);
        exit;
    }
}


// Read gets Parameter to get book data
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $book = getBookById($conn, $_GET['id']);
    if ($book->num_rows > 0) {
        $books = mysqli_fetch_assoc($book);
    }
} else {
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
<main class="mt-2 pt-3">
    <div class="container-fluid">
        <div class="row dashboard-counts">
            <div class="col-md-12">
                <?php include_once(DIR_URL . "./include/alerts.php") ?>
                <h4 class="fw-bold">Edit Books</h4>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Fill the Form</div>
                    <div class="card-body">
                        <form method="post" action="<?php echo  BASE_URL ?>books/edit.php">
                            <input type="hidden" name="id" value="<?php echo $books['id']; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bookName" class="form-label">Books Tile</label>
                                        <input type="text" name="title" class="form-control" id="bookName" required value="<?php echo $books["title"]; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="isbnNumber" class="form-label">ISBN Number</label>
                                        <input type="number" name="isbn" class="form-control" id="isbnNumber" required value="<?php echo $books["isbn"]; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="publisherName" class="form-label">Publication Year</label>
                                        <input type="number" name="publication_year" class="form-control" id="publisherName" required value="<?php echo $books["publication_year"]; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="authorName" class="form-label">Author Name</label>
                                        <input type="text" name="author" class="form-control" id="authorName" required value="<?php echo $books["author"]; ?>" />
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
                                            <?php

                                            $selected = "";
                                            while ($rows = $cats->fetch_assoc()) {
                                                if ($rows['id'] == $books['category_id']) {
                                                    $selected = "selected";
                                                }
                                            ?>
                                                <option selected value="<?= $rows['id']; ?>"><?= $rows['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button name="update" type="submit" class="btn btn-success">Update</button>
                                <a href="<?PHP echo  BASE_URL ?>books" type="submit" class="btn btn-secondary">Back</a>

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