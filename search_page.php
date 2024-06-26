<?php
require 'connection.php';
include 'login.php';
$search = '';


$categories_query = "select * from categories";
$category_result = mysqli_query($conn,$categories_query);
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    // $words = array();
    // $word = '';
    // for($i = 0, $j=0; $i<strlen($_POST['search']) ; $i++){
    //     if($_POST['$i'] == ' '){
    //         $words[$j] = $word;
    //         $word = '';
    //         $j++;
    //     }
    //     else{
    //         $word = $word.$_POST[$i];
    //     }
    // }
    $query = "select * from articles where LOWER(article) like '%" . strtolower($_POST['search']) . "%' or LOWER(category) like '%" . strtolower($_POST['search']) . "%' and status = 'published'";
} elseif (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query = "select * from articles where status = 'published' and LOWER(article) like '%" . strtolower($_GET['search']) . "%' or LOWER(category) like '%" . strtolower($_GET['search']) . "%'";
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
                            $name_query = "select * from login where email='".$login."'";
                            $name_result = mysqli_query($conn, $name_query);

                            $rows = mysqli_fetch_assoc($name_result);
                            // if ($login != 'fail' && $login != '') {
                            echo $rows['name'];
                            // }
                            ?>
                        </a>
                        <ul class="dropdown-menu px-2">
                            <li class="drop-down-item" <?php
                                                        if ($login != 'fail' || $login != '') {
                                                            $admin_query = "select * from login where account_type='admin'";
                                                            $admin_result = mysqli_query($conn, $admin_query);

                                                            $rows = mysqli_fetch_assoc($admin_result);
                                                            if ($rows['email'] != $login) {
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
                                <a class="nav-link" href="user_dashboard.php<?php
                                                                            // if (isset($login)) {
                                                                            if ($login != 'fail' && $login != '') {
                                                                                echo '?login=' . $login;
                                                                            }
                                                                            // }
                                                                            ?>">My Profile</a>
                            </li>
                            <li class="drop-down-item">
                                <a class="nav-link mx-2" href="<?php echo $_SERVER['PHP_SELF'] ?>">Log Out</a>
                            </li>
                        </ul>
                    </div>
                    <form class="d-flex" role="search" action='<?php if ($login != 'fail' || $login == '') {
                                                                    echo '?login=' . $login;
                                                                } ?>' method='post'>
                        <input class="form-control me-2" name='search' type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid my-3 row">
        <section class="container col-8">
            <?php
            if (isset($_POST['search']) || isset($_GET['search'])) {
                $result = mysqli_query($conn, $query);
                while ($rows = mysqli_fetch_assoc($result)) {
                    echo '<article class="container-fluid row my-5 px-5">
                    <h4 class="h4">' . $rows['title'] . '</h4>
                    <div class="container col-sm-2"><img src=' . $rows['image'] . ' width = 100%></img></div>
                    <div class="container col-sm-10"><p>' . $rows['description'] . '<button type="button" class="btn btn-link"
                    style="--bs-btn-padding-y: .05rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .95rem;"><a href="complete_article.php?a_id=' . $rows['a_id'] . '&login=' . $login . '">read more</a></button></p></div>
                    </article>';
                }
            }
            ?>
        </section>
        <aside class="container-fluid col-3">
            <div class='container-fluid mt-2 mb-4' style="<?php
                                                            // if (isset($login)) {
                                                            if ($login != 'fail' && $login != '') {
                                                                echo 'display: none;';
                                                            }
                                                            // }
                                                            ?>">
                <form role='login' action='<?php if ($search != '') {
                                                echo '?search=' . $search;
                                            } ?>' method='post'>
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name='password' class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-2 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Keep me signed in</label>
                    </div>
                    <div class="container-fluid mb-2">
                        <button type="submit" class="btn btn-primary mb-3 px-4">Login</button>
                        <a href="registration.php<?php
                                                    // if (isset($login)) {
                                                    if ($login != 'fail' && $login != '') {
                                                        echo '?login=' . $login;
                                                    }
                                                    // }
                                                    ?>"><button type="button" class="btn btn-primary mb-3">Register</button></a>
                    </div>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </form>
            </div>
            <!-- <div class="container-fluid mt-2">
                <h5 class="h5">Related Articles</h5>
                <?php
                // if (isset($login)) {
                // if ($login != 'fail' && $login != '') {
                //     $login = $login;
                // }
                // }
                // while ($related = mysqli_fetch_assoc($related_results)) {
                //     echo '<a style="text-decoration :none;" href="complete_article.php?a_id=' . $related['a_id'] . '&login=' . $login . '">
                //     <article class="container-fluid row my-5">
                //     <h6 class="h6">' . $related['title'] . '</h6>
                //     </article>
                //     </a>';
                // }
                // 
                ?>
            </div> -->
        </aside>
    </div>
    <div class="container-fluid position-realtive bottom-0 end-0 text-start">
        <div class="row align-items p-4">
            <div class="col position-relative">
                <h4 class="h4 text-center">About Us</h4>
                <h5 class='h5'>Naveen Danu</h5>
                <p>Hey! I am a MCA student, studing at Graphic Era Hill University, Dehradun.</p>
            </div>
            <div class="col">
                <h4 class="h4 text-center">Contact Us</h4>
                <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Youtube</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>