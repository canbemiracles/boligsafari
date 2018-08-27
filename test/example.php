<?php
	/*********************************************************************************************\
	***********************************************************************************************
	**                                                                                           **
	**  HTML5 CSS3 PHP Email with Attachments                                                    **
	**  Version 1.1                                                                              **
	**                                                                                           **
	**  http://techmynd.org/demos/html5-multiple-attachment-email/                               **
	**                                                                                           **
	**  Copyright 2013 (C) TechMynd                                                              **
	**  http://www.techmynd.org                                                                  **
	**                                                                                           **
	**  ***************************************************************************************  **
	**                                                                                           **
	**  Developer Information:                                                                   **
	**                                                                                           **
	**      Name  :  Muhammad Javed Khalil                                                       **
	**      Email :  admin@techmynd.com                                                          **
	**      Phone :  +92 300 426 9752                                                            **
	**      URL   :  http://www.techmynd.com                                                     **
	**      URL   :  http://www.techmynd.org                                                     **
	**      URL   :  http://www.javedkhalil.com                                                  **
	**                                                                                           **
	***********************************************************************************************
	\*********************************************************************************************/

// Settings
@ini_set('max_execution_time', "30"); // 30 seconds
// print ini_get('max_execution_time');
@ini_set('memory_limit', "64M"); // 8MB - Set any from 8M, 16M, 24M, 32M, 40M, 48M, 56M, 64M, 128M
// print ini_get('memory_limit');

// these two below are best to adjust via .htaccess - see documentation

@ini_set('post_max_size', "10M"); // 10MB
@ini_set('upload_max_filesize', "10M"); // 10MB

// Max File Size Allowed - Soft Restriction - Not always fool proof but its better to use
$Max_File_Size="10485760"; // In bytes - 10485760=10MB, 4194304=4MB, 2097152=2MB, 1048576=1MB
// convert bytes in mb
// $mbSize = "$Max_File_Size" / 1048576;
$mbSize = number_format($Max_File_Size / 1048576, 2); // MB
$kbSize = "$Max_File_Size" / 1024; // KB
// size to show - if less than 1 mb show in KBs
if($mbSize < 1 ) { $finalSize = $kbSize . ' KB'; } else { $finalSize = $mbSize . ' MB'; }

$showMaxSizeAllowed = "yes";
// set above to no to hide maxfilesize allowed info

// print ini_get('post_max_size');

// allow multiple upload or single upload
// set this no to allow single upload - use lowercase
// $multipleUpload="no";
$multipleUpload="yes";

// make form remember fields
$rememberFields="yes";
// set above to no to forget form fields data on next page load

// make upload files mendatory
$uploadFileMandatory="yes";
// set above to no to allow form submit without uploading files 


// deny access for ip addresses / spammers
// Edit ip addresses, redirect location or mesage and add more ips to ban below

// print $_SERVER['REMOTE_ADDR'];
$denyIP = array('ip address 1', 'ip address 2', 'ip address 3');
if (in_array ($_SERVER['REMOTE_ADDR'], $denyIP)) {

   // You can display a message for banned IP
   echo "<div class='alert alert-error'><strong>Sorry! Your IP address is banned</strong>!</div>";
   exit();
   
   // You can also redirect the page - uncomment two lines below
   
   // header("location: http://www.websitename.com/banned.html");
   // exit();
}
?>



<?php
// get all variables
function getVar(&$value, $default = null) { return isset($value) ? $value : $default; }
// usage example for above function
// $act = getVar($_REQUEST["act"]);

