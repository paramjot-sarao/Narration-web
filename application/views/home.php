<!DOCTYPE html PUBLIC "-//w3c//OTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/OTD/xhtml1-strict.dtd">
<html>
<head>
<title></title>
<meta http-eqiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body>
<div id="container">

<p> My view has been loaded.</p>
<p> <?php echo $myValue;?> </p> 
<p> <?php echo $anothervalue;?> </p> 
<!-- yhis code is used to get all values from the databse....... -->
<pre>
<?php print_r($records); ?>
</pre> 
<!-- this code is used particularly to show a field of a database
<?php foreach($records as $row) : ?>
	<h1><?php echo $row->stu_name;?></h1> 
<?php endforeach; ?> -->
</div>

</body>
</html>
