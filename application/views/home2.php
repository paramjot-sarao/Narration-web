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

<!-- this code is used to get all values from the databse....... 
<pre>
<?php print_r($record); ?>
</pre> -->




<!-- this code is used particularly to show a field of a database 
<?php foreach($record as $row) : ?>
	<h1><?php echo $row->stu_name;?></h1> 
<?php endforeach; ?> -->

<?php foreach($record as $row) : ?>
	<h1><?php echo $row->stu_id;?></h1> 
	<div><?php echo $row->stu_name;?> </div> 
	<div><?php echo $row->stu_phne;?> </div>
<?php endforeach; ?> 


</div>

</body>
</html>
