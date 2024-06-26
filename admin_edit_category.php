<?php
require 'connection.php';
include 'login.php';
$query = "select * from categories where category = " . $_GET['category'];
$related_results = mysqli_query($conn, $query);
$submit_response = '';

if (isset($_GET['a_id'])) {
    //    echo $_GET['a_id'];
    $article_fetch = "select * from articles where a_id = " . $_GET['a_id'];
    $article_result = mysqli_query($conn, $article_fetch);
    $article_rows = mysqli_fetch_assoc($article_result);
    if (isset($_POST['submit'])) {
        // echo "submit posted!";
        if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['description']) && isset($_POST['article'])) {
            $title = htmlspecialchars(strip_tags(str_replace("'", '', $_POST['title'])));
            $description = strip_tags(str_replace("'", '', $_POST['description']));
            $article = strip_tags(str_replace("'", '', $_POST['article']));
            $category = strtolower(strip_tags(str_replace("'", '', $_POST['category'])));

            if (isset($_FILES['image'])) {
                $image_temp = $_FILES['image']['tmp_name'];
                $image = './includes/images/article_' . $_GET['a_id'];
                if (is_uploaded_file($image_temp)) {
                    if (move_uploaded_file($image_temp, $image)) {

                        $publish_query = "UPDATE `articles` SET `title` = '" . $_POST['title'] . "', `category` = '" . $_POST['category'] . "', `description` = '" . $_POST['description'] . "', `article` = '" . $_POST['article'] . "', `image` = '" . $image . "' WHERE `articles`.`a_id` = " . $_GET['a_id'];
                        $result = mysqli_query($conn, $publish_query);
                    } else {
                        echo "Failed to move your image.";
                    }
                } else {
                    $publish_query = "UPDATE `articles` SET `title` = '" . $_POST['title'] . "', `category` = '" . $_POST['category'] . "', `description` = '" . $_POST['description'] . "', `article` = '" . $_POST['article'] . "' WHERE `articles`.`a_id` = " . $_GET['a_id'];
                    $result = mysqli_query($conn, $publish_query);
                    if ($result) {
                        $submit = 'Article Updated!';
                    }
                    header('Location: ' . $_SERVER['PHP_SELF'] . '?a_id=' . $_GET['a_id']);
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body>
    <section class="container col-6">
        <div class='container-fluid row mt-2 mb-4'>
            <h3 class='h3 mb-4'>Fill the necessary details and write you article.</h3>
            <form action="?a_id=<?php echo $_GET['a_id'] ?>" role='publish' method='post' enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Category Name: </span>
                    <input name='category' type="text" class="form-control" value="<?php echo $article_rows['category']; ?>" placeholder="Category of the Article, only(Politics, Medical, Sports) allowed." aria-label="Category of the Article" aria-describedby="basic-addon1">
                </div>

                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary mb-3">Update</button>
            </form>
        </div>
    </section>
</body>

</html>