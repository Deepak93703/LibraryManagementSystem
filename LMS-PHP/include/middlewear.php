<?php


if (isset($_SESSION['is_user_login'])) {
    return true;
} else {
    $_SESSION['error'] = "Please Login First";
    header("LOCATION:" . BASE_URL);
}
