<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

include('config/db_connect.php');
$email = $_SESSION['email'];
$sql = "SELECT is_valid FROM user_details WHERE email='$email'";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

if (!$user['is_valid']) {
    $_SESSION['is_valid'] = $user['is_valid'];
    header('Location: unauthorized.php');
    exit;
}

$sql = "SELECT * FROM genre ORDER BY id";

$result = mysqli_query($conn, $sql);

$genres = mysqli_fetch_all($result, MYSQLI_ASSOC);

$id = $_SESSION['id'];
$sql = "SELECT * FROM book WHERE owner_id NOT IN($id) AND is_available=1";

$result = mysqli_query($conn, $sql);

$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);

?>

<html lang="en">

<?php include('templates/header.php') ?>

<div class="row no-gutters">
    <?php include('templates/sidebar.php'); ?>

    <div class="col-md-10">
        <h4 class="mt-3 pl-5">Great Deals</h4>

        <hr class="hr-start">

        <!--Slider-->
        <div id="slider" class="carousel slide mx-auto w-50 my-5" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="img/fiftyoff.jpg" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/thirtyoff.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="img/fifteenoff.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <hr class="hr-end">

        <!-- Categories -->
        <h4 class="mt-1 pl-5">Categories</h4>

        <hr class="hr-start">
        <div class="row mx-5">
            <?php foreach ($genres as $genre) : ?>
                <div class="col-md-3 my-3">
                    <div class="card card-genre">
                        <div class="card-body">
                            <h4 class="text-center"><?php echo $genre['genre_name']; ?></h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr class="hr-end">

        <!-- Books -->
        <h4 class="mt-1 pl-5">Browse Books</h4>

        <hr class="hr-start">
        <div class="row mx-5">
            <?php if ($books) : ?>
                <?php foreach ($books as $book) : ?>
                    <div class="col-md-2 my-3">
                        <div class="card card-book">
                            <?php echo '<img src="data:image/jpg;base64,' . $book['cover_picture'] . '" class="img-fluid">'; ?>
                            <div class="card-body mb-1">
                                <div class="card-text">
                                    <h5 class="mb-1"><a href="bookdetail.php?id=<?php echo $book['book_id']; ?>" class="stretched-link text-dark"><?php echo $book['book_title']; ?></a></h5>
                                    <div>by <?php echo $book['author_name']; ?></div>
                                    <div><b>Price: </b>₹ <?php echo $book['price']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h5>No books available</h5>
            <?php endif; ?>
        </div>
        <hr class="hr-end">

    </div>
</div>

<?php include('templates/footer.php') ?>

</html>