<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISSUES</title>
    <link rel="stylesheet" href="issuestyle.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php require_once 'issueProcess.php'; ?>

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
        $result = $mysqli->query("SELECT * FROM issues") or die($mysqli->error);
        //pre_r($result);
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Member Name</th>
                        <th>Book Name</th>
                        <th>Borrow Date</th>
                        <th>Due Date</th>
                        <th>Price</th>




                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['book']; ?></td>
                    <td><?php echo $row['b_date']; ?></td>
                    <td><?php echo $row['due_date']; ?></td>
                    <td><?php echo $row['price']; ?></td>



                    <td>
                        <!--<a href="Issue.php?edit=<?php echo $row['issue_id']; ?>" class="btn btn-info">Edit</a>-->
                        <a href="issueProcess.php?delete=<?php echo $row['issue_id']; ?>"
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
            <form action="issueProcess.php" method="POST">
                <input type="hidden" name="issue_id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Member Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $mem_name; ?>"
                        placeholder="Enter Member's Name">
                </div>
                <div class="form-group">
                    <label>Book Name</label>
                    <input type="text" name="book" class="form-control" value="<?php echo $book_name; ?>"
                        placeholder="Enter Book Name">
                </div>
                <div class="form-group">
                    <label>Borrow Date</label>
                    <input type="date" name="b_date" class="form-control" value="<?php echo $borrow_date; ?>"
                        placeholder="Borrow Date">
                </div>
                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" class="form-control" value="<?php echo $due_date; ?>"
                        placeholder="Due date">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" value="<?php echo $price; ?>"
                        placeholder="Enter Price">
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