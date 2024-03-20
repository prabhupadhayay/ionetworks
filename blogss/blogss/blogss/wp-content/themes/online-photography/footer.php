<?php

    /**

    

     * The template for displaying the footer

    

     *

    

     * Contains the closing of the #content div and all content after.

    

     *

    

     * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials

    

     *

    

     * @package online_photography

    

     */

    

    

    

    ?>

</div><!-- #content -->

<!-- join-section -->
        <section class="join-section">
          <div class="container">
            <div class="join-section__inner">
              <div class="join-box">
                <div class="row align-items-center gy-4">
                  <div class="col-lg-8">
                    <div class="join-content cont-blk">
                      <p class="h2">Let’s Stay Connected</p>
                      <!-- <p>Together, we can achieve more. Explore partnership possibilities with us.</p> -->
                      <form class="formclass" method="POST" action="https://io.hfcl.com/contact-form.php" id="contactformsumbit">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="mobile" class="form-control validateMobileClass" placeholder="Mobile" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Email ID" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select name="country" onchange="checkCountry(this.value);" class="form-control checkcountryvalidation">

                <option selected disabled focus>Country</option>
                <?php 

                            $servername = "localhost";
                            $dbname = "ionetworks_blog";
                            $username = "appadm";
                            $password = "Matrix#3344";
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            $sql="select * from wp_country_master where is_deleted='0' AND active='1' ";
                            $result2 = mysqli_query($conn, $sql);
                            while ($countryDetails=mysqli_fetch_row($result2)) {

                        ?>
                            <option value="<?php echo $countryDetails[2]; ?>"><?php echo $countryDetails[2]; ?></option>
                        <?php } ?>

              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group onchcontry">
                <input type="text" name="city" class="form-control" placeholder="Enter City" pattern="^[a-zA-Z\s]+$" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <select name="enquiry_type" class="form-control">
                <option selected disabled focus>Enquiry Type</option>
                <option value="General Enquiry">General Enquiry</option>
                <option value="Product Enquiry">Product Enquiry</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <input type="text" name="message" class="form-control" placeholder="Message" required>
            </div>
          </div>
          <div class="col-md-4">
                  <div class="recaptcha-div">
                      <div id="recaptcha" name="recaptcha" class="g-recaptcha" data-sitekey="6LclOxAdAAAAAIQKSWYTCUhGkXsIFdFigZOabJZn"></div>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="btnbox">
                  <button type="submit" name="submitContactForm">Submit</button>
                  </div>
                </div>
        </div>
      </form>                    </div>
                  </div>
                  <div
                    class="col-lg-4 d-flex justify-content-lg-end justify-content-center order-lg-0 order-first"
                  >
                    <div class="join-img">
                      <img src="https://io.hfcl.com/images/join-img.png" alt="" class="img" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- join-section-end -->
      </main>
      <!-- main end -->

      <!-- footer-section -->
      <footer class="footer-section">
        <div class="container">
          <!--  -->
          <div class="footer-middle">
            <div class="row gy-4">
              <div class="col-lg-3 col-md-4">
                <!-- <div class="footer-menu mb-5">
                  <h4>Partner</h4>
                  <ul>
                    <li><a href="https://iopartner.hfcl.com/login">Partner Portal Login</a></li>
                    <li><a href="https://iopartner.hfcl.com/register">Become a Partner</a></li>
                  </ul>
                </div> -->
                <div class="footer-menu">
                  <p>Products</p>
                  <ul>
                    <li><a href="https://io.hfcl.com/products/access-points">Access Points</a></li>
                    <li><a href="https://io.hfcl.com/home-mesh-router">HMR</a></li>
                    <li><a href="https://io.hfcl.com/products/commercial-access-switches">Commercial Access Switches</a></li>
                    <li><a href="https://io.hfcl.com/products/industrial-access-switches">Industrial Access Switches</a></li>
                    <li><a href="https://io.hfcl.com/products/p2p">P2P</a></li>
                    <li><a href="https://io.hfcl.com/products/p2mp">P2MP</a></li>
                    <li><a href="https://io.hfcl.com/products/cnms">cNMS</a></li>
                    <li><a href="https://io.hfcl.com/products/ems">EMS</a></li>
                    <li><a href="https://io.hfcl.com/products/power-solutions-ac-dc-poe-injectors">AC /DC PoE Injectors</a></li>
                    <li><a href="https://io.hfcl.com/products/antennas">Antennas</a></li>
                    <li><a href="https://io.hfcl.com/products/xpon">xPON</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="footer-menu">
                  <p>Industries</p>
                  <ul>
                    <li><a href="https://io.hfcl.com/industries/tsp-isp">TSP/ISP</a></li>
                    <li><a href="https://io.hfcl.com/industries/hospitality">Hospitality</a></li>
                    <li><a href="https://io.hfcl.com/industries/education">Education</a></li>
                    <li><a href="https://io.hfcl.com/industries/healthcare">Healthcare</a></li>
                    <li><a href="https://io.hfcl.com/industries/public-wi-fi">Public Wi-Fi</a></li>
                    <li><a href="https://io.hfcl.com/industries/public-hotspots">Public Hotspots</a></li>
                    <li><a href="https://io.hfcl.com/industries/mining">Mining</a></li>
                    <li><a href="https://io.hfcl.com/industries/defence">Defence</a></li>
                    <li><a href="https://io.hfcl.com/industries/smes">SMEs</a></li>
                    <li><a href="https://io.hfcl.com/industries/enterprise">Enterprise</a></li>
                    <li><a href="https://io.hfcl.com/industries/retail">Retail</a></li>
                    <li><a href="https://io.hfcl.com/industries/cctv">CCTV</a></li>
                    <li><a href="https://io.hfcl.com/industries/iiot">IIoT</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-4">
                <div class="footer-menu">
                  <p>Resources</p>
                  <ul>
                    <li><a href="https://io.hfcl.com/blogs">Blogs</a></li>
                    <li><a href="https://io.hfcl.com/casestudies">Case Studies</a></li>
                    <li><a href="https://io.hfcl.com/whitepapers">Whitepapers</a></li>
                    <li><a href="https://io.hfcl.com/pressrelease">Press Release</a></li>
                    <li><a href="https://io.hfcl.com/events">Events</a></li>
                    <li><a href="https://io.hfcl.com/infographic">Infographic</a></li>
                    <li><a href="https://io.hfcl.com/documentation">Documentations</a></li>
                    <li><a href="https://io.hfcl.com/linkxpert">LinkXpert</a></li>
                    <li><a href="https://io.hfcl.com/videos">Videos</a></li>
                    <li><a href="https://io.hfcl.com/contact-us">Book a Demo</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-lg-3 col-md-12">
                <div class="footer-menu mb-5">
                  <p>Connect with us</p>
                  <ul>
                    <li>
                      Email: <a class="sora" href="mailto:iosales@hfcl.com"
                        >iosales@hfcl.com</a
                      >
                    </li>
                    <li>
                      Toll Free No: <a class="sora" href="TEL:8792701100"
                        >8792 701 100</a
                      >
                    </li>
                  </ul>
                </div>
                <div class="footer-menu nohover mb-5">
                  <p>Get in Touch</p>
                    <div class="socailflex">
                      <a href="https://www.instagram.com/iobyhfcl" target="_blank"><img src="https://io.hfcl.com/images/social/insta.svg"></a>
                      <a href="https://twitter.com/iobyhfcl" target="_blank"><img src="https://io.hfcl.com/images/social/tw.svg"></a>
                      <a href="https://www.youtube.com/channel/UCmFajVSnBH2eXHAGj71ajgg" target="_blank"><img src="https://io.hfcl.com/images/social/yt.svg"></a>
                      <a href="https://www.linkedin.com/company/iobyhfcl" target="_blank"><img src="https://io.hfcl.com/images/social/linkedin.svg"></a>
                      </div>
                </div>
                <div class="footer-menu nohover">
                  <p>Download Weave App</p>
                  <ul class="w-menu">
                    <li>
                      <a href="https://play.google.com/store/apps/details?id=com.hfclhomemeshrouter.android&hl=as&gl=US"
                        ><img src="https://io.hfcl.com/images/google-play.svg" alt=""
                      /></a>
                    </li>
                    <li>
                      <a href="https://apps.apple.com/in/app/hfcl-io-weave/id1639048461?platform=iphone"><img src="https://io.hfcl.com/images/app-store.svg" alt="" /></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!--  -->
          <div class="footer-bottom">
            <ul class="fb-menu">
              <li><a href="https://io.hfcl.com/privacy-policy">Privacy Policy</a></li>
              <li><a href="https://io.hfcl.com/terms-of-service">Terms of Services</a></li>
              <li><a href="https://io.hfcl.com/legal">Legal</a></li>
              <li><a href="https://io.hfcl.com/sitemap">Sitemap</a></li>
            </ul>
            <p class="copy-right">&copy; 2023 HFCL Limited | All rights reserved</p>
          </div>
        </div>
      </footer>
      <a href="#" class="scrollto-top"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
      <!--End footer-section -->

