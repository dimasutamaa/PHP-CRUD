<?php

include('config.php');

$name = $age = $email = $gender = "";
$nameErr = $ageErr = $emailErr = $genderErr = "";
$row = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
        } else {
            $age = test_input($_POST["age"]);
            if (!filter_var($age, FILTER_VALIDATE_INT)) {
                $ageErr = "Invalid age format";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }

        if (empty($nameErr) && empty($ageErr) && empty($emailErr) && empty($genderErr)) {
            //query update data into the database
            $query = "UPDATE users SET name = '$name', age = '$age', email = '$email', gender = '$gender' WHERE id = $id";

            //condition checking whether the data was successfully entered or not
            if ($conn->query($query)) {
                header("location: index.php");
            } else {
                echo "Data Failed to Save!";
            }
        }
    }
} else {
    echo "Invalid User ID!";
}

//function to sanitize user input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Edit User</title>
</head>

<body>
    <div class="mx-auto mt-5" style="width: 800px;">
        <div class="card">
            <h5 class="card-header">Edit User</h5>
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id) ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <span class="text-danger">* <?php echo $nameErr ?></span>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" value="<?php echo $row['name'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <span class="text-danger">* <?php echo $ageErr ?></span>
                        <input type="text" class="form-control" id="age" name="age" placeholder="20" value="<?php echo $row['age'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <span class="text-danger">* <?php echo $emailErr ?></span>
                        <input type="text" class="form-control" id="email" name="email" placeholder="johnDoe@gmail.com" value="<?php echo $row['email'] ?>">
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <span class="text-danger">* <?php echo $genderErr ?></span>
                        <select name="gender" id="gender" class="form-select">
                            <option value="">Choose Gender</option>
                            <option value="Male" <?php if ($row['gender'] == "Male") echo "selected" ?>>Male</option>
                            <option value="Female" <?php if ($row['gender'] == "Female") echo "selected" ?>>Female</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success" id="save" name="save">Update</button>
                    <button type="reset" class="btn btn-warning" id="reset" name="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>