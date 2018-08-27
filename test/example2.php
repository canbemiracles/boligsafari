<?php


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

// print ini_get('post_max_size');

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
$ssPhone2 = getVar($_REQUEST["ssPhone2"]);
$ssZip = getVar($_REQUEST["ssZip"]);
$ssAddress = getVar($_REQUEST["ssAddress"]);
$ssNumber = getVar($_REQUEST["ssNumber"]);
$ssEtage = getVar($_REQUEST["ssEtage"]);
$ssHeadline = getVar($_REQUEST["ssHeadline"]);
$ssMessage = getVar($_REQUEST["ssMessage"]);
$ssFile = getVar($_REQUEST["ssFile"]);
$ssLedig = getVar($_REQUEST["ssLedig"]);
$ssAreal = getVar($_REQUEST["ssAreal"]);
$ssBoligtype = getVar($_REQUEST["ssBoligtype"]);
$ssRooms = getVar($_REQUEST["ssRooms"]);
$ssHusleje = getVar($_REQUEST["ssHusleje"]);
$ssDepositum = getVar($_REQUEST["ssDepositum"]);
$ssForudbetalt = getVar($_REQUEST["ssForudbetalt"]);
$ssACForbrug = getVar($_REQUEST["ssACForbrug"]);
$ssHusdyr = getVar($_REQUEST["ssHusdyr"]);

$ssCopyEmail = getVar($_REQUEST["ssCopyEmail"]);



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
</head>
<body>
<div class="container">
<br />
<div class="clearfix"></div>

