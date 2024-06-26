<?php
require 'connection.php';
include 'login.php';
$user_query = "SELECT count(*) FROM login where account_type <> 'admin'";
$category_query = "SELECT count(distinct(category)) FROM articles";
$p_articles_query = "SELECT * FROM articles where status = 'published'";
$d_articles_query = "SELECT * FROM articles where status = 'drafted'";
$user_results = mysqli_query($conn, $user_query);
$category_results = mysqli_query($conn, $category_query);
$p_articles_results = mysqli_query($conn, $p_articles_query);
$d_articles_results = mysqli_query($conn, $d_articles_query);

if (isset($_POST['delete_article']) && isset($_GET['a_id'])) {
    $delete_query = "delete from articles where a_id = " . $_GET['a_id'];
    mysqli_query($conn, $delete_query);
    header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_POST['publish_article']) && isset($_GET['a_id'])) {
    $publish_query = "update articles set status = 'published' where a_id = " . $_GET['a_id'];
    $get_category = "select category from articles where a_id = " . $_GET['a_id'];
    $result = mysqli_query($conn, $get_category);
    $category = mysqli_fetch_assoc($result);

    $category_check = "select count(*) from categories where category = '" . $category['category'] . "'";
    $result = mysqli_query($conn, $category_check);
    $count_category = mysqli_fetch_assoc($result);
    if ($count_category['count(*)'] == 0) {
        $add_category_query = "insert into categories(category) values('" . $category['category'] . "')";
        $result = mysqli_query($conn, $add_category_query);
    }
    mysqli_query($conn, $publish_query);
    header("Location: " . $_SERVER['PHP_SELF']);
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
    <section class="container-fluid col text-center my-5 ">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Article ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($rows = mysqli_fetch_assoc($d_articles_results)) {
                    echo '<tr data-bs-toggle="modal" data-bs-target="#exampleModal' . $i . '">
                                <td>' . $rows['a_id'] . '</td>
                                <td>' . $rows['title'] . '</td>
                                <td>' . $rows['description'] . '</td>
                                <td>' . ucfirst($rows['status']) . '</td>
                                <td><a href="admin_edit_article.php?a_id=' . $rows['a_id'] . '">
                                <button type="button" class="btn btn-outline-secondary mt-4 ms-2"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .90rem; --bs-btn-font-size: 1.0rem;">Edit</button></a></td>
                                <form method="post" action ="?a_id=' . $rows['a_id'] . '">
                                <td>
                                <button type="submit" name="publish_article" class="btn btn-outline-warning mt-4 ms-2"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .6rem; --bs-btn-font-size: 1.0rem;">Publish</button></td>
                                <td>
                                <button type="submit" name="delete_article" class="btn btn-outline-danger mt-4 ms-2"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .6rem; --bs-btn-font-size: 1.0rem;">Delete</button></td>
                                </form>
                            </tr>

                            <div class="modal fade" id="exampleModal' . $i . '" tabindex="-1" aria-labelledby="exampleModalLabel' . $i . '" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-5" id="exampleModalLabel' . $i . '">Complete Article</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel' . $i . '">' . $rows['title'] . '</h1>
                                        <div class="container row my-5"><img src="' . $rows['image'] . '" width = "500px"></img></div>
                                        <div class="container row"><p>' . $rows['article'] . '</p></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            ';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>