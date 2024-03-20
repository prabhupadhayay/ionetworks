<?php
	/*
	 * v1 - basic email class
	 * v1.1 - removed support for ADMIN email
	 *
	 */
	require("smtp/class.phpmailer.php");
	
	class Email{
		private $to;
		// private $admin = ADMIN_EMAIL; // DEPRECATED
		private $admin = '';
		//private $from = "noreply@shareittofriends.com";
		private $from = "iosales@hfcl.com";
		private $subject;
		private $path;
		function setAddress($to){
			$this->to = $to;
		}
		function setAdminAddress($to){
			$this->admin = $to;
		}
		function setFromAddress($from){
			$this->from = $from;
		}
		function setSubject($subject){
			$this->subject = $subject;
		}
		function setEmailBody($msg){
			$this->msg = $msg;
		}
		function attachment($path /*,$filename,$encodedData,$type*/ ){
			$this->path = $path;
			/* $this->filename = $filename;
			$this->encodedData = $encodedData;
			$this->type = $type; */
		}
		function sendEmail(){
			// if(PROJECTSTATUS!="LIVE"){ // DO NOT WASTE EMAIL
			if(PROJECTSTATUS=="DEV"){ // DO NOT WASTE EMAIL
				// return true;
			}

			$headers = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$this->from."\r\n";
			if(isset($this->admin) && !empty($this->admin)){
				$headers .= 'Bcc: '.$this->admin."\r\n";
				// $headers .= 'CC: '.$this->admin."\r\n";
			}

			if(!isset($this->to) || empty($this->to)){
				return false;
			}
			if(!isset($this->subject) || empty($this->subject)){
				return false;
			}
			if(!isset($this->msg) || empty($this->msg)){
				return false;
			}

			$mail = new PHPMailer();
			$mail->IsSMTP();

			// $mail->SMTPDebug = 2;

			//$mail->SMTPAuth = true;
			//$mail->Host = "shareittofriends.com";
			//$mail->Host = "io.hfcl.com";
			$mail->Host = "172.17.10.90";
			$mail->Port = 25;
			//$mail->SMTPSecure = "ssl";
			$mail->SMTPSecure = "tls";

			$mail->Username = "noreply@shareittofriends.com";
			$mail->Password = "noreply@1234";

			// $mail->Username = "noreply@cg3dankfun.com";
			// $mail->Password = "8upST6DLMulV";

			$mail->From = $this->from;
			$mail->FromName = "IONETWORKS";
			$mail->AddAddress($this->to);
			//$mail->AddReplyTo("mail@mail.com");
			$mail->AddCustomHeader("X-MSMail-Priority: High"); // Not sure if Priority will also set the Importance header: $yourMessage->AddCustomHeader("Importance: High");

			if(isset($this->admin) && !empty($this->admin)){
				$mail->AddBCC($this->admin);
			}
			if(!empty($this->path)){
				$mail->addAttachment($this->path);
			}
			$mail->IsHTML(true);

			$mail->Subject = $this->subject;
			$mail->Body = $this->msg;
			//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

			 //if( mail($this->to, $this->subject, $this->msg, $headers) ){
			if($mail->Send()){
				return true;

			} else {
				return false;
			}
		}
	}
?>