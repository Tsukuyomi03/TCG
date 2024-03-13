<?php
include "assets/php/config.php";
session_start();
if (!isset($_SESSION['User'])) {
    header("Location: /tcg/index.php");
    exit();
} else {
    $uname = $_SESSION['User'];
    $wallet_address = $_SESSION['Wallet'];

}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pokemon TCG</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>
    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: rgb(19, 22, 27);
        border-color: rgb(40, 44, 52);
    }

    .nav-tabs {
        border-color: rgb(40, 44, 52);
    }
</style>

<body id="page-top" onload="loadall();">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgb(13, 14, 18)">
        <a class="navbar-brand" href="dashboard.php"><img src="assets/images/pkmn_logo.png" style="height:30px"></a>
        <button class="navbar-toggler py-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
            style="margin-left:2%; margin-right:2%">
            <i class="fas fa-bars"></i>
        </button>
        <button id="sidebarToggleTop" class="py-2 navbar navbar-toggler" style="margin-left:2%; margin-right:2%">
            <i class="fas fa-align-left"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"> <i class="fas fa-columns"></i> Dashboard <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-shopping-bag"></i> Marketplace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ma_gacha.php"><i class="fas fa-gamepad"></i> Gacha</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0 ">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link" href="ma_account.php">
                            <i class="fas fa-user-circle"></i> <span class="">My Account</span>
                        </a>
                    </li>
                </ul>
            </form>
        </div>
    </nav>
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar"
            style="background-color:rgb(19,22,27); border-right: 1px solid rgb(28, 31, 37);">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="ma_account.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div>
                    <?php echo $_SESSION['User'] ?>
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="ma_account.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Account</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="ma_inventory.php">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Inventory</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ma_activity.php">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Activity</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ma_settings.php">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Settings</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-sign-out-alt" style="color:red"></i>
                    <span style="color:red">Logout</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" style="background-color: rgb(19, 22, 27)">
                <div class="container-fluid">
                    <br>
                    <div class="row">
                        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'error'): ?>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    text: '<?php echo $_SESSION['message'] ?>',
                                })

                            </script>
                        <?php elseif (isset($_SESSION['status']) && $_SESSION['status'] == 'image'): ?>
                            <script>
                                Swal.fire({
                                    title: '<?php echo $_SESSION['title'] ?>',
                                    imageUrl: 'assets/images/cards/<?php echo $_SESSION['message'] ?>',
                                    imageWidth: 400,
                                    imageHeight: 500,
                                })

                            </script>
                        <?php elseif (isset($_SESSION['status']) && $_SESSION['status'] == 'success'): ?>
                            <script>
                                Swal.fire({
                                    icon: 'success',
                                    text: '<?php echo $_SESSION['message'] ?>',
                                })

                            </script>
                        <?php endif; ?>
                        <?php unset($_SESSION['message']); ?>
                        <?php unset($_SESSION['status']); ?>
                        <?php unset($_SESSION['title']); ?>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card" style="border:1px solid rgb(28, 31, 37);">
                                <div class="card-body" style="background-color: rgb(28, 31, 37)">
                                    <div class="row">
                                        <div class="col-lg-2 col-sm-2 col-2 col-md-2 col-xl-2">
                                            <img src="assets/images/currency.png" style="width:100%">
                                        </div>
                                        <div class="col-lg-10 col-sm-10 col-10 col-md-10 col-xl-10"
                                            style="text-align:right;">
                                            <h2 id="walletBalance">P

                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active block relative inline-flex item-center cursor-pointer"
                                        id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                                        aria-controls="nav-home" aria-selected="true">
                                        <img src="assets/images/tab_cards.png" width="24">&nbsp;&nbsp;<b>CARDS</b>
                                    </a>
                                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                        role="tab" aria-controls="nav-profile" aria-selected="false">
                                        <img src="assets/images/tab_items.png" width="24">&nbsp;&nbsp;<b>ITEMS</b>
                                    </a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                    aria-labelledby="nav-home-tab">
                                    <div class="row" id="inventory">

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                    aria-labelledby="nav-profile-tab">...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="assets/js/jquery/jquery.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery-easing/jquery.easing.min.js"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("wallet_address");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
        }
        $(function () {
            $('input').blur();
        });
        function loadall() {
            get_pokecoins();
            get_inventory();
        }
        function get_pokecoins() {
            $.ajax({
                url: 'assets/php/get_pokecoins.php',
                success: function (data) {
                    document.getElementById("walletBalance").innerHTML = data;
                }
            })
        }
        function get_inventory() {
            $.ajax({
                url: "assets/php/get_inventory.php",
                type: "POST",
                cache: false,
                success: function (data) {
                    $('#inventory').html(data);
                }
            });
        }
    </script>
</body>

</html>