<?php

include 'header.php';
include 'topbar.php';

$bilgiler = $conn->query("SELECT * FROM sitemap");
$cikti = $bilgiler->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['ayar_guncelle'])) {
	$aciklama = $_POST['aciklama'];
	$facebook = $_POST['facebook'];
	$twitter = $_POST['twitter'];
	$linkedin = $_POST['linkedin'];
	$youtube = $_POST['youtube'];
	$instagram = $_POST['instagram'];
	$footer = $_POST['footer'];

	$izinli_uzantilar=array('jpg','png','jpeg');

	$ae = explode(".",$_FILES['image']['name']);
	$aw = count($ae);
	$ext = $ae[$aw-1];

	if (in_array($ext, $izinli_uzantilar)===false) {
		echo '<script>alert("Sadece .jpg , .png , .jpeg uzantılı dosyalar yüklenebilir!")</script>';
	}else {

		$uploads_dir = 'upload/';

		@$tmp_name = $_FILES['image']["tmp_name"];
		@$name = $_FILES['image']["name"];

		$benzersizsayi4=rand(100000,9999999);
		$refimgyol=$uploads_dir."/".$benzersizsayi4.$name;
		$refimgyolmain="upload/".trim($benzersizsayi4.$name);

		@move_uploaded_file($tmp_name, trim("$uploads_dir/$benzersizsayi4$name"));


		$nRows = $conn->query('select count(*) from sitemap')->fetchColumn(); 

		if ($nRows > 0 ) {
			$sorgu = $conn->prepare("UPDATE sitemap SET aciklama = ?, facebook = ?, twitter = ?, linkedin = ?, youtube = ?, instagram = ?, footer = ?, logo = ?");
			$sorgu->bindParam(1,$aciklama, PDO::PARAM_STR);
			$sorgu->bindParam(2,$facebook, PDO::PARAM_STR);
			$sorgu->bindParam(3,$twitter, PDO::PARAM_STR);
			$sorgu->bindParam(4,$linkedin, PDO::PARAM_STR);
			$sorgu->bindParam(5,$youtube, PDO::PARAM_STR);
			$sorgu->bindParam(6,$instagram, PDO::PARAM_STR);
			$sorgu->bindParam(7,$footer, PDO::PARAM_STR);
			$sorgu->bindParam(8,$refimgyolmain, PDO::PARAM_STR);
			$sorgu->execute();
		}
		else{
			$sorgu = $conn->prepare("INSERT INTO sitemap SET aciklama = ?, facebook = ?, twitter = ?, linkedin = ?, youtube = ?, instagram = ?, footer = ?, logo = ?");
			$sorgu->bindParam(1,$aciklama, PDO::PARAM_STR);
			$sorgu->bindParam(2,$facebook, PDO::PARAM_STR);
			$sorgu->bindParam(3,$twitter, PDO::PARAM_STR);
			$sorgu->bindParam(4,$linkedin, PDO::PARAM_STR);
			$sorgu->bindParam(5,$youtube, PDO::PARAM_STR);
			$sorgu->bindParam(6,$instagram, PDO::PARAM_STR);
			$sorgu->bindParam(7,$footer, PDO::PARAM_STR);
			$sorgu->bindParam(8,$refimgyolmain, PDO::PARAM_STR);
			$sorgu->execute();
		}




		if($sorgu->rowCount() > 0){
			$alert = array
			(
				'type' => "success",
				'msg' => "Bilgiler başarıyla güncellendi.",
				'second' => "2",
				'url' => "pages-ayar.php"
			);
		}else{
			$alert = array
			(
				'type' => "danger",
				'msg' => "Bilgiler güncellenirken bir hatayla karşılaşıldı.",
				'second' => "2",
				'url' => "pages-ayar.php"
			);
		}

	}


}

?>

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Site Ayarları</h1>
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
		<form action="" method="POST" enctype="multipart/form-data" data-parsley-validate>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Site Açıklama</h5>
						</div>
						<div class="card-body">
							<textarea class="form-control" rows="2" name="aciklama" placeholder="<?php echo $cikti['aciklama'] ?>"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Facebook</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="facebook" placeholder="<?php echo $cikti['facebook'] ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Twitter</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="twitter" placeholder="<?php echo $cikti['twitter'] ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Linkedin</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="linkedin" placeholder="<?php echo $cikti['linkedin'] ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Youtube</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="youtube" placeholder="<?php echo $cikti['youtube'] ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Instagram</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="instagram" placeholder="<?php echo $cikti['instagram'] ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Footer Açıklama</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="footer" placeholder="<?php echo $cikti['footer'] ?>">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Logo</h5>
						</div>
						<div class="card-body">
							<input type="file" id="myFile" name="image">
						</div>
					</div>
				</div>
			</div>
			<div align="right">
				<button class="btn btn-primary" type="submit" name="ayar_guncelle">Onayla</button></div>
			</div>
		</form>
	</div>
</main>
<?php include 'footer.php' ?>