$ssAct = getVar($_REQUEST["ssAct"]);
$ssIPAddress = getVar($_REQUEST["ssIPAddress"]);
$ssSumMath = getVar($_REQUEST["ssSumMath"]);
$ssMathTest = getVar($_REQUEST["ssMathTest"]);
$ssName = getVar($_REQUEST["ssName"]);
$ssEmail = getVar($_REQUEST["ssEmail"]);
$ssPhone = getVar($_REQUEST["ssPhone"]);
$ssWebsite = getVar($_REQUEST["ssWebsite"]);
$ssCountry = getVar($_REQUEST["ssCountry"]);
$ssCity = getVar($_REQUEST["ssCity"]);
$ssZip = getVar($_REQUEST["ssZip"]);
$ssPurpose = getVar($_REQUEST["ssPurpose"]);
$ssMessage = getVar($_REQUEST["ssMessage"]);
$ssFile = getVar($_REQUEST["ssFile"]);
$ssCopyEmail = getVar($_REQUEST["ssCopyEmail"]);
$optionsRadios = getVar($_REQUEST["optionsRadios"]);
$sentMessage = getVar($_REQUEST["sentMessage"]);
$sentError = getVar($_REQUEST["sentError"]);
$testSeries1 = getVar($_REQUEST["testSeries1"]);
$fileAllow = getVar($_REQUEST["fileAllow"]);
$whichFile = getVar($_REQUEST["whichFile"]);
$fileSizeLimit = getVar($_REQUEST["fileSizeLimit"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>HTML5 PHP Multiple Attachment Email - Online Demo</title>
<meta name="description" content="">
<meta name="keywords" content="">
    
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
  	<meta http-equiv="cleartype" content="on">
	<meta name="HandheldFriendly" content="true">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<link href="css/custom.css" rel="stylesheet" type="text/css" />
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="js/start.validation.js"></script>
<script language="javascript" type="text/javascript" src="js/custom.js"></script>

</head>
<body>
<div class="container">
<br />
  <h2 class="pull-left">Multiple Attachment Email (HTML5, PHP)</h2>
<div class="clearfix"></div>
<hr />
    <ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li class="active"><a href="example.php">Example</a></li>
    <li><a href="example2.php">Example 2</a></li>
    <li><a href="filetypes.php">File Types</a></li>
    <li><a href="memory-filesize.php">PHP Memory/File Size</a></li>
    <li><a href="documentation/index.html">Docs</a></li>
    <li><a href="http://codecanyon.net/item/14740/4298991/faqs">FAQs</a></li>
    <li><a href="http://codecanyon.net/user/techmynd">Support</a></li>
    </ul>
<hr />



<?php
// file size limit check
// it will only work when your script file limits are less than that of defined in your server's php.ini or localhost php.ini
// I told you it was not fool proof but its good to use it
if($ssAct!='')
{
// file size check
for($i=0;$i<count($_FILES['ssFile']['size']);$i++)
{
		if($_FILES['ssFile']['size'][$i] > $Max_File_Size) { 
			// File too big
			$fileSizeLimit="Exceeded";
			$whichFile=$_FILES['ssFile']['name'][$i];
			echo "<div class='alert alert-error'><strong>File $whichFile exceeded allowed file size $finalSize</strong>! Please try again!</div>";
			break;
		}
		
		if($_FILES['ssFile']['size'][$i] > $Max_File_Size) { break; }
}

}
// if you dont want to use file size check then remove code above and uncomment line below - or - remove && $fileSizeLimit!='Exceeded' code from below
// if limit exceeds above code won't let the script pass the email or attachment
// $fileSizeLimit="notExceeded";
?>



<?php
// file types check
if($ssAct!='' && $fileSizeLimit!='Exceeded')
{
// view array - for testinfo
// print_r( $_FILES );

		for($i=0;$i<count($_FILES['ssFile']['size']);$i++)
		{
			
			/*
			// this was to compare filetypes but we are not using it now, because of its complications in complexity of filetype names
			// add this one line below if rar is not being accepted in system
			// || strstr($_FILES['ssFile']['type'][$i], 'application/rar')!==false
			// allow psd - add below if you want to allow psd files
			// || strstr($_FILES['ssFile']['type'][$i], 'application/photoshop')!==false			
		
			if(strstr($_FILES['ssFile']['type'][$i], 'image/png')!==false
				|| strstr($_FILES['ssFile']['type'][$i], 'image/gif')!==false
				|| strstr($_FILES['ssFile']['type'][$i], 'image/jpeg')!==false
				|| strstr($_FILES['ssFile']['type'][$i], 'image/pjpeg')!==false
				|| strstr($_FILES['ssFile']['type'][$i], 'application/x-rar-compressed')!==false
				|| strstr($_FILES['ssFile']['type'][$i], 'application/zip')!==false
				|| strstr($_FILES['ssFile']['type'][$i], 'application/pdf')!==false
			  )
					{
					$fileAllow="true";
					$whichFile="all";
					}
				else
					{
					$whichFile=$_FILES['ssFile']['type'][$i];
					$fileAllow="false";
					// if any disallowed file is trapped - block attachment and sending email - and show alert
					break;
					}			
				*/


				// compare file extensions and allow specific files with allowed extensions to pass
				// comparing extension is more simple
				// add/edit only file extension below - these files are allowed
				$allowedFiles =  array('gif','png' ,'jpg' ,'jpeg' ,'rar' ,'zip' ,'pdf' ,'doc' ,'docx' ,'xls' ,'xlsx' ,'rtf', 'txt');
				$filename = $_FILES['ssFile']['name'][$i];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				// if file extension matches with allowed file extensions, pass it, otherwise trap it
				if(in_array($ext,$allowedFiles) ) 
					{
					$fileAllow="true";
					$whichFile="all";
					}
				else
					{
					$whichFile = $ext;
					$fileAllow="false";
					// if any disallowed file is trapped - block attachment and sending email, break loop and further check - show alert
					break;
					}			
			
		}
}
?>

<?php
if($ssAct!='' && $ssSumMath!=$ssMathTest && $ssAct=='send' && $fileSizeLimit!='Exceeded') {
// Math test code wrong
$testSeries1="false";
}
//////////////////////
if($ssAct!='' && $testSeries1=='false') {
echo "<div class='alert alert-error'><strong>Simple math test verification failed</strong>! Please try again!</div>";
}
//////////////////////
if($ssAct!='' && $fileAllow=='false' && $whichFile!='') {
// disallowed file type was attached	
echo "<div class='alert alert-error'>File Type <strong> $whichFile </strong> is not allowed! Only JPG, GIF, PNG, PDF, RAR, ZIP and document files are allowed. Please try again!</div>";
}
//////////////////////
if($ssAct!='' && $whichFile=='' && $ssAct=='send') 
{
// no files attached	
echo "<div class='alert alert-info'>This is just an info! You did not attach any file!</div>";
}
?>
<?php
// send email
if($ssAct!='' && $ssAct=='send' && $testSeries1!='false' && $fileAllow!='false' && $fileSizeLimit!='Exceeded' || $ssAct!='' && $ssAct=='send' && $testSeries1!='false' && $fileAllow=='false' && $whichFile=='' && $fileSizeLimit!='Exceeded')
{
       // attach files and send html email ////////////////////////////////////////////////////////////////

       // where email should go
	   $to="admin@techmynd.com";

		// Cc and Bcc emails to send email to
		// uncomment from below and add email addresses if you need it
	   // $ssCcEmail = "";
	   // $ssBccEmail = "";

		// email subject
		$subject="HTML5 Multiple Attachment Email from ".$ssName;
	   // sender email
       $from = $ssEmail;
	   $sentDate = date("D, d M Y");

       $body = "<div style='background-color:#F4F4F4;padding:10px 0;font-family:Helvetica,Arial,sans-serif;' align='center'>
<div style='width:600px;border:1px solid #DBDBDB;border-radius:6px;background-color:#fff; overflow:hidden;'>
  <div style='background-color:#106AA8;height:100px;border-radius:6px 6px 0 0;box-shadow:0px 0px 10px 0px #ccc;border-bottom:1px solid #1067A0;'>
    <div style='float:left;' align='left'>
      <div style='color:#fff;font-size:30px;font-weight:bold;padding:24px 0 0 20px;text-shadow:2px 1px 1px #0B456C;'>Howdy<em>!</em></div>
      <div style='color:#D7ECFB;padding:0 0 0 20px; font-size:14px;text-shadow:1px 1px 1px #0B456C;'>You have got an email...<em>!</em></div>
      <div style='clear:both;'></div>
    </div>
    <div style='clear:both;'></div>
  </div>
  <div align='left' style='padding:10px 30px; text-align:justify; color:#666; font-size:13px;line-height:22px;'>
    <div style='border-bottom:1px solid #eee;margin:10px 0;'>
      <p>You have received a message from <br /><strong>$ssName [ $ssEmail ]</strong></p>
    </div>
    <p><strong>Message Details:</strong></p>
    <p>$ssMessage</p>
    <p> <em>Phone:</em> $ssPhone<br />
      <em>Website:</em> $ssWebsite<br />
      <em>Country:</em> $ssCountry<br />
      <em>City:</em> $ssCity<br />
      <em>Zip:</em> $ssZip<br />
      <em>Contact Purpose:</em> $ssPurpose<br /> 
	  <em>Radio Options:</em> $optionsRadios<br /> 
	  <em>Date:</em> $sentDate </p>
	  
    <p> <em>Sender's IP Address:</em> $ssIPAddress / <em>Location</em> <a href='http://ipinfodb.com/ip_locator.php?ip=$ssIPAddress'>here</a>, <a href='http://www.ip-tracker.org/ip-to-location.php?ip=$ssIPAddress'>here</a> and <a href='http://whatismyipaddress.com/ip/$ssIPAddress'>here</a> </p>
  </div>
</div>";

	      // generate a random string to use as boundary marker
	      $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
	      // email headers

		  $headers = "From: $from\r\n" .
		  "Reply-To: $ssEmail\r\n" .
		  // uncomment below to add Cc and Bcc reciepient support
		  // "Cc: $ssCcEmail\r\n" .
		  // "Bcc: $ssBccEmail\r\n" .
		  "Return-Path: $ssEmail\r\n" .
	      "MIME-Version: 1.0\r\n" .
	         "Content-Type: multipart/mixed;\r\n" .
	         " boundary=\"{$mime_boundary}\"";

	      // text message to display in email
	      $message=$body;
	      // MIME boundary for email message
	      $message = "This is a multi-part message in MIME format.\n\n" .
	         "--{$mime_boundary}\n" .
	         "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
	         "Content-Transfer-Encoding: 7bit\n\n" .
	      $message . "\n\n";

    // get uploaded files from form in loop
    function reArrayFiles($ssFile)
	{
		$file_ary = array();
		$file_count = count($ssFile['name']);
		$file_keys = array_keys($ssFile);
			for ($i=0; $i<$file_count; $i++)
			{
				foreach ($file_keys as $key)
				  {
					$file_ary[$i][$key] = $ssFile[$key][$i];
				  }
			}
       return $file_ary;
     }
           $file_ary = reArrayFiles($_FILES['ssFile']);
	      // process files
	      foreach($file_ary as $file)
	      {
	         // store file information in variables
	         $tmp_name = $file['tmp_name'];
	         $type = $file['type'];
	         $name = $file['name'];
	         $size = $file['size'];
	         // echo $tmp_name."\n\n";
	         // if file exists
	         if (file_exists($tmp_name))
	         {
	            // check to make sure it is uploaded file - not a system file
	            if(is_uploaded_file($tmp_name))
	            {
	               // open file for a binary read
	               $file = fopen($tmp_name,'rb');
	               // read file content into a variable
	               $data = fread($file,filesize($tmp_name));
	               // close file
	               fclose($file);
	               // encode it and split it into acceptable length lines
	               $data = chunk_split(base64_encode($data));
	            }

	            // insert a boundary to start the attachment
	            // specify the content type, file name, and disposition
				// boundary between each file
	            $message .= "--{$mime_boundary}\n" .
	               "Content-Type: {$type};\n" .
	               " name=\"{$name}\"\n" .
	               "Content-Disposition: attachment;\n" .
	               " filename=\"{$name}\"\n" .
	               "Content-Transfer-Encoding: base64\n\n" .
	            $data . "\n\n";
	         }
	      }
	      // closing mime boundary - end of message
	      $message.="--{$mime_boundary}--\n";
	      // send email
	      if (@mail($to, $subject, $message, $headers))
	      {
			  if($ssCopyEmail=='yes') { @mail($ssEmail, $subject, $message, $headers); }
          	   $sentMessage="Your email has been sent successfully.";
		  
		  	// clear form
		  	$rememberFields="no";
		  
		  // Thankyou email starts
				$subject2 = "Email sent notification";
				// To send HTML e-mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// change below to your email address
				$headers .="From: ".$mee." <admin@techmynd.com>";
				$message2 = "Thank you <b>$ssName</b>. Your message has been received successfully.<br>Regards<br />";
				@mail($ssEmail, $subject2, $message2, $headers);		  
		  // Thankyou email ends
		  }
		else
			{
			$sentError="Email was not sent due to some error";
            }

}
?>


  <?php if($ssAct!='' && $sentMessage!='') { ?>
  <div class="alert alert-success"><?php echo "$sentMessage"; ?></div>
  <?php } ?>
  <?php if($ssAct!='' && $sentError!='') { ?>
  <div class="alert alert-error"><?php echo "$sentError"; ?></div>
  <?php } ?>
 
<form class="form-horizontal" enctype="multipart/form-data" method="post" action="example.php" id="commentForm">
    <input type="hidden" name="ssAct" value="send">
    <input type="hidden" name="ssIPAddress" value="<?php print $_SERVER['REMOTE_ADDR']; ?>">
    <legend class="muted">Personal Details</legend>
    <div class="control-group">
      <label class="control-label text-info">* Name</label>
      <div class="controls">
        <input type="text" name="ssName" value="<?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "$ssName"; } ?>" maxlength="30" class="required" title="Your name?">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">* Email</label>
      <div class="controls">
        <input type="email" name="ssEmail" value="<?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "$ssEmail"; } ?>" class="required email" title="Your valid email address?">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">* Phone</label>
      <div class="controls">
        <input type="text" title="Your phone number? (only digits 0-9)" name="ssPhone" value="<?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "$ssPhone"; } ?>" class="required digits">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">* Website</label>
      <div class="controls">
        <input type="url" name="ssWebsite" value="<?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "$ssWebsite"; } ?>" placeholder="http://" title="Your website? (starting from http:// and no spaces)" class="required url">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">* Country</label>
      <div class="controls">
        <select name="ssCountry" class="required" title="Select your Country?">
          <?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "<option value='$ssCountry' selected='selected'>$ssCountry</option>"; } else { ?>
          <option value="" selected="selected">Please Select</option>
          <?php } ?>
          <option value="Afghanistan">Afghanistan</option>
          <option value="Albania">Albania</option>
          <option value="Algeria">Algeria</option>
          <option value="American Somoa">American Somoa</option>
          <option value="Andorra">Andorra</option>
          <option value="Angola">Angola</option>
          <option value="Anguilla">Anguilla</option>
          <option value="Antarctica">Antarctica</option>
          <option value="Antiqua">Antiqua</option>
          <option value="Argentina">Argentina</option>
          <option value="Armenia">Armenia</option>
          <option value="Aruba">Aruba</option>
          <option value="Ascension">Ascension</option>
          <option value="Australia">Australia</option>
          <option value="Austria">Austria</option>
          <option value="Azerbaijan">Azerbaijan</option>
          <option value="Bahamas">Bahamas</option>
          <option value="Bahrain">Bahrain</option>
          <option value="Bangladesh">Bangladesh</option>
          <option value="Barbados">Barbados</option>
          <option value="Belarus">Belarus</option>
          <option value="Belgium">Belgium</option>
          <option value="Belize">Belize</option>
          <option value="Benin">Benin</option>
          <option value="Bermoda">Bermoda</option>
          <option value="Bhutan">Bhutan</option>
          <option value="Bolivia">Bolivia</option>
          <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
          <option value="Botswana">Botswana</option>
          <option value="Brazil">Brazil</option>
          <option value="British Virgin Island">British Virgin Island</option>
          <option value="Brunei">Brunei</option>
          <option value="Bulgaria">Bulgaria</option>
          <option value="Burkina Faso">Burkina Faso</option>
          <option value="Burundi">Burundi</option>
          <option value="Combodia">Combodia</option>
          <option value="Cameroon">Cameroon</option>
          <option value="Canada">Canada</option>
          <option value="Cape Verde Islands">Cape Verde Islands</option>
          <option value="Cayman Island">Cayman Island</option>
          <option value="Central African Republic">Central African Republic</option>
          <option value="Chad">Chad</option>
          <option value="New Zealand">New Zealand</option>
          <option value="Chile">Chile</option>
          <option value="China">China</option>
          <option value="Christmas Island">Christmas Island</option>
          <option value="Cocos Islands">Cocos Islands</option>
          <option value="Colombia">Colombia</option>
          <option value="Comoros">Comoros</option>
          <option value="Congo">Congo</option>
          <option value="Cook Islands">Cook Islands</option>
          <option value="Costa Rica">Costa Rica</option>
          <option value="Croatia">Croatia</option>
          <option value="Cuba">Cuba</option>
          <option value="Cyprus">Cyprus</option>
          <option value="Czech Republic">Czech Republic</option>
          <option value="Denmark">Denmark</option>
          <option value="Diego Garcia">Diego Garcia</option>
          <option value="Djibouti">Djibouti</option>
          <option value="Dominica">Dominica</option>
          <option value="Dminican Republic">Dminican Republic</option>
          <option value="Easter Island">Easter Island</option>
          <option value="Ecuador">Ecuador</option>
          <option value="Egypt">Egypt</option>
          <option value="El Salvador">El Salvador</option>
          <option value="Equitorial Guinea">Equitorial Guinea</option>
          <option value="Eritrea">Eritrea</option>
          <option value="Estonia">Estonia</option>
          <option value="Ethiopia">Ethiopia</option>
          <option value="Falkland Islands">Falkland Islands</option>
          <option value="Faroe Islands">Faroe Islands</option>
          <option value="Fiji Islands">Fiji Islands</option>
          <option value="Finland">Finland</option>
          <option value="France">France</option>
          <option value="French Antilles">French Antilles</option>
          <option value="French Guiana">French Guiana</option>
          <option value="French Polynesia">French Polynesia</option>
          <option value="Gabon Republic">Gabon Republic</option>
          <option value="Gambia">Gambia</option>
          <option value="Georgia">Georgia</option>
          <option value="Germany">Germany</option>
          <option value="Ghana">Ghana</option>
          <option value="Gibraltar">Gibraltar</option>
          <option value="Greece">Greece</option>
          <option value="Greenland">Greenland</option>
          <option value="Grenada and Carriacuou">Grenada and Carriacuou</option>
          <option value="Grenadin Islands">Grenadin Islands</option>
          <option value="Guadeloupe">Guadeloupe</option>
          <option value="Guam">Guam</option>
          <option value="Guantanamo Bay">Guantanamo Bay</option>
          <option value="Guatemala">Guatemala</option>
          <option value="Guiana">Guiana</option>
          <option value="Guinea, Bissau">Guinea, Bissau</option>
          <option value="Guinea, Rep">Guinea, Rep</option>
          <option value="Guyana">Guyana</option>
          <option value="Haiti">Haiti</option>
          <option value="Honduras">Honduras</option>
          <option value="Hong Kong">Hong Kong</option>
          <option value="Hungary">Hungary</option>
          <option value="Iceland">Iceland</option>
          <option value="India">India</option>
          <option value="Indonesia">Indonesia</option>
          <option value="Inmarsat">Inmarsat</option>
          <option value="Iran">Iran</option>
          <option value="Iraq">Iraq</option>
          <option value="Ireland">Ireland</option>
          <option value="Israel">Israel</option>
          <option value="Italy">Italy</option>
          <option value="Ivory Coast">Ivory Coast</option>
          <option value="Jamaica">Jamaica</option>
          <option value="Japan">Japan</option>
          <option value="Jordan">Jordan</option>
          <option value="Kazakhstan">Kazakhstan</option>
          <option value="Kenya">Kenya</option>
          <option value="Kiribati">Kiribati</option>
          <option value="Korea, North">Korea, North</option>
          <option value="Korea, South">Korea, South</option>
          <option value="Kuwait">Kuwait</option>
          <option value="Kyrgyzstan">Kyrgyzstan</option>
          <option value="Laos">Laos</option>
          <option value="Latvia">Latvia</option>
          <option value="Lebanon">Lebanon</option>
          <option value="Lesotho">Lesotho</option>
          <option value="Liberia">Liberia</option>
          <option value="Libya">Libya</option>
          <option value="Liechtenstein">Liechtenstein</option>
          <option value="Lithuania">Lithuania</option>
          <option value="Luxembourg">Luxembourg</option>
          <option value="Macau">Macau</option>
          <option value="Macedonia, FYROM">Macedonia, FYROM</option>
          <option value="Madagascar">Madagascar</option>
          <option value="Malawi">Malawi</option>
          <option value="Malaysia">Malaysia</option>
          <option value="Maldives">Maldives</option>
          <option value="Mali Republic">Mali Republic</option>
          <option value="Malta">Malta</option>
          <option value="Mariana Islands">Mariana Islands</option>
          <option value="Marshall Islands">Marshall Islands</option>
          <option value="Martinique">Martinique</option>
          <option value="Mauritania">Mauritania</option>
          <option value="Mauritius">Mauritius</option>
          <option value="Mayotte Island">Mayotte Island</option>
          <option value="Mexico">Mexico</option>
          <option value="Micronesia, Fed States">Micronesia, Fed States</option>
          <option value="Midway Islands">Midway Islands</option>
          <option value="Miquelon">Miquelon</option>
          <option value="Moldova">Moldova</option>
          <option value="Monaco">Monaco</option>
          <option value="Mongolia">Mongolia</option>
          <option value="Montserrat">Montserrat</option>
          <option value="Morocco">Morocco</option>
          <option value="Mozambique">Mozambique</option>
          <option value="Myanmar">Myanmar</option>
          <option value="Namibia">Namibia</option>
          <option value="Nauru">Nauru</option>
          <option value="Nepal">Nepal</option>
          <option value="Neth. Antilles">Neth. Antilles</option>
          <option value="Netherlands">Netherlands</option>
          <option value="Nevis">Nevis</option>
          <option value="New Caledonia">New Caledonia</option>
          <option value="New Zealand">New Zealand</option>
          <option value="Nicaragua">Nicaragua</option>
          <option value="Niger Republic">Niger Republic</option>
          <option value="Nigeria">Nigeria</option>
          <option value="Niue">Niue</option>
          <option value="Norfolk Island">Norfolk Island</option>
          <option value="Norway">Norway</option>
          <option value="Oman">Oman</option>
          <option value="Pakistan">Pakistan</option>
          <option value="Palau">Palau</option>
          <option value="Panama">Panama</option>
          <option value="Papua New Guinea">Papua New Guinea</option>
          <option value="Paraguay">Paraguay</option>
          <option value="Peru">Peru</option>
          <option value="Philippines">Philippines</option>
          <option value="Poland">Poland</option>
          <option value="Portugal">Portugal</option>
          <option value="Principe">Principe</option>
          <option value="Puerto Rico">Puerto Rico</option>
          <option value="Qatar">Qatar</option>
          <option value="Reunion Island">Reunion Island</option>
          <option value="Romania">Romania</option>
          <option value="Russia">Russia</option>
          <option value="Rwanda">Rwanda</option>
          <option value="Saipan">Saipan</option>
          <option value="San Marino">San Marino</option>
          <option value="Sao Tome">Sao Tome</option>
          <option value="Saudi Arabia">Saudi Arabia</option>
          <option value="Senegal Republic">Senegal Republic</option>
          <option value="Serbia, Republic of">Serbia, Republic of</option>
          <option value="Seychelles">Seychelles</option>
          <option value="Sierra Leone">Sierra Leone</option>
          <option value="Singapore">Singapore</option>
          <option value="Slovakia">Slovakia</option>
          <option value="Slovenia">Slovenia</option>
          <option value="Solomon Islands">Solomon Islands</option>
          <option value="Somalia Republic">Somalia Republic</option>
          <option value="South Africa">South Africa</option>
          <option value="Spain">Spain</option>
          <option value="Sri Lanka">Sri Lanka</option>
          <option value="St. Helena">St. Helena</option>
          <option value="St. Kitts">St. Kitts</option>
          <option value="St. Lucia">St. Lucia</option>
          <option value="St. Pierre et Miquelon">St. Pierre et Miquelon</option>
          <option value="St. Vincent">St. Vincent</option>
          <option value="Sudan">Sudan</option>
          <option value="Suriname">Suriname</option>
          <option value="Swaziland">Swaziland</option>
          <option value="Sweden">Sweden</option>
          <option value="Switzerland">Switzerland</option>
          <option value="Syria">Syria</option>
          <option value="Taiwan">Taiwan</option>
          <option value="Tajikistan">Tajikistan</option>
          <option value="Tanzania">Tanzania</option>
          <option value="Thailand">Thailand</option>
          <option value="Togo">Togo</option>
          <option value="Tokelau">Tokelau</option>
          <option value="Tonga">Tonga</option>
          <option value="Trinidad and Tobago">Trinidad and Tobago</option>
          <option value="Tunisia">Tunisia</option>
          <option value="Turkey">Turkey</option>
          <option value="Turkmenistan">Turkmenistan</option>
          <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
          <option value="Tuvalu">Tuvalu</option>
          <option value="Uganda">Uganda</option>
          <option value="Ukraine">Ukraine</option>
          <option value="United Arab Emirates">United Arab Emirates</option>
          <option value="United Kingdom">United Kingdom</option>
          <option value="United States">United States</option>
          <option value="Uruguay">Uruguay</option>
          <option value="US Virgin Islands">US Virgin Islands</option>
          <option value="Uzbekistan">Uzbekistan</option>
          <option value="Vanuatu">Vanuatu</option>
          <option value="Vatican city">Vatican city</option>
          <option value="Venezuela">Venezuela</option>
          <option value="Vietnam, Soc Republic of">Vietnam, Soc Republic of</option>
          <option value="Wake Island">Wake Island</option>
          <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
          <option value="Western Samoa">Western Samoa</option>
          <option value="Yemen">Yemen</option>
          <option value="Yugoslavia">Yugoslavia</option>
          <option value="Zaire">Zaire</option>
          <option value="Zambia">Zambia</option>
          <option value="Zanzibar">Zanzibar</option>
          <option value="Zimbabwe">Zimbabwe</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">* City/State</label>
      <div class="controls">
        <input type="text" name="ssCity" value="<?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "$ssCity"; } ?>" title="Your city or state?" spellcheck="true" class="required">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">* Zip</label>
      <div class="controls">
        <input type="text" title="Your zip code?" name="ssZip" value="<?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "$ssZip"; } ?>" class="required">
      </div>
    </div>
    <legend class="muted">Email Details</legend>
    <div class="control-group">
      <label class="control-label text-info">Contact Purpose</label>
      <div class="controls">
        <select name="ssPurpose">
          <?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "<option value='$ssPurpose'>$ssPurpose</option>"; } ?>
          <option value="General Feedback">General Feedback</option>
          <option value="Inquiry">Inquiry</option>
          <option value="Suggestion">Suggestion</option>
          <option value="Support and Help">Support &amp; Help</option>
          <option value="Report">Report</option>
          <option value="Partnership">Partnership Opportunities</option>
          <option value="Advertise">Advertise</option>
          <option value="Nothing Special">Other</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">* Message</label>
      <div class="controls">
        <textarea rows="5" style="width:400px;" name="ssMessage" spellcheck="true" class="required" title="Please type your message"><?php if($ssAct!='' && $rememberFields=='yes' && $ssAct=='send') { echo "$ssMessage"; } ?>
</textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Attach File
        <?php if($multipleUpload=='yes') { echo "(s)"; } ?>
      </label>
      <div class="controls" style="padding:10px; background-color:#eee; border-radius:4px;">
        <input type="file" id="files" name="ssFile[]" style="height: 30px;" <?php if($multipleUpload=='yes') { echo "multiple='multiple'"; } if($uploadFileMandatory=='yes') { print "required='required'"; print "class='required'"; } ?>>
        
        <div id="selectedFiles" style="padding:10px 0 0 10px;" class="small muted"></div>
        
		<?php if($multipleUpload=='yes') { echo "<br><div class='muted small' style='display:inline-block;'>Multiple Select: <span class='badge'>ON</span></div>"; } ?>
        
        <?php if($showMaxSizeAllowed=='yes') { echo "<br><div class='muted small' style='display:inline-block;'>Max File Size Allowed: <span class='badge'>$finalSize</span></div>"; } ?>
        
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo "$Max_File_Size"; ?>" />
      </div>
    </div>
    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <label class="checkbox">
          <input type="checkbox" value="yes" name="ssCopyEmail" checked>
          <span class="muted">Email yourself a copy?</span></label>
      </div>
    </div>
    
    
<div class="control-group">
      <label class="control-label text-info">Radio Button Check</label>
      <div class="controls">
		<div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option 1" checked="">
          Option one
        </label>
      </div>      
		<div class="radio">
        <label>
          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option 2">
          Option two
        </label>
      </div>      
      </div>
</div>    
    
    
    <legend class="muted">Human Verification</legend>
    <div class="control-group">
      <?php $sum1=rand(1, 9); ?>
      <?php $sum2=rand(1, 9); ?>
      <?php $totalSum=$sum1+$sum2; ?>
      <label class="control-label text-info" style="padding-top:29px;">* Answer</label>
      <div class="controls">
        <div style="padding-bottom:4px;">What is the sum of <span class="label label-important"><?php echo "$sum1"; ?></span> and <span class="label label-important"><?php echo "$sum2"; ?></span> ?</div>
        <input type="text" name="ssSumMath" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssSumMath"; } ?>" class="required digits">
        <input type="hidden" value="<?php echo "$totalSum"; ?>" name="ssMathTest">
      </div>
    </div>
    <hr />
    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <button type="submit" class="btn btn-success">Send Email</button>
      </div>
    </div>
  </form>
  <br />
  <br />
  <hr>
  &copy 2014 TechMynd <br />
  <br />
</div>
</body>
</html>