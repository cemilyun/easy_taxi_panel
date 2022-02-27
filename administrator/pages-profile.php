<?php include 'header.php';
include 'topbar.php';

$mail = $_SESSION['mail'];

if(isset($_POST['sifre_guncelle'])){
	$eskipass = $_POST['eskipass'];
	$yenipass = $_POST['yenipass'];
	$repass = $_POST['repass'];
	if(strlen($yenipass) > 5){
		$eskipass = sha1(md5($_POST['eskipass']));
		$yenipass = sha1(md5($_POST['yenipass']));
		$repass = sha1(md5($_POST['repass']));
		if($yenipass == $repass){
			$kontrol = $conn->prepare("SELECT * FROM adminpanel WHERE password =? AND mail ='$mail'");
			$kontrol->bindParam(1,$eskipass,PDO::PARAM_STR);
			$kontrol->execute();

			if($kontrol->rowCount() > 0){
				$guncelle = $conn->prepare("UPDATE adminpanel SET password = ? WHERE mail = '$mail'");
				$guncelle->bindParam(1,$yenipass,PDO::PARAM_STR);
				$guncelle->execute();
				if($guncelle->rowCount() > 0){
					$alertpass = array
					(
						'type' => "success",
						'msg' => "Şifre başarıyla güncellendi.",
						'second' => "2",
						'url' => "pages-profile.php"
					);
				}
			}else{
				$alertpass = array
				(
					'type' => "danger",
					'msg' => "Eski şifreyi yanlış girdiniz.",
					'second' => "2",
					'url' => "pages-profile.php"
				);
			}
		}else{
			$alertpass = array
			(
				'type' => "danger",
				'msg' => "Yeni şifre ve tekrarı birbirine uymuyor.",
				'second' => "2",
				'url' => "pages-profile.php"
			);
		}
	}else{
		$alertpass = array
		(
			'type' => "danger",
			'msg' => "Yeni şifre 5 karakterden büyük olmalıdır.",
			'second' => "2",
			'url' => "pages-profile.php"
		);
	}
}

?>
<main class="content">
	<div class="container-fluid p-0">

		<div class="mb-3">
			<h1 class="h3 d-inline align-middle">Profil</h1>
		</div>
		<div class="row">
			<div class="col-md-4 col-xl-3">
				<div class="card mb-3">
					<div class="card-header">
						<h5 class="card-title mb-0">Profil Detay</h5>
					</div>
					<div class="card-body text-center">
						<img src="img/avatars/avatar.jpg" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
						<h5 class="card-title mb-0"><?php echo $_SESSION['mail']?></h5>
						<div class="text-muted mb-2">Developer</div>

					</div>
					<hr class="my-0" />

					<div class="card-body">
						<h5 class="h6 card-title">Hakkımda</h5>
						<ul class="list-unstyled mb-0">
							<li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Konum: <a href="#">Bahçelivler, İstanbul</a></li>
						</ul>
					</div>
					<hr class="my-0" />
					<div class="card-body">
						<h5 class="h6 card-title">İletişim</h5>
						<ul class="list-unstyled mb-0">
							<li class="mb-1"><a href="#">Facebook</a></li>
							<li class="mb-1"><a href="#">Twitter</a></li>
							<li class="mb-1"><a href="#">LinkedIn</a></li>
							<li class="mb-1"><a href="#">Youtube</a></li>
							<li class="mb-1"><a href="#">Instagram</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="col-md-8 col-xl-9">
				<?php
				if (isset($alertpass)) { ?>
					<div class="col-md-12">
						<div class="msg msg-<?php echo $alertpass['type'] ?>"> <span class="glyphicon glyphicon glyphicon-remove"></span> <?php echo $alertpass['msg'] ?></div>
						<?php

						if ($alertpass['url'] != "0") { ?>
							<meta http-equiv="refresh" content="<?php echo $alertpass['second'] ?>;URL=<?php echo $alertpass['url'] ?>">
						<?php } else { ?>
							<meta http-equiv="refresh" content="<?php echo $alertpass['second'] ?>;">
						<?php } ?>

					</div>
				<?php } ?>
				<form action="" method="POST">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Şifremi Yenile</h5>
						</div>
						<div class="card-body h-100">
							<div class="card-body">
								<input type="password" class="form-control" name="eskipass" placeholder="Eski şifrenizi giriniz">
							</div>
							<div class="card-body">
								<input type="password" class="form-control" name="yenipass" placeholder="Yeni şifreniz">
							</div>
							<div class="card-body">
								<input type="password" class="form-control" name="repass" placeholder="Şifrenizi onaylayın">
							</div>

						</div>

					</div>
					<div align="right">
						<button class="btn btn-primary" type="submit" name="sifre_guncelle">Onayla</button></div>
					</div>
				</form>
			</div>
		</div>

	</div>
</main>
<?php

include 'footer.php' ?>