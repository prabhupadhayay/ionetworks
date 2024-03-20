<?php

	//DELUXORA DB CRED.
	/* incinson_deluxus	USER
	incinson_deluxora	DB
	auBTfWqxccQM		PASS */

	/*
	* CONFIG
	* - v1 - 
	* - v2 - updated BASE CONFIG, error_reporting based on PROJECTSTATUS
	* - v3 - added staging option
	* - v3.1 - BUGFIX in staging option
	*/

	/* DEVELOPMENT CONFIG */
	//DEFINE('PROJECTSTATUS','LIVE');
	DEFINE('PROJECTSTATUS','STAGING');
	//DEFINE('PROJECTSTATUS','DEV');
	/* DEVELOPMENT CONFIG */

	/* TIMEZONE CONFIG */
	$timezone = "Asia/Calcutta";
	if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
	/* TIMEZONE CONFIG */

	if(PROJECTSTATUS=="LIVE"){
		error_reporting(0);
		DEFINE('BASE_URL','https://io.hfcl.com');
		DEFINE('ADMIN_EMAIL','imishart@gmail.com');
	} else if(PROJECTSTATUS=="STAGING"){
		error_reporting(0);
		DEFINE('BASE_URL','https://betaio.hfcl.com');
		DEFINE('ADMIN_EMAIL','imishart@gmail.com');

	} else { 
		// DEFAULT TO DEV
		error_reporting(E_ALL);
		DEFINE('BASE_URL','http://localhost/ionetwork');
		DEFINE('ADMIN_EMAIL','imishart@gmail.com');

	}

	DEFINE('SMS_OTP_TEMPLATE_ID', '1707161787040087416');
	DEFINE('SMS_LOGIN_OTP_TEMPLATE_ID', '1707161787042279006');
	DEFINE('SMS_ORDER_TEMPLATE_ID', '1707161787149983390');
	DEFINE('SMS_ORDER_ADMIN_TEMPLATE_ID', '1707161787153043863');

	/* === AWS CRED === */
	DEFINE('AWS_S3_KEY', 'AKIAUBMIYFPGDPQ3DA6I');
	DEFINE('AWS_S3_SECRET', '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');
	DEFINE('AWS_S3_REGION', 'ap-south-1');
	/* === AWS CRED === */

	/* === S3 BUCKET DETAILS === */
	DEFINE('AWS_S3_BUCKET', 'FDC');
	DEFINE('AWS_S3_BUCKET_FOLDER', 'product');
	DEFINE('AWS_S3_BUCKET_PRODUCT_LINK', 'https://'.AWS_S3_BUCKET.'.s3.amazonaws.com/'.AWS_S3_BUCKET_FOLDER.'/');
	/* === S3 BUCKET DETAILS === */

	/* BASE CONFIG */
	DEFINE('SITE_NAME','IO by HFCL');
	DEFINE('ADMIN_TITLE','Administrator Panel | '.SITE_NAME);
	DEFINE('TITLE', SITE_NAME);
	DEFINE('PREFIX','io_');
	DEFINE('COPYRIGHT','2020');
	DEFINE('currentdate',date('Y-m-d H:i:s'));
	DEFINE('CURRENTDATETIME',date('Y-m-d H:i:s'));
	//DEFINE('LOGO', BASE_URL.'/images/logo.png');
	DEFINE('LOGO', BASE_URL.'/images/Logo_Final.svg');
	DEFINE('FAVICON', BASE_URL.'/images/favicon.png');
	DEFINE('CAPTCHA_PUBLIC_KEY','');
	DEFINE('CAPTCHA_PRIVATE_KEY','');


	DEFINE('ADMIN_PANEL', 'io-panel');
	/* BASE CONFIG */
?>