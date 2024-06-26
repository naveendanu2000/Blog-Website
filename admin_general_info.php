<?php
require 'connection.php';
include 'login.php';
$user_query = "SELECT count(*) FROM login where account_type <> 'admin'";
$category_query = "SELECT count(distinct(category)) FROM categories";
$p_articles_query = "SELECT count(distinct(article)) FROM articles where status = 'published'";
$d_articles_query = "SELECT count(article) FROM articles where status = 'drafted'";
$user_results = mysqli_query($conn, $user_query);
$category_results = mysqli_query($conn, $category_query);
$p_articles_results = mysqli_query($conn, $p_articles_query);
$d_articles_results = mysqli_query($conn, $d_articles_query);

$user_rows = mysqli_fetch_assoc($user_results);
$category_rows = mysqli_fetch_assoc($category_results);
$p_articles_rows = mysqli_fetch_assoc($p_articles_results);
$d_articles_rows = mysqli_fetch_assoc($d_articles_results);

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
    <div class="container-fluid my-3 row">
        <section class="container col-8 text-center my-5 ">
            <div class="row gy-5">
                <div class="p-2 col-4 mx-5">
                    <a href="admin_manage_users.php" style="text-decoration:none;">
                        <div class="card-body pt-3 ms-3" style="border:2px solid black;">
                            <h5 class="card-title">Users</h5>
                            <h1 class="display-1 card-subtitle mb-2 "><?php echo $user_rows['count(*)'];?></h1>
                        </div>
                    </a>
                </div>
                <div class="p-2 col-4 mx-5">
                    <a href="admin_manage_category.php" style="text-decoration:none;">
                        <div class="card-body pt-3 ms-3" style="border:2px solid black;">
                            <h5 class="card-title">Categories</h5>
                            <h1 class="display-1 card-subtitle mb-2 "><?php echo $category_rows['count(distinct(category))'];?></h1>
                        </div>
                    </a>
                </div>
                <div class="p-2 col-4 mx-5">
                    <a href="admin_articles_published.php" style="text-decoration:none;">
                        <div class="card-body pt-3 ms-3" style="border:2px solid black;">
                            <h5 class="card-title">Published Articles</h5>
                            <h1 class="display-1 card-subtitle mb-2 "><?php echo $p_articles_rows['count(distinct(article))'];?></h1>
                        </div>
                    </a>
                </div>
                <div class="p-2 col-4 mx-5">
                    <a href="admin_articles_drafted.php" style="text-decoration:none;">
                        <div class="card-body pt-3 ms-3" style="border:2px solid black;">
                            <h5 class="card-title">Drafted Articles</h5>
                            <h1 class="display-1 card-subtitle mb-2 "><?php echo $d_articles_rows['count(article)'];?></h1>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</body>

</html>