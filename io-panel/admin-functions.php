<?php
	include('database.php');
	include('SaveImage.class.php');
	include('include/classes/Email.class.php');
	include('include/classes/SMS.class.php');

	require 'aws/aws-autoloader.php';
	use Aws\S3\S3Client;


	class AdminFunctions extends Database {
		private $userType = 'admin';
		private $allowTags = "<strong><b><p><u><ul><li><ol><s><sub><sup><h1><img><h2><h3><h4><h5><h6><div><i><span><br><table><tr><th><td><thead><tbody><a><em>";

		function getAdminEmail() {
			$query = $this->query("SELECT * FROM ".PREFIX."admin");
			return $this->fetch($query)['username'];
		}

		/* Check login session */
		function loginSession($userId, $userName, $userType,$role) {
			$_SESSION[SITE_NAME][$this->userType."UserId"] = $userId;
			$_SESSION[SITE_NAME][$this->userType."UserName"] = $userName;
			$_SESSION[SITE_NAME][$this->userType."UserType"] = $this->userType;
			$_SESSION[SITE_NAME][$this->userType."role"] = $role;
		}

		/* Logout Function session */
		function logoutSession() {
			if(isset($_SESSION[SITE_NAME])){
				if(isset($_SESSION[SITE_NAME][$this->userType."UserId"])){
					unset($_SESSION[SITE_NAME][$this->userType."UserId"]);
				}
				if(isset($_SESSION[SITE_NAME][$this->userType."UserName"])){
					unset($_SESSION[SITE_NAME][$this->userType."UserName"]);
				}
				if(isset($_SESSION[SITE_NAME][$this->userType."UserType"])){
					unset($_SESSION[SITE_NAME][$this->userType."UserType"]);
				}
				if(isset($_COOKIE['adminlogin'])){
					unset($_COOKIE['adminlogin']);
				}
				return true;
			} else {
				return false;
			}
		}

		/* Admin login function */
		function adminLogin($data, $successURL, $failURL = "admin-login.php?failed") {
			$username = $this->escape_string($this->strip_all($data['username']));
			$password = $this->escape_string($this->strip_all($data['password']));
			$query = "select * from ".PREFIX."admin where username='".$username."'";
			$result = $this->query($query);
			if($this->num_rows($result) == 1) { 
				$row = $this->fetch($result);
				if(password_verify($password, $row['password'])) {
					$this->loginSession($row['id'], $row['full_name'], $this->userType,$row['role']);

					setcookie("adminlogin", $username, time()+7200);
					$this->close_connection();
					header("location: ".$successURL);
					exit;
				} else {
					$this->close_connection();
					header("location: ".$failURL);
					exit;
				}
			} else {
				$this->close_connection();
				header("location: ".$failURL);
				exit;
			}
		}

		function sessionExists(){
			if($this->isUserLoggedIn()){
				return $loggedInUserDetailsArr = $this->getLoggedInUserDetails();
			} else {
				if(isset($_COOKIE['adminlogin'])) {
					$adminDetails = $this->fetch($this->query("select * from ".PREFIX."admin where username='".$_COOKIE['adminlogin']."'"));
					$this->loginSession($adminDetails['id'], $adminDetails['full_name'], $this->userType, $adminDetails['role']);
					return $adminDetails;
				}
				return false;
			}
		}

		function isUserLoggedIn(){
			if( isset($_SESSION[SITE_NAME]) && isset($_SESSION[SITE_NAME][$this->userType.'UserId']) && isset($_SESSION[SITE_NAME][$this->userType.'UserType']) && !empty($_SESSION[SITE_NAME][$this->userType.'UserId']) && $_SESSION[SITE_NAME][$this->userType.'UserType']==$this->userType){
				return true;
			} else {
				return false;
			}
		}

		function getLoggedInUserDetails(){
			$loggedInID = $this->escape_string($this->strip_all($_SESSION[SITE_NAME][$this->userType.'UserId']));
			$loggedInUserDetailsArr = $this->getUniqueUserById($loggedInID);
			return $loggedInUserDetailsArr;
		}

		function getUniqueUserById($userId) {
			$userId = $this->escape_string($this->strip_all($userId));
			$query = "select * from ".PREFIX."admin where id='".$userId."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getDateFromDay($year, $month, $day) {
			/*
			0 for tuesday
			1 for monday
			2 for sunday
			3 for saturday
			4 for friday
			5 for thursday
			6 for wednesday
			*/
			$mondays = array();
			$firstDay = date('N', mktime(0, 0, 0, $month, $day, $year));
			/* Add 0 days if monday ... 6 days if tuesday, 1 day if sunday
			to get the first monday in month */
			$addDays = (8 - $firstDay);
			$mondays[] = date('Y-m-d', mktime(0, 0, 0, $month, 1 + $addDays, $year));

			$nextMonth = mktime(0, 0, 0, $month + 1, 1, $year);

			# Just add 7 days per iteration to get the date of the subsequent week
			for ($week = 1, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year);
				$time < $nextMonth;
				++$week, $time = mktime(0, 0, 0, $month, 1 + $addDays + $week * 7, $year))
			{
				$mondays[] = date('Y-m-d', $time);
			}
			return $mondays;
		} 

		// === LOGIN ENDS ====

		// == EXTRA FUNCTIONS STARTS ==
		function getValidatedPermalink($permalink){ 
			$permalink = trim($permalink, '()');
			$replace_keywords = array("-:-", "-:", ":-", " : ", " :", ": ", ":",
				"-@-", "-@", "@-", " @ ", " @", "@ ", "@", 
				"-.-", "-.", ".-", " . ", " .", ". ", ".", 
				"-\\-", "-\\", "\\-", " \\ ", " \\", "\\ ", "\\",
				"-/-", "-/", "/-", " / ", " /", "/ ", "/", 
				"-&-", "-&", "&-", " & ", " &", "& ", "&", 
				"-,-", "-,", ",-", " , ", " ,", ", ", ",", 
				" ",
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
				"-?-", "-?", "?-", " ? ", " ?", "? ", "?",
				"-!-", "-!", "!-", " ! ", " !", "! ", "!");
			$escapedPermalink = str_replace($replace_keywords, '-', $permalink); 
			return strtolower($escapedPermalink);
		}

		function getUniquePermalink($permalink,$tableName,$main_menu,$newPermalink='',$num=1) {
			if($newPermalink=='') {
				$checkPerma = $permalink;
			} else {
				$checkPerma = $newPermalink;
			}
			$sql = $this->query("select * from ".PREFIX.$tableName." where permalink='$checkPerma' and main_menu='$main_menu'");
			if($this->num_rows($sql)>0) {
				$count = $num+1;
				$newPermalink = $permalink.$count;
				return $this->getUniquePermalink($permalink,$tableName,$main_menu,$newPermalink,$count);
			} else {
				return $checkPerma;
			}
		}

		function getActiveLabel($isActive){
			if($isActive){
				return 'Yes';
			} else {
				return 'No';
			}
		}

		function getImageUrl($imageFor, $fileName, $imageSuffix){
			$image = strtolower(pathinfo($fileName, PATHINFO_FILENAME));
			$image_ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
			switch($imageFor){
				case "curtain":
				$fileDir = "../images/curtain/";
				break;
				case "category":
				$fileDir = "../images/category/";
				break;
				case "products":
				$fileDir = "../images/products/";
				break;
				case "home-banners":
				$fileDir = "../images/home-banners/";
				break;
				case "home-banner":
				$fileDir = "../images/home-banner/";
				break;

				default:
				return false;
				break;
			}
			$imageUrl = $fileDir.$image."_".$imageSuffix.".".$image_ext;
			if(file_exists($imageUrl)){
				return $imageUrl;
			} else {
				return false;
			}
		}

		function unlinkImage($imageFor, $fileName, $imageSuffix){
			$imagePath = $this->getImageUrl($imageFor, $fileName, $imageSuffix);
			$status = false;
			if($imagePath!==false){
				$status = unlink($imagePath);
			}
			return $status;
		}

		function checkUserPermissions($permission,$loggedInUserDetailsArr) {
			$userPermissionsArray = explode(',',$loggedInUserDetailsArr['permissions']);
			if(!in_array($permission,$userPermissionsArray) and $loggedInUserDetailsArr['role']!='super') {
				header("location: admin-login.php");
				exit;
			}
		}

		function generate_id($prefix, $randomNo, $tableName, $columnName){
			$chkprofile=$this->query("select ".$columnName." from ".PREFIX.$tableName." where ".$columnName." = '".$prefix.$randomNo."'");
			if($this->num_rows($chkprofile)>0){
				$randomNo = str_shuffle('1234567890123456789012345678901234567890');
				$randomNo = substr($randomNo,0,8);
				$this->generate_id($prefix, $randomNo, $tableName, $columnName);
			}else{
				return  $prefix.$randomNo;
			}
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

		function ckeditorRefresh($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		} 

		function sendMessage($mobile, $message) {
			$SMSObj = new SMS();
			$SMSObj->setAddress($mobile);
			$SMSObj->setMessage($message);
			$smsResponse = $SMSObj->sendSMS();

			return $smsResponse;
		}

		// == EXTRA FUNCTIONS ENDS ==


		/* === BANNER START === */
		function getUniqueSliderBannerById($staticBannerId) {
			$staticBannerId = $this->escape_string($this->strip_all($staticBannerId));
			$query = "select * from ".PREFIX."slider_banner where id='".$staticBannerId."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addSliderBanner($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$title1 = $this->escape_string($this->strip_all($data['title1']));
			$title2 = $this->escape_string($this->strip_all($data['title2']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$url = $this->escape_string($this->strip_all($data['url']));

			$SaveImage = new SaveImage();
			$imgDir = '../images/home-banners/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 818, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."slider_banner(image_name, active, display_order, title1, title2 , description, url) values ('".$image_name."', '".$active."', '".$display_order."' , '".$title1."' , '".$title2."' , '".$description."' , '".$url."')";
			return $this->query($query);
		}

		function updateSliderBanner($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$title1 = $this->escape_string($this->strip_all($data['title1']));
			$title2 = $this->escape_string($this->strip_all($data['title2']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$url = $this->escape_string($this->strip_all($data['url']));
			$id = $this->escape_string($this->strip_all($data['id']));

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$SaveImage = new SaveImage();
				$imgDir = '../images/home-banners/';
				$Detail = $this->getUniqueSliderBannerById($id);
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("home-banners", $Detail['image_name'], "large");
				$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 818, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."slider_banner set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."slider_banner set title1='".$title1."', title2='".$title2."', description='".$description."', url='".$url."', active='".$active."', display_order='".$display_order."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteSliderBanner($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueSliderBannerById($id);
			$this->unlinkImage("home-banners", $Detail['image_name'], "large");
			$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."slider_banner where id='$id'";
			$this->query($query);
			return true;
		}


		function updateBannerVideo($data, $file){
			$video_active = $this->escape_string($this->strip_all($data['video_active']));
			$fileDir = '../images/videos/';
			$saveFileName = "";
			if(isset($file['banner_video']) and count($file['banner_video'])>0) {
				if(!empty($file['banner_video']['name'])) {
					$Detail = $this->fetch($this->query("select * from ".PREFIX."home_cms "));
					$tmpFileName = $file['banner_video']['tmp_name'];
					$fileName = $file['banner_video']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$saveFileName = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$saveFileName);
					$query = "update ".PREFIX."home_cms set banner_video = '".$saveFileName."' ";	
					$this->query($query);
					unlink($fileDir.$Detail['banner_video']);
				}
			}
			$query = "update ".PREFIX."home_cms set video_active = '".$video_active."' ";	
			$this->query($query);
		}

		/* === BANNER END === */



		/* === HOME SLIDER START === */
		function getUniqueHomeSliderById($staticBannerId) {
			$staticBannerId = $this->escape_string($this->strip_all($staticBannerId));
			$query = "select * from ".PREFIX."home_slider_master where id='".$staticBannerId."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addHomeSlider($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$url = $this->escape_string($this->strip_all($data['url']));

			$SaveImage = new SaveImage();
			$imgDir = '../images/home-banners/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 47, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}


			$fileDir = '../images/videos/';
			$saveFileName = "";
			if(isset($file['slider_video']) and count($file['slider_video'])>0) {
				if(!empty($file['slider_video']['name'])) {
					$tmpFileName = $file['slider_video']['tmp_name'];
					$fileName = $file['slider_video']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$saveFileName = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$saveFileName);
				}
			}

			$query = "insert into ".PREFIX."home_slider_master(slider_video, image_name, active, display_order, title, description, url) values ('".$saveFileName."', '".$image_name."', '".$active."', '".$display_order."' , '".$title."' , '".$description."' , '".$url."')";
			return $this->query($query);
		}

		function updateHomeSlider($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$url = $this->escape_string($this->strip_all($data['url']));
			$id = $this->escape_string($this->strip_all($data['id']));

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$SaveImage = new SaveImage();
				$imgDir = '../images/home-banners/';
				$Detail = $this->getUniqueHomeSliderById($id);
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("home-banners", $Detail['image_name'], "large");
				$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 63, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."home_slider_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}


			$fileDir = '../images/videos/';
			$saveFileName = "";
			if(isset($file['slider_video']) and count($file['slider_video'])>0) {
				if(!empty($file['slider_video']['name'])) {
					$Detail = $this->getUniqueHomeSliderById($id);
					$tmpFileName = $file['slider_video']['tmp_name'];
					$fileName = $file['slider_video']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$saveFileName = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$saveFileName);
					$query = "update ".PREFIX."home_slider_master set slider_video = '".$saveFileName."' where id = '".$id."' ";	
					$this->query($query);
					unlink($fileDir.$Detail['slider_video']);
				}
			}

			$query = "update ".PREFIX."home_slider_master set title='".$title."', description='".$description."', url='".$url."', active='".$active."', display_order='".$display_order."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteHomeSlider($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueHomeSliderById($id);
			$this->unlinkImage("home-banners", $Detail['image_name'], "large");
			$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."home_slider_master where id='$id'";
			$this->query($query);
			return true;
		}




		/* === HOME HEADLINE START === */
		function getUniqueHomeHeadlineById($staticBannerId) {
			$staticBannerId = $this->escape_string($this->strip_all($staticBannerId));
			$query = "select * from ".PREFIX."home_headline_master where id='".$staticBannerId."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addHomeHeadline($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$url = $this->escape_string($this->strip_all($data['url']));

			$SaveImage = new SaveImage();
			$imgDir = '../images/home-banners/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 990, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."home_headline_master(image_name, active, display_order, title , description, url) values ('".$image_name."', '".$active."', '".$display_order."' , '".$title."' , '".$description."' , '".$url."')";
			return $this->query($query);
		}

		function updateHomeHeadline($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$url = $this->escape_string($this->strip_all($data['url']));
			$id = $this->escape_string($this->strip_all($data['id']));

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$SaveImage = new SaveImage();
				$imgDir = '../images/home-banners/';
				$Detail = $this->getUniqueHomeHeadlineById($id);
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("home-banners", $Detail['image_name'], "large");
				$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 990, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."home_headline_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."home_headline_master set title='".$title."', description='".$description."', url='".$url."', active='".$active."', display_order='".$display_order."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteHomeHeadline($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueHomeHeadlineById($id);
			$this->unlinkImage("home-banners", $Detail['image_name'], "large");
			$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."home_headline_master where id='$id'";
			$this->query($query);
			return true;
		}



		/* === HOME TESTIMONIAL START === */
		function getUniqueHomeTestimonialById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."home_testimonial_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addHomeTestimonial($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$name = $this->escape_string($this->strip_all($data['name']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$designation = $this->escape_string($this->strip_all($data['designation']));

			$SaveImage = new SaveImage();
			$imgDir = '../images/home-banners/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1006, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."home_testimonial_master(image_name, active, display_order, name , description, designation) values ('".$image_name."', '".$active."', '".$display_order."' , '".$name."' , '".$description."' , '".$designation."')";
			return $this->query($query);
		}

		function updateHomeTestimonial($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$name = $this->escape_string($this->strip_all($data['name']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$designation = $this->escape_string($this->strip_all($data['designation']));
			$id = $this->escape_string($this->strip_all($data['id']));

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$SaveImage = new SaveImage();
				$imgDir = '../images/home-banners/';
				$Detail = $this->getUniqueHomeTestimonialById($id);
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("home-banners", $Detail['image_name'], "large");
				$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1006, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."home_testimonial_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."home_testimonial_master set name='".$name."', description='".$description."', designation='".$designation."', active='".$active."', display_order='".$display_order."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteHomeTestimonial($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueHomeTestimonialById($id);
			$this->unlinkImage("home-banners", $Detail['image_name'], "large");
			$this->unlinkImage("home-banners", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."home_testimonial_master where id='$id'";
			$this->query($query);
			return true;
		}



		/* === CMS START === */
		function updateCMS($data, $fieldName, $file) {
			$description = $this->escape_string($this->strip_selected($data['description'], $this->allowTags));
			$query = "update ".PREFIX."cms_master set description ='".$description."' where cms_type = '".$fieldName."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."cms_master set image_name='".$image_name."' where cms_type = '".$fieldName."' ");
			}
			
		}

		function updateIndustryCMS($data, $file) {
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$query = "update ".PREFIX."industry_listing_cms set description ='".$description."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."industry_listing_cms set image_name='".$image_name."' ");
			}
			
		}

		


		/* === TESTIMONIAL START === */
		function getUniqueTestimonialById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."testimonial_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addTestimonial($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$name = $this->escape_string($this->strip_all($data['name']));
			$designation = $this->escape_string($this->strip_all($data['designation']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$SaveImage = new SaveImage();
			$imgDir = '../images/testimonial/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 167, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."testimonial_master(display_order, image_name, active, name, designation, description) values ('".$display_order."', '".$image_name."', '".$active."', '".$name."', '".$designation."', '".$description."')";
			return $this->query($query);
		}

		function updateTestimonial($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$name = $this->escape_string($this->strip_all($data['name']));
			$designation = $this->escape_string($this->strip_all($data['designation']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$id = $this->escape_string($this->strip_all($data['id']));

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$SaveImage = new SaveImage();
				$imgDir = '../images/testimonial/';
				$Detail = $this->getUniqueTestimonialById($id);
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("testimonial", $Detail['image_name'], "large");
				$this->unlinkImage("testimonial", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 167, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."testimonial_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."testimonial_master set active='".$active."', name='".$name."', designation='".$designation."', description='".$description."', display_order='".$display_order."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteTestimonial($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueTestimonialById($id);
			$this->unlinkImage("testimonial", $Detail['image_name'], "large");
			$this->unlinkImage("testimonial", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."testimonial_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === TESTIMONIAL END === */


		/* === INDUSTRY START === */
		function getUniqueIndustryById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."industry_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addIndustry($data,$file){
			$name = $this->escape_string($this->strip_all($data['name']));
			$permalink = $this->getValidatedPermalink($name);
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$banner_description = $this->escape_string($this->strip_all($data['banner_description']));
			$image_title = $this->escape_string($this->strip_all($data['image_title']));
			$description = $data['description'];
			$detail_description1 = $data['detail_description1'];
			$detail_description2 = $data['detail_description2'];
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));


			$SaveImage = new SaveImage();
			$imgDir = '../images/industry/';
			if(isset($file['menu_icon']['name']) && !empty($file['menu_icon']['name'])){
				$file_name = strtolower( pathinfo($file['menu_icon']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$menu_icon = $SaveImage->uploadCroppedImageFileFromForm($file['menu_icon'], 25, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$menu_icon = '';
			}

			if(isset($file['listing_image']['name']) && !empty($file['listing_image']['name'])){
				$file_name = strtolower( pathinfo($file['listing_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				
				$listing_image = $SaveImage->uploadCroppedImageFileFromForm($file['listing_image'], 753, $cropData, $imgDir, $file_name.'-'.time().'-2');
			} else {
				$listing_image = '';
			}

			if(isset($file['detail_banner_image']['name']) && !empty($file['detail_banner_image']['name'])){
				$file_name = strtolower( pathinfo($file['detail_banner_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData3']);
				
				$detail_banner_image = $SaveImage->uploadCroppedImageFileFromForm($file['detail_banner_image'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-3');
			} else {
				$detail_banner_image = '';
			}

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData4']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-4');
			} else {
				$image_name = '';
			}

			if(isset($file['detail_image1']['name']) && !empty($file['detail_image1']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData5']);
				
				$detail_image1 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image1'], 652, $cropData, $imgDir, $file_name.'-'.time().'-5');
			} else {
				$detail_image1 = '';
			}

			if(isset($file['detail_image2']['name']) && !empty($file['detail_image2']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData6']);
				$detail_image2 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image2'], 652, $cropData, $imgDir, $file_name.'-'.time().'-6');
			} else {
				$detail_image2 = '';
			}


			$query = "insert into ".PREFIX."industry_master(permalink, name, short_description, banner_description, image_title, description, detail_description1, detail_description2, active, display_order, menu_icon, listing_image, detail_banner_image, image_name, detail_image1, detail_image2) values ('".$permalink."', '".$name."', '".$short_description."', '".$banner_description."' , '".$image_title."' , '".$description."' , '".$detail_description1."' , '".$detail_description2."', '".$active."', '".$display_order."', '".$menu_icon."', '".$listing_image."', '".$detail_banner_image."', '".$image_name."', '".$detail_image1."', '".$detail_image2."')";
			return $this->query($query);
		}

		function updateIndustry($data,$file) {
			$name = $this->escape_string($this->strip_all($data['name']));
			$permalink = $this->getValidatedPermalink($name);
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$banner_description = $this->escape_string($this->strip_all($data['banner_description']));
			$image_title = $this->escape_string($this->strip_all($data['image_title']));
			$description = $data['description'];
			$detail_description1 = $data['detail_description1'];
			$detail_description2 = $data['detail_description2'];
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueIndustryById($id);
			$imgDir = '../images/industry/';
			$SaveImage = new SaveImage();

			if(isset($file['menu_icon']['name']) && !empty($file['menu_icon']['name'])){
				$file_name = strtolower( pathinfo($file['menu_icon']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$this->unlinkImage("industry", $Detail['menu_icon'], "large");
				$this->unlinkImage("industry", $Detail['menu_icon'], "crop");

				$menu_icon = $SaveImage->uploadCroppedImageFileFromForm($file['menu_icon'], 25, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."industry_master set menu_icon='$menu_icon' where id='$id'";
				$this->query($sql);

			}

			if(isset($file['listing_image']['name']) && !empty($file['listing_image']['name'])){
				$file_name = strtolower( pathinfo($file['listing_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				$this->unlinkImage("industry", $Detail['listing_image'], "large");
				$this->unlinkImage("industry", $Detail['listing_image'], "crop");
				$listing_image = $SaveImage->uploadCroppedImageFileFromForm($file['listing_image'], 753, $cropData, $imgDir, $file_name.'-'.time().'-2');
				$sql="update ".PREFIX."industry_master set listing_image='$listing_image' where id='$id'";
				$this->query($sql);
				
			}

			if(isset($file['detail_banner_image']['name']) && !empty($file['detail_banner_image']['name'])){
				$file_name = strtolower( pathinfo($file['detail_banner_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData3']);
				$this->unlinkImage("industry", $Detail['detail_banner_image'], "large");
				$this->unlinkImage("industry", $Detail['detail_banner_image'], "crop");
				
				$detail_banner_image = $SaveImage->uploadCroppedImageFileFromForm($file['detail_banner_image'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-3');
				$sql="update ".PREFIX."industry_master set detail_banner_image='$detail_banner_image' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData4']);
				$this->unlinkImage("industry", $Detail['image_name'], "large");
				$this->unlinkImage("industry", $Detail['image_name'], "crop");
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-4');
				$sql="update ".PREFIX."industry_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_image1']['name']) && !empty($file['detail_image1']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData5']);
				$this->unlinkImage("industry", $Detail['detail_image1'], "large");
				$this->unlinkImage("industry", $Detail['detail_image1'], "crop");
				
				$detail_image1 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image1'], 652, $cropData, $imgDir, $file_name.'-'.time().'-5');
				$sql="update ".PREFIX."industry_master set detail_image1='$detail_image1' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_image2']['name']) && !empty($file['detail_image2']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData6']);
				$this->unlinkImage("industry", $Detail['detail_image2'], "large");
				$this->unlinkImage("industry", $Detail['detail_image2'], "crop");
				$detail_image2 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image2'], 652, $cropData, $imgDir, $file_name.'-'.time().'-6');
				$sql="update ".PREFIX."industry_master set detail_image2='$detail_image2' where id='$id'";
				$this->query($sql);


			}

			$query = "update ".PREFIX."industry_master set permalink='".$permalink."', name = '".$name."', short_description = '".$short_description."', banner_description = '".$banner_description."', image_title = '".$image_title."', description = '".$description."', detail_description1 = '".$detail_description1."', detail_description2 = '".$detail_description2."', active = '".$active."', display_order = '".$display_order."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteIndustry($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueIndustryById($id);
			$this->unlinkImage("industry", $Detail['image_name'], "large");
			$this->unlinkImage("industry", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."industry_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === INDUSTRY ENDS === */


		/* === CLASS LEAD START === */
		function getUniqueClassLeadById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."class_lead_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addClassLead($data,$file){
			$industry_id = $this->escape_string($this->strip_all($data['industry_id']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));

			$SaveImage = new SaveImage();
			$imgDir = '../images/industry/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 63, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."class_lead_master(industry_id, title, description, active, display_order, image_name) values ('".$industry_id."', '".$title."', '".$description."', '".$active."', '".$display_order."' , '".$image_name."')";
			return $this->query($query);
		}

		function updateClassLead($data,$file) {
			$industry_id = $this->escape_string($this->strip_all($data['industry_id']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueClassLeadById($id);
			$imgDir = '../images/industry/';
			$SaveImage = new SaveImage();
			
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("industry", $Detail['image_name'], "large");
				$this->unlinkImage("industry", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 63, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."class_lead_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."class_lead_master set industry_id='".$industry_id."', title='".$title."', description = '".$description."', active = '".$active."', display_order = '".$display_order."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteClassLead($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueClassLeadById($id);
			$this->unlinkImage("industry", $Detail['image_name'], "large");
			$this->unlinkImage("industry", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."class_lead_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === CLASS LEAD ENDS === */


		/* === MEDIA START === */
		function getUniqueMediaById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."media_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function generateOTP($length){
			$id = substr(str_shuffle("12345678901234567890"), 0, $length);
			return $id;
		}

		function addMedia($data,$file){
			$time = $this->generateOTP(6);
			$time = "NE-".$time;
			$type = $this->escape_string($this->strip_all($data['type']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$permalink = $this->getValidatedPermalink($title);
			$permalink = $permalink.$time;
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$description = $data['description'];
			$media_date = $this->escape_string($this->strip_all($data['media_date']));
			$facebook = $this->escape_string($this->strip_all($data['facebook']));
			$instagram = $this->escape_string($this->strip_all($data['instagram']));
			$twitter = $this->escape_string($this->strip_all($data['twitter']));
			$youtube = $this->escape_string($this->strip_all($data['youtube']));
			$linkedin = $this->escape_string($this->strip_all($data['linkedin']));
			$active = $this->escape_string($this->strip_all($data['active']));


			$SaveImage = new SaveImage();
			$imgDir = '../images/media/';
			if(isset($file['listing_image']['name']) && !empty($file['listing_image']['name'])){
				$file_name = strtolower( pathinfo($file['listing_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$listing_image = $SaveImage->uploadCroppedImageFileFromForm($file['listing_image'], 754, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$listing_image = '';
			}

			if(isset($file['detail_image']['name']) && !empty($file['detail_image']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				
				$detail_image = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image'], 764, $cropData, $imgDir, $file_name.'-'.time().'-2');
			} else {
				$detail_image = '';
			}


			$query = "insert into ".PREFIX."media_master(type, title, permalink, short_description, description, media_date, facebook, instagram, twitter, youtube, linkedin, active, listing_image, detail_image) values ('".$type."', '".$title."', '".$permalink."', '".$short_description."' , '".$description."' , '".$media_date."' , '".$facebook."' , '".$instagram."', '".$twitter."', '".$youtube."', '".$linkedin."', '".$active."', '".$listing_image."', '".$detail_image."')";
			return $this->query($query);
		}

		function updateMedia($data,$file) {
			$type = $this->escape_string($this->strip_all($data['type']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$description = $data['description'];
			$media_date = $this->escape_string($this->strip_all($data['media_date']));
			$facebook = $this->escape_string($this->strip_all($data['facebook']));
			$instagram = $this->escape_string($this->strip_all($data['instagram']));
			$twitter = $this->escape_string($this->strip_all($data['twitter']));
			$youtube = $this->escape_string($this->strip_all($data['youtube']));
			$linkedin = $this->escape_string($this->strip_all($data['linkedin']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueMediaById($id);
			$imgDir = '../images/media/';
			$SaveImage = new SaveImage();
			if(isset($file['listing_image']['name']) && !empty($file['listing_image']['name'])){
				$file_name = strtolower( pathinfo($file['listing_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("media", $Detail['listing_image'], "large");
				$this->unlinkImage("media", $Detail['listing_image'], "crop");
				$listing_image = $SaveImage->uploadCroppedImageFileFromForm($file['listing_image'], 754, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."media_master set listing_image='$listing_image' where id='$id'";
				$this->query($sql);

			}

			if(isset($file['detail_image']['name']) && !empty($file['detail_image']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				$this->unlinkImage("media", $Detail['detail_image'], "large");
				$this->unlinkImage("media", $Detail['detail_image'], "crop");
				$detail_image = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image'], 764, $cropData, $imgDir, $file_name.'-'.time().'-2');
				$sql="update ".PREFIX."media_master set detail_image='$detail_image' where id='$id'";
				$this->query($sql);
				
			}

			$query = "update ".PREFIX."media_master set type='".$type."', title = '".$title."', short_description = '".$short_description."', description = '".$description."', media_date = '".$media_date."', facebook = '".$facebook."', instagram = '".$instagram."', twitter = '".$twitter."', youtube = '".$youtube."', linkedin = '".$linkedin."', active = '".$active."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteMedia($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueMediaById($id);
			$this->unlinkImage("media", $Detail['listing_image'], "large");
			$this->unlinkImage("media", $Detail['listing_image'], "crop");
			$this->unlinkImage("media", $Detail['detail_image'], "large");
			$this->unlinkImage("media", $Detail['detail_image'], "crop");
			$query = "delete from ".PREFIX."media_master where id='$id'";
			$this->query($query);
			return true;
		}

		function updateMediaCMS($data, $file) {
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$query = "update ".PREFIX."media_listing_cms set description ='".$description."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."media_listing_cms set image_name='".$image_name."' ");
			}
			
		}

		/* === MEDIA ENDS === */


































		/* === CATEGORY STARTS === */
		function getUniqueCategoryById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."category_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getAllCategories() {
			$query = "select * from ".PREFIX."category_master where active='1' ";
			$sql = $this->query($query);
			return $sql;
		}

		function addCategory($data,$file){
			$category_name = $this->escape_string($this->strip_all($data['category_name']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$catPermalink = $this->getValidatedPermalink($category_name);

			$SaveImage = new SaveImage();
			$imgDir = '../images/category/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 328, $cropData, $imgDir, time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."category_master(category_name, image_name, active, permalink) values ('".$category_name."', '".$image_name."', '".$active."', '".$catPermalink."')";

			return $this->query($query);
		}

        function addCategorynew($data,$file){
			$category_name = $this->escape_string($this->strip_all($data['category_name']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$catPermalink = $this->getValidatedPermalink($category_name);
            $main_title = $this->escape_string($this->strip_all($data['main_title']));
			$main_sub_title = $this->escape_string($this->strip_all($data['main_sub_title']));
			$hero_title1 = $this->escape_string($this->strip_all($data['hero_title1']));
			$hero_description1 = $this->escape_string($this->strip_all($data['hero_description1']));
			$hero_title2 = $this->escape_string($this->strip_all($data['hero_title2']));
			$hero_description2 = $this->escape_string($this->strip_all($data['hero_description2']));
			$hero_title3 = $this->escape_string($this->strip_all($data['hero_title3']));
			$hero_description3 = $this->escape_string($this->strip_all($data['hero_description3']));
			$lower_bg_title = $this->escape_string($this->strip_all($data['lower_bg_title']));
			$lower_bg_description = $this->escape_string($this->strip_all($data['lower_bg_description']));
			$lower_url = $this->escape_string($this->strip_all($data['lower_url']));
			$cloud_title = $this->escape_string($this->strip_all($data['cloud_title']));
			$cloud_description = $this->escape_string($this->strip_all($data['cloud_description']));
			$cloud_url = $this->escape_string($this->strip_all($data['cloud_url']));
            $high_aps_area = $data['high_aps_area'];
			$related_resources_area = $data['related_resources_area'];

			$SaveImage = new SaveImage();
			$imgDir = '../images/category/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 328, $cropData, $imgDir, time().'-1');
			} else {
				$image_name = '';
			}
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 328, $cropData, $imgDir, time().'-1');
			} else {
				$image_name = '';
			}
			if(isset($file['hero_image1']['name']) && !empty($file['hero_image1']['name'])){
				$file_name = strtolower( pathinfo($file['hero_image1']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$hero_image1 = $SaveImage->uploadCroppedImageFileFromForm($file['hero_image1'], 328, $cropData, $imgDir, time().'-1');
			} else {
				$hero_image1 = '';
			}
			if(isset($file['hero_image2']['name']) && !empty($file['hero_image2']['name'])){
				$file_name = strtolower( pathinfo($file['hero_image2']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$hero_image2 = $SaveImage->uploadCroppedImageFileFromForm($file['hero_image2'], 328, $cropData, $imgDir, time().'-1');
			} else {
				$hero_image2 = '';
			}
			if(isset($file['hero_image3']['name']) && !empty($file['hero_image3']['name'])){
				$file_name = strtolower( pathinfo($file['hero_image3']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$hero_image3 = $SaveImage->uploadCroppedImageFileFromForm($file['hero_image3'], 328, $cropData, $imgDir, time().'-1');
			} else {
				$hero_image3 = '';
			}
			if(isset($file['lower_bg_image']['name']) && !empty($file['lower_bg_image']['name'])){
				$file_name = strtolower( pathinfo($file['lower_bg_image']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$lower_bg_image = $SaveImage->uploadCroppedImageFileFromForm($file['lower_bg_image'], 328, $cropData, $imgDir, time().'-1');
			} else {
				$lower_bg_image = '';
			}
			



			$query = "insert into ".PREFIX."new_category_master(category_name, image_name, active, permalink , main_title,main_sub_title,hero_image1,hero_title1,hero_description1,hero_image2,hero_title2,hero_description2,hero_image3,hero_title3,hero_description3,high_aps_area,lower_bg_image,lower_bg_title,lower_bg_description,lower_url,cloud_title,cloud_url,cloud_description,related_resources_area) values ('".$category_name."', '".$image_name."', '".$active."', '".$catPermalink."', '".$main_title."', '".$main_sub_title."', '".$hero_image1."', '".$hero_title1."', '".$hero_description1."', '".$hero_image2."', '".$hero_title2."', '".$hero_description2."', '".$hero_image3."', '".$hero_title3."', '".$hero_description3."', '".$high_aps_area."', '".$lower_bg_image."', '".$lower_bg_title."', '".$lower_bg_description."', '".$lower_url."', '".$cloud_title."', '".$cloud_url."', '".$cloud_description."', '".$related_resources_area."')";

			return $this->query($query);
		}


		function updateCategory($data,$file) {
			$id = $this->escape_string($this->strip_all($data['id']));
			$category_name = $this->escape_string($this->strip_all($data['category_name']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$catPermalink = $this->getValidatedPermalink($category_name);

			$SaveImage = new SaveImage();
			$imgDir = '../images/category/';

			$Detail = $this->getUniqueCategoryById($id);

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				if(!empty($Detail['image_name'])) {
					$this->unlinkImage("category", $Detail['image_name'], "large");
					$this->unlinkImage("category", $Detail['image_name'], "crop");
				}

				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 328, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."category_master set image_name='".$image_name."' where id='".$id."'");
			}
				
			$query = "update ".PREFIX."category_master set permalink='".$catPermalink."', category_name='".$category_name."', active='".$active."'  where id='".$id."'";
			$this->query($query);
			return true;
		}

		function deleteCategory($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."category_master where id='".$id."'";
			$this->query($query);
			return true;
		}
		

		function getListOfStates(){
			$query = "select name as statename from ".PREFIX."states order by name asc";
			return $this->query($query);
		}

		function updateAboutCMS($data,$file) {
			$fdc_description = $this->escape_string($this->strip_all($data['fdc_description']));
			$id="1";

			$banner_image = $this->escape_string($this->strip_all($data['banner_image']));
			$banner_title = $this->escape_string($this->strip_all($data['banner_title']));
			$banner_description = $this->escape_string($this->strip_all($data['banner_description']));
			$image_name = $this->escape_string($this->strip_all($data['image_name']));
			$description = $data['description'];
			$mid_image = $this->escape_string($this->strip_all($data['mid_image']));
			$image_name1 = $this->escape_string($this->strip_all($data['image_name1']));
			$description1 = $data['description1'];
			$image_name2 = $this->escape_string($this->strip_all($data['image_name2']));
			$description2 = $data['description2'];
			
			$SaveImage = new SaveImage();
			$Detail = $this->fetch($this->query("select * from ".PREFIX."about_cms "));
			$imgDir = '../images/about-us/';

			if(isset($file['banner_image']['name']) && !empty($file['banner_image']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['banner_image']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("about-us", $Detail['banner_image'], "large");
				$this->unlinkImage("about-us", $Detail['banner_image'], "crop");
				$banner_image = $SaveImage->uploadCroppedImageFileFromForm($file['banner_image'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."about_cms set banner_image='$banner_image' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData2']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("about-us", $Detail['image_name'], "large");
				$this->unlinkImage("about-us", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 646, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."about_cms set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['image_name1']['name']) && !empty($file['image_name1']['name'])) {
				$cropData = $this->strip_all($data['cropData4']);
				$file_name = strtolower( pathinfo($file['image_name1']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("about-us", $Detail['image_name1'], "large");
				$this->unlinkImage("about-us", $Detail['image_name1'], "crop");
				$image_name1 = $SaveImage->uploadCroppedImageFileFromForm($file['image_name1'], 419, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."about_cms set image_name1='$image_name1' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['mid_image']['name']) && !empty($file['mid_image']['name'])) {
				$cropData = $this->strip_all($data['cropData3']);
				$file_name = strtolower( pathinfo($file['mid_image']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("about-us", $Detail['mid_image'], "large");
				$this->unlinkImage("about-us", $Detail['mid_image'], "crop");
				$mid_image = $SaveImage->uploadCroppedImageFileFromForm($file['mid_image'], 1922, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."about_cms set mid_image='$mid_image' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['image_name2']['name']) && !empty($file['image_name2']['name'])) {
				$cropData = $this->strip_all($data['cropData5']);
				$file_name = strtolower( pathinfo($file['image_name2']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("about-us", $Detail['image_name2'], "large");
				$this->unlinkImage("about-us", $Detail['image_name2'], "crop");
				$image_name2 = $SaveImage->uploadCroppedImageFileFromForm($file['image_name2'], 384, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."about_cms set image_name2='$image_name2' where id='$id'";
				$this->query($sql);
			}

			$fileDir = '../images/videos/';
			$saveFileName = "";
			if(isset($file['corporate_video']) and count($file['corporate_video'])>0) {
				if(!empty($file['corporate_video']['name'])) {
					$tmpFileName = $file['corporate_video']['tmp_name'];
					$fileName = $file['corporate_video']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$saveFileName = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$saveFileName);
					$query = "update ".PREFIX."about_cms set corporate_video='".$saveFileName."'  where id='".$id."'";
					$this->query($query);
					unlink($fileDir.$Detail['corporate_video']);
				}
			}

			$query = "update ".PREFIX."about_cms set banner_title='".$banner_title."', banner_description='".$banner_description."', description='".$description."', description1='".$description1."', description2='".$description2."'  where id='".$id."'";
			return $this->query($query);
		}



		/* === PRODUCTS START === */
		function getUniqueProductById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."product_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addProduct($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$product_name = $this->escape_string($this->strip_all($data['product_name']));
			$SaveImage = new SaveImage();
			$imgDir = '../images/product-image/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 238, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."product_master(image_name, active, product_name) values ('".$image_name."', '".$active."', '".$product_name."')";
			return $this->query($query);
		}

		function updateProduct($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$product_name = $this->escape_string($this->strip_all($data['product_name']));
			$id = $this->escape_string($this->strip_all($data['id']));

			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$SaveImage = new SaveImage();
				$imgDir = '../images/product-image/';
				$Detail = $this->getUniqueProductById($id);
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("product-image", $Detail['image_name'], "large");
				$this->unlinkImage("product-image", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 238, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."product_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."product_master set active='".$active."', product_name='".$product_name."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteProduct($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueProductById($id);
			$this->unlinkImage("product-image", $Detail['image_name'], "large");
			$this->unlinkImage("product-image", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."product_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === PRODUCTS END === */

	} 
?>