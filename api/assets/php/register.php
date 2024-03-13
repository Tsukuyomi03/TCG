<?php

include "config.php";
session_start();
if (isset($_POST['register'])) {
    $name = $_POST['fname'];
    $surname = $_POST['lname'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $pword = $_POST['pword'];

    $sql1 = "SELECT * FROM users Where Username = '$uname' LIMIT 1";
    $result = mysqli_query($db, $sql1);
    $fetch = mysqli_fetch_assoc($result);
    if ($fetch) {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Username Already Exist";
        header("Location: /tcg/register.php");
        exit();
    } else {
        $wallet = "tcg:" . md5(uniqid(mt_rand(), true) . microtime(true));
        $sql2 = "INSERT INTO `users`(`ID`, `Timestamp`, `Name`, `Surname`, `Email`, `Username`, `Password`, `Wallet_Address`,`Wallet_Balance`) VALUES (NULL,NULL,'$name','$surname','$email','$uname','$pword','$wallet','50000')";
        $result2 = $db->query($sql2);
        if ($result2) {
            $_SESSION['status'] = "success";
            $_SESSION['message'] = "Account Created Successfully";
            header("Location: /tcg/index.php");
            exit();
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "There's an error creating your account, Please Try again after 5mins";
            header("Location: /tcg/register.php");
            exit();
        }
    }
}
?>