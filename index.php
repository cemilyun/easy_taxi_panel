<?php
include 'baglanti.php';

$sorgu = $conn->query("SELECT * FROM sitemap");
$cikti = $sorgu->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['gonder'])) {
  $nereden = $_POST['nereden'];
  $nereye = $_POST['nereye'];
  $iletisim = $_POST['iletisim'];

  $sorgux = $conn->prepare("INSERT INTO istekler SET nereden = ?, nereye = ?, gsm = ?");
  $sorgux->bindParam(1,$nereden, PDO::PARAM_STR);
  $sorgux->bindParam(2,$nereye, PDO::PARAM_STR);
  $sorgux->bindParam(3,$iletisim, PDO::PARAM_INT);
  $sorgux->execute();

  if($sorgu->rowCount() > 0){
    $alert = array
    (
      'baslik' =>"Basarılı",
      'type' => "success",
      'msg' => "İsteğiniz başarıyla iletildi."
    );
  }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- basic -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <!-- site metas -->
  <title>ULOAX</title>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="author" content="">	
  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- style css -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- Responsive-->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- fevicon -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
  <!-- Tweaks for older IEs-->
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  <!-- owl stylesheets --> 
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

  <?php if (isset($alert)) { ?>
    <script>Swal.fire("<?php echo $alert['baslik'] ?>", "<?php echo $alert['msg'] ?>", "<?php echo $alert['type'] ?>"); </script>
  <?php } ?>


  <!--header section start -->
  <div id="index.php" class="header_section">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="logo"><a href="index.php"><img src="administrator/<?php echo $cikti['logo'] ?>" width="250" height="50"></a></div>
        </div>
        <div class="col-sm-6 col-lg-9">
          <div class="menu_text">
            <ul>
              <li><a href="index.php">Anasayfa</a></li>                                                    
              <li><a href="#taxis">Taksilerimiz</a></li>
              <li><a href="#booking">Neden Biz ?</a></li>
              <li><a href="#contact">İletişim</a></li>
            </div>  
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- header section end -->
<!-- banner section start -->
<div class="banner_section">
  <div class="container-fluid">
    <div id="main_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="row">
            <div class="col-md-6">
              <div class="image_1"><img src="images/img-1.png"></div>
            </div>
            <div class="col-md-6">
            </br>
            <div class="contact_bg">
              <div class="input_main">
                <div class="container">
                  <h2 class="request_text">Günlük seyahat partneriniz</h2>
                  <form action="" method="POST">
                    <div class="form-group">
                      <input type="text" class="email-bt" placeholder="NEREDEN" name="nereden" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="email-bt" placeholder="NEREYE" name="nereye" required>
                    </div>
                    <div class="form-group">
                      <input type="number" class="email-bt" placeholder="İLETİŞİM" name="iletisim" required>
                    </div>

                    <button type="submit" class="subscribr_tx" name="gonder">TAKSİ BUL</button>
                  </form>
                </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- banner section end -->
<!-- our taxis section start -->
<div id="taxis" class="taxis_section layout_padding">
  <div class="container">
    <h1 class="our_text">Sizin <span style="color: #f4db31;">Taksileriniz</span></h1>
    <div class="taxis_section_2">
      <div class="row">
        <?php $taksisor = $conn->prepare("SELECT * FROM taksiler");
        $taksisor->execute();
        while($taksi = $taksisor->fetch(PDO::FETCH_ASSOC)){ ?>
          <div class="col-sm-4" style="padding-left: 0px;">
            <div class="taxi_main">
              <div class="round_1"><?php echo $taksi['id']?></div>
              <h2 class="carol_text"><?php echo $taksi['adi']?></h2>
              <p class="reader_text"><?php echo $taksi['aciklama']?><br></p>
              <div class="images_2"><a href="#"><img src="administrator/<?php echo $taksi['resim']?>"></a></div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
<!-- our taxis section end -->
<!-- why ride section start -->
<div id="booking" class="ride_section layout_padding">
  <div class="container">
    <div class="ride_main">
      <h1 class="ride_text">Neden <span style="color: #f4db31;">Biz ?</span></h1>
    </div>
  </div>
</div>
<div class="ride_section_2 layout_padding">
  <?php $nedensor = $conn->prepare("SELECT * FROM nedenbiz");
  $nedensor->execute();
  while($neden = $nedensor->fetch(PDO::FETCH_ASSOC)){ ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="image_3"><img src="administrator/<?php echo $neden['resim']?>"></div>
        </div>
        <div class="col-sm-8">
          <h1 class="cabe_text"><?php echo $neden['baslik']?></h1>
          <p class="long_text"><?php echo $neden['aciklama']?></p>
        </div>
      </div>
    </div>
  <?php } ?>
</div>
<!-- why ride section end -->
<!-- location section start -->
<div id="contact" class="location_sectin layout_padding">
  <div class="container-fluid">
    <div class="location_main">
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-5">
          <div class="download_text">DOWNLOAD<br><span style="color: #fffcf4;">OUR APP TODAY</span></div>
        </div>
        <div class="col-sm-3">
          <div class="image_7"><img src="images/img-7.png"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- download section end -->
<!-- section footer start -->
<div class="section_footer ">
  <div class="container"> 
    <div class="footer_section_2">
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3">
          <h2 class="account_text">Hakkımızda</h2>
          <p class="ipsum_text"><?php echo $cikti['aciklama'] ?></p>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
          <h2 class="account_text">Sayfalar</h2>
          <div class="image-icon"><img src="images/bulit-icon.png"><span class="fb_text"><a href="#">Anasayfa</span></a></div>
          <div class="image-icon"><img src="images/bulit-icon.png"><span class="fb_text"><a href="#taxis">Taksilerimiz</span></a></div>
          <div class="image-icon"><img src="images/bulit-icon.png"><span class="fb_text"><a href="#booking">Neden biz ?</span></a></div>
          <div class="image-icon"><img src="images/bulit-icon.png"><span class="fb_text"><a href="#contact">İletişim</span></a></div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
          <h2 class="account_text">Bizi Takip Edin!</h2>
          <div class="image-icon"><img src="images/fb-icon.png"><span class="fb_text"><a href="<?php echo $cikti['facebook']?>" target="_blank">Facebook</a></span></div>
          <div class="image-icon"><img src="images/twitter-icon.png"><span class="fb_text"><a href="<?php echo $cikti['twitter']?>" target="_blank">Twitter</a></span></div>
          <div class="image-icon"><img src="images/in-icon.png"><span class="fb_text"><a href="<?php echo $cikti['linkedin']?>" target="_blank">Linkedin</a></span></div>
          <div class="image-icon"><img src="images/youtube-icon.png"><span class="fb_text"><a href="<?php echo $cikti['youtube']?>" target="_blank">Youtube</a></span></div>            
          <div class="image-icon"><img src="images/instagram-icon.png"><span class="fb_text"><a href="<?php echo $cikti['instagram']?>" target="_blank">Instagram</a></span></div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
          <h2 class="adderess_text">Haber Bülteni</h2>
          <input type="" class="email_text" placeholder="Email adresinizi giriniz." name="Enter Your Email">
          <button class="subscribr_bt">Abone Ol</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- section footer end -->
<!-- copyright section start -->
<div class="copyright_section">
  <div class="container">
    <p class="copyright"><?php echo $cikti['footer']?></p>
  </div>
</div>

<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<script src="js/plugin.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<!-- javascript --> 
<script src="js/owl.carousel.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<script>
  $(document).ready(function(){
    $(".fancybox").fancybox({
      openEffect: "none",
      closeEffect: "none"
    });

    $(".zoom").hover(function(){

      $(this).addClass('transition');
    }, function(){

      $(this).removeClass('transition');
    });
  });
</script> 
<script>
  function openNav() {
    document.getElementById("myNav").style.width = "100%";
  }

  function closeNav() {
   document.getElementById("myNav").style.width = "0%";
 }
</script>   
</body>
</html>