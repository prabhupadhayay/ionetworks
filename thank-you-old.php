<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
   ?>
<!DOCTYPE>
<html>
   <head>
      <title><?php echo SITE_NAME; ?> || Thankyou </title>
      <?php include ("include/header-link.php"); ?>
   </head>
   <body class="innerpage thankyoupage">
      <?php include ("include/header.php"); ?>
      <section class="thankyou mtop">
         <img src="images/horizaontalimg.png" alt="horizaontalimg" class="thnksbg">
         <div class="main-content">
            <h2>Thank You!</h2>
            <i class="fa fa-check main-content__checkmark"></i>
            <?php 
               if(isset($_GET['resourceDownload'])){
                 ?>
            <p>We thank you for the request to download the file.</p>
            <p>A confirmation link has been sent to your email ID, please complete the verification process to access your file.</p>
            <?php }else if(isset($_GET['contactus'])){ ?>
            <p>Thank you for writing to us.</p>
            <p>Our representative will contact you at the earliest.</p>
            <h5>Warm Regards,</h5>
            <h6>IO by HFCL</h6>
            <?php }else if(isset($_GET['pregistration'])){ ?>
            <p>Thank you for your interest in partnering with us.</p>
            <p>Your request will be verified by the designated authorities and they will reach out to you shortly.</p>
            <p>We look forward to collaborating with you!</p>
            <!-- <h3>Partner registration</h3> -->
            <h5 class="nomtop">Warm Regards,</h5>
            <h6>IO by HFCL</h6>
            <?php }else{ ?>
            <p>Thanks for contacting us! We will be in touch with you shortly.</p>
            <h5>Warm Regards,</h5>
            <h6>IO by HFCL</h6>
            <?php } ?>
            <div class="animated" style="opacity:0">
               <p>This page will redirect in <span id="time">00:00</span></p>
            </div>
         </div>
      </section>
      <?php include ("include/footer.php"); ?>
      <?php include ("include/footer-link.php"); ?>
      <script>
         function startTimer(duration, display) {
           var timer = duration, minutes, seconds;
           var end =setInterval(function () {
             minutes = parseInt(timer / 60, 10)
             seconds = parseInt(timer % 60, 10);
             minutes = minutes < 10 ? "0" + minutes : minutes;
             seconds = seconds < 10 ? "0" + seconds : seconds;
             display.textContent = minutes + ":" + seconds;
             if (--timer < 0) {
               window.location.replace(history.back());
               clearInterval(end);
           }
         }, 1000);
         }
         window.onload = function () {
           var fiveMinutes = 5,
           display = document.querySelector('#time');
           startTimer(fiveMinutes, display);
         };

         // setTimeout(function(){history.back();}, 3000);
      </script>
   </body>
</html>