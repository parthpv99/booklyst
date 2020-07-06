<?php

$book = $author = $description = $price = $isbn = $photo = '';
$errors = array('book' => '', 'author' => '', 'description' => '', 'price' => '', 'isbn' => '', 'photo' => '');
include('config/db_connect.php');

if(isset($_POST['addbook'])) {
    if (empty($_POST['book'])) {
        $errors['book'] = 'Book name must be entered <br />';
    } else {
        $book = $_POST['book'];
    }

    if (empty($_POST['author'])) {
        $errors['author'] = 'Author name must be entered <br />';
    } else {
        $author = $_POST['author'];
        if (strlen($author) < 2) {
            $author = '';
            $errors['author'] = 'Invalid Author name <br />';
        } else if (!preg_match("/^[a-z ,.'-]+$/i", $author)) {
            $author = '';
            $errors['author'] = 'Invalid Author name <br />';
        }
    }

    if (!empty($_POST['description'])) {
        $description = $_POST['description'];
        if (!preg_match("/^[a-z0-9'():\/\.\-\s\,]+$/i", $description)) {
            $description = '';
            $errors['description'] = 'Invalid description <br />';
        }
    }

    if (empty($_POST['price'])) {
        $errors['price'] = 'price must be entered <br />';
    } else {
        $price = $_POST['price'];
        if (!preg_match("/^[0-9]+$/", $price)) {
            $price = '';
            $errors['price'] = 'Invalid Price <br />';
        }
    }
    
    if (empty($_POST['isbn'])) {
        $errors['isbn'] = 'ISBN must be entered <br />';
    } else {
        $isbn = $_POST['isbn'];
        if(strlen($isbn) < 13) {
            $isbn = '';
            $errors['isbn'] = 'Invalid isbn <br />';
        }
        else if (!preg_match("/^[0-9]+$/", $isbn)) {
            $isbn = '';
            $errors['isbn'] = 'Invalid isbn <br />';
        }
    }

    if(empty($_FILES['photo'])) {
        $errors['photo'] = 'Photo must be entered <br />';
    } else {
        $photo = base64_encode(file_get_contents($_FILES['photo']['tmp_name']));
    }
    
    if (!array_filter($errors)) {
        $book = mysqli_real_escape_string($conn, $_POST['book']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
        $photo = mysqli_escape_string($conn,base64_encode(file_get_contents($_FILES['photo']['tmp_name'])));
        $user = $_SESSION['id'];
        $sql = "INSERT INTO book(owner_id,book_title,author_name,book_description,price,isbn,cover_picture) VALUES('$user','$book','$author','$description','$price','$isbn','$photo')";

        if(mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}


?>

<!-- Add Book Modal -->
<div class="modal fade book-modal" id="addBookModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="addBookForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-book"></i></span>
                        </div>
                        <input type="text" name="book" class="form-control" value="<?php echo $book; ?>" placeholder="Book Name" required>
                        <div class="text-danger input-group mb-2"><?php echo $errors['book']; ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                        <input type="text" name="author" class="form-control" value="<?php echo $author; ?>" placeholder="Author Name" required>
                        <div class="text-danger input-group mb-2"><?php echo $errors['author']; ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-edit"></i></span>
                        </div>
                        <textarea class="form-control" name="description" placeholder="Description" rows="3" required><?php echo $description; ?></textarea>
                        <div class="text-danger input-group mb-2"><?php echo $errors['description']; ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-inr"></i></span>
                        </div>
                        <input type="number" name="price" class="form-control" value="<?php echo $price; ?>" placeholder="Price" required>
                        <div class="text-danger input-group mb-2"><?php echo $errors['price']; ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                        </div>
                        <input type="number" name="isbn" class="form-control" value="<?php echo $isbn; ?>" placeholder="ISBN" required>
                        <div class="text-danger input-group mb-2"><?php echo $errors['isbn']; ?></div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-camera-retro"></i></span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="photo" class="custom-file-input" id="addBookPhoto" required>
                            <label class="custom-file-label" for="addBookPhoto">Photo</label>
                            <div class="text-danger input-group mb-2"><?php echo $errors['photo']; ?></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" name="addbook" value="Add Book" form="addBookForm" class="btn btn-primary">
            </div>
        </div>
    </div>
</div>