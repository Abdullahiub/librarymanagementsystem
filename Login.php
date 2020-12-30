<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $error = "";
    $success = "";

    if (isset($_POST['submit'])) {
        $uname = $_POST['user'];
        $pass = $_POST['pass'];
        if ($uname == "admin") {
            if ($pass == "admin") {
                $error = "";
                $success = "Welcome Admin!";
                // Redirect to another page
                header("location: homepage.html");
            } else {
                $error = "Invalid Password!";
                $success = "";
            }
        } else {
            $error = "Invalid username!";
            $success = "";
        }
    }
    ?>
    <form class="box" method="POST">
        <p style="color: white;" class="error"> <?php echo $error; ?></p>
        <p style="color: white;" class="success"> <?php echo $success; ?></p>
        <h1>Login</h1>
        <input type="text" name="user" placeholder="Username" required>
        <input type="password" name="pass" placeholder="Password" required>
        <input type="submit" id="btn" name="submit" value="Login">

    </form>
</body>

</html>