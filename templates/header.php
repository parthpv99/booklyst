<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booklyst</title>
    <link rel="stylesheet" type="text/css" href="templates/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>


<body class="topbody">
    <?php include('addbook.php'); ?>
    <nav class="navbar fixed-top navbar-dark bg-dark">
        <div class="d-flex flex-grow-1">
            <a href="index.php" class="navbar-brand">
                <img src="img/logo.png" width="112" height="32" class="d-inline-block align-top my-1" alt="Booklyst">
            </a>
            <form class="pl-5 pr-3 d-inline-block w-100 my-auto">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <button type="button" class="nav-link my-auto btn btn-secondary btn-circle" data-toggle="modal" data-target=".book-modal">
                <i class="fa fa-plus text-white"></i>
            </button>
            <!-- <a href="#" class="nav-link my-auto bt" id="addbook">
                
            </a> -->
            <a href="#" class="nav-link my-auto pr-2" id="profile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="img/profile.png" alt="Profile" width="45" height="45" class="img-fluid rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="profile">
                <a class="dropdown-item" href="my_profile.php">My Profile</a>
                <a class="dropdown-item" href="notifications.php">Notifications<span class="badge badge-light ml-2">0</span></a>
                <a class="dropdown-item" href="your_orders.php">Your Orders</a>
                <a class="dropdown-item" href="your_wishlist.php">Your Wishlist</a>
                <a class="dropdown-item" href="logout.php">logout</a>
            </div>
            <a href="my_cart.php" class="nav-link my-auto text-white pr-2">
                <i class="fa fa-shopping-cart" style="font-size: 1.8rem;"></i>
            </a>
            <span class="badge badge-light my-auto">0</span>
        </div>
    </nav>