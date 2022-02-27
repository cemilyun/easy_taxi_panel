<?php

include 'header.php';
include 'topbar.php';


if (isset($_POST['nedenbiz_guncelle'])) {
	$aciklama = $_POST['aciklama'];
	$adi = $_POST['adi'];

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

		$sorgu = $conn->prepare("INSERT INTO nedenbiz SET aciklama = ?, baslik = ?, resim = ?");
		$sorgu->bindParam(1,$aciklama, PDO::PARAM_STR);
		$sorgu->bindParam(2,$adi, PDO::PARAM_STR);
		$sorgu->bindParam(3,$refimgyolmain, PDO::PARAM_STR);
		$sorgu->execute();


		if($sorgu->rowCount() > 0){
			$alert = array
			(
				'type' => "success",
				'msg' => "Nedenbiz seçeneği başarıyla eklendi.",
				'second' => "2",
				'url' => "pages-nedenbiz.php"
			);
		}else{
			$alert = array
			(
				'type' => "danger",
				'msg' => "Bir hatayla karşılaşıldı.",
				'second' => "2",
				'url' => "pages-nedenbiz.php"
			);
		}

	}


}

?>

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Neden Biz ?</h1>
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
							<h5 class="card-title mb-0">Nedenbiz Açıklama</h5>
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
							<h5 class="card-title mb-0">Nedenbiz Başlık</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="adi" placeholder="Başlık" required>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Nedenbiz Resim</h5>
						</div>
						<div class="card-body">
							<input type="file" id="myFile" name="image">
						</div>
					</div>
				</div>
			</div>
			<div align="right">
				<button class="btn btn-primary" type="submit" name="nedenbiz_guncelle">Onayla</button></div>
			</div>
		</form>
	</br>

</div>
</main>
<?php include 'footer.php' ?>