<!DOCTYPE html PUBLIC "-//w3c//OTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/OTD/xhtml1-strict.dtd">
<html>
<head>
<title></title>
<meta http-eqiv="Content-Type" content="text/html; charset=UTF-8">

<style type="text/css" media="screen">
label {display:block;}
</style>
</head>

<body>


<h2>create</h2>
<?php
 echo form_open('site3/create'); 
 ?>

<p>
<label for="title"> Student_Id:</label>
<input type="integer" name="stud_id" id="stu_id" 
 />
 </p>

<p>
<label for="content">Student_Name:</label>
<input type="text" name="stud_name" id="stu_name"
 />
 </p>
 <p>
 <input type="submit" value="Submit" />
 </p>

 <?php 
echo form_close(); 
?> 
</body>
</html>
