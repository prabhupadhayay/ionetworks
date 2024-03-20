<script src="<?php echo BASE_URL; ?>/js/jquery-3.3.1.min.js" type="text/javascript"></script>

<script src="<?php echo BASE_URL; ?>/js/jquery-ui.js" type="text/javascript"></script>

<script src="<?php echo BASE_URL; ?>/js/bootstrap.min.js" type="text/javascript"></script><script src="<?php echo BASE_URL; ?>/js/jquery.validate.js"></script>

<script src="<?php echo BASE_URL; ?>/js/additional-methods.js"></script>

<script src="<?php echo BASE_URL; ?>/js/slick.min.js"></script>
<script src="<?php echo BASE_URL; ?>/js/fancy.js"></script>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>  

<script src="<?php echo BASE_URL; ?>/js/index.js" type="text/javascript"></script>

<script src="<?php echo BASE_URL; ?>/js/jquery.cookie.min.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?php echo BASE_URL; ?>/js/fullpage.min.js"></script>

<script src="<?php echo BASE_URL; ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/js/wow.min.js"></script>

<script>

	new WOW().init();

</script>

<script src="<?php echo BASE_URL; ?>/js/jquery.matchHeight.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.flipster/1.1.5/jquery.flipster.min.js" integrity="sha512-YPskov+TTZvojhg9iWYQKa6iRPRm8hko8GBbdV8A8KKMTwp84+jm2K+soYNx3Wf6qQhxb+kn2sjpMZwkWxnD/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script type="text/javascript">
		$(document).ready(function() {
			$("#contactformsumbit").validate({
				ignore: [],
				debug: false,
				rules: {
					fname:{
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

			$("#partenerEmailForm").validate({
				ignore: [],
				debug: false,
				rules: {
					email:{
						required:true,
						email:true
					}
				},
				messages: {
					email: {
						required: "Please enter email id",
						email:"Please enter correct email id"
					}
				}
			});


			


			$("#submitPartnerForm").validate({
				ignore: [],
				debug: false,
				rules: {
					company_name:{
						required:true
					},
					primary_market:{
						required:true
					},
					primary_bus:{
						required:true
					},
					tc:{
						required:true
					},
					company_nature:{
						required:true
					},
					company_website:{
						required:false,
						url:false,
						validUrl:true
					},
					company_address:{
						required:true
					},
					investor:{
						required:true,
						extension:'pdf',
						filesize: 5000000
					},
					city:{
						required:true,
						lettersonly: true
					},
					zip:{
						required:true,
						number:true
					},
					state:{
						required:true,
						lettersonly: true
					},
					country:{
						required:true
					},
					no_emp:{
						required:true
					},
					prime_customer:{
						required:true
					},
					wireless_product:{
						required:true
					},
					network_product:{
						required:true
					},
					personal_first_name:{
						required:true,
						lettersonly: true
					},
					personal_last_name:{
						required:true,
						lettersonly: true
					},
					personal_mobile_no:{
						required:true,
						number:true
					},
					personal_email_id:{
						required:true,
						email:true,
						remote:{
                           url:"<?php echo BASE_URL; ?>/ajax-check-pt-email.php",
                           type: "post"
                        }
					},
					personal_designation:{
						required:true,
						lettersonly: true
					}
				},
				messages: {
					image_name: {
						extension: "Please upload jpg or png image"
					},
					investor:{
						extension: "Please upload pdf only",
						filesize:"Max 5 MB file size allowed"
					},
					tc:{
						required:"Please select terms and conditions."
					},
					personal_email_id:{
						remote:"gmail/yahoo/hotmail and rediff email id is not allowed."
					}
				}
			});
			$.validator.addMethod('filesize', function (value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, 'File size must be less than 5 MB');


            $.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
            }, "Letters only please");

            $.validator.addMethod('validUrl', function(value, element) {
		        var url = $.validator.methods.url.bind(this);
		        return url(value, element) || url('http://' + value, element);
		    }, 'Please enter a valid URL');

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
	


