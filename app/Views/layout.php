<!doctype html>
<?php

$errors = session()->getFlashData('errors');
// print_r($errors);
// exit();

?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title><?= isset($title) ? "{$title} | SkyWave Cafe" : "SkyWave Cafe" ?></title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
    <!-- Bootstrap core CSS -->
    <link href="
	
	<?= base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <meta name="theme-color" content="#7952b3">
    <link rel="stylesheet" href="<?= base_url("/css/style.css") ?>">
    <link rel="stylesheet" href="<?= base_url("/css/jquery.dataTables.min.css") ?>">

    <style> 
   @media print {
       .navbar, .card, .text-muted, .btn, .caption-top,
       .span, 
       th:nth-child(5), 
       td:nth-child(5),
       footer, 
       a#debug-icon-link{
           display: none;
       }
   }
</style>
</head>

<body>
    <header>
        <!--  <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">Add some information about the album below, the author, or any other
                            background context. Make it a few sentences long so folks can pick up some informative
                            tidbits. Then, link them off to some social networking sites or contact information.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#" class="text-white">Follow on Twitter</a>
                            </li>
                            <li>
                                <a href="#" class="text-white">Like on Facebook</a>
                            </li>
                            <li>
                                <a href="#" class="text-white">Email me</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  -->



        <div class="navbar navbar-expand-lg navbar-light" style="background-color: #ecf0f1;">
            <div class="container">
                <a href="/" class="navbar-brand d-flex align-items-center">
                    <strong>SkyWave Cafe Pontianak </strong>
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= $title == "Home" ? "active" : "" ?>" aria-current="page"
                                href="/">Home</a>
                        </li>
                        <?php if (session()->isLoggedIn) : ?>
                        <li class="nav-item"><a href="<?= base_url('menu/create') ?>"
                                class="nav-link <?= $title == "Create Menu" ? "active" : "" ?>">Tambah Menu</a></li>
                        <?php endif; ?>
                        <?php if (session()->isLoggedIn) : ?>
                        <li class="nav-item"><a href="<?= base_url('menu/me') ?>"
                                class="nav-link <?= $title == "My Menu" ? "active" : "" ?>">Menu Saya</a></li>
                        <?php endif; ?>
                    </ul>
                    <span class="navbar-text">
                        <?php if (!session()->isLoggedIn) : ?>
                        <a href="<?= base_url('auth/login') ?>">Login</a>
                        <a href="<?= base_url('auth/register') ?>">Register</a>
                        <?php else : ?>
                        <a href="
								<?= base_url('auth/logout') ?>">Logout </a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <?php if (!is_null($errors) && !empty($errors)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Terjadi Kesalahan</h4>
                            <hr>
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php if (!is_null(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success" role="alert">
                            <?= session()->getFlashData('success') ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </main>


    
    <footer class="text-muted py-5">
        <div class="container">
            <p class="mb-1">Copyright © 2022, SkyWave Cafe Pontianak</p>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script scr="<?= base_url('/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script scr="<?= base_url('/sweetalert2.all.min.js') ?>"></script>
<script scr="<?= base_url('/js/main.js') ?>"></script>

<script>
<?php if ($errors != null) : ?>
var text_errors = [];
<?php foreach ($errors as $err) : ?>
text_errors.push("<?= $err ?>");
<?php endforeach ?>
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: text_errors.join(),
});
<?php endif ?>
</script>
</script>
<?= $this->renderSection('script') ?>

</html>