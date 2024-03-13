<?php
include("config.php");
session_start();
$user = $_SESSION['User'];
$sql = "SELECT * FROM users WHERE Username ='$user'";
$result = $db->query($sql);
$row = $result->fetch_assoc();
echo $row['Wallet_Balance'];
$db->close();
?>