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
					<div class="dashboard-profile2">
						<h4>Stock Report</h4>
						<div class="dashboard-table dashtables">
							<table>
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Category</th>
										<th>SKU</th>
										<th>Opening <br>Stock(in Units)</th>
										<th>Closing Stock <br>(in Units)</th>
										<th>Stock till <br>Date</th>
										<th>Stock MTD <br>(In Units)</th>
										<th>Stock MTD <br>Value (in INR)</th>
										<th>Stock YTD <br>Value (in Units)</th>
										<th>Stock YTD</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>
											<select name="company_nature" class="form-control selctpic">
												<option selected disabled focus>-- Select --</option>
												<option value="Option1">Option1</option>
												<option value="Option2">Option2</option>
												<option value="Option3">Option3</option>
											</select>
										</td>
										<td>
											<select name="company_nature" class="form-control selctpic">
												<option selected disabled focus>-- Select --</option>
												<option value="Option1">Option1</option>
												<option value="Option2">Option2</option>
												<option value="Option3">Option3</option>
											</select>
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>2</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>3</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>
						<h4>Statement of Account</h4>
						<div class="dashboard-table dashtables">
							<table>
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Category</th>
										<th>SKU</th>
										<th>Opening <br>Stock(in Units)</th>
										<th>Closing Stock <br>(in Units)</th>
										<th>Stock till <br>Date</th>
										<th>Stock MTD <br>(In Units)</th>
										<th>Stock MTD <br>Value (in INR)</th>
										<th>Stock YTD <br>Value (in Units)</th>
										<th>Stock YTD</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<select name="company_nature" class="form-control selctpic">
												<option selected disabled focus>-- Select --</option>
												<option value="Option1">Option1</option>
												<option value="Option2">Option2</option>
												<option value="Option3">Option3</option>
											</select>
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td>
											<select name="company_nature" class="form-control selctpic">
												<option selected disabled focus>-- Select --</option>
												<option value="Option1">Option1</option>
												<option value="Option2">Option2</option>
												<option value="Option3">Option3</option>
											</select>
										</td>
										<td></td>
									</tr>
									<tr>
										<td>2</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>3</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
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
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.selctpic').selectpicker();
		});

	</script>
</body>
</html>