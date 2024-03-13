<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        TCG
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="assets/css/argon-dashboard.css?v=2.0.2" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <?php if(isset($_SESSION['message']) && $_SESSION['status'] == 'error'): ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                text: '<?php echo $_SESSION['message']?>',
                            })

                        </script>
                        <?php elseif (isset($_SESSION['message']) && $_SESSION['status'] == 'success'):?>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                text: '<?php echo $_SESSION['message']?>',
                            })

                        </script>
                        <?php endif; ?>
                        <?php unset($_SESSION['message']); ?>
                        <?php unset($_SESSION['status']); ?>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">CREATE AN ACCOUNT</h4>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="post" action="assets/php/register.php">
                                        <legend>Personal Information</legend>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Name" aria-label="Name" name="fname" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Last Name" aria-label="Last Name" name="lname" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" required>
                                        </div>
                                        <legend>Account Information</legend>
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Username" name="uname" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" name="pword" id="pword1" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg" placeholder="Re-Password" aria-label="Password" id="pword2" required>
                                        </div>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="showPass" onClick="showPassword();">
                                            <label class="form-check-label" for="showPass">Show Password</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" name="register" id="submit">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Already Have An Account ?
                                        <a href="/TCG/login.php" class="text-primary text-gradient font-weight-bold">Login</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('assets/images/register_logo.png');background-repeat: no-repeat;
  background-size: cover">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Pokémon Trading Card Game"</h4>
                                <p class="text-white position-relative">I see now that the circumstances of one's birth is irrelevant. It is what you do with the gift of life that determines who you are.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/argon-dashboard.min.js"></script>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script>
        $('#pword1, #pword2').on('keyup', function() {
            if ($('#pword1').val() == $('#pword2').val() || ($('#pword1').val() == "" && $('#pword2').val() == "")) {
                document.getElementById('submit').disabled = false;
                $('#pword1').html('').css('border-color', '#d2d6da');
                $('#pword2').html('').css('border-color', '#d2d6da');


            } else {
                $('#pword1').html('').css('border-color', 'red');
                $('#pword2').html('').css('border-color', 'red');
                document.getElementById('submit').disabled = true;
            }
        });

        function showPassword() {
            var x = document.getElementById("pword1");
            var y = document.getElementById("pword2");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";

            } else {
                x.type = "password";
                y.type = "password";
            }
        }

    </script>
</body>

</html>
