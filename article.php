<?php
require 'connection.php';
include 'login.php';
$query = "SELECT * FROM articles ORDER BY articles.a_id DESC";
$result = mysqli_query($conn, $query);
$related_results = mysqli_query($conn, $query);

$categories_query = "select * from categories";
$category_result = mysqli_query($conn,$categories_query);
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
    <nav class="navbar navbar-expand-lg bg-success-subtle">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php<?php
                                                    // if (isset($_GET['login'])) {
                                                    if ($login != 'fail' && $login != '') {
                                                        echo '?login=' . $login;
                                                    }
                                                    // }
                                                    ?>">Chugli</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php<?php
                                                                                // if (isset($login)) {
                                                                                if ($login != 'fail' && $login != '') {
                                                                                    echo '?login=' . $login;
                                                                                }
                                                                                // }
                                                                                ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="publish.php<?php
                                                                // if (isset($login)) {
                                                                if ($login != 'fail' && $login != '') {
                                                                    echo '?login=' . $login;
                                                                }
                                                                // }
                                                                ?>">Publish</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                        <?php     
                            while ($rows = mysqli_fetch_assoc($category_result)) {
                            echo '<li><a class="dropdown-item" href="category_page.php?category='.$rows['category'];
                                if ($login != 'fail' && $login != '') {
                                    echo '&login=' . $login;
                                }
                                echo '">'.ucfirst($rows['category']).'</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="nav-item dropdown mx-4 pt-2">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="<?php
                                                                                                                                            // if (isset($_GET['login'])) {
                                                                                                                                            if ($login == 'fail' || $login == '') {
                                                                                                                                                echo 'display: none;';
                                                                                                                                            }
                                                                                                                                            // }
                                                                                                                                            ?>">
                            <?php
                            // if ($login != 'fail' && $login != '') {
                            echo $login;
                            // }
                            ?>
                        </a>
                        <ul class="dropdown-menu px-2">
                            <li class="drop-down-item">
                                <a class="nav-link" href="publications.php<?php
                                                                            // if (isset($login)) {
                                                                            if ($login != 'fail' && $login != '') {
                                                                                echo '?login=' . $login;
                                                                            }
                                                                            // }
                                                                            ?>">My Publications</a>
                            </li>
                            <li class="drop-down-item" <?php
                                                        if ($login != 'fail' || $login != '') {
                                                            $admin_query = "select * from login where account_type='admin'";
                                                            $admin_result = mysqli_query($conn, $admin_query);

                                                            $rows = mysqli_fetch_assoc($admin_result);
                                                            if ($rows['name'] != $login) {
                                                                echo 'style ="display: none;"';
                                                            }
                                                        }
                                                        ?>>
                                <a class="nav-link" href="admin_dashboard.php<?php
                                                                                // if (isset($login)) {
                                                                                if ($login != 'fail' && $login != '') {
                                                                                    echo '?login=' . $login;
                                                                                }
                                                                                // }
                                                                                ?>">Admin Dashboard</a>
                            </li>
                            <li class="drop-down-item">
                                <a class="nav-link mx-2" href="index.php">Log Out</a>
                            </li>
                        </ul>
                    </div>
                    <form class="d-flex" role="search" action='search_page.php<?php
                                                                                // if (isset($login)) {
                                                                                if ($login != 'fail' && $login != '') {
                                                                                    echo '?login=' . $login;
                                                                                }
                                                                                // }
                                                                                ?>' method='post'>
                        <input class="form-control me-2" name='search' type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="toast-container position-fixed  top-0 end-0 p-3">
                    <div id="liveToast" class="toast alert-success" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong id='toastHeading' class="me-auto"></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body" id="toastMessage">
                        </div>
                    </div>
                </div>
    <div class="container-fluid my-3 row">
        <aside class="container col-2 my-3" style="border-right: 1px solid black;">
            <div class='row my-2 px-4'>
                <button class="btn active" type="button" onclick="change('generalInfoBtn','admin_general_info.php')" id="generalInfoBtn">
                    Dashboard
                </button>
            </div>

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Articles
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordian-body">
                            <ul class="list-group list-group-flush">
                                <button class="btn" onclick="change('publishedBtn','admin_articles_published.php')" id="publishedBtn">
                                    <li class="list-group-item">Published</li>
                                </button>
                                <button class="btn" onclick="change('draftedBtn','admin_articles_drafted.php')" id="draftedBtn">
                                    <li class="list-group-item">Drafted</li>
                                </button>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion accordion-flush" id="accordionFlushExample2">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Categories
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample2">
                        <div class="accordian-body">
                            <ul class="list-group list-group-flush">
                                <button class="btn" id="categoryDistributionBtn" onclick="change('categoryDistributionBtn','admin_category_distribution.php')">
                                    <li class="list-group-item">Category Distribution</li>
                                </button>
                                <button class="btn" id="manageCategoryBtn" onclick="change('manageCategoryBtn','admin_manage_category.php')">
                                    <li class="list-group-item">Manage Categories</li>
                                </button>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row my-2 px-4'><button class="btn" id="manageUsers" onclick="change('manageUsers','admin_manage_users.php')">Manage Users</button></div>
            <div class='row my-2 px-4'><button class="btn" id="updateCredentials" onclick="change('updateCredentials','admin_update_credentials.php')">Update Credentials</button></div>
        </aside>
        <section class="container col-10 text-center mt-2 mb-5">
            <div class="ratio ratio-16x9">
                <iframe id='frame' src="admin_general_info.php" title="dashboard"></iframe>
            </div>
        </section>
    </div>
    <script>
        function Updated(heading, message) {
            const toastLiveExample = document.getElementById('liveToast')
            console.log("Function Called!");
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            const toastHeading = document.getElementById('toastHeading');
            const toastMessage = document.getElementById('toastMessage');

            toastHeading.innerHTML = heading;
            toastMessage.innerHTML = message;
            toastBootstrap.show()
        }

        function change(id, src) {
            document.querySelectorAll('.active').forEach(buttonElement => {
                const button = bootstrap.Button.getOrCreateInstance(buttonElement)
                button.toggle()
            })
            let element = document.getElementById(id);
            element.classList.add('active');
            const frame = document.getElementById('frame');
            frame.src = src;
        }
    </script>
</body>

</html>