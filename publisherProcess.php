<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'admin', 'database') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$address = '';
$Email = '';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $Email = $_POST['Email'];

    $mysqli->query("INSERT INTO publishers (name, address, Email) VALUES('$name', '$address', '$Email')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: Publisher.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM publishers WHERE pub_id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: Publisher.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM publishers WHERE pub_id=$id") or die($mysqli->error);
    if (count((array)$result)) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $address = $row['address'];
        $Email = $row['Email'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['pub_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $Email = $_POST['Email'];

    $mysqli->query("UPDATE publishers SET name ='$name', address='$address', Email='$Email' WHERE pub_id=$id") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: Publisher.php');
}