<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   error_reporting(E_ALL);
	include("include/php-variables.php");

		$sql ="select * from ".PREFIX."blog_cms ";
	   $query = $functions->query($sql);
	   $emsCMS = $functions->fetch($query);
	   $bannerImageData = $functions->getImageUrl('slider-banner', $emsCMS['image_name'], 'crop', '');

	   	$sqlFooter ="select * from ".PREFIX."contact_cms ";
   $queryFooter = $functions->query($sqlFooter);
   $contactCMSFooter = $functions->fetch($queryFooter);
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $websitename; ?> || Videos </title>

	<meta name="description" content="A list of all the videos categorised as event videos and product videos is available for better visuals of the wide range of products provided by us.">

  <meta name="keywords" content="hfcl videos, io by hfcl videos, 2022 wifi prediction, rnd lab hfcl, world wifi day, product videos, hfcl product videos, IO by HFCL videos" />
	
  <?php include("include/header-link.php");?>
  
</head>
<body class="innerpage">
	<main class="root">
		<?php include("include/header.php");?>
		<section class="innerpagebanner-section mtop">
			<img src="https://io.hfcl.com/images/slider-banner/16330156161.jpg" alt="blogbanner" class="inbanner">
			<div class="inbantext">
				<div class="container p0">
					<h1 class="wow fadeInUp" data-wow-delay="0.5s">Get a glimpse of our connected ecosystem</h1>
					<p class="wow fadeInUp" data-wow-delay="0.55s">Witness the power of digital transformation with our latest videos</p>
				</div>
			</div>
		</section>

		<section class="breadcrumb-section">
			<div class="container p0">
				<ul class="breadcrumb-in">
					<li class="wow fadeIn" data-wow-delay="0.5s"><a href="https://io.hfcl.com">Home</a></li>
					<!-- <li class="wow fadeIn" data-wow-delay="0.55s"><a href="javascript:void(0);">Resources</a></li> -->
					<li class="wow fadeIn" data-wow-delay="0.6s"><a href="javascript:void(0);">Videos</a></li>
				</ul>
			</div>
		</section>

    <section class="container">
      <div class="subfeature-menu">
        <ul>
          <li><a id ="allvideos" href="javascript:void(0)">All Videos</a></li>
          <li><a id ="eventvideos" href="javascript:void(0)">Event Videos</a></li>
          <li><a id="productvideos" href="javascript:void(0)">Product Videos</a></li>
        </ul>
      </div>
    </section>

		<section class="video-section">
			<div class="container">

        <h2 class="eventvid">Event Videos</h2>

				<div class="videolists eventvid">
					
          <div class="videobox">
							<div class="videothumbimage">
              	<img src="https://io.hfcl.com/images/videos/video-banner/data2.png" alt="">
              </div>
              <div class="videodesc">
              <h3>2022 Wi-Fi Prediction</h3>
              <p>Mr. Jitendra Chaudhary, Our Executive President, HFCL, in an interview with Wi-Fi Alliance, predicts disaggregated networks would be the game-changer in Wi-Fi deployments in 2022</p>
							<button class="btn videoBtn" >Play Now</button>
          </div>
					</div>
					
          <div class="videobox">
							<div class="videothumbimage">
              	<img src="https://io.hfcl.com/images/videos/video-banner/data1.png" alt="">
              </div>
              <div class="videodesc">
              <h3>R&D Lab (Bangalore)</h3>
              <p>A comprehensive overview of our innovation platform in Bangalore, with enhanced capabilities and pioneering technology</p>
							<button class="btn videoBtn1">Play Now</button>
          </div>
					</div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data3.png" alt="">
              </div>
              <div class="videodesc">
              <h3>World Wi-Fi Day</h3>
              <p>Celebrating the power of Wi-Fi by focusing efforts on top-notch connectivity</p>
              <button class="btn videoBtn2">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data4.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>Unlocking the potential of Wi-Fi</h3>
              <p>Mr. Bhuvnesh Sachdeva, Our Vice President, HFCL, sharing his insights on TIP OpenWiFi solutions & multiple use cases, unlocking the potential of socio-economic Wi-Fi perspective for global scaling through disaggregation.</p>
              <button class="btn videoBtn3">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data5.png" alt="">
              </div>
              <div class="videodesc">
              <h3>IO by HFCL at a Glance</h3>
              <p>Learn more about IO by HFCL, our product portfolio and how we are making an impact in everyday lives by making technology accessible.</p>
              <button class="btn videoBtn4">Play Now</button>
          </div>
          </div>

				</div>

        <h2 class="product-videoss" style="margin-top: 30px;">Product Videos</h2>

        <div class="videolists product-videoss">
          
          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-1.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4xi</h3>
              <p>Wi-Fi 6 2x2 Indoor Access Point with Integrated Omni Antenna</p>
              <button class="btn videoBtn-1" onclick="showDetails('autoplay');">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-2.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4i</h3>
              <p>Wi-Fi 5 2x2 Indoor Access Point with Integrated Omni Antenna</p>
              <button class="btn videoBtn-2">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-3.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion8i</h3>
              <p>Wi-Fi 5 4x4 Indoor Access Point with Integrated Omni Antenna</p>
              <button class="btn videoBtn-3">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-4.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4x</h3>
              <p>Wi-Fi 6 2x2 Outdoor Access Point with Integrated Sector Antenna</p>
              <button class="btn videoBtn-4">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-5.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4xe</h3>
              <p>Wi-Fi 6 2x2 Outdoor Access Point with option for External Antenna</p>
              <button class="btn videoBtn-5">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-6.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4</h3>
              <p>Wi-Fi 5 2x2 Outdoor Access Point with Integrated Sector Antenna</p>
              <button class="btn videoBtn-6">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-7.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4e</h3>
              <p>Wi-Fi 5 2x2 Outdoor Access Point with option for External Antenna</p>
              <button class="btn videoBtn-7">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-8.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion8</h3>
              <p>Wi-Fi 5 4x4 Outdoor Access Point with Integrated Sector Antenna</p>
              <button class="btn videoBtn-8">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-9.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion8e</h3>
              <p>Wi-Fi 5 4x4 Outdoor Access Point with option for External Antenna</p>
              <button class="btn videoBtn-9">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-10.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>HSP-IO-4GE2S-CPD</h3>
              <p>4 Port PoE+ L2 Managed Switch with 2x1G SFP Uplinks (Dual DC Supply)</p>
              <button class="btn videoBtn-10">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-11.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>HSP-IO-8GE2S-C2U</h3>
              <p>8 Port Non-PoE L2 Managed Switch with 2x1G SFP Uplinks (Universal Supply)</p>
              <button class="btn videoBtn-11">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-12.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4le</h3>
              <p>5 GHz 700 Mbps UBR with option for external antenna</p>
              <button class="btn videoBtn-12">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-13.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4ln</h3>
              <p>5 GHz 700 Mbps UBR with Integrated Dish Antenna</p>
              <button class="btn videoBtn-13">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-14.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4ln_BTS</h3>
              <p>5 GHz 700 Mbps UBR with Integrated Sector Antenna (BTS side)</p>
              <button class="btn videoBtn-14">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-15.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>ion4ln_CPE</h3>
              <p>5 GHz 300 Mbps CPE with Integrated Antenna</p>
              <button class="btn videoBtn-15">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-16.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>HF-POE20-AC/DC-I</h3>
              <p>Gigabit, High Power, PoE+ Injectors Indoor Unit, AC/ DC Supply</p>
              <button class="btn videoBtn-16">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-17.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>HF-POE20-AC/DC-O</h3>
              <p>Gigabit, High Power, PoE+ Injectors Outdoor Unit, AC/ DC Supply</p>
              <button class="btn videoBtn-17">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-18.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>HFDBV-NMOMNI-0406</h3>
              <p>IO Dual-Band Wi-Fi Antenna, Omni</p>
              <button class="btn videoBtn-18">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-19.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>Sector Antenna</h3>
              <p>IO Dual Band Wi-Fi Antenna, Sector</p>
              <button class="btn videoBtn-19">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-19.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>Sector Antenna</h3>
              <p>IO 5 GHz UBR Antenna, Sector</p>
              <button class="btn videoBtn-20">Play Now</button>
          </div>
          </div>

          <div class="videobox">
              <div class="videothumbimage">
                <img src="https://io.hfcl.com/images/videos/video-banner/data-20.jpg" alt="">
              </div>
              <div class="videodesc">
              <h3>Dish Antenna</h3>
              <p>IO 5 GHz UBR Antenna, Dish</p>
              <button class="btn videoBtn-21">Play Now</button>
          </div>
          </div>

        </div>


			</div>
		</section>


		<section class="commoncontact-section">
			<div class="container p0">
				<div class="commoncontact-in">
					<?php include('commoncontact.php');?>
				</div>
			</div>
		</section>

