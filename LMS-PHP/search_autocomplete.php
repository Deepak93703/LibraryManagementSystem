<?php
include_once("config/config.php");
include_once(DIR_URL . "config/database.php");
include_once("./models/auth.php");

if(isset($_POST['q'])) {
    $q = mysqli_real_escape_string($conn, $_POST['q']);
    $output = '<ul class="autocomplete-list">';

    $students = mysqli_query($conn, "SELECT name FROM students WHERE name LIKE '%$q%' LIMIT 5");
    while ($row = mysqli_fetch_assoc($students)) {
        $highlight = str_ireplace($q, "<mark>$q</mark>", $row['name']);
        $output .= '<li class="suggestion-item student-item">Student: ' . $highlight . '</li>';
    }

    $books = mysqli_query($conn, "SELECT title FROM books WHERE title LIKE '%$q%' LIMIT 5");
    while ($row = mysqli_fetch_assoc($books)) {
        $highlight = str_ireplace($q, "<mark>$q</mark>", $row['title']);
        $output .= '<li class="suggestion-item book-item">Book: ' . $highlight . '</li>';
    }

    $output .= '</ul>';
    echo $output;
}
?>
