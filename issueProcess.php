<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'admin', 'database') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$mem_name = '';
$book_name = '';
$borrow_date = '';
$due_date = '';
$price = '';

if (isset($_POST['save'])) {
    $mem_name = $_POST['name'];
    $book_name = $_POST['book'];
    $borrow_date = $_POST['b_date'];
    $due_date = $_POST['due_date'];
    $price = $_POST['price'];



    $mysqli->query("INSERT INTO issues (name, book, b_date, due_date, price) VALUES('$mem_name', '$book_name', '$borrow_date', '$due_date', '$price')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: Issue.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM issues WHERE issue_id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: Issue.php");
}

/*if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM issues WHERE issue_id=$id") or die($mysqli->error);
    if (count((array)$result)) {
        $row = $result->fetch_array();
        $mem_name = $row['name'];
        $book_name = $row['book'];
        $borrow_date = $row['b_date'];
        $due_date = $row['due_date'];
        $price = $row['price'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['issue_id'];
    $mem_name = $row['name'];
    $book_name = $row['book'];
    $borrow_date = $row['b_date'];
    $due_date = $row['due_date'];
    $price = $row['price'];

    $mysqli->query("UPDATE issues SET name ='$mem_name', book='$book_name', b_date='$borrow_date', due_date='$due_date', price='$price' WHERE issue_id=$id") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: Issue.php');
}*/