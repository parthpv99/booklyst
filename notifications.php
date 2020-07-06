<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit;
}

if (isset($_SESSION['is_valid']) && !$_SESSION['is_valid']) {
    header('Location: unauthorized.php');
    exit;
}

include('config/db_connect.php');

if (isset($_GET['id'])) {
    $tid = $_GET['id'];
    if (isset($_GET['accept']) && isset($_GET['bid'])) {
        $accept = $_GET['accept'];
        $book_id = $_GET['bid'];
        if ($accept) {
            $sql = "UPDATE book SET is_available=0 WHERE book_id= $book_id";
            if (!mysqli_query($conn, $sql)) {
                echo "Sql error: " . mysqli_error($conn);
            } else {
                $sql = "UPDATE transaction SET status=1,approval_status=$accept WHERE transaction_id= $tid";
                if (!mysqli_query($conn, $sql)) {
                    echo "Sql error: " . mysqli_error($conn);
                }
            }
        } else {
            $sql = "UPDATE transaction SET status=1,approval_status=$accept WHERE transaction_id= $tid";
            if (!mysqli_query($conn, $sql)) {
                echo "Sql error: " . mysqli_error($conn);
            }
        }
    }
}

$info = '';
$id = $_SESSION['id'];
$sql = "SELECT * FROM transaction WHERE owner_id= $id";

$result = mysqli_query($conn, $sql);
$transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

?>

<html lang="en">

<?php include('templates/header.php') ?>

<div class="container">
    <?php foreach ($transactions as $transaction) {
        $bid = $transaction['book_id'];
        $sql = "SELECT * FROM book WHERE book_id=$bid";
        $result = mysqli_query($conn, $sql);
        $book = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $borrower_id = $transaction['owner_id'];
        $sql = "SELECT first_name,last_name FROM user_details WHERE user_id=$borrower_id";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($transaction['approval_status']) {
            $info = 'You have approved this transaction.';
        } else {
            $info = 'You have rejected this transaction.';
        }
    ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <div class="card my-5">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $book['book_title']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $book['book_title']; ?></h6>
                    <p class="card-text"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?> is requesting to purchase this book.</p>
                    <?php if (!$transaction['status']) { ?>
                        <a href="?id=<?php echo $transaction['transaction_id']; ?>&&accept=1&&bid=<?php echo $book['book_id']; ?>" name="accept" class="btn btn-success"><i class="fa fa-check"></i> Accept</a>
                        <a href="?id=<?php echo $transaction['transaction_id']; ?>&&accept=0" name="reject" class="btn btn-danger"><i class="fa fa-times"></i> Reject</a>
                    <?php } else { ?>
                        <p class="card-text <?php
                                            if ($transaction['approval_status']) {
                                                echo "text-success";
                                            } else {
                                                echo "text-danger";
                                            }
                                            ?>">
                            <?php echo $info; ?>
                        </p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
</div>

<?php include('templates/footer.php') ?>

</html>