<style>
body { 
    background-color: transparent;
}
</style>

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
// file type check
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
				// add/edit only file extension below - these kinds of files are allowed
				$allowedFiles =  array('gif','png' ,'jpg' ,'jpeg' ,'rar' ,'zip' ,'pdf' ,'doc' ,'docx' ,'xls' ,'xlsx' ,'rtf', 'txt');
				$filename = $_FILES['ssFile']['name'][$i];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				// if file extension matches with allowed file extensions, pass it, otherwise trap it
				if(in_array($ext,$allowedFiles))
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
if($ssSumMath!=$ssMathTest && $ssAct=='send') {
// Math test code wrong
$testSeries1="false";
}
//////////////////////
if($testSeries1=='false') {
echo "<div class='alert alert-error'><strong>Simple math test verification failed</strong>! Please try again!</div>";
}
//////////////////////
if($fileAllow=='false' && $whichFile!='') {
// disallowed file type was attached			
echo "<div class='alert alert-error'>Filtypen <strong> $whichFile </strong> kan ikke benyttes - kun JPG, GIF og PNG er tilladt. Prøv venligst igen!</div>";
}
//////////////////////
/*
if($ssAct!='' && $whichFile=='' && $ssAct=='send') {
// no files attached	
echo "<div class='alert alert-info'>This is just an info! You did not attach any file!</div>";
}
*/
?>
<?php
// send email
if($ssAct!='' && $ssAct=='send' && $testSeries1!='false' && $fileAllow!='false' && $fileSizeLimit!='Exceeded' || $ssAct!='' && $ssAct=='send' && $testSeries1!='false' && $fileAllow=='false' && $whichFile=='' && $fileSizeLimit!='Exceeded')
{
       // attach files and send html email ////////////////////////////////////////////////////////////////

       // where email should go
	   $to="as@rabmarketing.dk";
	   
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
<div style='width:600px;border:1px solid #DBDBDB;border-radius:6px;background-color:#fff;'>
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
<b>Kontaktoplysninger</b>
   <p><em>Navn og efternavn:</em> $ssName<br />
      <em>Email:</em> $ssEmail<br />
      <em>Telefon 1:</em> $ssPhone<br />
      <em>Telefon 2:</em> $ssPhone2<br /> </p>

<b>Lejemålets adresse</b>
   <p><em>Post nr.</em> $ssZip<br /> 
      <em>Adresse:</em> $ssAddress<br /> 
      <em>Hus nr.:</em> $ssNumber<br /> 
      <em>Etage:</em> $ssEtage<br /> </p>

<b>Annoncetekst</b>
     <p> <em>Overskrift:</em> $ssHeadline<br /> 
      <em>Beskrivelse:</em> $ssMessage<br /> 
      <em>Vedhæftede filer:</em> Se i bunden.<br />  </p>

<b>Detaljer om lejemålet</b>
   <p>   <em>Ledighedsdato:</em> $ssLedig<br /> 
      <em>Boligtype:</em> $ssBoligtype<br /> 
      <em>Areal (m2):</em> $ssAreal<br /> 
      <em>Værelser:</em> $ssRooms<br /> 
      <em>Husleje (eks. forbrug):</em> $ssHusleje<br /> 
      <em>Depositum:</em> $ssDepositum<br /> 
      <em>Forudbetalt leje:</em> $ssForudbetalt<br /> 
      <em>A/C Forbrug:</em> $ssACForbrug<br /> 
      <em>Husdyr:</em> $ssHusdyr<br /> </p>


	  <em>Date:</em> $sentDate</p>
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
  <?php if($sentMessage!='') { ?>
  <div class="alert alert-success"><?php echo "$sentMessage"; ?></div>
  <?php } ?>
  <?php if($sentError!='') { ?>
  <div class="alert alert-error"><?php echo "$sentError"; ?></div>
  <?php } ?>
  <form class="form-horizontal" enctype="multipart/form-data" method="post" action="example2.php" id="commentForm">
    <input type="hidden" name="ssAct" value="send">
    <input type="hidden" name="ssIPAddress" value="<?php print $_SERVER['REMOTE_ADDR']; ?>">
    <legend style="margin-top:-25px;" class="muted">Kontaktoplysninger</legend>
    <div class="control-group">
      <label class="control-label text-info">Navn og efternavn</label>
      <div class="controls">
        <input type="text" name="ssName" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssName"; } ?>" maxlength="30" class="required" title="Indtast venligst dit navn og efternavn">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Email</label>
      <div class="controls">
        <input type="email" name="ssEmail" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssEmail"; } ?>" class="required email" title="Indtast venligst din email">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Telefon 1</label>
      <div class="controls">
        <input type="text" title="Dit telefon nr. (tal mellem 0-9)" name="ssPhone" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssPhone"; } ?>" class="required digits">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Telefon 2</label>
      <div class="controls">
        <input type="text" title="" name="ssPhone2" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssPhone2"; } ?>" class="digits">
      </div>
    </div>
    <legend class="muted">Lejemålet adresse:</legend>
    <div class="control-group">
      <label class="control-label text-info">Post nr.</label>
      <div class="controls">
        <input type="text" name="ssZip" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssZip"; } ?>" title="Indtast venligst post nr." class="required">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Gadenavn</label>
      <div class="controls">
        <input type="text" title="Indtast venligst gadenavn" name="ssAddress" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssAddress"; } ?>" class="required">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Hus nr.</label>
      <div class="controls">
        <input type="text" title="Indtast venligst hus nr." name="ssNumber" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssNumber"; } ?>" class="required">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Etage, side, etc.</label>
      <div class="controls">
        <input type="text" name="ssEtage" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssEtage"; } ?>">
      </div>
    </div>

    <legend class="muted">Annoncetekst</legend>

    <div class="control-group">
      <label class="control-label text-info">Overskrift</label>
      <div class="controls">
        <input type="text" title="Indtast venligst en overskrift" name="ssHeadline" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssHeadline"; } ?>" class="required">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Beskrivelse</label>
      <div class="controls">
        <textarea rows="5" style="width:400px;" name="ssMessage" spellcheck="true" class="required" title="Indtast venligst en beskrivelse"><?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssMessage"; } ?>
</textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Upload billeder
        <?php if($multipleUpload=='yes') { echo ""; } ?>
      </label>
      <div class="controls">

        <input type="file" name="ssFile[]" style="height: 26px;" <?php if($uploadFileMandatory=='yes') { print "required='required'"; print "class='required'"; } ?>>
        <?php if($multipleUpload=='yes') { ?>
        <br /><input type="file" name="ssFile[]" style="height: 26px;">
        <br /><input type="file" name="ssFile[]" style="height: 26px;">
        <br /><input type="file" name="ssFile[]" style="height: 26px;">
        <br /><input type="file" name="ssFile[]" style="height: 26px;">
        <?php } ?>
        
        <?php if($showMaxSizeAllowed=='yes') { echo "<br><div class='muted small' style='display:inline-block;'>Max File Size Allowed: <span class='badge'>$finalSize</span></div>"; } ?>
        
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo "$Max_File_Size"; ?>" />
      </div>
    </div>


    <legend class="muted">Detaljer om lejemålet:</legend>

    <div class="control-group">
      <label class="control-label text-info">Ledighedsdato:</label>
      <div class="controls">
        <input type="text" title="Angiv hvornår lejemålet er ledigt (dato eks.)" name="ssLedig" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssLedig"; } ?>" class="required">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Boligtype</label>
      <div class="controls">
        <select name="ssBoligtype">
          <?php if($ssAct=='send' && $rememberFields=='yes') { echo "<option value='$ssBoligtype'>$ssBoligtype</option>"; } ?>
          <option value="Lejlighed">Lejlighed</option>
          <option value="Vaerelse">Værelse</option>
          <option value="Hus">Hus</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Areal (m2):</label>
      <div class="controls">
        <input type="text" title="Lejemålets areal" name="ssAreal" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssAreal"; } ?>" class="required digits">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Værelser:</label>
      <div class="controls">
        <input type="text" title="Antallet af værelser" name="ssRooms" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssRooms"; } ?>" class="required digits">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Husleje (eks. forbrug):</label>
      <div class="controls">
        <input type="text" title="Huslejen for lejemålet" name="ssHusleje" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssHusleje"; } ?>" class="required digits">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Depositum</label>
      <div class="controls">
        <select name="ssDepositum">
          <?php if($ssAct=='send' && $rememberFields=='yes') { echo "<option value='$ssDepositum'>$ssDepositum</option>"; } ?>
          <option value="1-mdr">1 mdr.</option>
          <option value="2-mdr">2 mdr.</option>
          <option value="3-mdr">3 mdr.</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Forudbetalt leje</label>
      <div class="controls">
        <select name="ssForudbetalt">
          <?php if($ssAct=='send' && $rememberFields=='yes') { echo "<option value='$ssForudbetalt'>$ssForudbetalt</option>"; } ?>
          <option value="1-mdr">1 mdr.</option>
          <option value="2-mdr">2 mdr.</option>
          <option value="3-mdr">3 mdr.</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">A/C forbrug</label>
      <div class="controls">
        <input type="text" title="Angiv venligst a conto forbrug" name="ssACForbrug" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssACForbrug"; } ?>" class="digits">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label text-info">Husdyr:</label>
      <div class="controls">
        <select name="ssHusdyr">
          <?php if($ssAct=='send' && $rememberFields=='yes') { echo "<option value='$ssHusdyr'>$ssHusdyr</option>"; } ?>
          <option value="Tilladt">Tilladt</option>
          <option value="Ikke-Tilladt">Ikke tilladt</option>
          <option value="Kontakt">Kontakt udlejer</option>
        </select>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <label class="checkbox">
          <input type="checkbox" value="yes" name="ssCopyEmail" checked>
          <span class="muted">Send en kopi til dig selv?</span></label>
      </div>
    </div>
    




    
    <legend class="muted">Verifikation</legend>
    <div class="control-group">
      <?php $sum1=rand(1, 9); ?>
      <?php $sum2=rand(1, 9); ?>
      <?php $totalSum=$sum1+$sum2; ?>
      <label class="control-label text-info" style="padding-top:29px;">* Svar</label>
      <div class="controls">
        <div style="padding-bottom:4px;">Hvad er summen af <span class="label label-important"><?php echo "$sum1"; ?></span> og <span class="label label-important"><?php echo "$sum2"; ?></span> ?</div>
        <input type="text" name="ssSumMath" value="<?php if($ssAct=='send' && $rememberFields=='yes') { echo "$ssSumMath"; } ?>" class="required digits">
        <input type="hidden" value="<?php echo "$totalSum"; ?>" name="ssMathTest">
      </div>
    </div>

    <hr />

    <div class="control-group">
      <label class="control-label"></label>
      <div class="controls">
        <button type="submit" class="btn btn-success">Indsend til oprettelse</button>
      </div>
    </div>
  </form>
  <br />
  <br />
   <br />
</div>
</body>
</html>