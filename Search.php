<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="searchStyle.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <?php require_once 'searchProcess.php'; ?>

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
        <div class="jumbotron">
            <div class="card">

            </div>
            <div class="card">
                <div class="card-body">

                </div>
            </div>

            <div class="card">
                <?php
                $connection = mysqli_connect('localhost', 'root', 'admin', 'database');
                $sql = "SELECT * FROM members";
                $result = mysqli_query($connection, $sql);
                ?>
                <div class="card-body">
                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <?php
                        while ($row = mysqli_fetch_object($result)) { ?>
                        <tr>
                            <td><?php echo $row->name ?></td>
                            <td><?php echo $row->location ?></td>
                            <td><?php echo $row->Email ?></td>
                            <?php } ?>

                        </tr>
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
            </div>
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

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#table').DataTable();
    });
    </script>
</body>

</html>