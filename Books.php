<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKS</title>
    <link rel="stylesheet" href="bookstyle.css">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php require_once 'bookProcess.php'; ?>

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
        $result = $mysqli->query("SELECT * FROM books") or die($mysqli->error);
        //pre_r($result);
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Availability</th>


                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['Price']; ?></td>
                    <td><?php echo $row['availability']; ?></td>


                    <td>
                        <a href="Books.php?edit=<?php echo $row['book_id']; ?>" class="btn btn-info">Edit</a>
                        <a href="bookProcess.php?delete=<?php echo $row['book_id']; ?>"
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
            <form action="bookProcess.php" method="POST">
                <input type="hidden" name="book_id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $title; ?>"
                        placeholder="Enter book title">
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" class="form-control" value="<?php echo $author; ?>"
                        placeholder="Enter book author">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="Price" class="form-control" value="<?php echo $price; ?>"
                        placeholder="Enter book price">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="availability" class="form-control" value="<?php echo $availability; ?>"
                        placeholder="Enter book availability">
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