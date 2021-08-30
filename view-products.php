<?php
include "config.php";

$sql = "Select * from book";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Books</h2>

        <a class="btn btn-primary" style="float:right" href="add-products.php">Add New Book</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <!-- <th>Description</th> -->
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php
                    while($row = $result->fetch_assoc()){
                ?>

                <tr>
                    <td><?php echo $row['id']?></td>
                    <td><?php echo $row['title']?></td>
                    <td><?php echo $row['category']?></td>
                    <td><?php echo $row['author']?></td>
                    <td><?php echo $row['price']?></td>
                    <td><?php echo $row['quantity']?></td>
                    <!-- <td><?php echo $row['description']?></td> -->
                    <!-- <td><?php echo $row['image']?></td> -->
                    <td><img width="100px"; height="100px"; src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt=""></td>

                    <td><a class="btn btn-info" href="edit-products.php?id=<?php echo $row['id']?>">Edit</a>&nbsp;&nbsp; <a class="btn btn-danger" href="delete-products.php?id=<?php echo $row['id'];?>" >Delete</a></td>

                </tr>

                <?php
                    }
                ?>

            </tbody>

        </table>

    </div>
</body>
</html>