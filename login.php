<?php

include("header.php");


if (isset($_POST['username']) && isset($_POST['password'])) {

    //Assign variables to information received from the form, sanitize the input, hash the password
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = md5(mysqli_real_escape_string($conn, $_POST['password']));

    //Store the SQL in a variable, run the SQL query and store the result in another variable.
    $sql = "Select * FROM users WHERE username = '$user'";
    $result = $conn->query($sql);

    //Store the SQL query results in a variable
    $row = $result->fetch_assoc();

    //Check to see if any rows were returned. This verifies if the username is present in the database.
    if (isset($row['username'])) {

        //Check to see if the password in the database matches the password we received from the form.
        if ($row['password'] == $pass) {

            //Create session variables to identify the user is now logged in. 
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('Location: index.php');
        } else {
            echo '<div class="alert alert-danger">Invalid Password.</div>';
        }
    } else {
        echo '<div class="alert alert-danger">User not found.</div>';
    }
}
?>
    <div class="container mt-2 minh-72">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" />
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Sign In!</button>
                </form>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>