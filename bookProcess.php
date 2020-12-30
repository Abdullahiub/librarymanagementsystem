<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'admin', 'database') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$title = '';
$author = '';
$price = '';
$availability = '';

if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['Price'];
    $availability = $_POST['availability'];


    $mysqli->query("INSERT INTO books (title, author, Price, availability) VALUES('$title', '$author', '$price', '$availability')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: Books.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM books WHERE book_id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: Books.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM books WHERE book_id=$id") or die($mysqli->error);
    if (count((array)$result)) {
        $row = $result->fetch_array();
        $title = $row['title'];
        $author = $row['author'];
        $price = $row['Price'];
        $availability = $row['availability'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['book_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['Price'];
    $availability = $_POST['availability'];


    $mysqli->query("UPDATE books SET title ='$title', author='$author', Price='$price', availability='$availability' WHERE book_id=$id") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: Books.php');
}