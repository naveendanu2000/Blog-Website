<?php
require 'connection.php';
include 'login.php';
$category_validation = '';

if(isset($_GET['category_validation'])){
    $category_validation = $_GET['category_validation'];
}
$user_query = "SELECT count(*) FROM login where account_type <> 'admin'";
$category_query = "SELECT categories.category, count(articles.category) FROM categories LEFT JOIN articles ON categories.category=articles.category group by categories.category;";
$p_articles_query = "SELECT * FROM articles where status = 'published'";
$d_articles_query = "SELECT count(article) FROM articles where status = 'drafted'";
$user_results = mysqli_query($conn, $user_query);
$category_results = mysqli_query($conn, $category_query);
$p_articles_results = mysqli_query($conn, $p_articles_query);
$d_articles_results = mysqli_query($conn, $d_articles_query);

$user_rows = mysqli_fetch_assoc($user_results);
$d_articles_rows = mysqli_fetch_assoc($d_articles_results);

if (isset($_POST['delete_category'])) {
    $delete_category_query_category = "delete from categories where category = '" . $_GET['category'] . "'";
    $delete_category_query_articles = "update articles set status = 'drafted' where category = '" . $_GET['category'] . "'";
    $delete_category_result = mysqli_query($conn, $delete_category_query_category);
    $delete_category_result = mysqli_query($conn, $delete_category_query_articles);

    header("Location: " . $_SERVER['PHP_SELF']);
}

if (isset($_POST['name_submit'])) {
    $change_name = "update categories set category = '" . $_POST['name'] . "' where category = '" . $_GET['category'] . "'";
    $change_name_article = "update articles set category = '" . $_POST['name'] . "' where category = '" . $_GET['category'] . "'";
    $result = mysqli_query($conn, $change_name);
    $result = mysqli_query($conn, $change_name_article);
    header("Location: " . $_SERVER['PHP_SELF']);
}

if (isset($_POST['add_category'])) {
    $validation_query = "select count(*) from categories where category='".strtolower($_POST['name'])."'";
    $validation_result = mysqli_query($conn,$validation_query);
    $count = mysqli_fetch_assoc($validation_result);
    if($count['count(*)'] == 0){
        $add_category = "insert into categories(category) values('" . strtolower($_POST['name']) . "')";
        $result = mysqli_query($conn, $add_category);
        header("Location: " . $_SERVER['PHP_SELF'] . "?category_validation=success");
    }
    else{
        header("Location: " . $_SERVER['PHP_SELF'] . "?category_validation=fail");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
</head>

<body style='font-family: "IBM Plex Sans", sans-serif;'>
    <section class="container text-center my-5 ">

    </section>
    <section class="container text-center my-5 ">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope='col'>S.NO.</th>
                    <th scope="col">Category</th>
                    <th scope="col">Number Articles</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($rows = mysqli_fetch_assoc($category_results)) {
                    echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . ucfirst($rows['category']) . '</td>
                                <td>' . $rows['count(articles.category)'] . '</td>
                                <td>
                                <button type="button" class="btn btn-outline-secondary ms-2"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .90rem; --bs-btn-font-size: 1.0rem;"  data-bs-toggle="modal" data-bs-target="#staticBackdrop' . $i . '">Edit</button></td>
                                <td>
                                <form method="post" action="?category=' . strtolower($rows['category']) . '" role="delete">
                                <button type="submit" name="delete_category" class="btn btn-outline-danger ms-2"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .90rem; --bs-btn-font-size: 1.0rem;">Delete</button></form></td>
                                </tr>
                                <div class="modal fade" id="staticBackdrop' . $i . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel' . $i . '" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel' . $i . '">Category Name:</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="?category=' . $rows['category'] . '" role="category name change" method="post">
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">Category Name: </span>
                                                    <input name="name" type="text" class="form-control" value="' . $rows['category'] . '" placeholder="Category of the Article, only(Politics, Medical, Sports) allowed." aria-label="Category of the Article" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" onclick="parent.Updated(`Success!`,`Category name changed!`)" name="name_submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                ';
                    $i++;
                }
                ?>
            </tbody>
        </table>

        <button type="button" class="btn btn-outline-success ms-2" style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .6rem; --bs-btn-font-size: 1.0rem;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Category</button>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Category Name:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="?category=' . $rows['category'] . '" role="category name change" method="post">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Category Name: </span>
                                <input name="name" type="text" class="form-control" placeholder="New category you want to add" aria-label="Category of the Article" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="add_category" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <script>
        <?php if($category_validation == 'success'){ echo "parent.Updated(`Success!`,`Category name added!`)";}
              elseif($category_validation == 'fail'){ echo "parent.Updated(`Failure!`,`Category already exit!`)";}?>
    </script>
</body>

</html>