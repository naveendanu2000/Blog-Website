<?php
require 'connection.php';
include 'login.php';
if(isset($_GET['login'])){
    $login = $_GET['login'];
}
$user_query = "SELECT * FROM login where account_type = 'admin'";
$category_query = "select category, count(*) from articles group by category";
$p_articles_query = "SELECT * FROM articles where status = 'published'";
$d_articles_query = "SELECT count(article) FROM articles where status = 'drafted'";
$user_results = mysqli_query($conn, $user_query);
$category_results = mysqli_query($conn, $category_query);
$p_articles_results = mysqli_query($conn, $p_articles_query);
$d_articles_results = mysqli_query($conn, $d_articles_query);

$admin_info = mysqli_fetch_assoc($user_results);
$d_articles_rows = mysqli_fetch_assoc($d_articles_results);

$password_status = "";
$verification_flag = "";
if (isset($_GET['verification_flag'])) {
    $verification_flag = $_GET['verification_flag'];
}

if (isset($_POST['old_password']) && isset($_POST['password']) && isset($_POST['re_password'])) {
    $verification = "select * from login where account_type = 'admin'";
    $verification_result = mysqli_query($conn, $verification);
    if ($_POST['password'] != $_POST['re_password']) {
        $password_status = 'Passwords do not match!';
        $verification_flag = "0";
        header('Location: ' . $_SERVER['PHP_SELF'] . '?login=' . $login . '&verification_flag=' .$verification_flag);
    } else {
        while ($rows = mysqli_fetch_assoc($verification_result)) {
            if ($rows['password'] != $_POST['old_password']) {
                $password_status = 'Old Password is not correct!';
                $verification_flag = "2";
                header('Location: ' . $_SERVER['PHP_SELF'] . '?login=' . $login . '&verification_flag=' .$verification_flag);
                break;
            }else{
                $verification_flag = "1";
            }
        }
    }
    if ($verification_flag) {
        $password_query = "UPDATE `login` SET `password` = '" . $_POST['password'] . "' WHERE `login`.`account_type` = 'admin';";
        $result = mysqli_query($conn, $password_query);
        if ($result) {
            $password_status = 'Password Changed!';
            header('Location: ' . $_SERVER['PHP_SELF'] . '?login=' . $login . '&verification_flag=' .$verification_flag);
        }
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
        <h3 class="h3 mb-4 mt-2 text-center">Credentials Updation</h3>
        <form action="" role='register' method='post'>


            <div class="input-group mb-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="<?php echo $admin_info['name']; ?>" id="floatingInputDisabled" placeholder="name@example.com" disabled>
                    <label for="floatingInputDisabled">Name</label>
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" value="<?php echo $admin_info['email']; ?>" id="floatingInputDisabled" placeholder="name@example.com" disabled>
                    <label for="floatingInputDisabled">Email</label>
                </div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Old-Password</span>
                <input name="old_password" type="password" class="form-control" placeholder="(8-16) character" aria-label="(8-16) character" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input name="password" type="password" class="form-control" placeholder="(8-16) character" aria-label="(8-16) character" aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Re-enter Password</span>
                <input name="re_password" type="password" class="form-control" placeholder="(8-16) character" aria-label="(8-16) character" aria-describedby="basic-addon1">
            </div>

            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-primary mb-3">Update</button>
            <div id="emailHelp" class="form-text"><?php if ($password_status != '') {
                                                        echo $password_status;
                                                    } ?></div>

            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirm Change Password</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script>
        // onclick="parent.Updated(`Success!`,`Password Changed!`)" 
        <?php
                if ($verification_flag == "1") {
                    echo "parent.Updated(`Success!`,`Password Changed Successfully!`)";
                } elseif ($verification_flag == "0") {
                    echo "parent.Updated(`Failure!`,`New Passwords do not match!`)";
                } elseif ($verification_flag == "2") {
                    echo "parent.Updated(`Failure!`,`Old Password is not correct!`)";
                }            
            // if($verification_flag == ''){echo "parent.Updated(`verification_flag`, ".$verification_flag.")";}
            ?>

    </script>
</body>

</html>