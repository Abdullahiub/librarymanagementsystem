<?php

$username = $_POST['User'];
$password = $_POST['Pass'];

// To prevent mysql injection
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

//create connection
$conn = mysqli_connect('localhost', 'root', 'admin', 'Library');

//check connection
if (mysqli_connect_errno()) {
    //connection failed
    echo 'Failed to connect to MySQL' . mysqli_connect_errno();
}

//Query database
$result = mysqli_query($conn, "select * from login where Username = '$username' AND Password = '$password'")
    or die("Failed to query database" . mysqli_error($conn));
$row = mysqli_fetch_array($result);
if ($row['Username'] == $username && $row['Password'] == $password) {
    echo "Login successful!!! welcome " . $row['Username'];
} else {
    echo "Failed to login";
}