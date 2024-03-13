<?php
include "config.php";
session_start();
$sender = $_SESSION['Wallet'];
$reciever = $_POST['reciever'];
$amount = $_POST['amount'];

$sql1 = "SELECT * FROM users WHERE Wallet_Address='$reciever' LIMIT 1";
$resutl1 = $db->query($sql1);

if ($sender == $reciever) {
    echo json_encode(array("statusCode" => 201));
    $db->close();
} else {
    $sql2 = "UPDATE `users` SET `Wallet_Balance`=`Wallet_Balance`-'$amount' WHERE `Wallet_Address`='$sender'";
    if (mysqli_query($db, $sql2)) {
        $sql3 = "UPDATE `users` SET `Wallet_Balance`=`Wallet_Balance`+'$amount' WHERE `Wallet_Address`='$reciever'";
        $resutl3 = $db->query($sql3);
        if (mysqli_query($db, $sql3)) {
            echo json_encode(array("statusCode" => 200));
            $db->close();
        } else {
            echo json_encode(array("statusCode" => 203));
            $db->close();
        }
    } else {
        echo json_encode(array("statusCode" => 203));
        $db->close();
    }
}


?>