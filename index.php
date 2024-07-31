<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>User Data</title>
</head>

<body>
    <div class="mx-auto mt-5" style="width: 800px" ;>
        <div class="card">
            <h5 class="card-header">User Data</h5>
            <div class="card-body">
                <a href="addUser.php" class="btn btn-success">Add User</a>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Age</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('config.php');
                    $query = mysqli_query($conn, "SELECT * FROM users");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>

                        <tr>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['age'] ?></td>
                            <td><?php echo $data['email'] ?></td>
                            <td><?php echo $data['gender'] ?></td>
                            <td class="text-center">
                                <a href="editUser.php?id=<?php echo $data['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="deleteUser.php?id=<?php echo $data['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>