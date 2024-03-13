<?php
include("config.php");
session_start();
$wallet_address = $_SESSION["Wallet"];
$sql2 = "SELECT * FROM cards WHERE Owner='$wallet_address' ORDER BY `Card_Name`, `Rarity` DESC";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
        <div class="col-lg-1 col-md-1 col-sm-2 col-2" style="margin:5px;">
            <div class="row">
                <a href="" data-toggle="modal" data-target="viewCard"><img src="assets/images/cards/<?= $row2['File_Name']; ?>"
                        style="width:100%; border-radius:10px;"></a>
            </div>
        </div>
    <?php }
} else {
    echo "There's no card in your Inventory";
}
$db->close();
?>