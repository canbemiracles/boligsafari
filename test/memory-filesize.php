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
<title>HTML5 PHP Multiple Attachment Email - Memory and File Size</title>
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

<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery-min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="js/start.validation.js"></script>
</head>
<body>
<div class="container">
<br />
  <h2 class="pull-left">Multiple Attachment Email (HTML5, PHP)</h2>

<div class="clearfix"></div>

<hr />

    <ul class="nav nav-pills">
    <li><a href="index.php">Home</a></li>
    <li><a href="example.php">Example</a></li>
    <li><a href="example2.php">Example 2</a></li>
    <li><a href="filetypes.php">File Types</a></li>
    <li class="active"><a href="memory-filesize.php">PHP Memory/File Size</a></li>
    <li><a href="documentation/index.html">Docs</a></li>
    <li><a href="http://codecanyon.net/item/14740/4298991/faqs">FAQs</a></li>
    <li><a href="http://codecanyon.net/user/techmynd">Support</a></li>
    </ul>
<hr />

<div class="clearfix"></div>

<p>PHP has default limits set for few things in php.ini file. PHP.ini file is not always available in all web hosting environments so you can adjust those limits by defining in the PHP scripts or via .htacces file.</p>

<h3>PHP Memory Limit</h3>

<p>PHP has memory limit for any script. You can increase / decrease / adjust it according to your needs.</p>

<h4>Via PHP Script</h4>

<pre>
@ini_set('memory_limit', "64M");
</pre>

<p>OR</p>

<h4>Via .htaccess</h4>

<pre>
php_value memory_limit 64M
</pre>

<br />

<h3>File Size Limit for Upload and Post Data Through Form</h3>

PHP has got a limit for data size you can post through a form. And limit for data size that can be uploaded. Adjust it according to your needs by using code below.

<h4>Via PHP Script</h4>

<pre>
@ini_set('post_max_size', "10M");
@ini_set('upload_max_filesize', "10M");
</pre>

<p>OR</p>

<h4>Via .htaccess</h4>

<pre>
php_value upload_max_filesize 10M
php_value post_max_size 10M
</pre>

This will set allowed file size limit for 'upload' and 'post data' to 10 MB. These two are best to set via .htaccess.


<hr>
&copy 2014 TechMynd
<br /><br />


</div>
</body>
</html>