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
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>HTML5 PHP Multiple Attachment Email - PHP Script Introduction</title>
<meta name="description" content="html5 css3 php based fully customizable script that handles email attachments. Attach and send multiple files via email.">
<meta name="keywords" content="html5, css3, php, attachments, upload, multiple files, multiple uploads, email">

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

<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
<br />
  <h2 class="pull-left">Multiple Attachment Email (HTML5, PHP)</h2>

<div class="clearfix"></div>

<hr />
    <ul class="nav nav-pills">
    <li class="active"><a href="index.php">Home</a></li>
    <li><a href="example.php">Example</a></li>
    <li><a href="example2.php">Example 2</a></li>
    <li><a href="filetypes.php">File Types</a></li>
    <li><a href="memory-filesize.php">PHP Memory/File Size</a></li>
    <li><a href="documentation/index.html">Docs</a></li>
    <li><a href="http://codecanyon.net/item/14740/4298991/faqs">FAQs</a></li>
    <li><a href="http://codecanyon.net/user/techmynd">Support</a></li>
    </ul>
<hr />

<h4>Introduction</h4>

<p>'HTML5 PHP Multiple Attachment Email Script' is fully custiomizable PHP script that lets you <strong>send fully supported HTML email with multiple files attachments</strong>. Get this script, customize settings and upload it at your web server or integrate it in your current project to send or receive HTML based emails containing multiple file attachments. GIF, PNG, JPG, RAR, ZIP, PDF, TXT, DOC, DOCX, XLS, XLXS files support is built-in. You can add more file type support easily. Email recepient will receive HTML based email with attached files to download or view.</p>

<hr />

<div align="center">5 Stars Rating on Codecanyon
<br>
<img src="images/5-star-rating.png">
</div>

<hr />


<h4>Features</h4>

<div style="float:right;">
<a href="images/html-email-view-with-attachments-2.png" target="_blank"><img src="images/html-email-view-with-attachments.png"></a>
<br><br>
<a href="images/file-names-sizes.png" target="_blank"><img src="images/file-names-sizes-1.png"></a>
</div>

<ul>
<li>Single page HTML5 CSS3 Clean Form</li>
<li>Fully supported, well formatted HTML email with attachments</li>
<li>Set PHP custom MAX EXECUTION TIME for script</li>
<li>Set PHP custom MEMORY LIMIT for script</li>
<li>Set PHP MAX FILE SIZE limit for file attachments</li>
<li>Set Max Upload Size limit for script</li>
<li>Limit file size to be uploaded</li>
<li>Ban IP addresses to stop spam</li>
<li>Set allowed file types or restrict file types</li>
<li>Out of the box support to attach PNG, GIF, JPG, RAR, ZIP, PDF, TXT, COX, DOCX, XLS, XLSX files</li>
<li>Add more file type attachment support easily</li>
<li>Simple math human verification included</li>
<li>Email a copy to self, enabled</li>
<li>Cc and Bcc email copies support</li>
<li>Send email with or without files attachments</li>
<li>Attach single file or multiple files</li>
<li>Switch on/off single or multiple file attachment capabilities</li>
<li>Easy form fields validation</li>
<li>Customizable form fields</li>
<li>File names and filesizes display on files select (before upload)</li>
<li>Cross browser support</li>
<li>Well written documentation</li>
<li>Well commented clean code</li>
<li>Easy to configure Settings</li>
<li>Styled with Twitter BootStrap</li>
</ul>


<hr />

<h4>Whats New</h4>

<ul>
<li>Changed PHP_SELF to pagename in the form action</li>
<li>Fixed 'Undefined index' notices (warnings) by using request variable function</li>
<li>Added option for form to remember or forget input field values (optional)</li>
<li>Added option to make file upload mandatory (optional)</li>
<li>Added radio select options</li>
<li>Cc and Bcc recepients support in email (optional)</li>
<li>Added 'date' in email</li>
<li>Added file name previews and file size previews support in upload element (ability to check file names and file sizes before sending attachments in email)</li>
<li>Added 'max file size allowed' display in upoad file element (user can check max file size allowed limit) - (optional)</li>
<li>Removed file type comparison, added file extension comparison for allowed files</li>
<li>Added support to ban IP addresses to control spam</li>
<li>Added alert message and action for exceeding file size limit</li>
</ul>

<hr>

<div align="center"><img pagespeed_url_hash="1006886412" style="border:1px solid #eee;" src="http://techmynd.org/demos/html5-multiple-attachment-email/screens/html5-php-email-attachments-main.png"></div>

<hr>


<pre>
Multiple File Attachment Support:
Firefox 3.6+, Safari 5+, Chrome 6+, Opera 11+, IE 10+.
Browsers prior than these can attach one file at a time.
</pre>


<hr>
&copy 2014 TechMynd
<br /><br />


</div>
</body>
</html>