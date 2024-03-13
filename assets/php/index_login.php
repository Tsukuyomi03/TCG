<?php
include "config.php";
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['uname'];
    $password = $_POST['pword'];
    $sql = "SELECT * FROM `users` WHERE Username = '$username' and Password = '$password'";
    $result = $db->query($sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['User'] = $row['Username'];
        $_SESSION['Wallet'] = $row['Wallet_Address'];
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Login Sucessful";
        header("Location: /tcg/ma_account.php");
        exit();

    } else {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Your Login Name or Password is invalid";
        header("Location: /tcg/index.php");
    }
}
?>