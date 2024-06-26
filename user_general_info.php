<?php
require 'connection.php';
include 'login.php';
if (isset($_GET['login'])) {
    $login = $_GET['login'];
}
$user_query = "SELECT * FROM login where email = '" . $login . "'";
$p_articles_query = "SELECT count(distinct(article)) FROM articles where status = 'published' and author = '" . $login . "'";
$d_articles_query = "SELECT count(article) FROM articles where status = 'drafted'  and author = '" . $_GET['login'] . "'";
$user_results = mysqli_query($conn, $user_query);
$p_articles_results = mysqli_query($conn, $p_articles_query);
$d_articles_results = mysqli_query($conn, $d_articles_query);

$user_rows = mysqli_fetch_assoc($user_results);
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
        <section class="container col-8 my-5 ">
            <div class="row gy-5">
                <h2 class="h2">User Details</h2>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Name: </strong><?php echo ucfirst($user_rows['name']);?></li>
                    <li class="list-group-item"><strong>Email: </strong><?php echo ($user_rows['email']);?></li>
                    <li class="list-group-item"><strong>Account type: </strong><?php echo ucfirst($user_rows['account_type']);?></li>
                </ul>
            </div>
            <div class="row my-5 text-center ">
                <div class="p-2 col-4  mx-5">
                    <a href="user_articles_published.php?login=<?php echo $login;?>" style="text-decoration:none;">
                        <div class="card-body pt-3 ms-3" style="border:2px solid black;">
                            <h5 class="card-title">Published Articles</h5>
                            <h1 class="display-1 card-subtitle mb-2 "><?php echo $p_articles_rows['count(distinct(article))']; ?></h1>
                        </div>
                    </a>
                </div>
                <div class="p-2 col-4 mx-5">
                    <a href="user_articles_drafted.php?login=<?php echo $login;?>" style="text-decoration:none;">
                        <div class="card-body pt-3 ms-3" style="border:2px solid black;">
                            <h5 class="card-title">Drafted Articles</h5>
                            <h1 class="display-1 card-subtitle mb-2 "><?php echo $d_articles_rows['count(article)']; ?></h1>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</body>

</html>