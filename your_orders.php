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
?>

<html lang="en">

<?php include('templates/header.php') ?>
<?php include('templates/footer.php') ?>

</html>