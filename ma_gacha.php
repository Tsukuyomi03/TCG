<?php
include "assets/php/config.php";
session_start();
if (!isset($_SESSION['User'])) {
    header("Location: /tcg/index.php");
    exit();
} else {
    $uname = $_SESSION['User'];
    $sql = "SELECT * FROM users WHERE Username ='$uname'";
    $result = $db->query($sql);
    $row = mysqli_fetch_assoc($result);
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

<body id="page-top">
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
                    <a class="nav-link" href="#"><i class="fas fa-gamepad"></i> Gacha</a>
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
            <li class="nav-item active">
                <a class="nav-link" href="ma_account.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Account</span></a>
            </li>
            <li class="nav-item">
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
                    <div class="d-sm-flex align-items-center mb-4">
                        <input type="text" onclick="copyToClipboard()" id="wallet_address"
                            value="<?php echo $row['Wallet_Address'] ?>" readonly
                            style="width:30%;border: none; background-color:transparent"
                            class="form-list-item-name text-white">
                    </div>
                    <div class="row">
                        <?php if (isset($_SESSION['status']) && $_SESSION['status'] == 'error'): ?>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    text: '<?php echo $_SESSION['message'] ?>',
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
                        <div class="col-xl-12 col-sm-12 mb-xl-0 mb-4">
                            <div class="card text-white bg-dark mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-1">
                                            VSTAR = 1%
                                        </div>
                                        <div class="col-lg-1">
                                            VMAX = 1%
                                        </div>
                                        <div class="col-lg-1">
                                            V = 2%
                                        </div>
                                        <div class="col-lg-1">
                                            Trainer = 3%
                                        </div>
                                        <div class="col-lg-1">
                                            Rare = 3%
                                        </div>
                                        <div class="col-lg-2">
                                            Uncommon = 30%
                                        </div>
                                        <div class="col-lg-2">
                                            Common = 60%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-2 col-sm-4 col-md-4 mb-xl-0 mb-4 d-flex align-items-stretch">
                            <div class="card  text-white bg-dark mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <img src="assets/images/Brilliant_Stars_Card_Set.png" style="width:100%;">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <button class="btn btn-light btn-sm form-control"
                                            onclick="BSCS();">DRAW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-2 col-sm-4 col-md-4 mb-xl-0 mb-4 d-flex align-items-stretch">
                            <div class="card  text-white bg-dark mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <img src="assets/images/Fusion_Strike_Card_Set.png" style="width:100%;">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <button class="btn btn-light btn-sm form-control" onclick="CS()">DRAW</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-2 col-sm-4 col-md-4 mb-xl-0 mb-4 d-flex align-items-stretch">
                            <div class="card text-white bg-dark mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <img src="assets/images/Celebrations_Card_Set.png" style="width:100%;">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <button class="btn btn-light form-control btn-sm" onclick="CS()">DRAW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-lg-2 col-sm-4 col-md-4 mb-xl-0 mb-4 d-flex align-items-stretch">
                            <div class="card text-white bg-dark mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <img src="assets/images/Evolving_Skies_Card_Set.png" style="width:100%;">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <button class="btn btn-light form-control btn-sm" onclick="CS()">DRAW</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSend" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Send Poke Coins</h5>
                </div>
                <form method="post" action="assets/php/send.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" placeholder="Enter Wallet Address" class="form-control" required
                                name="wallet">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-12 col-md-12 col-xl-12">
                                    <div class="row">
                                        <div class="col-lg-1 col-sm-1 col-1 col-md-1 col-xl-1">
                                            <h4>P</h4>
                                        </div>
                                        <div class="col-lg-11 col-sm-11 col-11 col-md-11 col-xl-11">
                                            <input type="number" class="form-control" min="1"
                                                max="<?php echo $row['Wallet_Balance'] ?>" required name="amount">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <span style="font-size:12px;">NOTE:Please Double Check The Wallet Address Before
                                    Sending, Wrong Recipient Wont Be Refunded
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="send">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="assets/js/sb-admin-2.min.js"></script>
    <script>
        function copyToClipboard() {
            var copyText = document.getElementById("wallet_address");
            copyText.select();
            copyText.setSelectionRange(0, 99999);

            navigator.clipboard.writeText(copyText.value);
            alert("Copied the text: " + copyText.value);
        }
        function BSCS() {
            Swal.fire({
                title: 'CONFIRMATION',
                text: "Spend P5000 to draw this card set?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/tcg/assets/php/gacha.php",
                        success: function (dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if (dataResult.statusCode == 200) {
                                Swal.fire({
                                    imageUrl: 'assets/images/cards/' + dataResult.Image,
                                    imageWidth: 400,
                                    imageHeight: 500,
                                })
                            }
                            else if (dataResult.statusCode == 201) {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Insufficient Balance',
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    text: 'Something Went Wrong',
                                })
                            }
                        }
                    });
                }
            })
        }
    </script>
</body>

</html>