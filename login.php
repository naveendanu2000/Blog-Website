<?php
require "connection.php";
$login = '';
if (isset($_GET['login'])) {
    $query = "select * from login where email='" . $_GET['login'] ."'";
    $result = mysqli_query($conn, $query);

    while ($rows = mysqli_fetch_assoc($result)) {
        if ($_GET['login']== $rows['email']) {
            $login = $rows['email'];
            break;
        } else {
            $login = 'fail';
        }
    }
}
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "select * from login where email='" . $email . "' and password='" . $password . "'";
    $result = mysqli_query($conn, $query);

    while ($rows = mysqli_fetch_assoc($result)) {
        if ($email == $rows['email'] && $password == $rows['password']) {
            $login = $rows['email'];
            break;
        } else {
            $login = 'fail';
        }
    }

    // if (isset($_GET['category'])) {
    //     header('Location: ' . $_SERVER['HTTP_REFERER'] . '&login=' . $login);
    // } elseif (isset($_GET['a_id'])) {
    //     header('Location: ' . $_SERVER['HTTP_REFERER'] . '&login=' . $login);
    // } else {
    //     header('Location: ' . $_SERVER['HTTP_REFERER'] . '?login=' . $login);
    // }
    // } else {
    //     header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>

<?php
// if (isset($_GET['login'])) {
//     if ($_GET['login'] == 'success') {
//         echo '?login=' . $_GET['login'];
//     }
// }
?>