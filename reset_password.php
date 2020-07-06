<?php

$email = $password = '';
$errors = array('password' => '', 'confirm-password' => '');
$success = array('message' => '');

if (isset($_POST['reset'])) {

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
        echo $password;
        echo $confirmpassword;
        if ($confirmpassword != $password) {
            $confirmpassword = '';
            $errors['confirm-password'] = 'Password must be same <br />';
        }
    }

    if (!array_filter($errors)) {
        $success['message'] = 'Password changed successfully <br />';
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
                <img src="img/logo.png" class="card-img-top img-fluid card-image mx-auto d-block">
                <div class="car-body">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" class="container" method="POST">
                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </div>
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter Your New Password" value="<?php echo $password ?>">
                            <div class="text-danger input-group mb-2"><?php echo $errors['password']; ?></div>
                        </div>
                        <div class="input-group px-5 mb-3">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary disabled btn-primary" type="button">
                                    <i class="fa fa-lock"></i>
                                </button>
                            </div>
                            <label for="confirm-password" class="sr-only">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm-password" placeholder="Reenter Your New Password" value="<?php echo $password ?>">
                            <div class="text-danger input-group mb-2"><?php echo $errors['confirm-password']; ?></div>
                            <div class="text-success input-group mb-2"><?php echo $success['message']; ?></div>
                            <p class="card-text mx-auto mb-1"><a href="login.php" class="card-link">Click here to login</a></p>
                        </div>
                        <button type="submit" name="reset" class="btn btn-primary mb-3 mx-auto d-block"><i class="fa fa-retweet mr-3"></i><b>Reset Password</b></button>
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