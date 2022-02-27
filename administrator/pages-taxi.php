<?php

include 'header.php';
include 'topbar.php';

$bilgiler = $conn->query("SELECT * FROM taksiler");
$cikti = $bilgiler->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['taksi_guncelle'])) {
	$aciklama = $_POST['aciklama'];
	$adi = $_POST['adi'];
	$gsm = $_POST['gsm'];

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

		$sorgu = $conn->prepare("INSERT INTO taksiler SET aciklama = ?, adi = ?, gsm = ?, resim = ?");
		$sorgu->bindParam(1,$aciklama, PDO::PARAM_STR);
		$sorgu->bindParam(2,$adi, PDO::PARAM_STR);
		$sorgu->bindParam(3,$gsm, PDO::PARAM_INT);
		$sorgu->bindParam(4,$refimgyolmain, PDO::PARAM_STR);
		$sorgu->execute();


		if($sorgu->rowCount() > 0){
			$alert = array
			(
				'type' => "success",
				'msg' => "Taksi başarıyla eklendi.",
				'second' => "2",
				'url' => "pages-taxi.php"
			);
		}else{
			$alert = array
			(
				'type' => "danger",
				'msg' => "Taksi eklerken bir hatayla karşılaşıldı.",
				'second' => "2",
				'url' => "pages-taxi.php"
			);
		}

	}


}

?>

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Taksi Ekle - Çıkar</h1>
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
							<h5 class="card-title mb-0">Taksi Açıklama</h5>
						</div>
						<div class="card-body">
							<textarea class="form-control" rows="2" name="aciklama" placeholder="Açıklama" required></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Taksi Adı</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="adi" placeholder="Adı" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Taksi Telefon</h5>
						</div>
						<div class="card-body">
							<input type="number" class="form-control" name="gsm" placeholder="Telefon" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Taksi Resim</h5>
						</div>
						<div class="card-body">
							<input type="file" id="myFile" name="image">
						</div>
					</div>
				</div>
			</div>
			<div align="right">
				<button class="btn btn-primary" type="submit" name="taksi_guncelle">Onayla</button></div>
			</div>
		</form>
	</br>
	<div class="row">
		<?php $taksisor = $conn->prepare("SELECT * FROM taksiler");
		$taksisor->execute();
		while($taksi = $taksisor->fetch(PDO::FETCH_ASSOC)){ ?>
			<div class="col-4">
				<div class="card">
					<img class="card-img-top" src="<?php echo $taksi['resim'] ?>" alt="Unsplash">
					<div class="card-header">
						<h5 class="card-title mb-0"><?php echo $taksi['adi'] ?></h5>
					</div>
					<div class="card-body">
						<p class="card-text"><?php echo $taksi['aciklama'] ?></p>
						<i class="align-middle" data-feather="phone"></i><span class="align-middle"> <?php echo $taksi['gsm'] ?></span>
					</div>
				</div>
			</div>

		<?php } ?>

	</div>

</div>
</main>
<?php include 'footer.php' ?>