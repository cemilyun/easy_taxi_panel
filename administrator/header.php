<?php
session_start();
if (empty($_SESSION["mail"])) {
  header("Location:pages-sign-in.php");
  exit;
}
include '../baglanti.php';
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>TAKSIPANEL</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
	<script>
	$(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle">SizerSoft Yönetim Paneli</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Yönetim
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="index.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Anasayfa</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-profile.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-ayar.php">
              <i class="align-middle" data-feather="terminal"></i> <span class="align-middle">Site Ayarları</span>
            </a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-taxi.php">
              <i class="align-middle" data-feather="terminal"></i> <span class="align-middle">Taksi Ekle - Çıkar</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-nedenbiz.php">
              <i class="align-middle" data-feather="terminal"></i> <span class="align-middle">Neden Biz ?</span>
            </a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-istekler.php">
              <i class="align-middle" data-feather="terminal"></i> <span class="align-middle">Müşteri İstekleri</span>
            </a>
					</li>

			</div>
		</nav>