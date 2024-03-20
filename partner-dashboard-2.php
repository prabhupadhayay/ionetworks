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
					<div class="dashboard-profile1">
						<div class="dashboard-table table1">
							<table>
								<thead>
									<tr>
										<th>Sr. No</th>
										<th>Company name</th>
										<th>Billing Date</th>
										<th>Invoice no.</th>
										<th>Value(excluding GST)</th>
										<th>Distributor name</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><p style="opacity:0;">1</p></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="dashboard-table table2">
							<table>
								<thead>
									<tr>
										<th>Sr. No</th>
										<th>Opportunity / Customer name</th>
										<th>Date Raised</th>
										<th>Product</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><p style="opacity:0;">1</p></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>

	</main>
	<?php include("include/footer.php");?> 
	<?php include("include/footer-link.php");?>
	<script type="text/javascript">
	</script>
</body>
</html>