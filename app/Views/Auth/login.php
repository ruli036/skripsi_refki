<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="<?= base_url('nubis/images/logo.png') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('nubis/images/logo.png') ?>" type="image/x-icon">
    <title><?=env('TITLE','Default Title')?></title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">

    <link rel="preload" as="style" href="https://aicom.usk.ac.id/build/assets/app-31ac1ac1.css" />
    <link rel="stylesheet" href="https://aicom.usk.ac.id/build/assets/app-31ac1ac1.css" />
</head>

<body>
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <!-- <div>
                        <a class="logo" href="https://aicom.usk.ac.id">
                            <img class="img-fluid for-light" src="https://aicom.usk.ac.id/aicom/assets/img/logo/aicom-light.png" width="150px" alt="loginpage">
                            <img class="img-fluid for-dark" src="https://aicom.usk.ac.id/aicom/assets/img/logo/aicom-dark.png" width="150px" alt="loginpage">
                        </a>
                    </div> -->
                        <div class="login-main">
                            <form method="POST" class="theme-form" action="<?= url_to('login') ?>">
                                <h4>Sign in to account</h4>
                                <p>Enter your username & password to login</p>
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="col-form-label">Username</label>
                                    <input id="login" type="text" class="form-control " name="login" value="" required autocomplete="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password" placeholder="*********">
                                    <div class="show-hide"><span class="show"> </span></div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input type="checkbox" name="remember" id="remember">
                                        <label class="text-muted" for="remember">Remember password</label>
                                    </div>
                                    <a class="link" href="<?= base_url('forgot-password') ?>">Forgot Your Password?</a>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                </div>

                                <!-- <p class="mt-4 mb-0">Don't have account?<a class="ms-2" href="<?= base_url('register') ?>">Create Account</a></p> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
    <!-- Bootstrap js-->
    <script src="<?= base_url('assets/js/bootstrap/bootstrap.bundle.min.js') ?>"></script>
    <!-- feather icon js-->
    <script src="<?= base_url('assets/js/icons/feather-icon/feather.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/icons/feather-icon/feather-icon.js') ?>"></script>
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="<?= base_url('assets/js/config.js') ?>"></script>
    <!-- Plugins JS start-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <!-- Plugin used-->
</body>

</html>