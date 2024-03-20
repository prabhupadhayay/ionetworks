<?php 
	$sqlFooter ="select * from ".PREFIX."contact_cms ";
   $queryFooter = $functions->query($sqlFooter);
   $contactCMSFooter = $functions->fetch($queryFooter);
?>
<footer class="section footer">
	<div class="footerin">
		<div class="container p0">

			<div class="footerinflex">

				<!-- <div class="footsub wow fadeInUp" data-wow-delay="0.5s">

					<h4>About Us</h4>

					<ul>

						<li><a href="<?php //echo BASE_URL; ?>/about-us.php?action=abouthfcl">About HFCL</a></li>

						<li><a href="<?php //echo BASE_URL; ?>/about-us.php?action=aboutio">About IO</a></li>

					</ul>

				</div> -->

				<div class="footsub wow fadeInUp" data-wow-delay="0.55s">

					<h4>Contact Us</h4>

					<ul>

						<li><a href="<?php echo BASE_URL; ?>/contact-us">Industry Associations</a></li>

						<li><a href="<?php echo BASE_URL; ?>/contact-us">Office Locations</a></li>

					</ul>

				</div>

				<div class="footsub wow fadeInUp" data-wow-delay="0.6s">

					<h4>News & Media</h4>

					<ul>

						<li><a href="<?php echo BASE_URL; ?>/news&media/PressRelease">Press Releases</a></li>

						<!-- <li><a href="<?php// echo BASE_URL; ?>/news-media?action=ExternalMedia">External Media</a></li> -->

						<li><a href="<?php echo BASE_URL; ?>/news&media/Events">Events</a></li>

					</ul>

				</div>

				<div class="footsub wow fadeInUp" data-wow-delay="0.65s">

					<h4>Partner</h4>

					<ul>

						<li><a href="<?php echo BASE_URL;?>/Partner/Become-a-Partner">Partner Portal Login</a></li>

						<li><a href="<?php echo BASE_URL; ?>/Partner/Become-a-Partner">Become a Partner</a></li>

					</ul>

				</div>

				<div class="footsub wow fadeInUp" data-wow-delay="0.7s">

					<h4>Resources</h4>

					<ul>

						<li><a href="<?php echo BASE_URL; ?>/blogs">Blogs</a></li>

						<li><a href="<?php echo BASE_URL; ?>/documentation">Documentation</a></a></li>

						<!-- <li><a href="news-media">News & Media</a></a></li> -->

					</ul>

				</div>

				<div class="footsub wow fadeInUp" data-wow-delay="0.75s">

					<h4>Follow Us</h4>

					<div class="socailflex">

					<?php 
						if(!empty($contactCMSFooter['facebook'])){
					?>
						<a href="<?php echo $contactCMSFooter['facebook']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/fb.png"></a>
					<?php 
						} if(!empty($contactCMSFooter['instagram'])){
					?>

						<a href="<?php echo $contactCMSFooter['instagram']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/insta.png"></a>
					<?php 
						} if(!empty($contactCMSFooter['twitter'])){
					?>
						<a href="<?php echo $contactCMSFooter['twitter']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/tw.png"></a>
					<?php 
						} if(!empty($contactCMSFooter['youtube'])){
					?>
						<a href="<?php echo $contactCMSFooter['youtube']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/yt.png"></a>
					<?php 
						} if(!empty($contactCMSFooter['linkedin'])){
					?>
						<a href="<?php echo $contactCMSFooter['linkedin']; ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/social/linkedin.png"></a>
					<?php 
						}
					?>

					</div>

					<div class="footlogo">
						<img src="<?php echo BASE_URL; ?>/images/footlogo.png" alt="footlogo" loading="lazy" onclick="window.open('https://www.hfcl.com/')">
					</div>
				</div>
			</div>
			<div class="bottomfooter wow fadeInUp" data-wow-delay="0.8s">
				<div class="botlinks">
					<a href="<?php echo BASE_URL; ?>/privacy-policy">Privacy Policy</a>
					<a href="<?php echo BASE_URL; ?>/terms-of-service">Terms of Service</a>
					<!-- <a href="<?php //echo BASE_URL; ?>/legal">Legal</a> -->
					<a href="<?php echo BASE_URL; ?>/sitemap">Site Map</a>
				</div>
				<div class="copyright">
    				<p>© <script>var currentYear = new Date().getFullYear();document.write(currentYear);</script> HFCL Limited All Rights Reserved</p>
				</div>
			</div>
		</div>
	</div>
</footer>

</div>