<?php

session_start();

$mysqli = new mysqli('localhost', 'root', 'admin', 'database') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = '';
$location = '';
$Email = '';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $Email = $_POST['Email'];

    $mysqli->query("INSERT INTO members (name, location, Email) VALUES('$name', '$location', '$Email')") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: Search.php");
}

if (isset($_POST['search'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $Email = $_POST['Email'];
    $result = $mysqli->query("SELECT * FROM members WHERE name = '$name' || location = '$location' || Email = '$Email'") or die($mysqli->error);

    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        $location = $row['location'];
        $Email = $row['Email'];
    }
    $_SESSION['message'] = "Record has been retrieved!";
    $_SESSION['msg_type'] = "warning";

    header('location: Search.php');
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM members WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: Search.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM members WHERE id=$id") or die($mysqli->error);
    if (count((array)$result)) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
        $Email = $row['Email'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $Email = $_POST['Email'];
    $mysqli->query("UPDATE members SET name ='$name', location='$location', Email='$Email' WHERE id=$id") or
        die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location: Search.php');
}