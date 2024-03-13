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
            <li class="nav-item active">
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
                        <div class="col-lg-12">
                            <div class="row">
                                <h4><b>ACCOUNT SETTINGS</b></h4>
                            </div>
                            <br>
                            <div class="row">
                                <h6>GENERAL SETTINGS</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <form class="form-floating">
                                        <div class="form-group">
                                            <label class="form-control-placeholder" for="name">Name</label>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <input type="text" id="name" class="form-control" required
                                                        style="background-color:rgb(19, 22, 27); border-color:rgb(40, 44, 52)"
                                                        value="<?php echo $row['Name'] ?>">
                                                </div>
                                                <div class="col-lg-4">
                                                    <button class="btn btn-outline-dark form-control">SAVE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form>
                                        <div class="form-group">
                                            <label class="form-control-placeholder" for="name">Surame</label>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <input type="text" id="name" class="form-control" required
                                                        style="background-color:rgb(19, 22, 27); border-color:rgb(40, 44, 52)"
                                                        value="<?php echo $row['Surname'] ?>">
                                                </div>
                                                <div class="col-lg-4">
                                                    <button class="btn btn-outline-dark form-control">SAVE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <h6>PASSWORD SETTINGS</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <form class="form-floating">
                                        <div class="form-group">
                                            <label class="form-control-placeholder" for="name">Old Password</label>
                                            <div class="row">
                                                <input type="password" id="name" class="form-control" required
                                                    style="background-color:rgb(19, 22, 27); border-color:rgb(40, 44, 52)"
                                                    value="<?php echo $row['Name'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-placeholder" for="name">New Password</label>
                                            <div class="row">
                                                <input type="password" id="name" class="form-control" required
                                                    style="background-color:rgb(19, 22, 27); border-color:rgb(40, 44, 52)"
                                                    value="<?php echo $row['Name'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-placeholder" for="name">Re-Enter New
                                                Password</label>
                                            <div class="row">
                                                <input type="password" id="name" class="form-control" required
                                                    style="background-color:rgb(19, 22, 27); border-color:rgb(40, 44, 52)"
                                                    value="<?php echo $row['Name'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-outline-dark form-control">SAVE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <h6>PROMO CODE</h6>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <form>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <input type="text" id="name" class="form-control" required
                                                        style="background-color:rgb(19, 22, 27); border-color:rgb(40, 44, 52)">
                                                </div>
                                                <div class="col-lg-4">
                                                    <button class="btn btn-outline-dark form-control">SUBMIT</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
            /* Get the text field */
            var copyText = document.getElementById("wallet_address");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Copied the text: " + copyText.value);
        }
        $(function () {
            $('input').blur();
        });

    </script>
</body>

</html>