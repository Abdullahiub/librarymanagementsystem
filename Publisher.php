<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUBLISHERS</title>
    <link rel="stylesheet" href="pubstyle.css">

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php require_once 'publisherProcess.php'; ?>

    <?php
    if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
    <?php endif ?>
    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', 'admin', 'database') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM publishers") or die($mysqli->error);
        //pre_r($result);
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>

                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['Email']; ?></td>


                    <td>
                        <a href="Publisher.php?edit=<?php echo $row['pub_id']; ?>" class="btn btn-info">Edit</a>
                        <a href="publisherProcess.php?delete=<?php echo $row['pub_id']; ?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php

        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>
        <div class="row justify-content-center">
            <form action="publisherProcess.php" method="POST">
                <input type="hidden" name="pub_id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"
                        placeholder="Enter publisher's name">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $address; ?>"
                        placeholder="Enter publisher's address">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="Email" class="form-control" value="<?php echo $Email; ?>"
                        placeholder="Enter publisher's Email">
                </div>


                <div class="form-group">
                    <?php
                    if ($update == true) :
                    ?>
                    <button type="submit" class="btn btn-info" name="update">update</button>
                    <?php else : ?>;
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <footer>
        <nav class="nav">
            <ul class="nav__links">
                <li><a href="homepage.html">Home</a></li>
                <li><a href="Member.php">Members</a></li>
                <li><a href="Books.php">Books</a></li>
                <li><a href="Publisher.php">Publisher</a></li>
                <li><a href="Issue.php">Issue Books</a></li>
                <li><a href="Search.php">Search</a></li>


            </ul>
        </nav>
    </footer>
</body>

</html>