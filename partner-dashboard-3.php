<?php 
   include_once 'include/functions.php';
   $functions = new Functions();
	include("include/php-variables.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $websitename; ?> || Partner Dashboard </title>
	<?php include("include/header-link.php");?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body class="innerpage dashboardpages">
	<main class="root">
		<?php include("include/header.php");?>

		<section class="dashboard-section mtop">
			<div class="container p0">
				<div class="dashboard-in">
					<div class="dashboard-profile">
						<div class="dashboard-profiledetails">
							<div class="profiledashpic">
								<img src="<?php echo BASE_URL;?>/images/dashpic.png" alt="dashpic">
							</div>
							<div class="profiledashname">
								<h4>Hello, Chandrashekhar</h4>
							</div>
						</div>
						<div class="dashboard-profileid">
							<h4>Partner Code : DF9821</h4>
						</div>
					</div>
					<div class="dashboard-profile3">
						<h4>SPP (Special Price Program Application)</h4>
						<form class="dashboardform" autocomplete="off">
							<div class="dashboardflex">
								<div class="form-group">
									<label>Partnership Status</label>
									<input type="text" name="company_name" class="form-control" required> 
								</div>
								<div class="checkboxdiv">
									<div class="checkboxsub">
										<input type="checkbox" name="Gold_Partner" id="goldpartner">
										<label for="goldpartner">Gold Partner</label>
									</div>
									<div class="checkboxsub">
										<input type="checkbox" name="Silver_Partner" id="silverpartner">
										<label for="silverpartner">Silver Partnerr</label>
									</div>
									<div class="checkboxsub">
										<input type="checkbox" name="Certified_Partner" id="certifiedpartner">
										<label for="certifiedpartner">Certified Partner</label>
									</div>
									<div class="checkboxsub">
										<input type="checkbox" name="Value Added Distributor" id="valuepartner">
										<label for="valuepartner">Value Added Distributor</label>
									</div>
								</div>
								<div class="form-group">
									<label>Project Name</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Project Detail</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>HFCL Products</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Expected Closure Date</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Relationship with the Customer <span>(New/Existing)</span></label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Past Experience with same customer</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Winning Probability</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
							</div>
							<div class="dashboardflex">
								<p>Reason for Special Pricing</p>
								<div class="form-group">
									<label>Competition Make</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Competition Model No.</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group sgrp">
									<label>Please specify a reason for Special Price</label>
									<div class="radiobox">
										<div class="radiosub">
											<input type="radio" name="radio1" id="lowbudget">
											<label for="lowbudget">Customer Budget is low</label>
										</div>
										<div class="radiosub">
											<input type="radio" name="radio1" id="aggressive_comp">
											<label for="aggressive_comp">Aggressive Competition</label>
										</div>
										<div class="radiosub">
											<input type="radio" name="radio1" id="otherreason">
											<label for="otherreason">If any other reason, please specify</label>
										</div>
									</div>
								</div>
								<p>Customer Details</p>
								<div class="form-group">
									<label>Name of the concerned Authority</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Designation</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Contact No.</label>
									<input type="text" name="project_name" class="form-control" required> 
								</div>
								<div class="form-group">
									<label>Address</label>
									<textarea type="text" name="project_name" class="form-control" rows="2" required></textarea>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

	</main>
	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.selctpic').selectpicker();
		});

	</script>
</body>
</html>