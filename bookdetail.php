<?php include('templates/header.php') ?>
<?php

include('config/db_connect.php');

$requested = '';
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM book WHERE book_id= $id";

    $result = mysqli_query($conn, $sql);

    $book = mysqli_fetch_assoc($result);
    
    $photo = $book['cover_picture'];

    mysqli_free_result($result);

    $owner_id = $book['owner_id'];
    $sql = "SELECT first_name,last_name FROM user_details WHERE user_id= $owner_id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    mysqli_close($conn);
}
?>

<div class="container">
    <div class="row align-items-center">
        <?php if ($book) : ?>
            <div class="col col-lg-3 my-3">
                <?php echo '<img width="225 px" src="data:image/jpg;base64,' . $photo . '" class="img-fluid">'; ?>
            </div>
            <div class="col col-lg-9">
                <div class="my-4">
                    <h2><b><?php echo htmlspecialchars($book['book_title']); ?></b></h2>
                </div>
                <div class="my-4">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half-o"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <div class="my-4">
                    <h5><b>Price :</b> <i class="fa fa-inr"></i> <span><?php echo htmlspecialchars($book['price']); ?></span></h5>
                </div>
                <div class="my-4">
                    <h5><b>Uploaded By :</b> <i class="fa fa-user"></i> <span><?php echo htmlspecialchars($user['first_name']).' '.htmlspecialchars($user['last_name']); ?></span></h5>
                </div>
                <div class="my-4">
                    <h5><b>Description :</b> <span><?php echo htmlspecialchars($book['book_description']); ?></span></h5>
                </div>
                <div class="row my-4">
                    <div class="col-md d-flex justify-content-center">
                        <button type="button" class="btn btn-dark">Add To Cart</button>
                    </div>
                    <div class="col-md d-flex justify-content-center">
                        <a id="buynow" href="submitrequest.php?bid=<?php echo $id; ?>" class="btn btn-dark text-white" >Buy Now</a>
                        <div class="text-danger mb-2"><?php echo $requested; ?></div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <h5>No such book exists!</h5>
        <?php endif; ?>
    </div>
</div>

<?php include('templates/footer.php') ?>