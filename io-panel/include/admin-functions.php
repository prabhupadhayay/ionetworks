<?php
	include('database.php');
	include('SaveImage.class.php');
	include('include/classes/Email.class.php');
	include('include/classes/SMS.class.php');
	error_reporting(E_ALL);


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
				"-!-", "-!", "!-", " ! ", " !", "! ", "!",
				"’", " ’", "’ ", " ’ ");
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
			$banner_title = $this->escape_string($this->strip_all($data['banner_title']));
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

			if(isset($file['banner_image']['name']) && !empty($file['banner_image']['name'])) {
				$SaveImage = new SaveImage();
				$imgDir = '../images/home-banners/';
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['banner_image']['name'], PATHINFO_FILENAME));
				$banner_image = $SaveImage->uploadCroppedImageFileFromForm($file['banner_image'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-15');
				$sql="update ".PREFIX."home_cms set banner_image='$banner_image' ";
				$this->query($sql);
			}

			$query = "update ".PREFIX."home_cms set banner_title = '".$banner_title."', video_active = '".$video_active."' ";	
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
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 63, $cropData, $imgDir, $file_name.'-'.time().'-1');
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

		function updateCategoryCMS($data, $file) {
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$page_title = $this->escape_string($this->strip_all($data['page_title']));
			$page_description = $this->escape_string($this->strip_all($data['page_description']));
			$title1 = $this->escape_string($this->strip_all($data['title1']));
			$title2 = $this->escape_string($this->strip_all($data['title2']));
			$title3 = $this->escape_string($this->strip_all($data['title3']));

			$query = "update ".PREFIX."category_page_cms set title ='".$title."', description ='".$description."', page_title ='".$page_title."', page_description ='".$page_description."', title1 ='".$title1."', title2 ='".$title2."', title3 ='".$title3."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDirr = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDirr, time().'-1');
				$this->query("update ".PREFIX."category_page_cms set image_name='".$image_name."' ");
			}
			
			$imgDir = '../images/category/';
			if(isset($file['image1']['name']) && !empty($file['image1']['name'])) {
				$cropData = $this->strip_all($data['cropData2']);
				$image1 = $SaveImage->uploadCroppedImageFileFromForm($file['image1'], 155, $cropData, $imgDir, time().'-2');
				$this->query("update ".PREFIX."category_page_cms set image1='".$image1."' ");
			}

			if(isset($file['image2']['name']) && !empty($file['image2']['name'])) {
				$cropData = $this->strip_all($data['cropData3']);
				$image2 = $SaveImage->uploadCroppedImageFileFromForm($file['image2'], 155, $cropData, $imgDir, time().'-3');
				$this->query("update ".PREFIX."category_page_cms set image2='".$image2."' ");
			}

			if(isset($file['image3']['name']) && !empty($file['image3']['name'])) {
				$cropData = $this->strip_all($data['cropData4']);
				$image3 = $SaveImage->uploadCroppedImageFileFromForm($file['image3'], 155, $cropData, $imgDir, time().'-4');
				$this->query("update ".PREFIX."category_page_cms set image3='".$image3."' ");
			}
		}

		

		function updateContactUsCMS($data, $file) {
			$url = $this->escape_string($this->strip_all($data['url']));
			$facebook = $this->escape_string($this->strip_all($data['facebook']));
			$instagram = $this->escape_string($this->strip_all($data['instagram']));
			$twitter = $this->escape_string($this->strip_all($data['twitter']));
			$youtube = $this->escape_string($this->strip_all($data['youtube']));
			$linkedin = $this->escape_string($this->strip_all($data['linkedin']));
			$query = "update ".PREFIX."contact_cms set url ='".$url."', facebook ='".$facebook."', instagram ='".$instagram."', twitter ='".$twitter."', youtube ='".$youtube."', linkedin ='".$linkedin."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."contact_cms set image_name='".$image_name."' ");
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
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			//$permalink = $this->getValidatedPermalink($name);
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$banner_description = $this->escape_string($this->strip_all($data['banner_description']));
			$image_title = $data['image_title'];
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
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			//$permalink = $this->getValidatedPermalink($name);
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$banner_description = $this->escape_string($this->strip_all($data['banner_description']));
			$image_title = $data['image_title'];
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


		/* === EMPOWER INDUSTRY START === */
		function getUniqueEmpowerById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."industry_empower_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addEmpower($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$industry1 = $this->escape_string($this->strip_all($data['industry1']));
			$industry2 = $this->escape_string($this->strip_all($data['industry2']));
			$industry3 = $this->escape_string($this->strip_all($data['industry3']));
			$text1 = $this->escape_string($this->strip_all($data['text1']));
			$text2 = $this->escape_string($this->strip_all($data['text2']));
			$text3 = $this->escape_string($this->strip_all($data['text3']));
			$SaveImage = new SaveImage();
			$imgDir = '../images/industry/';
			if(isset($file['image1']['name']) && !empty($file['image1']['name'])){
				$file_name = strtolower( pathinfo($file['image1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image1 = $SaveImage->uploadCroppedImageFileFromForm($file['image1'], 297, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image1 = '';
			}

			if(isset($file['image2']['name']) && !empty($file['image2']['name'])){
				$file_name = strtolower( pathinfo($file['image2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				
				$image2 = $SaveImage->uploadCroppedImageFileFromForm($file['image2'], 297, $cropData, $imgDir, $file_name.'-'.time().'-2');
			} else {
				$image2 = '';
			}


			if(isset($file['image3']['name']) && !empty($file['image3']['name'])){
				$file_name = strtolower( pathinfo($file['image3']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData3']);
				$image3 = $SaveImage->uploadCroppedImageFileFromForm($file['image3'], 720, $cropData, $imgDir, $file_name.'-'.time().'-3');
			} else {
				$image3 = '';
			}

			$query = "insert into ".PREFIX."industry_empower_master(active, industry1, industry2, industry3, text1, text2, text3, image1, image2, image3) values ('".$active."', '".$industry1."', '".$industry2."', '".$industry3."' , '".$text1."' , '".$text2."' , '".$text3."' , '".$image1."', '".$image2."', '".$image3."')";
			return $this->query($query);
		}

		function updateEmpower($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$industry1 = $this->escape_string($this->strip_all($data['industry1']));
			$industry2 = $this->escape_string($this->strip_all($data['industry2']));
			$industry3 = $this->escape_string($this->strip_all($data['industry3']));
			$text1 = $this->escape_string($this->strip_all($data['text1']));
			$text2 = $this->escape_string($this->strip_all($data['text2']));
			$text3 = $this->escape_string($this->strip_all($data['text3']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueEmpowerById($id);
			$imgDir = '../images/industry/';
			$SaveImage = new SaveImage();

			if(isset($file['image1']['name']) && !empty($file['image1']['name'])){
				$file_name = strtolower( pathinfo($file['image1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("industry", $Detail['image1'], "large");
				$this->unlinkImage("industry", $Detail['image1'], "crop");
				$image1 = $SaveImage->uploadCroppedImageFileFromForm($file['image1'], 297, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."industry_empower_master set image1='$image1' where id='$id'";
				$this->query($sql);

			}

			if(isset($file['image2']['name']) && !empty($file['image2']['name'])){
				$file_name = strtolower( pathinfo($file['image2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				$this->unlinkImage("industry", $Detail['image2'], "large");
				$this->unlinkImage("industry", $Detail['image2'], "crop");
				$image2 = $SaveImage->uploadCroppedImageFileFromForm($file['image2'], 297, $cropData, $imgDir, $file_name.'-'.time().'-2');
				$sql="update ".PREFIX."industry_empower_master set image2='$image2' where id='$id'";
				$this->query($sql);

			}

			if(isset($file['image3']['name']) && !empty($file['image3']['name'])){
				$file_name = strtolower( pathinfo($file['image3']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData3']);
				$this->unlinkImage("industry", $Detail['image3'], "large");
				$this->unlinkImage("industry", $Detail['image3'], "crop");
				$image3 = $SaveImage->uploadCroppedImageFileFromForm($file['image3'], 720, $cropData, $imgDir, $file_name.'-'.time().'-3');
				$sql="update ".PREFIX."industry_empower_master set image3='$image3' where id='$id'";
				$this->query($sql);

			}

			$query = "update ".PREFIX."industry_empower_master set active='".$active."', industry1 = '".$industry1."', industry2 = '".$industry2."', industry3 = '".$industry3."', text1 = '".$text1."', text2 = '".$text2."', text3 = '".$text3."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteEmpower($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueEmpowerById($id);
			$this->unlinkImage("industry", $Detail['image1'], "large");
			$this->unlinkImage("industry", $Detail['image1'], "crop");

			$this->unlinkImage("industry", $Detail['image2'], "large");
			$this->unlinkImage("industry", $Detail['image2'], "crop");

			$this->unlinkImage("industry", $Detail['image3'], "large");
			$this->unlinkImage("industry", $Detail['image3'], "crop");

			$query = "delete from ".PREFIX."industry_empower_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === EMPOWER INDUSTRY ENDS === */


		/* === CLASS LEAD START === */
		function getUniqueClassLeadById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."class_lead_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}



		function getUniqueClassLeadById2($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."class_lead_master_2 where id='".$id."'";
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


		function addClassLead2($data,$file){
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
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."class_lead_master_2(industry_id, title, description, active, display_order, image_name) values ('".$industry_id."', '".$title."', '".$description."', '".$active."', '".$display_order."' , '".$image_name."')";
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


		function updateClassLead2($data,$file) {
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
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."class_lead_master_2 set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."class_lead_master_2 set industry_id='".$industry_id."', title='".$title."', description = '".$description."', active = '".$active."', display_order = '".$display_order."' where id='".$id."'";
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

		function deleteClassLead2($id) {
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
			$third_party_url = $this->escape_string($this->strip_all($data['third_party_url']));
			$type = $this->escape_string($this->strip_all($data['type']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			//$permalink = $this->getValidatedPermalink($title);
			//$permalink = $permalink.$time;
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$description = $data['description'];
			$media_date = $this->escape_string($this->strip_all($data['media_date']));
			$media_date = str_replace("/", "-", $media_date);
			$media_date = date('Y-m-d', strtotime($media_date));
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


			$query = "insert into ".PREFIX."media_master(type, title, permalink, short_description, description, media_date, facebook, instagram, twitter, youtube, linkedin, active, listing_image, detail_image, third_party_url) values ('".$type."', '".$title."', '".$permalink."', '".$short_description."' , '".$description."' , '".$media_date."' , '".$facebook."' , '".$instagram."', '".$twitter."', '".$youtube."', '".$linkedin."', '".$active."', '".$listing_image."', '".$detail_image."', '".$third_party_url."')";
			return $this->query($query);
		}

		function updateMedia($data,$file) {
			$type = $this->escape_string($this->strip_all($data['type']));
			$third_party_url = $this->escape_string($this->strip_all($data['third_party_url']));
			$title = $this->escape_string($this->strip_all($data['title']));
			//$permalink = $this->getValidatedPermalink($title);
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$description = $data['description'];
			$media_date = $this->escape_string($this->strip_all($data['media_date']));
			$media_date = str_replace("/", "-", $media_date);
			$media_date = date('Y-m-d', strtotime($media_date));
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

			$query = "update ".PREFIX."media_master set permalink='".$permalink."', type='".$type."', title = '".$title."', short_description = '".$short_description."', description = '".$description."', media_date = '".$media_date."', facebook = '".$facebook."', instagram = '".$instagram."', twitter = '".$twitter."', youtube = '".$youtube."', linkedin = '".$linkedin."', active = '".$active."', third_party_url='".$third_party_url."' where id='".$id."'";
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


		/* === ADDRESS START === */
		function getUniqueAddressById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."address_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addAddress($data){
			$name = $this->escape_string($this->strip_all($data['name']));
			$email = $this->escape_string($this->strip_all($data['email']));
			$address = $this->escape_string($this->strip_all($data['address']));
			$telephone = $this->escape_string($this->strip_all($data['telephone']));
			$fax = $this->escape_string($this->strip_all($data['fax']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$office_type = $this->escape_string($this->strip_all($data['office_type']));
			$query = "insert into ".PREFIX."address_master(name, email, address, telephone, fax , active, office_type) values ('".$name."', '".$email."', '".$address."' , '".$telephone."' , '".$fax."' , '".$active."' , '".$office_type."')";
			return $this->query($query);
		}

		function updateAddress($data) {
			$name = $this->escape_string($this->strip_all($data['name']));
			$email = $this->escape_string($this->strip_all($data['email']));
			$address = $this->escape_string($this->strip_all($data['address']));
			$telephone = $this->escape_string($this->strip_all($data['telephone']));
			$fax = $this->escape_string($this->strip_all($data['fax']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$id = $this->escape_string($this->strip_all($data['id']));
			$office_type = $this->escape_string($this->strip_all($data['office_type']));

			$query = "update ".PREFIX."address_master set office_type='".$office_type."', address='".$address."', fax='".$fax."', active='".$active."', name='".$name."', email='".$email."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteAddress($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."address_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === ADDRESS ENDS === */


		/* === EMAIL START === */
		function getUniqueEmailById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."email_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addEmail($data){
			$email = $this->escape_string($this->strip_all($data['email']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$query = "insert into ".PREFIX."email_master(email, active) values ('".$email."', '".$active."')";
			return $this->query($query);
		}

		function updateEmail($data) {
			$email = $this->escape_string($this->strip_all($data['email']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$query = "update ".PREFIX."email_master set active='".$active."', email='".$email."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteEmail($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."email_master where id='$id'";
			$this->query($query);
			return true;
		}

		function deleteContactEmquiry($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."contact_us_details_modified where id='$id'";
			$this->query($query);
			return true;
		}
		function deleteWhitepaperEnquiry($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."whitepaper_enquiries where id='$id'";
			$this->query($query);
			return true;
		}
		function deleteProductTrainingEnquiry($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."product_training_details where id='$id'";
			$this->query($query);
			return true;
		}

		function deletePartnershipEmquiry($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."partnership_form_details where id='$id'";
			$this->query($query);
			return true;
		}

		function deleteResourceEmquiry($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."document_download_request where id='$id'";
			$this->query($query);
			return true;
		}

		/* === EMAIL ENDS === */

		/* === ASSOCIATION START === */
		function getUniqueAssociationById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."association_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addAssociation($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$type = $this->escape_string($this->strip_all($data['type']));
			$fileDir = '../images/association/';
			$saveFileName = "";
			if(isset($file['image_name']) and count($file['image_name'])>0) {
				if(!empty($file['image_name']['name'])) {
					$tmpFileName = $file['image_name']['tmp_name'];
					$fileName = $file['image_name']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$saveFileName = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$saveFileName);
				}
			}

			$query = "insert into ".PREFIX."association_master(image_name, active, type) values ('".$saveFileName."', '".$active."', '".$type."')";
			return $this->query($query);
		}

		function updateAssociation($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$type = $this->escape_string($this->strip_all($data['type']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$fileDir = '../images/association/';
			$saveFileName = "";
			if(isset($file['image_name']) and count($file['image_name'])>0) {
				if(!empty($file['image_name']['name'])) {
					$tmpFileName = $file['image_name']['tmp_name'];
					$fileName = $file['image_name']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$saveFileName = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$saveFileName);
					$query = "update ".PREFIX."association_master set image_name='".$saveFileName."'  where id='".$id."'";
					$this->query($query);
				}
			}

			$query = "update ".PREFIX."association_master set type='".$type."', active='".$active."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteAssociation($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."association_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === ASSOCIATION ENDS === */


		/* === FAQ STARTS === */
		function getUniqueFAQById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."faq_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getAllFAQs() {
			$query = "select * from ".PREFIX."faq_master";
			$sql = $this->query($query);
			return $sql;
		}

		function addFAQ($data,$file){
			$question = $this->escape_string($this->strip_all($data['question']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$answer = $data['answer'];
			$active = $this->escape_string($this->strip_all($data['active']));
			$query = "insert into ".PREFIX."faq_master(question, answer, active, category_id) values ('".$question."', '".$answer."', '".$active."', '".$category_id."')";
			return $this->query($query);
		}

		function updateFAQ($data,$file) {
			$id = $this->escape_string($this->strip_all($data['id']));
			$question = $this->escape_string($this->strip_all($data['question']));
			$answer = $data['answer'];
			$active = $this->escape_string($this->strip_all($data['active']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$query = "update ".PREFIX."faq_master set category_id='".$category_id."', active='".$active."', question='".$question."', answer='".$answer."'  where id='".$id."'";
			$this->query($query);
			return true;
		}

		function deleteFAQ($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."faq_master where id='".$id."'";
			$this->query($query);
			return true;
		}

		/* === FAQ ENDS === */




		/* === PRODUCT START === */
		function getUniqueProductById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."product_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addProduct($data,$file){
			$product_name = $this->escape_string($this->strip_all($data['product_name']));
			$time=time();
			//$permalink = $this->getValidatedPermalink($product_name);
			//$permalink = $permalink."-".$time;
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			$product_title = $this->escape_string($this->strip_all($data['product_title']));
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$sub_category_id = $this->escape_string($this->strip_all($data['sub_category_id']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$varient_id = $this->escape_string($this->strip_all($data['varient_id']));
			$sub_varient_id = $this->escape_string($this->strip_all($data['sub_varient_id']));
			$only_for_documentation = $this->escape_string($this->strip_all($data['only_for_documentation']));
			$display_user_manual = $this->escape_string($this->strip_all($data['display_user_manual']));
			$detail_video_title =  $this->escape_string($this->strip_all($data['detail_video_title']));
			$overview = $data['overview'];
			$detail_description = $data['detail_description'];		
			$top_pics = implode(",", $data['top_pics']);
            $overview_2 = $data['overview_2'];
			$detail_area_1 = $data['detail_area_1'];
			$detail_area_2 = $data['detail_area_2'];
			$video_description_area = $data['video_description_area'];
			$SaveImage = new SaveImage();
			$imgDir = '../images/product/';
			if(isset($file['home_image']['name']) && !empty($file['home_image']['name'])){
				$file_name = strtolower( pathinfo($file['home_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$home_image = $SaveImage->uploadCroppedImageFileFromForm($file['home_image'], 246, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$home_image = '';
			}

			if(isset($file['detail_image']['name']) && !empty($file['detail_image']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				
				$detail_image = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
			} else {
				$detail_image = '';
			}


			if(isset($file['detail_imagee1']['name']) && !empty($file['detail_imagee1']['name'])){
				$file_name = strtolower( pathinfo($file['detail_imagee1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData9']);
				
				$detail_imagee1 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_imagee1'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
			} else {
				$detail_imagee1 = '';
			}


			if(isset($file['detail_imagee2']['name']) && !empty($file['detail_imagee2']['name'])){
				$file_name = strtolower( pathinfo($file['detail_imagee2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData10']);
				
				$detail_imagee2 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_imagee2'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
			} else {
				$detail_imagee2 = '';
			}


			if(isset($file['detail_imagee3']['name']) && !empty($file['detail_imagee3']['name'])){
				$file_name = strtolower( pathinfo($file['detail_imagee3']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData11']);
				
				$detail_imagee3 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_imagee3'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
			} else {
				$detail_imagee3 = '';
			}





			if(isset($file['category_image']['name']) && !empty($file['category_image']['name'])){
				$file_name = strtolower( pathinfo($file['category_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData3']);
				
				$category_image = $SaveImage->uploadCroppedImageFileFromForm($file['category_image'], 200, $cropData, $imgDir, $file_name.'-'.time().'-3');
			} else {
				$category_image = '';
			}

			$fileDir = '../images/videos/';
			$detail_video = "";
			if(isset($file['detail_video']) and count($file['detail_video'])>0) {
				if(!empty($file['detail_video']['name'])) {
					$tmpFileName = $file['detail_video']['tmp_name'];
					$fileName = $file['detail_video']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$detail_video = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$detail_video);
				}
			}

			$fileDirAtt = '../images/product/';
			$data_sheet = "";
			if(isset($file['data_sheet']) and count($file['data_sheet'])>0) {
				if(!empty($file['data_sheet']['name'])) {
					$tmpFileName = $file['data_sheet']['tmp_name'];
					$fileName = $file['data_sheet']['name'];
					$fname= $this->getValidatedPermalink($fileName);
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$data_sheet = $fname.'-'.time().'-11.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$data_sheet);
				}
			}

			$user_start_guide = "";
			if(isset($file['user_start_guide']) and count($file['user_start_guide'])>0) {
				if(!empty($file['user_start_guide']['name'])) {
					$tmpFileName = $file['user_start_guide']['tmp_name'];
					$fileName = $file['user_start_guide']['name'];
					$fname= $this->getValidatedPermalink($fileName);
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$user_start_guide = $fname.'-'.time().'-22.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide);
				}
			}


 //newly added start guides 
 $user_start_guide_1 = "";
 if(isset($file['user_start_guide_1']) and count($file['user_start_guide_1'])>0) {
	 if(!empty($file['user_start_guide_1']['name'])) {
		 $tmpFileName = $file['user_start_guide_1']['tmp_name'];
		 $fileName = $file['user_start_guide_1']['name'];
		 $fname= $this->getValidatedPermalink($fileName);
		 $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		 $user_start_guide_1 = $fname.'-'.time().'-22.'.$fileExt;
		 move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide_1);
	 }
 }

 
 $user_start_guide_domestic = "";
 if(isset($file['user_start_guide_domestic']) and count($file['user_start_guide_domestic'])>0) {
	 if(!empty($file['user_start_guide_domestic']['name'])) {
		 $tmpFileName = $file['user_start_guide_domestic']['tmp_name'];
		 $fileName = $file['user_start_guide_domestic']['name'];
		 $fname= $this->getValidatedPermalink($fileName);
		 $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		 $user_start_guide_domestic = $fname.'-'.time().'-22.'.$fileExt;
		 move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide_domestic);
	 }
 }


 $user_start_guide_international = "";
 if(isset($file['user_start_guide_international']) and count($file['user_start_guide_international'])>0) {
	 if(!empty($file['user_start_guide_international']['name'])) {
		 $tmpFileName = $file['user_start_guide_international']['tmp_name'];
		 $fileName = $file['user_start_guide_international']['name'];
		 $fname= $this->getValidatedPermalink($fileName);
		 $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		 $user_start_guide_international = $fname.'-'.time().'-22.'.$fileExt;
		 move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide_international);
	 }
 }



			$start_guide = "";
			/*if(isset($file['start_guide']) and count($file['start_guide'])>0) {
				if(!empty($file['start_guide']['name'])) {
					$tmpFileName = $file['start_guide']['tmp_name'];
					$fileName = $file['start_guide']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$start_guide = time().'-33.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$start_guide);
				}
			}*/

			$brochure = "";
			if(isset($file['brochure']) and count($file['brochure'])>0) {
				if(!empty($file['brochure']['name'])) {
					$tmpFileName = $file['brochure']['tmp_name'];
					$fileName = $file['brochure']['name'];
					$fname= $this->getValidatedPermalink($fileName);
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$brochure = $fname.'-'.time().'-44.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$brochure);
				}
			}	
			

			if(isset($file['detail_image1']['name']) && !empty($file['detail_image1']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData4']);
				
				$detail_image1 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image1'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-4');
			} else {
				$detail_image1 = '';
			}

			if(isset($file['detail_image2']['name']) && !empty($file['detail_image2']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData5']);
				
				$detail_image2 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image2'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-5');
			} else {
				$detail_image2 = '';
			}

			if(isset($file['detail_image3']['name']) && !empty($file['detail_image3']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image3']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData6']);
				
				$detail_image3 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image3'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-6');
			} else {
				$detail_image3 = '';
			}

			if(isset($file['detail_image4']['name']) && !empty($file['detail_image4']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image4']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData7']);
				
				$detail_image4 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image4'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-7');
			} else {
				$detail_image4 = '';
			}

			if(isset($file['detail_image5']['name']) && !empty($file['detail_image5']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image5']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData8']);
				
				$detail_image5 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image5'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-8');
			} else {
				$detail_image5 = '';
			}


			$query = "insert into ".PREFIX."product_master(product_name, permalink, product_title, short_description, category_id, sub_category_id, active, overview, detail_description,  home_image, detail_image, category_image, detail_video, detail_image1, detail_image2, detail_image3, detail_image4, detail_image5,varient_id, sub_varient_id, data_sheet, user_start_guide, start_guide, brochure, detail_imagee1, detail_imagee2, detail_imagee3, top_pics, only_for_documentation, display_user_manual ,user_start_guide_1,user_start_guide_domestic , user_start_guide_international , overview_2,detail_area_1 ,detail_area_2 ,video_description_area, detail_video_title) values ('".$product_name."', '".$permalink."', '".$product_title."', '".$short_description."' , '".$category_id."' , '".$sub_category_id."' , '".$active."' , '".$overview."', '".$detail_description."', '".$home_image."', '".$detail_image."', '".$category_image."', '".$detail_video."', '".$detail_image1."', '".$detail_image2."', '".$detail_image3."', '".$detail_image4."', '".$detail_image5."', '".$varient_id."', '".$sub_varient_id."', '".$data_sheet."', '".$user_start_guide."', '".$start_guide."', '".$brochure."', '".$detail_imagee1."', '".$detail_imagee2."', '".$detail_imagee3."', '".$top_pics."', '".$only_for_documentation."', '".$display_user_manual."', '".$user_start_guide_1."', '".$user_start_guide_domestic."', '".$user_start_guide_international."','".$overview_2."','".$detail_area_1."','".$detail_area_2."','".$video_description_area."','".$detail_video_title."')";
			return $this->query($query);
		}

		function updateProduct($data,$file) {
			$product_name = $this->escape_string($this->strip_all($data['product_name']));
			//$permalink = $this->getValidatedPermalink($product_name);
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			$product_title = $this->escape_string($this->strip_all($data['product_title']));
			$short_description = $this->escape_string($this->strip_all($data['short_description']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$sub_category_id = $this->escape_string($this->strip_all($data['sub_category_id']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$varient_id = $this->escape_string($this->strip_all($data['varient_id']));
			$sub_varient_id = $this->escape_string($this->strip_all($data['sub_varient_id']));
			$only_for_documentation = $this->escape_string($this->strip_all($data['only_for_documentation']));
			$display_user_manual = $this->escape_string($this->strip_all($data['display_user_manual']));
			$detail_video_title =  $this->escape_string($this->strip_all($data['detail_video_title']));
			$overview = $data['overview'];
			$overview_2 = $data['overview_2'];
			$detail_description = $data['detail_description'];
			$detail_area_1 = $data['detail_area_1'];
			$detail_area_2 = $data['detail_area_2'];
			$video_description_area = $data['video_description_area'];
			$id = $this->escape_string($this->strip_all($data['id']));
			$top_pics = implode(",", $data['top_pics']);
            $related_products_area = $data['related_products_area'];
			$Detail = $this->getUniqueProductById($id);
			$SaveImage = new SaveImage();
			$imgDir = '../images/product/';
			if(isset($file['home_image']['name']) && !empty($file['home_image']['name'])){
				$file_name = strtolower( pathinfo($file['home_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$home_image = $SaveImage->uploadCroppedImageFileFromForm($file['home_image'], 246, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$this->unlinkImage("product", $Detail['home_image'], "large");
				$this->unlinkImage("product", $Detail['home_image'], "crop");
				$sql="update ".PREFIX."product_master set home_image='$home_image' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_image']['name']) && !empty($file['detail_image']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData2']);
				$detail_image = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
				$this->unlinkImage("product", $Detail['detail_image'], "large");
				$this->unlinkImage("product", $Detail['detail_image'], "crop");
				$sql="update ".PREFIX."product_master set detail_image='$detail_image' where id='$id'";
				$this->query($sql);
			}


			if(isset($file['detail_imagee1']['name']) && !empty($file['detail_imagee1']['name'])){
				$file_name = strtolower( pathinfo($file['detail_imagee1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData9']);
				$detail_imagee1 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_imagee1'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
				$this->unlinkImage("product", $Detail['detail_imagee1'], "large");
				$this->unlinkImage("product", $Detail['detail_imagee1'], "crop");
				$sql="update ".PREFIX."product_master set detail_imagee1='$detail_imagee1' where id='$id'";
				$this->query($sql);
			}


			if(isset($file['detail_imagee2']['name']) && !empty($file['detail_imagee2']['name'])){
				$file_name = strtolower( pathinfo($file['detail_imagee2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData10']);
				$detail_imagee2 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_imagee2'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
				$this->unlinkImage("product", $Detail['detail_imagee2'], "large");
				$this->unlinkImage("product", $Detail['detail_imagee2'], "crop");
				$sql="update ".PREFIX."product_master set detail_imagee2='$detail_imagee2' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_imagee3']['name']) && !empty($file['detail_imagee3']['name'])){
				$file_name = strtolower( pathinfo($file['detail_imagee3']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData11']);
				$detail_imagee3 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_imagee3'], 820, $cropData, $imgDir, $file_name.'-'.time().'-2');
				$this->unlinkImage("product", $Detail['detail_imagee3'], "large");
				$this->unlinkImage("product", $Detail['detail_imagee3'], "crop");
				$sql="update ".PREFIX."product_master set detail_imagee3='$detail_imagee3' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['category_image']['name']) && !empty($file['category_image']['name'])){
				$file_name = strtolower( pathinfo($file['category_image']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData3']);
				$category_image = $SaveImage->uploadCroppedImageFileFromForm($file['category_image'], 200, $cropData, $imgDir, $file_name.'-'.time().'-3');
				$this->unlinkImage("product", $Detail['category_image'], "large");
				$this->unlinkImage("product", $Detail['category_image'], "crop");
				$sql="update ".PREFIX."product_master set category_image='$category_image' where id='$id'";
				$this->query($sql);
			}

			$fileDir = '../images/videos/';
			if(isset($file['detail_video']) and count($file['detail_video'])>0) {
				if(!empty($file['detail_video']['name'])) {
					$tmpFileName = $file['detail_video']['tmp_name'];
					$fileName = $file['detail_video']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$detail_video = time().'-1.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDir.$detail_video);
					$sql="update ".PREFIX."product_master set detail_video='$detail_video' where id='$id'";
					$this->query($sql);
					unlink($fileDir.$Detail['detail_video']);
				}
			}

			if(isset($file['detail_image1']['name']) && !empty($file['detail_image1']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image1']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData4']);
				$detail_image1 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image1'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-4');
				$this->unlinkImage("product", $Detail['detail_image1'], "large");
				$this->unlinkImage("product", $Detail['detail_image1'], "crop");
				$sql="update ".PREFIX."product_master set detail_image1='$detail_image1' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_image2']['name']) && !empty($file['detail_image2']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image2']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData5']);
				$detail_image2 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image2'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-5');
				$this->unlinkImage("product", $Detail['detail_image2'], "large");
				$this->unlinkImage("product", $Detail['detail_image2'], "crop");
				$sql="update ".PREFIX."product_master set detail_image2='$detail_image2' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_image3']['name']) && !empty($file['detail_image3']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image3']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData6']);
				
				$detail_image3 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image3'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-6');
				$this->unlinkImage("product", $Detail['detail_image3'], "large");
				$this->unlinkImage("product", $Detail['detail_image3'], "crop");
				$sql="update ".PREFIX."product_master set detail_image3='$detail_image3' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_image4']['name']) && !empty($file['detail_image4']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image4']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData7']);
				
				$detail_image4 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image4'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-7');
				$this->unlinkImage("product", $Detail['detail_image4'], "large");
				$this->unlinkImage("product", $Detail['detail_image4'], "crop");
				$sql="update ".PREFIX."product_master set detail_image4='$detail_image4' where id='$id'";
				$this->query($sql);
			}

			if(isset($file['detail_image5']['name']) && !empty($file['detail_image5']['name'])){
				$file_name = strtolower( pathinfo($file['detail_image5']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData8']);
				
				$detail_image5 = $SaveImage->uploadCroppedImageFileFromForm($file['detail_image5'], 1014, $cropData, $imgDir, $file_name.'-'.time().'-8');
				$this->unlinkImage("product", $Detail['detail_image5'], "large");
				$this->unlinkImage("product", $Detail['detail_image5'], "crop");
				$sql="update ".PREFIX."product_master set detail_image5='$detail_image5' where id='$id'";
				$this->query($sql);
			}


			$fileDirAtt = '../images/product/';
			if(isset($file['data_sheet']) and count($file['data_sheet'])>0) {
				if(!empty($file['data_sheet']['name'])) {
					$tmpFileName = $file['data_sheet']['tmp_name'];
					$fileName = $file['data_sheet']['name'];
					$fname= $this->getValidatedPermalink($fileName);
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$data_sheet = $fname.'-'.time().'-11.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$data_sheet);
					$sql="update ".PREFIX."product_master set data_sheet='$data_sheet' where id='$id'";
					$this->query($sql);
				}
			}


			if(isset($file['user_start_guide']) and count($file['user_start_guide'])>0) {
				if(!empty($file['user_start_guide']['name'])) {
					$tmpFileName = $file['user_start_guide']['tmp_name'];
					$fileName = $file['user_start_guide']['name'];
					$fname= $this->getValidatedPermalink($fileName);
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$user_start_guide = $fname.'-'.time().'-22.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide);
					$sql="update ".PREFIX."product_master set user_start_guide='$user_start_guide' where id='$id'";
					$this->query($sql);
				}
			}


//newly added user start guides 
if(isset($file['user_start_guide_1']) and count($file['user_start_guide_1'])>0) {
	if(!empty($file['user_start_guide_1']['name'])) {
		$tmpFileName = $file['user_start_guide_1']['tmp_name'];
		$fileName = $file['user_start_guide_1']['name'];
		$fname= $this->getValidatedPermalink($fileName);
		$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		$user_start_guide_1 = $fname.'-'.time().'-22.'.$fileExt;
		move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide_1);
		$sql="update ".PREFIX."product_master set user_start_guide_1='$user_start_guide_1' where id='$id'";
		$this->query($sql);
	}
}

if(isset($file['user_start_guide_domestic']) and count($file['user_start_guide_domestic'])>0) {
	if(!empty($file['user_start_guide_domestic']['name'])) {
		$tmpFileName = $file['user_start_guide_domestic']['tmp_name'];
		$fileName = $file['user_start_guide_domestic']['name'];
		$fname= $this->getValidatedPermalink($fileName);
		$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		$user_start_guide_domestic = $fname.'-'.time().'-22.'.$fileExt;
		move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide_domestic);
		$sql="update ".PREFIX."product_master set user_start_guide_domestic='$user_start_guide_domestic' where id='$id'";
		$this->query($sql);
	}
}

if(isset($file['user_start_guide_international']) and count($file['user_start_guide'])>0) {
	if(!empty($file['user_start_guide_international']['name'])) {
		$tmpFileName = $file['user_start_guide_international']['tmp_name'];
		$fileName = $file['user_start_guide_international']['name'];
		$fname= $this->getValidatedPermalink($fileName);
		$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
		$user_start_guide_international = $fname.'-'.time().'-22.'.$fileExt;
		move_uploaded_file($tmpFileName, $fileDirAtt.$user_start_guide_international);
		$sql="update ".PREFIX."product_master set user_start_guide_international='$user_start_guide_international' where id='$id'";
		$this->query($sql);
	}
}


			/*if(isset($file['start_guide']) and count($file['start_guide'])>0) {
				if(!empty($file['start_guide']['name'])) {
					$tmpFileName = $file['start_guide']['tmp_name'];
					$fileName = $file['start_guide']['name'];
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$start_guide = time().'-33.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$start_guide);
					$sql="update ".PREFIX."product_master set start_guide='$start_guide' where id='$id'";
					$this->query($sql);
				}
			}*/

			if(isset($file['brochure']) and count($file['brochure'])>0) {
				if(!empty($file['brochure']['name'])) {
					$tmpFileName = $file['brochure']['tmp_name'];
					$fileName = $file['brochure']['name'];
					$fname= $this->getValidatedPermalink($fileName);
					$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
					$brochure = $fname.'-'.time().'-44.'.$fileExt;
					move_uploaded_file($tmpFileName, $fileDirAtt.$brochure);
					$sql="update ".PREFIX."product_master set brochure='$brochure' where id='$id'";
					$this->query($sql);
				}
			}


			$query = "update ".PREFIX."product_master set permalink = '".$permalink."', product_name='".$product_name."', product_title = '".$product_title."', short_description = '".$short_description."', category_id = '".$category_id."', sub_category_id = '".$sub_category_id."', active = '".$active."', overview = '".$overview."', overview_2 = '".$overview_2."',detail_description = '".$detail_description."', varient_id = '".$varient_id."', sub_varient_id = '".$sub_varient_id."', top_pics='".$top_pics."', only_for_documentation='".$only_for_documentation."', display_user_manual='".$display_user_manual."', detail_area_1='".$detail_area_1."', detail_area_2 = '".$detail_area_2."', video_description_area = '".$video_description_area."',related_products_area = '".$related_products_area."', detail_video_title = '".$detail_video_title."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteProduct($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueProductById($id);
			$this->unlinkImage("product", $Detail['image_name'], "large");
			$this->unlinkImage("product", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."product_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === PRODUCT ENDS === */


		/* === PRODUCT SPECIFICATION START === */
		function getUniqueProductSpecificationById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."product_specification_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addProductSpecification($data,$file){
			$industry_id = $this->escape_string($this->strip_all($data['industry_id']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $data['description'];
			$active = $this->escape_string($this->strip_all($data['active']));

			$SaveImage = new SaveImage();
			$imgDir = '../images/product/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 120, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."product_specification_master(product_id, title, description, active, image_name) values ('".$industry_id."', '".$title."', '".$description."', '".$active."','".$image_name."')";
			return $this->query($query);
		}

		function updateProductSpecification($data,$file) {
			$industry_id = $this->escape_string($this->strip_all($data['industry_id']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $data['description'];
			$active = $this->escape_string($this->strip_all($data['active']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueProductSpecificationById($id);
			$imgDir = '../images/product/';
			$SaveImage = new SaveImage();
			
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$this->unlinkImage("product", $Detail['image_name'], "large");
				$this->unlinkImage("product", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 120, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."product_specification_master set image_name='$image_name' where id='$id'";
				$this->query($sql);
			}

			$query = "update ".PREFIX."product_specification_master set product_id='".$industry_id."', title='".$title."', description = '".$description."', active = '".$active."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteProductSpecification($id) {
			$id = $this->escape_string($this->strip_all($id));
			$Detail = $this->getUniqueProductSpecificationById($id);
			$this->unlinkImage("product", $Detail['image_name'], "large");
			$this->unlinkImage("product", $Detail['image_name'], "crop");
			$query = "delete from ".PREFIX."product_specification_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === PRODUCT SPECIFICATION ENDS === */


		/* === VARIENT STARTS === */
		function getUniqueVarientById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."varient_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getAllVarientBySubCategoryId($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."varient_master where active='1' AND sub_category_id = '".$id."' ";
			$sql = $this->query($query);
			return $sql;
		}

		function addVarient($data,$file){
			$name = $this->escape_string($this->strip_all($data['name']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$sub_category_id = $this->escape_string($this->strip_all($data['sub_category_id']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$permalink = $this->getValidatedPermalink($name);

			$query = "insert into ".PREFIX."varient_master(name, category_id, active, permalink, sub_category_id) values ('".$name."', '".$category_id."', '".$active."', '".$permalink."', '".$sub_category_id."')";

			return $this->query($query);
		}

		function updateVarient($data,$file) {
			$id = $this->escape_string($this->strip_all($data['id']));
			$name = $this->escape_string($this->strip_all($data['name']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$sub_category_id = $this->escape_string($this->strip_all($data['sub_category_id']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$permalink = $this->getValidatedPermalink($name);
				
			$query = "update ".PREFIX."varient_master set permalink='".$permalink."', name='".$name."', active='".$active."', category_id='".$category_id."', sub_category_id='".$sub_category_id."'  where id='".$id."'";
			$this->query($query);
			return true;
		}

		function deleteVarient($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."varient_master where id='".$id."'";
			$this->query($query);
			return true;
		}



		/* === SUB VARIENT STARTS === */
		function getUniqueSubVarientById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."sub_varient_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getAllSubVarientByVarientId($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."sub_varient_master where active='1' AND varient_id = '".$id."' ";
			$sql = $this->query($query);
			return $sql;
		}

		function addSubVarient($data){
			$name = $this->escape_string($this->strip_all($data['name']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$sub_category_id = $this->escape_string($this->strip_all($data['sub_category_id']));
			$varient_id = $this->escape_string($this->strip_all($data['varient_id']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$permalink = $this->getValidatedPermalink($name);
			$query = "insert into ".PREFIX."sub_varient_master(name, category_id, active, permalink, sub_category_id, varient_id, description) values ('".$name."', '".$category_id."', '".$active."', '".$permalink."', '".$sub_category_id."', '".$varient_id."', '".$description."')";
			return $this->query($query);
		}

		function updateSubVarient($data) {
			$id = $this->escape_string($this->strip_all($data['id']));
			$name = $this->escape_string($this->strip_all($data['name']));
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$sub_category_id = $this->escape_string($this->strip_all($data['sub_category_id']));
			$varient_id = $this->escape_string($this->strip_all($data['varient_id']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$permalink = $this->getValidatedPermalink($name);
				
			$query = "update ".PREFIX."sub_varient_master set varient_id='".$varient_id."', permalink='".$permalink."', name='".$name."', active='".$active."', category_id='".$category_id."', sub_category_id='".$sub_category_id."', description='".$description."'  where id='".$id."'";
			$this->query($query);
			return true;
		}

		function deleteSubVarient($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."sub_varient_master where id='".$id."'";
			$this->query($query);
			return true;
		}


		function partnershipFormCMS($data,$file){
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$query = "update ".PREFIX."partnership_form_cms set description ='".$description."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1349, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."partnership_form_cms set image_name='".$image_name."' ");
			}
		}

		function blogFormCMS($data,$file){
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$query = "update ".PREFIX."blog_cms set description ='".$description."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1349, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."blog_cms set image_name='".$image_name."' ");
			}
		}

		function docFormCMS($data,$file){
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$query = "update ".PREFIX."doc_cms set description ='".$description."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1349, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."doc_cms set image_name='".$image_name."' ");
			}
		}

		function updatePartnerCMS($data, $file) {
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$testimonial_title = $this->escape_string($this->strip_all($data['testimonial_title']));
			$introduction = $data['introduction'];
			$testimonial_description = $data['testimonial_description'];
			$togather_we_can = $data['togather_we_can'];

			$query = "update ".PREFIX."partner_cms set testimonial_title ='".$testimonial_title."', introduction ='".$introduction."', testimonial_description ='".$testimonial_description."', togather_we_can ='".$togather_we_can."', description ='".$description."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."partner_cms set image_name='".$image_name."' ");
			}
			
		}


		function updatePartnerCMS2($data, $file) {
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$testimonial_title = $this->escape_string($this->strip_all($data['testimonial_title']));
			$introduction = $data['introduction'];
			$testimonial_description = $data['testimonial_description'];
			$togather_we_can = $data['togather_we_can'];
            $channel_partner_description = $data['channel_partner_description'];

			$query = "update ".PREFIX."partner_cms set testimonial_title ='".$testimonial_title."', introduction ='".$introduction."', testimonial_description ='".$testimonial_description."', togather_we_can ='".$togather_we_can."', description ='".$description."',channel_partner_description ='".$channel_partner_description."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."partner_cms set image_name='".$image_name."' ");
			}

			if(isset($file['partner_new_image']['name']) && !empty($file['partner_new_image']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['partner_new_image'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."partner_cms set partner_new_image='".$image_name."' ");
			}

            if(isset($file['channel_partner_image']['name']) && !empty($file['channel_partner_image']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['channel_partner_image'], 1920, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."partner_cms set channel_partner_image='".$image_name."' ");
			}

			
		}





		function updatePartnerDetailsCMS($data) {
			$ladder_detail_description = $this->escape_string($this->strip_all($data['ladder_detail_description']));
			$query = "update ".PREFIX."partner_cms set ladder_detail_description ='".$ladder_detail_description."' ";
			$this->query($query);			
		}




		/* === PARTNER ONBOARD START === */
		function getUniquePartnerOnboardById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."partner_onboard_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addPartnerOnboard($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$SaveImage = new SaveImage();
			$imgDir = '../images/partner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 108, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."partner_onboard_master(active, title, image_name) values ('".$active."', '".$title."', '".$image_name."')";
			return $this->query($query);
		}

		function updatePartnerOnboard($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniquePartnerOnboardById($id);
			$imgDir = '../images/partner/';
			$SaveImage = new SaveImage();
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("partner", $Detail['image_name'], "large");
				$this->unlinkImage("partner", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 108, $cropData, $imgDir, $file_name.'-'.time().'-1');
				$sql="update ".PREFIX."partner_onboard_master set image_name='$image_name' where id='$id'";
				$this->query($sql);

			}

			$query = "update ".PREFIX."partner_onboard_master set active='".$active."', title = '".$title."' where id='".$id."'";
			return $this->query($query);
		}

		function deletePartnerOnboard($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."partner_onboard_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === PARTNER ONBOARD ENDS === */


		/* === PARTNER TOGATHER IMAGE START === */
		function getUniqueTogatherImageById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."togimg_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addTogatherImage($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$SaveImage = new SaveImage();
			$imgDir = '../images/partner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 230, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."togimg_master(active, title, image_name,description) values ('".$active."', '".$title."', '".$image_name."', '".$description."')";
			return $this->query($query);
		}

		function updateTogatherImage($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueTogatherImageById($id);
			$imgDir = '../images/partner/';
			$SaveImage = new SaveImage();
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("partner", $Detail['image_name'], "large");
				$this->unlinkImage("partner", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 230, $cropData, $imgDir, $file_name.'-'.time().'-1');
				echo $sql="update ".PREFIX."togimg_master set image_name='$image_name' where id='$id'";
				$this->query($sql);

			}

			$query = "update ".PREFIX."togimg_master set description='".$description."', active='".$active."', title = '".$title."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteTogatherImage($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."togimg_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === PARTNER TOGATHER IMAGE ENDS === */


		/* === LADDER CATEGORY STARTS === */
		function getUniqueLadderCategoryById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."ladder_category_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function getAllLadderCategories() {
			$query = "select * from ".PREFIX."ladder_category_master where active='1' ";
			$sql = $this->query($query);
			return $sql;
		}

		function addLadderCategory($data){
			$name = $this->escape_string($this->strip_all($data['name']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$query = "insert into ".PREFIX."ladder_category_master(name, active) values ('".$name."', '".$active."')";

			return $this->query($query);
		}

		function updateLadderCategory($data) {
			$id = $this->escape_string($this->strip_all($data['id']));
			$name = $this->escape_string($this->strip_all($data['name']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$query = "update ".PREFIX."ladder_category_master set name='".$name."', active='".$active."'  where id='".$id."'";
			$this->query($query);
			return true;
		}

		function deleteLadderCategory($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."ladder_category_master where id='".$id."'";
			$this->query($query);
			return true;
		}

		/* === LADDER CATEGORY ENDS === */

		/* === LADDER STARTS === */
		function getUniqueLadderById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."ladder_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}


		function addLadder($data){
			$key_name = $this->escape_string($this->strip_all($data['key_name']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$ladder = implode(",", $data['ladder']);
			$query = "insert into ".PREFIX."ladder_master(key_name, active,display_order,ladder) values ('".$key_name."', '".$active."', '".$display_order."', '".$ladder."')";

			return $this->query($query);
		}

		function updateLadder($data) {
			$id = $this->escape_string($this->strip_all($data['id']));
			$key_name = $this->escape_string($this->strip_all($data['key_name']));
			$active = $this->escape_string($this->strip_all($data['active']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$ladder = implode(",", $data['ladder']);
			$query = "update ".PREFIX."ladder_master set display_order='".$display_order."',ladder='".$ladder."',key_name='".$key_name."', active='".$active."'  where id='".$id."'";
			$this->query($query);
			return true;
		}

		function deleteLadder($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."ladder_master where id='".$id."'";
			$this->query($query);
			return true;
		}

		/* === LADDER ENDS === */



		function updateEMSCMS($data, $file) {
			$title = $this->escape_string($this->strip_all($data['title']));
			$url = $this->escape_string($this->strip_all($data['url']));
			$technology_url = $this->escape_string($this->strip_all($data['technology_url']));
			$technology_description = $this->escape_string($this->strip_all($data['technology_description']));
			$introduction = $data['introduction'];

			$query = "update ".PREFIX."ems_cms set technology_url ='".$technology_url."', introduction ='".$introduction."', technology_description ='".$technology_description."', url ='".$url."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1349, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."ems_cms set image_name='".$image_name."' ");
			}

			if(isset($file['faq_banner']['name']) && !empty($file['faq_banner']['name'])) {
				$cropData = $this->strip_all($data['cropData2']);
				$faq_banner = $SaveImage->uploadCroppedImageFileFromForm($file['faq_banner'], 1934, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."ems_cms set faq_banner='".$faq_banner."' ");
			}
			
		}

		function updateCNMSCMS($data, $file) {
			$title = $this->escape_string($this->strip_all($data['title']));
			$url = $this->escape_string($this->strip_all($data['url']));
			$technology_url = $this->escape_string($this->strip_all($data['technology_url']));
			$technology_description = $this->escape_string($this->strip_all($data['technology_description']));
			$introduction = $data['introduction'];

			$query = "update ".PREFIX."cnms_cms set technology_url ='".$technology_url."', introduction ='".$introduction."', technology_description ='".$technology_description."', url ='".$url."', title ='".$title."' ";
			$this->query($query);

			$SaveImage = new SaveImage();
			$imgDir = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1349, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."cnms_cms set image_name='".$image_name."' ");
			}

			if(isset($file['faq_banner']['name']) && !empty($file['faq_banner']['name'])) {
				$cropData = $this->strip_all($data['cropData2']);
				$faq_banner = $SaveImage->uploadCroppedImageFileFromForm($file['faq_banner'], 1934, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."cnms_cms set faq_banner='".$faq_banner."' ");
			}
			
		}



		/* === EMS ICON START === */
		function getUniqueEMSIconById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."emsicon_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addEMSIcon($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$SaveImage = new SaveImage();
			$imgDir = '../images/ems/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 58, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."emsicon_master(active, title, image_name) values ('".$active."', '".$title."', '".$image_name."')";
			return $this->query($query);
		}

		function updateEMSIcon($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueEMSIconById($id);
			$imgDir = '../images/ems/';
			$SaveImage = new SaveImage();
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("ems", $Detail['image_name'], "large");
				$this->unlinkImage("ems", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 58, $cropData, $imgDir, $file_name.'-'.time().'-1');
				echo $sql="update ".PREFIX."emsicon_master set image_name='$image_name' where id='$id'";
				$this->query($sql);

			}

			$query = "update ".PREFIX."emsicon_master set active='".$active."', title = '".$title."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteEMSIcon($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."emsicon_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === EMS ICON ENDS === */


		/* === CNMS ICON START === */
		function getUniqueCNMSIconById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."cnmsicon_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addCNMSIcon($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$SaveImage = new SaveImage();
			$imgDir = '../images/cnms/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 58, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."cnmsicon_master(active, title, image_name) values ('".$active."', '".$title."', '".$image_name."')";
			return $this->query($query);
		}

		function updateCNMSIcon($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueCNMSIconById($id);
			$imgDir = '../images/cnms/';
			$SaveImage = new SaveImage();
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("cnms", $Detail['image_name'], "large");
				$this->unlinkImage("cnms", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 58, $cropData, $imgDir, $file_name.'-'.time().'-1');
				echo $sql="update ".PREFIX."cnmsicon_master set image_name='$image_name' where id='$id'";
				$this->query($sql);

			}

			$query = "update ".PREFIX."cnmsicon_master set active='".$active."', title = '".$title."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteCNMSIcon($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."cnmsicon_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === CNMS ICON ENDS === */



		/* === EMS DATA START === */
		function getUniqueEMSDATAById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."emsdata_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addEMSDATA($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $data['description'];
			$SaveImage = new SaveImage();
			$imgDir = '../images/ems/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 434, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."emsdata_master(active, title, image_name,description) values ('".$active."', '".$title."', '".$image_name."', '".$description."')";
			return $this->query($query);
		}

		function updateEMSDATA($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $data['description'];
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueEMSDATAById($id);
			$imgDir = '../images/ems/';
			$SaveImage = new SaveImage();
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("ems", $Detail['image_name'], "large");
				$this->unlinkImage("ems", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 434, $cropData, $imgDir, $file_name.'-'.time().'-1');
				echo $sql="update ".PREFIX."emsdata_master set image_name='$image_name' where id='$id'";
				$this->query($sql);

			}

			$query = "update ".PREFIX."emsdata_master set description='".$description."', active='".$active."', title = '".$title."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteEMSDATA($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."emsdata_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === EMS DATA ENDS === */


		/* === CNMS DATA START === */
		function getUniqueCNMSDATAById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."cnmsdata_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addCNMSDATA($data,$file){
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $data['description'];
			$SaveImage = new SaveImage();
			$imgDir = '../images/cnms/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 434, $cropData, $imgDir, $file_name.'-'.time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."cnmsdata_master(active, title, image_name,description) values ('".$active."', '".$title."', '".$image_name."', '".$description."')";
			return $this->query($query);
		}

		function updateCNMSDATA($data,$file) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $data['description'];
			$id = $this->escape_string($this->strip_all($data['id']));

			$Detail = $this->getUniqueCNMSDATAById($id);
			$imgDir = '../images/cnms/';
			$SaveImage = new SaveImage();
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$cropData = $this->strip_all($data['cropData1']);
				$this->unlinkImage("cnms", $Detail['image_name'], "large");
				$this->unlinkImage("cnms", $Detail['image_name'], "crop");
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 434, $cropData, $imgDir, $file_name.'-'.time().'-1');
				echo $sql="update ".PREFIX."cnmsdata_master set image_name='$image_name' where id='$id'";
				$this->query($sql);

			}

			$query = "update ".PREFIX."cnmsdata_master set description='".$description."', active='".$active."', title = '".$title."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteCNMSDATA($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."cnmsdata_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === CNMS DATA ENDS === */


		/* === EMS FAQ START === */
		function getUniqueEMSFAQById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."emsfaq_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addEMSFAQ($data){
			$active = $this->escape_string($this->strip_all($data['active']));
			$question = $this->escape_string($this->strip_all($data['question']));
			$answer = $this->escape_string($this->strip_all($data['answer']));
			$query = "insert into ".PREFIX."emsfaq_master(active, question,answer) values ('".$active."', '".$question."', '".$answer."')";
			return $this->query($query);
		}

		function updateEMSFAQ($data) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$question = $this->escape_string($this->strip_all($data['question']));
			$answer = $this->escape_string($this->strip_all($data['answer']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$query = "update ".PREFIX."emsfaq_master set question='".$question."', answer='".$answer."', active='".$active."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteEMSFAQ($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."emsfaq_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === EMS FAQ ENDS === */

		/* === CNMS FAQ START === */
		function getUniqueCNMSFAQById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."cnmsfaq_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addCNMSFAQ($data){
			$active = $this->escape_string($this->strip_all($data['active']));
			$question = $this->escape_string($this->strip_all($data['question']));
			$answer = $this->escape_string($this->strip_all($data['answer']));
			$query = "insert into ".PREFIX."cnmsfaq_master(active, question,answer) values ('".$active."', '".$question."', '".$answer."')";
			return $this->query($query);
		}

		function updateCNMSFAQ($data) {
			$active = $this->escape_string($this->strip_all($data['active']));
			$question = $this->escape_string($this->strip_all($data['question']));
			$answer = $this->escape_string($this->strip_all($data['answer']));
			$id = $this->escape_string($this->strip_all($data['id']));

			$query = "update ".PREFIX."cnmsfaq_master set question='".$question."', answer='".$answer."', active='".$active."' where id='".$id."'";
			return $this->query($query);
		}

		function deleteCNMSFAQ($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."cnmsfaq_master where id='$id'";
			$this->query($query);
			return true;
		}

		/* === CNMS FAQ ENDS === */





/** Installation report */



function getAllInstallationReport() {
	$query = "select * from ".PREFIX."installation_queries";
	$sql = $this->query($query);
	return $sql;
}


function deleteInstallationReport($id) {
	$id = $this->escape_string($this->strip_all($id));
	$query = "delete from ".PREFIX."installation_queries where id='".$id."'";
	$this->query($query);
	return true;
}
























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
			$show_tab = $this->escape_string($this->strip_all($data['show_tab']));
			//$catPermalink = $this->getValidatedPermalink($category_name);
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			$SaveImage = new SaveImage();
			$imgDir = '../images/category/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])){
				$file_name = strtolower( pathinfo($file['image_name']['name'], PATHINFO_FILENAME));
				$file_name = $this->getValidatedPermalink($file_name);
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 39, $cropData, $imgDir, time().'-1');
			} else {
				$image_name = '';
			}

			$query = "insert into ".PREFIX."category_master(category_name, image_name, active, permalink, show_tab) values ('".$category_name."', '".$image_name."', '".$active."', '".$permalink."', '".$show_tab."')";

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
			$show_tab = $this->escape_string($this->strip_all($data['show_tab']));
			//$catPermalink = $this->getValidatedPermalink($category_name);
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
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
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 39, $cropData, $imgDir, time().'-1');
				$this->query("update ".PREFIX."category_master set image_name='".$image_name."' where id='".$id."'");
			}
				
			$query = "update ".PREFIX."category_master set show_tab='".$show_tab."', permalink='".$permalink."', category_name='".$category_name."', active='".$active."'  where id='".$id."'";
			$this->query($query);
			return true;
		}

		function deleteCategory($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "delete from ".PREFIX."category_master where id='".$id."'";
			$this->query($query);
			return true;
		}


		/* === SUB CATEGORY LEVEL 1 BEGINS === */

		function getAllSubCategories() {
			$query = "select * from ".PREFIX."sub_category_master where active='1' ";
			$sql = $this->query($query);
			return $sql;
		}

		function getAllSubCategoriesByCategoryId($category_id) {
			$category_id = $this->escape_string($this->strip_all($category_id));
			$query = "select * from ".PREFIX."sub_category_master where category_id='".$category_id."'";
			$sql = $this->query($query);
			return $sql;
		}

		function getAllVarientsBySubCategoriesId($sub_category_id) {
			$sub_category_id = $this->escape_string($this->strip_all($sub_category_id));
			$query = "select * from ".PREFIX."varient_master where sub_category_id='".$sub_category_id."' AND active='1' ";
			$sql = $this->query($query);
			return $sql;
		}

		function getAllSubCategoriesByCategoryIds($category_id) {
			$category_id = $this->escape_string($this->strip_all($category_id));
			$query = "select * from ".PREFIX."sub_category_master where category_id in (".$category_id.")";
			$sql = $this->query($query);
			return $sql;
		}

		function getUniqueSubCategoryById($id) {
			$id = $this->escape_string($this->strip_all($id));
			$query = "select * from ".PREFIX."sub_category_master where id='".$id."'";
			$sql = $this->query($query);
			return $this->fetch($sql);
		}

		function addSubCategory($data) {
			$category_id = $this->escape_string($this->strip_all($data['category_id']));
			$category_name 	= $this->escape_string($this->strip_all($data['category_name']));
			$display_order 	= $this->escape_string($this->strip_all($data['display_order']));
			$active = $this->escape_string($this->strip_all($data['active']));


			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$page_title = $this->escape_string($this->strip_all($data['page_title']));
			$page_description = $this->escape_string($this->strip_all($data['page_description']));
			$title1 = $this->escape_string($this->strip_all($data['title1']));
			$title2 = $this->escape_string($this->strip_all($data['title2']));
			$title3 = $this->escape_string($this->strip_all($data['title3']));
			$comparison = $data['comparison'];
			$comparison_2 = $data['comparison_2'];
			//$permalink	= $this->getValidatedPermalink($category_name);
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));
			$date = date("Y-m-d h:i:s");


			$SaveImage = new SaveImage();
			$imgDirr = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDirr, time().'-1');
			}else{
				$image_name = "";
			}
			
			$imgDir = '../images/category/';
			if(isset($file['image1']['name']) && !empty($file['image1']['name'])) {
				$cropData = $this->strip_all($data['cropData2']);
				$image1 = $SaveImage->uploadCroppedImageFileFromForm($file['image1'], 160, $cropData, $imgDir, time().'-2');
			}else{
				$image1 = "";
			}

			if(isset($file['image2']['name']) && !empty($file['image2']['name'])) {
				$cropData = $this->strip_all($data['cropData3']);
				$image2 = $SaveImage->uploadCroppedImageFileFromForm($file['image2'], 160, $cropData, $imgDir, time().'-3');
			}else{
				$image2 = "";
			}

			if(isset($file['image3']['name']) && !empty($file['image3']['name'])) {
				$cropData = $this->strip_all($data['cropData4']);
				$image3 = $SaveImage->uploadCroppedImageFileFromForm($file['image3'], 160, $cropData, $imgDir, time().'-4');
			}else{
				$image3 = "";
			}



			$query = "insert into ".PREFIX."sub_category_master(display_order, category_id, category_name, permalink , active , title , description , page_title , page_description , title1 , title2 , title3, image_name, image1, image2, image3, comparison,comparison_2) values ('".$display_order."', '".$category_id."', '".$category_name."', '".$permalink."', '".$active."', '".$title."', '".$description."', '".$page_title."', '".$page_description."', '".$title1."', '".$title2."', '".$title3."', '".$image_name."', '".$image1."', '".$image2."', '".$image3."', '".$comparison."', '".$comparison_2."')";
			return $this->query($query);
		}

		function updateSubCategory($data,$file){
			$id = $this->escape_string($this->strip_all($data['id']));
			$category_name = $this->escape_string($this->strip_all($data['category_name']));
			$display_order = $this->escape_string($this->strip_all($data['display_order']));
			$active = $this->escape_string($this->strip_all($data['active']));
			//$permalink	= $this->getValidatedPermalink($category_name);
			$permalink = trim($this->escape_string($this->strip_all($data['permalink'])));

			$title = $this->escape_string($this->strip_all($data['title']));
			$description = $this->escape_string($this->strip_all($data['description']));
			$page_title = $this->escape_string($this->strip_all($data['page_title']));
			$page_description = $this->escape_string($this->strip_all($data['page_description']));
			$title1 = $this->escape_string($this->strip_all($data['title1']));
			$title2 = $this->escape_string($this->strip_all($data['title2']));
			$title3 = $this->escape_string($this->strip_all($data['title3']));
			$comparison = $data['comparison'];
            $comparison_2 = $data['comparison_2'];
            $high_performance_data = $data['high_performance_data'];
			$related_resource = $data['related_resource'];
            $title1_description = $data['title1_description'];
			$title2_description = $data['title2_description'];
			$title3_description = $data['title3_description'];
            $self_aps = $data['self_aps'];
			$wifi_standard = $data['wifi_standard'];

			$SaveImage = new SaveImage();
			$imgDirr = '../images/slider-banner/';
			if(isset($file['image_name']['name']) && !empty($file['image_name']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$image_name = $SaveImage->uploadCroppedImageFileFromForm($file['image_name'], 1920, $cropData, $imgDirr, time().'-1');
				$this->query("update ".PREFIX."sub_category_master set image_name='".$image_name."' where id='".$id."' ");
			}
			
			$imgDir = '../images/category/';
			if(isset($file['image1']['name']) && !empty($file['image1']['name'])) {
				$cropData = $this->strip_all($data['cropData2']);
				$image1 = $SaveImage->uploadCroppedImageFileFromForm($file['image1'], 160, $cropData, $imgDir, time().'-2');
				$this->query("update ".PREFIX."sub_category_master set image1='".$image1."' where id='".$id."' ");
			}

			if(isset($file['main_image']['name']) && !empty($file['main_image']['name'])) {
				$cropData = $this->strip_all($data['cropData1']);
				$main_image = $SaveImage->uploadCroppedImageFileFromForm($file['main_image'], 1920, $cropData, $imgDir, time().'-2');
				$this->query("update ".PREFIX."sub_category_master set main_image='".$main_image."' where id='".$id."' ");
			}

			if(isset($file['image2']['name']) && !empty($file['image2']['name'])) {
				$cropData = $this->strip_all($data['cropData3']);
				$image2 = $SaveImage->uploadCroppedImageFileFromForm($file['image2'], 160, $cropData, $imgDir, time().'-3');
				$this->query("update ".PREFIX."sub_category_master set image2='".$image2."' where id='".$id."' ");
			}

			if(isset($file['image3']['name']) && !empty($file['image3']['name'])) {
				$cropData = $this->strip_all($data['cropData4']);
				$image3 = $SaveImage->uploadCroppedImageFileFromForm($file['image3'], 160, $cropData, $imgDir, time().'-4');
				$this->query("update ".PREFIX."sub_category_master set image3='".$image3."' where id='".$id."' ");
			}

			$query = "update ".PREFIX."sub_category_master set category_name='".$category_name."', permalink='".$permalink."', active='".$active."', title='".$title."', description='".$description."', page_title='".$page_title."', page_description='".$page_description."', title1='".$title1."', title2='".$title2."', title3='".$title3."', comparison='".$comparison."', display_order='".$display_order."', title1_description='".$title1_description."',title2_description='".$title2_description."',title3_description='".$title3_description."',high_performance_data='".$high_performance_data."',self_aps='".$self_aps."',wifi_standard='".$wifi_standard."',related_resource='".$related_resource."',comparison_2='".$comparison_2."' where id='".$id."' ";
			return $this->query($query);
		}

		function deleteSubcategory($id) {
			$id = $this->escape_string($this->strip_all($id));
			$this->query("DELETE FROM ".PREFIX."sub_category_master WHERE `id`='".$id."'");
			return true;
		}

		/* === SUB CATEGORY LEVEL 1 ENDS === */
		

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

	} 
?>