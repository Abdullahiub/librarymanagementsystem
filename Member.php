<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMBERS</title>
    <link rel="stylesheet" href="memberstyle.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {

        $('#table').DataTable();

    });
    </script>
</head>

<body>
    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['message'])) : ?>
    <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

        <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
    </div>
    <?php endif ?>
    <div>
        <h1>Members</h1>
    </div>
    <div class="container">
        <?php
        $mysqli = new mysqli('localhost', 'root', 'admin', 'database') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM members") or die($mysqli->error);
        //pre_r($result);
        ?>
        <div class="row justify-content-center">
            <table id="table" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Email</th>

                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['location']; ?></td>
                    <td><?php echo $row['Email']; ?></td>

                    <td>
                        <a href="Member.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
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
            <form action="process.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>"
                        placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo $location; ?>"
                        placeholder="Enter location">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="Email" class="form-control" value="<?php echo $Email; ?>"
                        placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <?php
                    if ($update == true) :
                    ?>
                    <button type="submit" class="btn btn-info" name="update">update</button>
                    <?php else : ?>;
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary" name="search">Search</button>

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