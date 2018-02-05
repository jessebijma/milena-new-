<?php

require_once 'Classes/DB.php';

$username = $password = "";
$username_err = $password_err = "";
//print_r(password_hash('pwtohash', PASSWORD_BCRYPT,['cost'=>11]));

//process form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"]) {

    //check if username is empty
    if (!isset($_POST["username"])) {
        $username_err = "Please enter username";
    } else {
        $username = trim($_POST["username"]);
    }

    //Check if password is empty
    if (!isset($_POST['password'])) {
        $password_err = "Please enter your password";
    } else {
        $password = trim($_POST['password']);
    }

    //validate credentials
    if (empty($username_err) && empty($password_err)) {
        //prepare a select statement
        $login = new DB();
        $login->query('SELECT `id`, `username`, `password` FROM `admins` WHERE `username` = :username');
        $login->bind(':username', $username);
        $row = $login->single();

        // check if user exists
        if ($login->rowCount() == 1) {
            // verify password
            $cred = $login->single();

            if (password_verify($password, $cred["password"])) {
                //password is correct, start new session

                session_start();
                $_SESSION['uid'] = $cred["id"];
                header("location: admin.php");
            } else {
                // display error message
                $password_err = "password incorrect";
            }
        } else {
            $login->close();
        }
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 350px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username:<sup>*</sup></label>
            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password:<sup>*</sup></label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </div>
    </form>
</div>
</body>
</html>


