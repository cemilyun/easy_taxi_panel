<?php
session_start();
include '../baglanti.php';

if (isset($_POST['girisform'])) {
	$mail = $_POST['mail'];
	$password = $_POST['password'];

	$query ="SELECT * FROM adminpanel WHERE mail=:mail AND password=:password AND status = 1";
	$statement = $conn->prepare($query); 
	$statement->execute(  
		array(  
			'mail' => $_POST["mail"],  
			'password' => sha1(md5($_POST["password"]))  
		)  
	);  
	$count = $statement->rowCount(); 
	if($count > 0)  
	{  
		$_SESSION["mail"] = $_POST["mail"];  
		$alert = array
		(
			'type' => "success",
			'msg' => "Başarıyla giriş yaptınız. Anasayfaya yönlendiriliyorsunuz.",
			'second' => "2",
			'url' => "index.php"
		);
	}else  
	{  
		$alert = array
		(
			'type' => "danger",
			'msg' => "Hatalı şifre veya kullanıcı adı !",
			'second' => "2",
			'url' => "pages-sign-in.php"
		); 
	}  
}



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
	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>Sign In | AdminKit Demo</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Hoşgeldiniz</h1>
							<p class="lead">
								Giriş Yapmak İçin Bilgilerinizi Giriniz
							</p>
						</div>
						<div class="row">
							<?php
							if (isset($alert)) { ?>
								<div class="col-md-12">
									<div class="msg msg-<?php echo $alert['type'] ?>"> <span class="glyphicon glyphicon glyphicon-remove"></span> <?php echo $alert['msg'] ?></div>
									<?php

									if ($alert['url'] != "0") { ?>
										<meta http-equiv="refresh" content="<?php echo $alert['second'] ?>;URL=<?php echo $alert['url'] ?>">
									<?php } else { ?>
										<meta http-equiv="refresh" content="<?php echo $alert['second'] ?>;">
									<?php } ?>
								
							</div>
							<?php } ?>
						</div>
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<img src="img/avatars/avatar.jpg" alt="Charles Hall" class="img-fluid rounded-circle" width="132" height="132" />
									</div>
									<form method="POST" action="">
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="mail" placeholder="Email giriniz." />
										</div>
										<div class="mb-3">
											<label class="form-label">Şifre</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Şifrenizi giriniz." />
											<small>
												<a href="index.html">Şifremi unuttum</a>
											</small>
										</div>
										<div>
											<label class="form-check">
												<input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
												<span class="form-check-label">
													Beni Hatırla
												</span>
											</label>
										</div>
										<div class="text-center mt-3">
											<button type="submit" name="girisform" class="btn btn-lg btn-primary">Giriş Yap</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>
	<style>
		.msg {
			background: #fefefe;
			color: #666666;
			font-weight: bold;
			font-size: small;
			padding: 12px;
			padding-left: 16px;
			border-top: solid 3px #CCCCCC;
			border-radius: 5px;
			margin-bottom: 10px;
			-webkit-box-shadow: 0 10px 10px -5px rgba(0,0,0,.08);
			-moz-box-shadow: 0 10px 10px -5px rgba(0,0,0,.08);
			box-shadow: 0 10px 10px -5px rgba(0,0,0,.08);
		}
		.msg-clear {
			border-color: #fefefe;
			-webkit-box-shadow: 0 7px 10px -5px rgba(0,0,0,.15);
			-moz-box-shadow: 0 7px 10px -5px rgba(0,0,0,.15);
			box-shadow: 0 7px 10px -5px rgba(0,0,0,.15);
		}
		.msg-info {
			border-color: #b8dbf2;
		}
		.msg-success {
			border-color: #cef2b8;
		}
		.msg-warning {
			border-color: rgba(255,165,0,.5);
		}
		.msg-danger {
			border-color: #ec8282;
		}
		.msg-primary {
			border-color: #9ca6f1;
		}
		.msg-magick {
			border-color: #e0b8f2;
		}
		.msg-info-text {
			color: #39b3d7;
		}
		.msg-success-text {
			color: #80d651;
		}
		.msg-warning-text {
			color: #db9e34;
		}
		.msg-danger-text {
			color: #c9302c;
		}
		.msg-primary-text {
			color: rgba(47,106,215,.9);
		}
		.msg-magick-text {
			color: #bb39d7;
		}
	</style>
</body>

</html>