<?php
require 'connection.php';
include 'login.php';
$query = "select * from articles";
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
                        $update_query = "update articles set title = '" . $title . "', category = '" . $category . "', description = '" . $description . "', article = '" . $article . "', image = '" . $image . "' where a_id = " . $_GET['a_id'];
                        $result = mysqli_query($conn, $publish_query);
                        if ($result) {
                            // echo "Arcticle Submitted!";
                            $submit = 'Article Updated!';
                            header('Location: ' . $_SERVER['PHP_SELF'] . '?a_id=' . $_GET['a_id']);
                        }
                    } else {
                        echo "Failed to move your image.";
                    }
                } else {
                    // echo $_POST['title']
                    // echo $_POST['category'];
                    // echo $_POST['description'];
                    // echo $_POST['article'];
                    // echo $_GET['a_id'];
                    // $query = "select * form articles where title = ";
                    $update_query = "update articles set title = '" . $title . "', category = '" . $category . "', description = '" . $description . "', article = '" . $article . "' where a_id = " . $_GET['a_id'];
                    $result = mysqli_query($conn, $update_query);
                    if ($result) {
                        // echo "Arcticle Submitted!";
                        $submit = 'Article Updated!';
                        header('Location: ' . $_SERVER['PHP_SELF'] . '?a_id=' . $_GET['a_id']);
                    }
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
                    <span class="input-group-text" id="basic-addon1">Title</span>
                    <input name='title' type="text" class="form-control" value="<?php echo $article_rows['title']; ?>" placeholder="Title of the Article" aria-label="Title of the Article" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">Category</span>
                    <input name='category' type="text" class="form-control" value="<?php echo $article_rows['category']; ?>" placeholder="Category of the Article, only(Politics, Medical, Sports) allowed." aria-label="Category of the Article" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Description</span>
                    <textarea name='description' class="form-control" maxlength="500" value="" placeholder="Write a description of the article in less than 500 characters." aria-label="Description"><?php echo $article_rows['description']; ?></textarea>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text">Article</span>
                    <textarea name='article' rows="10" class="form-control" value="" placeholder="Write the complete article." aria-label="With textarea"><?php echo $article_rows['article']; ?></textarea>
                </div>
                <div>
                    <img src="<?php echo $article_rows['image']; ?>" height="350" width="450" alt="">
                </div>
                <div class="input-group mb-3">
                    <input name='image' type="file" class="form-control" id="inputGroupFile02">
                </div>


                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary mb-3">Update</button>


                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Updation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel Updation</button>
                                <button type="submit" onclick="parent.Updated(`Success!`,`The Article has been updated!`)" name='submit' data-bs-dismiss="modal" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        // const toastTrigger = document.getElementById('liveToastBtn')
        // const toastLiveExample = document.getElementById('liveToast')

        // if (toastTrigger) {
        //     const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
        //     toastTrigger.addEventListener('click', () => {
        //         toastBootstrap.show()
        //     })
        // }
        // parent.articleUpdated();
    </script>
</body>

</html>