<!-- copy this stuff and down -->
<div id="video-popup-overlay"></div>

<div id="video-popup-container">
  <div id="video-popup-close" class="fade">&#10006;</div>
  <div id="video-popup-iframe-container">
    <iframe id="video-popup-iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
  </div>
</div>


	</main>

	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>

	<script type="text/javascript">
    // $(".videoBtn1").on('click', function(e) {
    //   e.preventDefault();
    //   $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
    //   $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/hfcl.mp4?autoplay=1");
    //   $("#video-popup-iframe").on('load', function() {
    //     $("#video-popup-container").show();
    //   });
    // });
    // $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
    //   $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
    //   $("#video-popup-iframe").attr('src', '');
    // });



    function showDetails(id)
{
   window.location = '/ionetwork/products/access-points/ion4xi?video='+id;
}
  </script>

	<script type="text/javascript">
    $(".videoBtn").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/wifi-trends-video.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });
    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
	</script>

  <script type="text/javascript">
    $(".videoBtn2").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/HFCL-Video_HD_New-Logo.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn3").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/tip_openwifi_bhuv-nesh-sachdeva.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn4").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/io-14542154.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-1").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633345978-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-2").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633422595-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-3").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633422470-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-4").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633428136-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-5").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633426997-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-6").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633424503-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-7").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633425387-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-8").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633423646-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-9").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633422654-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-10").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633438619-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-11").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633436978-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-12").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1635502812-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-13").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1635502905-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-14").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633495671-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-15").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633499649-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-16").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633501158-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-17").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633502124-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-18").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633505628-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-19").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633506350-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-20").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633507330-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

  <script type="text/javascript">
    $(".videoBtn-21").on('click', function(e) {
      e.preventDefault();
      $("#video-popup-overlay,#video-popup-iframe-container,#video-popup-container,#video-popup-close").show();
      $("#video-popup-iframe").attr('src', "https://io.hfcl.com/images/videos/1633507913-1.mp4?autoplay=1");
      $("#video-popup-iframe").on('load', function() {
        $("#video-popup-container").show();
      });
    });

    $("#video-popup-close, #video-popup-overlay").on('click', function(e) {
      $("#video-popup-iframe-container,#video-popup-container,#video-popup-close,#video-popup-overlay").hide();
      $("#video-popup-iframe").attr('src', '');
    });
  </script>

<script type="text/javascript">

  $("#allvideos").click(function(){
    $("#allvideos").addClass('active');
    $("#eventvideos").removeClass('active');
    $("#productvideos").removeClass('active');
    $(".eventvid").removeClass('hidediv');
    $(".product-videoss").removeClass('hidediv');
    $(".eventvid").removeClass('showdiv');
    $(".product-videoss").removeClass('showdiv');
  });

  $("#eventvideos").click(function(){
    $("#eventvideos").addClass('active');
    $("#allvideos").removeClass('active');
    $("#productvideos").removeClass('active');
    $(".eventvid").addClass('showdiv');
    $(".eventvid").removeClass('hidediv');
    $(".product-videoss").addClass('hidediv');
    $(".product-videoss").removeClass('showdiv');
  });

  $("#productvideos").click(function(){
    $("#productvideos").addClass('active');
    $("#eventvideos").removeClass('active');
    $("#allvideos").removeClass('active');
    $(".eventvid").addClass('hidediv');
    $(".eventvid").removeClass('showdiv');
    $(".product-videoss").addClass('showdiv');
    $(".product-videoss").removeClass('hidediv');
  });

</script>

</body>
</html>