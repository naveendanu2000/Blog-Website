<?php
require 'connection.php';
include 'login.php';
$user_query = "SELECT * FROM login where account_type <> 'admin'";
$category_query = "select category, count(*) from articles group by category";
$p_articles_query = "SELECT * FROM articles where status = 'published'";
$d_articles_query = "SELECT count(article) FROM articles where status = 'drafted'";
$user_results = mysqli_query($conn, $user_query);
$category_results = mysqli_query($conn, $category_query);
$p_articles_results = mysqli_query($conn, $p_articles_query);
$d_articles_results = mysqli_query($conn, $d_articles_query);

$d_articles_rows = mysqli_fetch_assoc($d_articles_results);

if (isset($_POST['delete_user'])) {
    $delete_user_query = "delete from login where email = '" . $_GET['email'] . "'";
    $delete_user_result = mysqli_query($conn, $delete_user_query);

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
    <section class="container text-center my-5 ">

    </section>
    <section class="container text-center my-5 ">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope='col'>Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Account type</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($rows = mysqli_fetch_assoc($user_results)) {
                    echo '<tr>
                                <td>' . ucfirst($rows['name']) . '</td>
                                <td>' . ucfirst($rows['email']) . '</td>
                                <td>' . ucfirst($rows['account_type']) . '</td>
                                <td>
                                <form method="post" action="?email=' . $rows['email'] . '" role="delete">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop'.$i.'" class="btn btn-outline-danger ms-2"
                                style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .90rem; --bs-btn-font-size: 1.0rem;">Remove</button></td>
                                </tr>
                                <div class="modal fade" id="staticBackdrop'.$i.'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel'.$i.'" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel'.$i.'">Confirm Removal</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit"  name="delete_user" onclick="parent.Updated(`Success!`,`User Removed!`)" class="btn btn-primary">Remove</button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </form>
                                ';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </section>
</body>

</html>