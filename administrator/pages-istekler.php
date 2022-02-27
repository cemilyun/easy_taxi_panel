<?php

include 'header.php';
include 'topbar.php';

$sorgu = $conn->query("SELECT * FROM istekler");
$cikti = $sorgu->fetchAll(PDO::FETCH_ASSOC);

if(isset($_GET["sil"]))
{
	$id = $_GET['sil'];
	$sorgu = $conn->prepare("DELETE FROM istekler WHERE id = ?");
	$sorgu->bindParam(1,$id,PDO::PARAM_INT);
	$sorgu->execute();

	if ($sorgu->rowCount()>0) {
		$alert = array
		(
			'type' => "success",
			'msg' => "İstek başarıyla silindi.",
			'second' => "1",
			'url' => "pages-istekler.php"
		);
	}else{
		$alert = array
		(
			'type' => "danger",
			'msg' => "Bir hatayla karşılaşıldı.",
			'second' => "2",
			'url' => "pages-istekler.php"
		);
	} 
}


?>

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3">Taksi İstekleri</h1>
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
		<table class="table" id="table_id">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nereden</th>
					<th>Nereye</th>
					<th>GSM</th>
					<th>Saat</th>
					<th>Sil</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($cikti as $k) { ?>
					<tr>
						<th><?php echo $k['id']?></th>
						<th><?php echo $k['nereden']?></th>
						<th><?php echo $k['nereye']?></th>
						<th><?php echo $k['gsm']?></th>
						<th><?php echo $k['saat']?></th>
						<th><a href="pages-istekler.php?sil=<?php echo $k['id'] ?>"><button type="submit" name="sil" class="btn btn-danger">SİL</button></a></th>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</br>

</div>
</main>
<?php include 'footer.php' ?>