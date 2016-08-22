<?php
class Users
{
 function validate($uname,$pswd)
 {
 	global $conn;
	
  //$sql = "SELECT * FROM users u, usergroups ug WHERE u.userGroupId = ug.id AND md5(u.username) = '". md5(cleanQuery($uname)). "' AND md5(u.password) = '". md5(cleanQuery($pswd)) ."' AND u.status = 'A'";
  $sql = "SELECT * FROM users u WHERE md5(u.username) = '". md5(cleanQuery($uname)). "' AND md5(u.password) = '". md5(cleanQuery($pswd)) ."' AND u.status = 'A'";
  //echo $sql;
  $result = $conn -> exec($sql);
  $numRows = $conn -> numRows($result);
  if($numRows)
  {
   $row = $conn -> fetchArray($result);
   $_SESSION['sessUserId'] = $row['id'];
   $_SESSION['sessUsername'] = $row['username'];
   $_SESSION['sessLastLogin'] = $row['lastLogin'];

   return true;
  }
  else
  {
   return false;
  }
 }

 function updateLastLogin($id)
 {
 	global $conn;
	
  $sql = "UPDATE users SET lastLogin = NOW() WHERE id = '$id'";
  $result = $conn -> exec($sql);
 }

 function updateLoginTimes($id)
 {
 	global $conn;
	
  $sql = "UPDATE users SET loginTimes = (loginTimes + 1) WHERE id = '$id'";
  $result = $conn -> exec($sql);
 }

 function validatePassword($id,$pswd)
 {
 	global $conn;
	
  $sql = "SELECT COUNT(*) cnt FROM users WHERE id = '$id' AND password = '$pswd'";
  //echo $sql;
  $result = $conn -> exec($sql);
  $row = $conn -> fetchArray($result);
  if($row['cnt'] > 0)
   return true;
  else
   return false;
 }

 function updatePassword($id,$pswd)
 {
 	global $conn;
	
  $sql = "UPDATE users SET password = '$pswd' WHERE id = '$id'";
  //echo $sql;
  $result = $conn -> exec($sql);
  $affRows = $conn -> affRows();
  if($affRows)
   return true;
  else
   return false;
 }
 
 //front end user operations
 function saveUser($name, $username, $password, $email, $address, $phone)
 {
	global $conn;
	
  	$sql = "insert into usergroups SET name = '$name', username='$username', password='$password', email='$email', address='$address', phone='$phone'";
  	
	$result = $conn -> exec($sql);	 
 }
 
 function validateUser($username,$password)
 {
 	global $conn;
	
  	$sql = "SELECT * FROM usergroups u WHERE md5(u.username) = '". md5(cleanQuery($username)). "' AND md5(u.password) = '". md5(cleanQuery($password)) ."'";
 	//echo $sql;
  	$result = $conn -> exec($sql);
  	$numRows = $conn -> numRows($result);
  	if($numRows)
  	{
		$data=$conn->fetchArray($result);
		$_SESSION['sessFrontUserId']=$data['id'];
		$_SESSION['sessFrontUsername']=$data['username'];
		$_SESSION['sessFrontName']=$data['name'];
		return true;
	}
	else
	{
		return false;
	}
 }
 
 //forum operations
 function getUserById($id)
	{
		global $conn;
		$id = cleanQuery($id);
		$sql = "SElECT * FROM usergroups WHERE id = '$id'";
		$result = $conn->fetchArray($conn->exec($sql));
		return $result;
	}
	
	function updateUserPassword($id,$pswd)
	{
		global $conn;
		
	  $sql = "UPDATE usergroups SET password = '$pswd' WHERE id = '$id'";
	  //echo $sql;
	  $result = $conn -> exec($sql);
	  $affRows = $conn -> affRows();
	  if($affRows)
	   return true;
	  else
	   return false;
	}
	
	function getUserByEmail($email)
	{
		global $conn;
		$email = cleanQuery($email);
		$sql = "SElECT * FROM usergroups WHERE email = '$email'";
		$result = $conn->exec($sql);
		return $result;
	}
 
}
?>