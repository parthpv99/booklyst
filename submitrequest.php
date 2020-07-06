
<?php session_start(); include('templates/header.php') ?>

<?php
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['is_valid']) && !$_SESSION['is_valid']) {
    header('Location: unauthorized.php');
    exit;
}

include('config/db_connect.php');

if (isset($_GET['bid'])) {

    $id = mysqli_real_escape_string($conn, $_GET['bid']);

    $sql = "SELECT * FROM transaction WHERE book_id= $id";

    $result = mysqli_query($conn, $sql);
    $transaction = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    mysqli_free_result($result);

    if (!$count) {
        $sql = "SELECT owner_id FROM book WHERE book_id= $id";
        $result = mysqli_query($conn, $sql);
        $owners = mysqli_fetch_assoc($result);
        $owner = $owners['owner_id'];
        mysqli_free_result($result);

        $borrower = $_SESSION['id'];
        $sql = "INSERT INTO transaction(owner_id,borrower_id,book_id) VALUES('$owner','$borrower','$id');";

        if (mysqli_query($conn, $sql)) {
            $info = 'Your request is submitted, waiting for the approval from owner!';
        } else {
            $info =  mysqli_error($conn);
        }
    } else {
        if($transaction['status']) {
            if($transaction['approval_status']) {
                $info = 'Your Request is approved. Enjoy reading!';                
            } else {
                $info = 'Your Request is rejected. Please try again letter.';
            }
        } else {
            $info = 'Your have already submitted for approval, wait for the approval!';
        }
    }
    mysqli_close($conn);
}
?>

<div class="container">
    <div class="my-5 text-center">
        <div class="text-info my-5">
            <h3><?php echo $info; ?></h3>
        </div>
        <div class="d-flex justify-content-center">
            <a href="index.php" class="btn btn-dark">Continue Shopping</a>
        </div>
    </div>
</div>
<?php include('templates/footer.php') ?>