<?php
require 'connection.php';
include 'login.php';
$user_query = "SELECT count(*) FROM login where account_type <> 'admin'";
$category_query = "select category, count(*) from articles group by category";
$p_articles_query = "SELECT * FROM articles where status = 'published'";
$d_articles_query = "SELECT count(article) FROM articles where status = 'drafted'";
$user_results = mysqli_query($conn, $user_query);
$category_results = mysqli_query($conn, $category_query);
$p_articles_results = mysqli_query($conn, $p_articles_query);
$d_articles_results = mysqli_query($conn, $d_articles_query);

$user_rows = mysqli_fetch_assoc($user_results);
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
        <section class="container text-center my-5 ">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope='col'>S.NO.</th>
                        <th scope="col">Category</th>
                        <th scope="col">Number of Articles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1;
                    while ($rows = mysqli_fetch_assoc($category_results)) {
                        echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . ucfirst($rows['category']) . '</td>
                                <td>' . $rows['count(*)'] . '</td>
                            </tr>';
                            $i++;
                    }
                    ?>
                </tbody>
            </table>
        </section>
</body>

</html>