<?php
	$rootDir = dirname(dirname(__FILE__));
	include_once($rootDir.'/io-panel/include/config.php');
	include_once($rootDir.'/include/classes/SaveImage.class.php');
	include_once($rootDir.'/include/login-functions.php');
	include_once($rootDir.'/include/classes/CSRF.class.php');
	include_once($rootDir.'/include/classes/Email.class.php');

	/*
	 * Functions
	 * v1 - updated loginSession(), logoutSession(), customerLogin()
	 * v2 - added $groupType option
	 * v3 - checks if user(customer) is verified or not while login
	 * v4 - added support for SaveImage.class.php
	 * v5 - added support for AJAX login
	 * v6 - checks if user is active or not while login
	 * v7 - replaced customerLogin() with userLogin(), 
			updated userLogin() to use ajaxCustomerLogin()
			checks if user(wholesale) is verified or not while login
	 * v8 - added userSocialLogin()
	 */
	class Functions extends LoginFunctions {

		/** * Function to get image directory */
		function getImageDir($imageFor){
			switch($imageFor){
				case "banner":
					$fileDir = "images/banner/";
					break;
				case "ems":
					$fileDir = "images/ems/";
					break;
				case "cnms":
					$fileDir = "images/cnms/";
					break;
				case "partner":
					$fileDir = "images/partner/";
					break;
				case "association":
					$fileDir = "images/association/";
					break;
				case "home-banners":
					$fileDir = "images/home-banners/";
					break;
				case "industry":
					$fileDir = "images/industry/";
					break;
				case "about-us":
					$fileDir = "images/about-us/";
					break;
				case "category":
					$fileDir = "images/category/";
					break;
				case "media":
					$fileDir = "images/media/";
					break;
				case "home-images":
					$fileDir = "images/home-images/";
					break;
				case "home-health":
					$fileDir = "images/home-health/";
					break;
				case "product":
					$fileDir = "images/product/";
					break;
				case "testimonial":
					$fileDir = "images/testimonial/";
					break;
				case "subscription-icon":
					$fileDir = "images/subscription-icon/";
					break;
				case "about-images":
					$fileDir = "images/about-images/";
					break;
				case "web_banner":
					$fileDir = "images/web_banner/";
					break;
				case "slider-banner":
					$fileDir = "images/slider-banner/";
					break;
				case "brand":
					$fileDir = "images/brand/";
					break;
				case "home-banner":
					$fileDir = "images/home-banner/";
					break;
				case "category":
					$fileDir = "images/category/";
					break;
				default:
					return false;
					break;
			}
			return $fileDir;
		}

		function getValidatedPermalink($permalink){ // v2
			$permalink = trim($permalink, '()');
			$replace_keywords = array("-:-", "-:", ":-", " : ", " :", ": ", ":",
				"-@-", "-@", "@-", " @ ", " @", "@ ", "@", 
				"-.-", "-.", ".-", " . ", " .", ". ", ".", 
				"-\\-", "-\\", "\\-", " \\ ", " \\", "\\ ", "\\",
				"-/-", "-/", "/-", " / ", " /", "/ ", "/", 
				"-&-", "-&", "&-", " & ", " &", "& ", "&", 
				"-,-", "-,", ",-", " , ", " ,", ", ", ",", 
				" ", "\r", "\n", 
				"---", "--", " - ", " -", "- ",
				"-#-", "-#", "#-", " # ", " #", "# ", "#",
				"-$-", "-$", "$-", " $ ", " $", "$ ", "$",
				"-%-", "-%", "%-", " % ", " %", "% ", "%",
				"-^-", "-^", "^-", " ^ ", " ^", "^ ", "^",
				"-*-", "-*", "*-", " * ", " *", "* ", "*",
				"-(-", "-(", "(-", " ( ", " (", "( ", "(",
				"-)-", "-)", ")-", " ) ", " )", ") ", ")",
				"-;-", "-;", ";-", " ; ", " ;", "; ", ";",
				"-'-", "-'", "'-", " ' ", " '", "' ", "'",
				'-"-', '-"', '"-', ' " ', ' "', '" ', '"',
				"-?-", "-?", "?-", " ? ", " ?", "? ", "?",
				"-+-", "-+", "+-", " + ", " +", "+ ", "+",
				"-!-", "-!", "!-", " ! ", " !", "! ", "!",
				"®");
			$escapedPermalink = str_replace($replace_keywords, '-', $permalink); 
			return strtolower($escapedPermalink);
		}

		function moneyFormate($amt){
			return number_format($amt,2);
		}

		function getIndianCurrency($number) {
			$decimal = round($number - ($no = floor($number)), 2) * 100;
			$hundred = null;
			$digits_length = strlen($no);
			$i = 0;
			$str = array();
			$words = array(0 => '', 1 => 'one', 2 => 'two',
				3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
				7 => 'seven', 8 => 'eight', 9 => 'nine',
				10 => 'ten', 11 => 'eleven', 12 => 'twelve',
				13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
				16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
				19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
				40 => 'forty', 50 => 'fifty', 60 => 'sixty',
				70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
			$digits = array('', 'hundred','thousand','lakh', 'crore');
			while( $i < $digits_length ) {
				$divider = ($i == 2) ? 10 : 100;
				$number = floor($no % $divider);
				$no = floor($no / $divider);
				$i += $divider == 10 ? 1 : 2;
				if ($number) {
					$plural = (($counter = count($str)) && $number > 9) ? '' : null;
					//$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
					$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
					$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
				} else $str[] = null;
			}
			$Rupees = implode('', array_reverse($str));
			$paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
			//return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
			return ucfirst(($Rupees ? $Rupees . 'rupees ' : '') . $paise);
		}

		/** * Function to get image url */
		function getImageUrl($imageFor, $fileName, $imageSuffix, $dirPrefix = ""){
			if($imageFor=='products') {
				$image_name = strtolower(pathinfo($fileName, PATHINFO_FILENAME));
				$image_ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

				return AWS_S3_BUCKET_PRODUCT_LINK.$image_name."_".$imageSuffix.".".$image_ext;
			}
			$fileDir = $this->getImageDir($imageFor, $dirPrefix);
			// var_dump($fileDir);
			if($fileDir === false){ // custom directory not found, error!
				$fileDir = "../images/"; // add / at end
				$defaultImageUrl = $fileDir."default.jpg";
				return BASE_URL."/".$defaultImageUrl;
			} else { // process custom directory
				$defaultImageUrl = $fileDir."default.jpg";
				//var_dump($fileName);
				if(empty($fileName)){
					return BASE_URL."/".$defaultImageUrl;
				} else {
					$image_name = strtolower(pathinfo($fileName, PATHINFO_FILENAME));
					$image_ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					if(!empty($imageSuffix)){
						$imageUrl = $fileDir.$image_name."_".$imageSuffix.".".$image_ext;
					} else {
						$imageUrl = $fileDir.$image_name.".".$image_ext;
					}
					//echo $imageUrl;
					if(file_exists($imageUrl)){
						return BASE_URL."/".$imageUrl;
					} else {
						return BASE_URL."/".$defaultImageUrl;
					}
				}
			}
		}

		/** * Function to delete/unlink image file */
		function unlinkImage($imageFor, $fileName, $imageSuffix, $dirPrefix = ""){
			$fileDir = $this->getImageDir($imageFor, $dirPrefix);
			if($fileDir === false){ // custom directory not found, error!
				return false;
			} else { // process custom directory
				$defaultImageUrl = $fileDir."default.jpg";

				$imagePath = $this->getImageUrl($imageFor, $fileName, $imageSuffix, $dirPrefix);
				if($imagePath != $defaultImageUrl){
					$status = unlink($imagePath);
					return $status;
				} else {
					return false;
				}
			}
		}

		function getAdminDetails(){
			$sql ="SELECT * FROM ".PREFIX."admin WHERE `id`='1'";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

		function generate_id($prefix, $randomNo, $tableName, $columnName){
			$chkprofile=$this->query("select ".$columnName." from ".PREFIX.$tableName." where ".$columnName." = '".$prefix.$randomNo."'");
			if($this->num_rows($chkprofile)>0) {
				$randomNo = str_shuffle('1234567890123456789012345678901234567890');
				$randomNo = substr($randomNo,0,8);
				$this->generate_id($prefix, $randomNo, $tableName, $columnName);
			} else {
				return  $prefix.$randomNo;
			}
		}


		function generateReferralCode($myName) {
			$myName = trim($this->escape_string($this->strip_all($myName)));
			$name = substr($myName, 0, 4);
			
			$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$codeAlphabet.= "0123456789";
			
			$code = substr(str_shuffle($codeAlphabet), 0, 6);
			$referralCode = $name.$code;
			$query = "select * from ".PREFIX."customers where referral_code='".$referralCode."'";
			$result = $this->query($query);
			if($this->num_rows($result)>0){ // exists
				$this->generateReferralCode($myName); // get another id
			} else {
				 return $referralCode;
			}
		}

		/* === EXTRA FUNCTION END === */

		/* === CUSTOMER START === */
		function generateCustomerNo($prefix){
			$id = substr(str_shuffle("12345678901234567890"), 0, 8);
			$id = $prefix.'-'.$id;
			$query = "select * from ".PREFIX."customers where customer_no='".$id."'";
			$result = $this->query($query);
			if($result->num_rows>0){ // exists
				return $this->generateCustomerNo($prefix); // get another id
			} else {
				return $id;
			}
		}

		function getListOfCities(){
			$query = "select distinct districtname from ".PREFIX."pincode order by districtname asc";
			return $this->query($query);
		}

		function getListOfStates(){
			$query = "select name as statename from ".PREFIX."states order by name asc";
			return $this->query($query);
		}

		/* === CUSTOMER ENDS === */








		function getSliderbBanner(){
			$sql = "SELECT * FROM ".PREFIX."slider_banner WHERE `active`='1' order by  display_order";
			return $this->query($sql);
		}

		function getAboutCMS(){
			$sql = "SELECT * FROM ".PREFIX."about_cms";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

		function getContactUsCmsMasterDetails(){
			$sql = "SELECT * FROM ".PREFIX."contact_us_cms order by id DESC";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

		/* === CATEGORY STARTS === */
		function getMainCategories() {
			$query = "select * from ".PREFIX."category_master where active=1 order by category_name ASC";
			return $this->query($query);
		}

		function getUniqueCategoryById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."category_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getSubCategoryByCategoryId($category_id) {
			$category_id = $this->escape_string($this->strip_all($category_id));
			$query = "select * from ".PREFIX."sub_category_master where category_id='".$category_id."' and active=1 order by sub_category_name ASC";
			return $this->query($query);
		}

		function getUniqueSubCategoryById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."sub_category_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}


		function getAllActiveProductBySubscriptionId($subscriptionId){
			$sql = "SELECT * FROM ".PREFIX."product_master where FIND_IN_SET('".$subscriptionId."', subscription_id) AND active='1' and is_deleted=0 order by id DESC";
			return $this->query($sql);
		}


		function gerCMSDetailsByPageName($cms_type){
			$sql = "SELECT * FROM ".PREFIX."cms_master WHERE cms_type = '".$cms_type."' ";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

		function getAllActiveSubscriptionByCustomerId($customerId){
			$created = date('Y-m-d');
			$sql = "SELECT * FROM ".PREFIX."subscription_order WHERE customer_id = '".$customerId."' AND expirt_date >= '".$created."' and payment_status = 'Payment Complete' ";
			return $this->query($sql);
			
		}


		function contactUsRequestAdd($data, $file){
			$name = $this->escape_string($this->strip_all($data['name']));
			$email = $this->escape_string($this->strip_all($data['email']));
			$mobile = $this->escape_string($this->strip_all($data['mobile']));
			$purpose = $this->escape_string($this->strip_all($data['purpose']));
			$details = $this->escape_string($this->strip_all($data['details']));
			$fileDir = 'uploads/';
			$saveFileName = "";
			if(isset($file['investor']) and count($file['investor']['name'])>0) {
				if(!empty($file['investor']['name'])) {
					$tmpFileName = $file['investor']['tmp_name'];
					$fileName = $file['investor']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$saveFileName = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$saveFileName);
				}
			}
			$createDate = date('Y-m-d H:i:s');
			$sql = "INSERT INTO ".PREFIX."contact_us_master(name, email, mobile, purpose, details, contact_file) VALUES ('".$name."','".$email."','".$mobile."','".$purpose."', '".$details."' , '".$saveFileName."')";
			$this->query($sql);
		}

		function getUniqueProductById($id){
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."product_master where id = '".$id."' ";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		

		function getProductByproductPermalink($productPermalink) {
			$productPermalink = $this->escape_string($this->strip_all($productPermalink));
			$sql ="SELECT * FROM ".PREFIX."product_master WHERE `permalink`='".$productPermalink."'";
			$productData = $this->query($sql);
			return  $this->fetch($productData);
		}

		/* === ORDER ENDS === */

		function gerCMSDetails(){
			$sql = "SELECT * FROM ".PREFIX."cms_master order by id DESC";
			$result = $this->query($sql);
			return $this->fetch($result);
		}



		function getAllActiveHomeSlider() {
			$query = "select * from ".PREFIX."home_slider_master where active ='1' ORDER BY display_order ASC ";
			return $this->query($query);
		}

		function getAllActiveHomeHeadline() {
			$query = "select * from ".PREFIX."home_headline_master where active ='1' ORDER BY display_order ASC";
			return $this->query($query);
		}

		function getAllActiveHomeTestimonial(){
			$query = "select * from ".PREFIX."home_testimonial_master where active ='1' ORDER BY display_order ASC ";
			return $this->query($query);
		}

		function getAllActiveTestimonial(){
			$sql = "SELECT * FROM ".PREFIX."testimonial_master where active = '1' ORDER BY display_order ASC ";
			return $this->query($sql);
		}

		function getIndustryDetailsByPermalink($permalink){
			$permalink = $this->escape_string($this->strip_all($permalink));
			$sql = "SELECT * FROM ".PREFIX."industry_master where permalink='".$permalink."'";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

		function getAllActiveIndustry(){
			$sql = "SELECT * FROM ".PREFIX."industry_master where active = '1' ORDER BY display_order ASC ";
			return $this->query($sql);
		}

		function getMediaDetailsByPermalink($permalink){
			$permalink = $this->escape_string($this->strip_all($permalink));
			$sql = "SELECT * FROM ".PREFIX."media_master where permalink='".$permalink."'";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

		function getRandomMediaByType($type){
			$type = $this->escape_string($this->strip_all($type));
			$sql = "SELECT * FROM ".PREFIX."media_master where type='".$type."' ORDER BY RAND() LIMIT 1 ";
			$result = $this->query($sql);
			$data = $this->fetch($result);
			return $permalink = BASE_URL."/news&media/".$data['permalink'];

		}


		function getSubCategoryDetailsByPermalink($permalink){
			$permalink = $this->escape_string($this->strip_all($permalink));
			$sql = "SELECT * FROM ".PREFIX."sub_category_master where permalink='".$permalink."'";
			$result = $this->query($sql);
			return $this->fetch($result);
		}

		function getUniqueIndustryById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."industry_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getUniqueSubVarientById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."sub_varient_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getAllSubCategoriesByCategoryId($category_id) {
			$category_id = $this->escape_string($this->strip_all($category_id));
			$query = "select * from ".PREFIX."sub_category_master where category_id='".$category_id."' AND active='1' ";
			$sql = $this->query($query);
			return $sql;
		}

		function getAllProductsBySubCategoryId($sub_category_id) {
			$sub_category_id = $this->escape_string($this->strip_all($sub_category_id));
			$query = "select * from ".PREFIX."product_master where sub_category_id='".$sub_category_id."' AND active='1' ";
			$sql = $this->query($query);
			return $sql;
		}

		function generateOTP($length){
			$id = substr(str_shuffle("12345678901234567890"), 0, $length);
			return $id;
		}

		function encryptValue($id){
            $ciphering = "AES-128-CTR";
			$options = 0;
			$encryption_iv = '1234567891011121';
			$encryption_key = "GeeksforGeeks";
			$encryptedQuestion = openssl_encrypt($id, $ciphering,
			            $encryption_key, $options, $encryption_iv);
            return $encryptedQuestion;
		}


		function descryptValue($encryption){
			$options = 0;
			$ciphering = "AES-128-CTR";
            $decryption_iv = '1234567891011121';
			$decryption_key = "GeeksforGeeks";
			$decryption=openssl_decrypt ($encryption, $ciphering, 
			        $decryption_key, $options, $decryption_iv);
			return $decryption;
		}

	}
?>