</div><!-- #page -->

<?php wp_footer(); ?>

<script src="https://io.hfcl.com/js/jquery-3.4.1.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-3.3.1.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slick.min.js"></script>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>  
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.validate.js"></script>
<script type="text/javascript" src="https://io.hfcl.com/js/index.js"></script>

<script src="https://io.hfcl.com/js/owl.carousel.min.js" type="text/javascript"></script>

<script src="https://io.hfcl.com/js/bootstrap.bundle.min.js" type="text/javascript"></script>

<script src="https://io.hfcl.com/js/scripts.js" type="text/javascript"></script>

<script src="https://io.hfcl.com/js/main.js" type="text/javascript"></script>



<script type="text/javascript">
        $(document).ready(function() {
            $("#contactformsumbit").validate({
                
                rules: {
                    name:{
                        required:true,
                        lettersonly: true
                    },
                    lname:{
                        required:true,
                        lettersonly: true
                    },
                    email:{
                        email:true,
                        required:true
                    },
                    mobile:{
                        number:true,
                        required:true
                    },
                    country:{
                        required:true
                    },
                    city:{
                        lettersonly: true,
                        lettersonly: true
                    },
                    message:{
                        required:true
                    },
                    enquiry_type:{
                        required:true
                    }
                },
                messages: {
                    image_name: {
                        extension: "Please upload jpg or png image"
                    }
                }
            });


            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
            }, "Letters only please");
             });
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".checkcountryvalidation").on("change", function(){
                var country = $(this).val();
                if(country == 'India'){
                    $(".validateMobileClass").attr("minlength","10");
                    $(".validateMobileClass").attr("maxlength","10");
                }else{
                    $(".validateMobileClass").removeAttr("minlength");
                    $(".validateMobileClass").removeAttr("maxlength");
                }
            });
        });
    </script>
    <script type="text/javascript">
    $(".searchclick").click(function(){
       $("body").addClass('bg-overlay');
    });
    $(".closesearch").click(function(){
       $("body").removeClass('bg-overlay');
    });
  </script>
</body>

</html>