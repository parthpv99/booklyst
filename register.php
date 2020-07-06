<?php

$fname = $lname = $email = $password = $confirmpassword = $address = $country = $state = $city = '';
$errors = array('fname' => '', 'lname' => '', 'email' => '', 'password' => '', 'confirm-password' => '', 'address' => '', 'country' => '', 'state' => '', 'city' => '');
include('config/db_connect.php');

if (isset($_POST['register'])) {

    if (empty($_POST['fname'])) {
        $errors['fname'] = 'First name must be entered <br />';
    } else {
        $fname = $_POST['fname'];
        if (strlen($fname) < 2) {
            $fname = '';
            $errors['fname'] = 'Invalid first name <br />';
        } else if (!preg_match("/^[a-z ,.'-]+$/i", $fname)) {
            $fname = '';
            $errors['fname'] = 'Invalid first name <br />';
        }
    }

    if (!empty($_POST['lname'])) {
        $lname = $_POST['lname'];
        if (strlen($lname) < 2) {
            $lname = '';
            $errors['lname'] = 'Invalid last name <br />';
        } else if (!preg_match("/^[a-z ,.'-]+$/i", $lname)) {
            $lname = '';
            $errors['lname'] = 'Invalid last name <br />';
        }
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email id must be entered <br />';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = '';
            $errors['email'] = 'Email id not valid <br />';
        }
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Password must be entered <br />';
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8) {
            $password = '';
            $errors['password'] = 'Password must be atleast 8 Characters long <br />';
        }
    }

    if (empty($_POST['confirm-password'])) {
        $errors['confirm-password'] = 'Password must be same <br />';
    } else {
        $confirmpassword = $_POST['confirm-password'];
        if ($confirmpassword != $password) {
            $confirmpassword = '';
            $errors['confirm-password'] = 'Password must be same <br />';
        }
    }

    if (!empty($_POST['address'])) {
        $address = $_POST['address'];
        if (!preg_match("/^[a-z0-9'\/\.\-\s\,]+$/i", $address)) {
            $address = '';
            $errors['address'] = 'Invalid address <br />';
        }
    }

    if (!empty($_POST['country'])) {
        $country = $_POST['country'];
        if (!preg_match('/[a-zA-Z]{2,}/', $country)) {
            $country = '';
            $errors['country'] = 'Invalid country name';
        }
    }

    if (!empty($_POST['state'])) {
        $state = $_POST['state'];
        if (!preg_match('/[a-zA-Z]{2,}/', $state)) {
            $state = '';
            $errors['state'] = 'Invalid state name';
        }
    }

    if (!empty($_POST['city'])) {
        $city = $_POST['city'];
        if (!preg_match('/[a-zA-Z]{2,}/', $city)) {
            $city = '';
            $errors['city'] = 'Invalid city name';
        }
    }

    if (!array_filter($errors)) {
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);

        $sql = "INSERT INTO user_details(first_name,last_name,email,password,address,country,state,city) VALUES('$fname','$lname','$email','$password','$address','$country','$state','$city')";

        if(mysqli_query($conn, $sql)) {
            header('Location: login.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
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
        <div class="row h-100 mt-3 mb-5">
            <div class="card rounded card-style mx-auto my-auto">
                <img src="img/logo.png" class="card-img-top img-fluid card-image mx-auto d-block my-3">
                <div class="car-body">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="container" method="POST">
                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-user-o"></i>
                                </button>
                            </div>
                            <label for="fname" class="sr-only">First Name</label>
                            <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>" placeholder="Enter Your First Name*">
                            <div class="text-danger input-group mb-2"><?php echo $errors['fname']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-user-o"></i>
                                </button>
                            </div>
                            <label for="lname" class="sr-only">Last Name</label>
                            <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>" placeholder="Enter Your Last Name">
                            <div class="text-danger input-group mb-2"><?php echo $errors['lname']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-envelope"></i>
                                </button>
                            </div>
                            <label for="email" class="sr-only">Email id</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Enter Your Email*">
                            <div class="text-danger input-group mb-2"><?php echo $errors['email']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </div>
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="Enter Your Password*">
                            <div class="text-danger input-group mb-2"><?php echo $errors['password']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </div>
                            <label for="confirm-password" class="sr-only">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm-password" value="<?php echo $confirmpassword; ?>" placeholder="Reenter Your Password*">
                            <div class="text-danger input-group mb-2"><?php echo $errors['confirm-password']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <label for="address" class="sr-only">address</label>
                            <textarea class="form-control" name="address" rows="3" value="<?php echo $address; ?>" placeholder="Enter Your Address"></textarea>
                            <div class="text-danger input-group mb-2"><?php echo $errors['address']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-globe"></i>
                                </button>
                            </div>
                            <label for="country" class="sr-only">Country</label>
                            <input type="text" class="form-control" name="country" value="<?php echo $country; ?>" placeholder="Enter Your Country">
                            <div class="text-danger input-group mb-2"><?php echo $errors['country']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-map"></i>
                                </button>
                            </div>
                            <label for="state" class="sr-only">State</label>
                            <input type="text" class="form-control" name="state" value="<?php echo $state; ?>" placeholder="Enter Your State">
                            <div class="text-danger input-group mb-2"><?php echo $errors['state']; ?></div>
                        </div>

                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-street-view"></i>
                                </button>
                            </div>
                            <label for="city" class="sr-only">City</label>
                            <input type="text" class="form-control" name="city" value="<?php echo $city; ?>" placeholder="Enter Your City">
                            <div class="text-danger input-group mb-2"><?php echo $errors['city']; ?></div>
                        </div>

                        <p class="card-text text-center">Already have an account? <a href="login.php" class="card-link">Login</a></p>
                        <button type="submit" name="register" class="btn btn-primary mb-3 mx-auto d-block"><i class="fa fa-send mr-3"></i><b>Register</b></button>
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