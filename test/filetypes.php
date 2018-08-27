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
<title>HTML5 PHP Multiple Attachment Email - File Type</title>
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
    <li class="active"><a href="filetypes.php">File Types</a></li>
    <li><a href="memory-filesize.php">PHP Memory/File Size</a></li>
    <li><a href="documentation/index.html">Docs</a></li>
    <li><a href="http://codecanyon.net/item/14740/4298991/faqs">FAQs</a></li>
    <li><a href="http://codecanyon.net/user/techmynd">Support</a></li>
    </ul>
<hr />

<div class="clearfix"></div>

<?php
// get all variables
function getVar(&$value, $default = null) { return isset($value) ? $value : $default; }
// usage example for above function
// $act = getVar($_REQUEST["act"]);

$act = getVar($_REQUEST["act"]);
$postit = getVar($_REQUEST["postit"]);
$name = getVar($_FILES['postit']['name']);
$type = getVar($_FILES['postit']['type']);
$ext = @pathinfo($_FILES['postit']['name'], PATHINFO_EXTENSION);

if($act!='' && $act=='posted') { 
?>
<div class="alert alert-info">Your file type is <strong><?php echo "$type"; ?></strong> and extension is <strong><?php echo "$ext"; ?></strong></div>
<?php } ?>



<h3>Current Method</h3>

<p>This is the current method that we are using to add/edit/remove file support for the file attachments.</p>


<pre>
$allowedFiles =  array('gif','png' ,'jpg' ,'jpeg' ,'rar' ,'zip' ,'pdf' ,'doc' ,'docx' ,'xls' ,'xlsx' ,'rtf', 'txt');
</pre>

<p>Separated by single comma, above are the file extensions supported to be attached. These files can be attached. You can remove any if you do not want or you can add more extensions for files you want to have support to be attached in email.</p>

<p>You can still use the old method that is described below. In the script, we have commented the old code.</p>

<h3>Common File Types</h3>

<span class="label label-info">PNG</span> image/png<br />
<span class="label label-info">GIF</span> image/gif<br />
<span class="label label-info">JPG</span> image/jpeg<br />
<span class="label label-info">RAR</span> application/x-rar-compressed<br />
<span class="label label-info">ZIP</span> application/zip<br />
<span class="label label-info">PDF</span> application/pdf<br />
<span class="label label-info">XML</span> text/xml<br />
<span class="label label-info">TXT</span> text/plain<br />
<span class="label label-info">HTML</span> text/html<br />
<span class="label label-info">MP3</span> audio/x-mp3<br />


<br />

<h4>Get File Type for any File</h4>

<p>You can add or remove file attachment support for specific file types in this script, but for that - you should know what type of any perticular file is. For example extension of PNG image is PNG but the file type for PNG image will be recognized as <strong>image/png</strong> by the script. If you want to add a new filetype to the system but you do not know how it will be recognized by the script, then use form below.</p>


<form name="frmTest" enctype="multipart/form-data" method="post" action="filetypes.php" />
<div class="input">
<input type="file" class="span2 required" name="postit" style="height:25px; width:80%;" required title="please select a file" />
<div class="clearfix"></div>
<br />
<button class="btn" type="submit">Get File Type</button>
</div>
<input type="hidden" name="act" value="posted" />
</form>

<br />

<h4>Add Remove Filetype Support (Old Method)</h4>

<p>For example</p>

<pre>
|| strstr($_FILES['ssFile']['type'][$i], 'image/gif')!==false
|| strstr($_FILES['ssFile']['type'][$i], 'image/jpeg')!==false
</pre>

<p>Above code will allow GIF and JPG files to be attached.</p>

<p>Search for these lines of code in the script and remove or comment any of these lines to remove support for that file type.</p>

<p>Let's say you want to add support for <strong>XML</strong> file to be attached. You will have to add the following line in above code.</p>

<pre>
|| strstr($_FILES['ssFile']['type'][$i], 'text/xml')!==false
</pre>

<p>So the above code becomes:</p>

<pre>
|| strstr($_FILES['ssFile']['type'][$i], 'image/gif')!==false
|| strstr($_FILES['ssFile']['type'][$i], 'image/jpeg')!==false
|| strstr($_FILES['ssFile']['type'][$i], 'text/xml')!==false
</pre>



<hr>
&copy 2014 TechMynd
<br /><br />


</div>
</body>
</html>