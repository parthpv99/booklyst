<?php
session_start();
if (isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

include('config/db_connect.php');

$email = $password = $id = '';
$errors = array('email' => '', 'password' => '');
if (isset($_POST['login'])) {

    //Checking Email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email id must be entered <br />';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = '';
            $errors['email'] = 'Invalid email or password <br />';
        } else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            
            $sql = "SELECT user_id FROM user_details WHERE email='$email'";

            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if(!$count) {
                $errors['email'] = 'Invalid email or password <br />';
            }

            mysqli_free_result($result);
        }
    }

    //Checking Password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password must be entered <br />';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $password = '';
            $errors['password'] = 'Invalid email or password <br />';
        } else {
            $password = mysqli_real_escape_string($conn,$_POST['password']);   
            
            $sql = "SELECT user_id FROM user_details WHERE email='$email' AND password='$password'";

            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            $id = $row['user_id'];
            
            if(!$count) {
                $errors['email'] = 'Invalid email or password <br />';
                $errors['password'] = 'Invalid email or password <br />';
            }

            mysqli_free_result($result);
        }
    }

    if (!array_filter($errors)) {
        $_SESSION['email'] = $email;
        $_SESSION['id'] = $id;
        header('Location: index.php');
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booklyst</title>
    <style>
        .card-image {
            width: 25% !important;
            height: 25% !important;
        }

        .card-style {
            width: 50% !important;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row h-100">
            <div class="card rounded card-style mx-auto my-auto">
                <img src="img/logo.png" class="card-img-top img-fluid card-image mx-auto d-block my-3">
                <div class="car-body">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="container" method="POST">
                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-user"></i>
                                </button>
                            </div>
                            <label for="email" class="sr-only">Email id</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter Your Email" value="<?php echo $email ?>">
                            <div class="text-danger input-group mb-2"><?php echo $errors['email']; ?></div>
                        </div>
                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </div>
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Your Password" value="<?php echo $password ?>">
                            <div class="text-danger input-group mb-2"><?php echo $errors['password']; ?></div>
                        </div>
                        <p class="card-text text-center mb-1"><a href="forgot_password.php" class="card-link">Forgot Pasword?</a></p>
                        <p class="card-text text-center">Don't have an account? <a href="register.php" class="card-link">Register</a></p>
                        <button type="submit" name="login" class="btn btn-primary mb-3 mx-auto d-block"><i class="fa fa-send mr-3"></i><b>Login</b></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- required scripts for BS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>