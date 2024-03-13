<?php
include "config.php";
include "cards.php";
session_start();
$wallet_address = $_SESSION['Wallet'];
$sql = "SELECT Wallet_Balance FROM users WHERE Wallet_Address='$wallet_address'";
$result = $db->query($sql);
$row = mysqli_fetch_assoc($result);
$balance = (double) $row['Wallet_Balance'];
if ($balance < 5000) {
    echo json_encode(array("statusCode" => 201));
} else {
    $gacha = rand(1, 10000);
    if ($gacha >= 9700 && $gacha <= 10000) {
        $draw = array_rand($vstars_cards, 1);
        $cname = $vstars_cards[$draw];
        $prefix = "VS_";
        $ext = ".jpg";
        $final = $prefix . $cname . $ext;
        $sql2 = "INSERT INTO cards VALUES (NULL, NULL, '$wallet_address','$cname','$final','VSTAR','Brilliant Stars','Inventory')";
        if (mysqli_query($db, $sql2)) {
            $sql3 = "UPDATE users SET Wallet_Balance=Wallet_Balance-5000 WHERE Wallet_Address='$wallet_address'";
            if (mysqli_query($db, $sql3)) {
                echo json_encode(array("Image" => $final, "statusCode" => 200));
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
    // VMAX = 3%
    elseif ($gacha >= 9400 && $gacha <= 9699) {
        $draw = array_rand($vmax_cards, 1);
        $cname = $vmax_cards[$draw];
        $prefix = "VM_";
        $ext = ".jpg";
        $final = $prefix . $cname . $ext;
        $sql2 = "INSERT INTO cards VALUES (NULL, NULL, '$wallet_address','$cname','$final','VMAX','Brilliant Stars','Inventory')";
        if (mysqli_query($db, $sql2)) {
            $sql3 = "UPDATE users SET Wallet_Balance=Wallet_Balance-5000 WHERE Wallet_Address='$wallet_address'";
            if (mysqli_query($db, $sql3)) {
                echo json_encode(array("Image" => $final, "statusCode" => 200));
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
    // V = 3%
    elseif ($gacha >= 9100 && $gacha <= 9399) {
        $draw = array_rand($v_cards, 1);
        $cname = $v_cards[$draw];
        $prefix = "V_";
        $ext = ".jpg";
        $final = $prefix . $cname . $ext;
        $sql2 = "INSERT INTO cards VALUES (NULL, NULL, '$wallet_address','$cname','$final','V','Brilliant Stars','Inventory')";
        if (mysqli_query($db, $sql2)) {
            $sql3 = "UPDATE users SET Wallet_Balance=Wallet_Balance-5000 WHERE Wallet_Address='$wallet_address'";
            if (mysqli_query($db, $sql3)) {
                echo json_encode(array("Image" => $final, "statusCode" => 200));
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
    // Trainer = 10%
    elseif ($gacha >= 8100 && $gacha <= 9099) {
        $draw = array_rand($trainer_cards, 1);
        $cname = $trainer_cards[$draw];
        $prefix = "T_";
        $ext = ".jpg";
        $final = $prefix . $cname . $ext;
        $sql2 = "INSERT INTO cards VALUES (NULL, NULL, '$wallet_address','$cname','$final','Trainer','Brilliant Stars','Inventory')";
        if (mysqli_query($db, $sql2)) {
            $sql3 = "UPDATE users SET Wallet_Balance=Wallet_Balance-5000 WHERE Wallet_Address='$wallet_address'";
            if (mysqli_query($db, $sql3)) {
                echo json_encode(array("Image" => $final, "statusCode" => 200));
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
    // Rare = 10%
    elseif ($gacha >= 7100 && $gacha <= 8099) {
        $draw = array_rand($rare_cards, 1);
        $cname = $rare_cards[$draw];
        $prefix = "R_";
        $ext = ".jpg";
        $final = $prefix . $cname . $ext;
        $sql2 = "INSERT INTO cards VALUES (NULL, NULL, '$wallet_address','$cname','$final','Rare','Brilliant Stars','Inventory')";
        if (mysqli_query($db, $sql2)) {
            $sql3 = "UPDATE users SET Wallet_Balance=Wallet_Balance-5000 WHERE Wallet_Address='$wallet_address'";
            if (mysqli_query($db, $sql3)) {
                echo json_encode(array("Image" => $final, "statusCode" => 200));
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
    // Uncommon = 30%
    elseif ($gacha >= 4000 && $gacha <= 7099) {
        $draw = array_rand($uncommon_cards, 1);
        $cname = $uncommon_cards[$draw];
        $prefix = "U_";
        $ext = ".jpg";
        $final = $prefix . $cname . $ext;
        $sql2 = "INSERT INTO cards VALUES (NULL, NULL, '$wallet_address','$cname','$final','Uncommon','Brilliant Stars','Inventory')";
        if (mysqli_query($db, $sql2)) {
            $sql3 = "UPDATE users SET Wallet_Balance=Wallet_Balance-5000 WHERE Wallet_Address='$wallet_address'";
            if (mysqli_query($db, $sql3)) {
                echo json_encode(array("Image" => $final, "statusCode" => 200));
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
    // Common = 60%
    elseif ($gacha >= 1 && $gacha <= 3999) {
        $draw = array_rand($common_cards, 1);
        $cname = $common_cards[$draw];
        $prefix = "C_";
        $ext = ".jpg";
        $final = $prefix . $cname . $ext;
        $sql2 = "INSERT INTO cards VALUES (NULL, NULL, '$wallet_address','$cname','$final','Common','Brilliant Stars','Inventory')";
        if (mysqli_query($db, $sql2)) {
            $sql3 = "UPDATE users SET Wallet_Balance=Wallet_Balance-5000 WHERE Wallet_Address='$wallet_address'";
            if (mysqli_query($db, $sql3)) {
                echo json_encode(array("Image" => $final, "statusCode" => 200));
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
}
?>