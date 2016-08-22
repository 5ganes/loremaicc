<?php header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
mb_internal_encoding("UTF-8");
mb_http_output('UTF-8');
require_once("../data/conn1.php");
require_once("../data/users.php");
require_once("../data/groups.php");
require_once("../data/sqlinjection.php");
$conn 					= new Dbconn();		
$users	 				= new Users();
$groups					= new Groups();

$qtype=$_GET['service'];
if($qtype=="diary")
{
	$sql="select id,name,categoryId,phone,fax,email,website,weight from diary where categoryId in(select id from categories where parentId='3')";
}
else if($qtype=="audio")
{
	$sql="select id,name,contents,weight from groups where parentId='1069' order by weight";
}
else if($qtype=="video")
{
	$sql="select id,name,shortcontents,contents from groups where parentId='1048' order by id";	
}
else if($qtype=="magazine")
{
	$sql="select id,name,year,month,contents,file,weight from magazine order by year,weight";
}
else if($qtype=="menubar")
{
	$sql="select id,name,weight from groups where type='Header' and parentId='0' and id!='995' and id!='1009' and id!='1022' and id!='796' order by 
	weight";
}
else if($qtype=="links")
{
	$sql="select id,name,parentId,contents,weight from groups where parentId='1022' order by weight";
}
else if($qtype=="home")
{
	$sql="select id,name,urlname,contents,weight from groups where id='176' or id='998' or id='796' order by id";
}
else if($qtype=="year")
{
	$sql="select distinct year from magazine where file!='' order by year";
}
else if($qtype=="diarycategory")
{
	$sql="select id,title from categories where parentId='3' order by id";
}
else if($qtype=="about-aicc")
{
	$sql="select contents from groups where urlname='about-aicc'";
}
else if($qtype=="gallery-list")
{
	$sql="select id,name,urlname,weight from groups where parentId='1138' order by weight";
}
else if($qtype=="gallery-images")
{
	$sql="select parentId,image,weight from groups where parentId in (select id from groups where parentId='1138')";
}

$sql=mysql_query($sql);
$rows = array(); 
while($r = mysql_fetch_array($sql, MYSQL_ASSOC)) {
	$rows[] = $r;
}

print json_encode($rows);
?>