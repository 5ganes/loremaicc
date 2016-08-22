<?php
class Magazine
{
	
	function saveMagazine($id, $name, $year, $month, $contents, $publish, $weight)
	{
		global $conn;
		
		$id = cleanQuery($id);
		$name = cleanQuery($name);
		$year = cleanQuery($year);
		$month = cleanQuery($month);
		$contents = cleanQuery($contents);
		$publish = cleanQuery($publish); //echo $publish; die();
		$weight = cleanQuery($weight);
		
		if($id > 0)
		$sql = "UPDATE magazine
						SET
							name = '$name',
							year = '$year',
							month = '$month',
							contents='$contents',
							publish = '$publish',
							weight = '$weight'
						WHERE
							id = '$id'";
		else
		$sql = "INSERT INTO magazine 
						SET
							name = '$name',
							year = '$year',
							month = '$month',
							contents='$contents',
							publish = '$publish',
							weight = '$weight',
							onDate = NOW()";
		
		$conn->exec($sql);
		if($id > 0)
			return $conn -> affRows();
		return $conn->insertId();
	}
	
	function saveFile($id)
	{
		global $conn;
		global $_FILES;
		
		$id = cleanQuery($id);
		$filename = $_FILES['file']['name']; //echo $filename; die();
		
		/*$ext = end(explode(".", $filename));
		$image = $id . "." . $ext;*/
		$file = $filename;
		if(!empty($file))
		{
			copy($_FILES['file']['tmp_name'], "../". CMS_FILES_DIR . $file);
			$sql = "UPDATE magazine SET file = '$file' WHERE id = '$id'";
			$conn->exec($sql);
		}
	}
	
	function getById($id)
	{
		global $conn;

		$id = cleanQuery($id);

		$sql = "SElECT * FROM magazine WHERE id = '$id'";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function getByParentIdAndType($id, $categoryId)
	{
		global $conn;
		
		$id = cleanQuery($id);
		$categoryId = cleanQuery($categoryId);
		
		$sql = "SElECT * FROM diary WHERE `categoryId` = '$categoryId' ORDER BY weight";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function getByYear($year)
	{
		global $conn;
		
		$year = cleanQuery($year);
		
		$sql = "SElECT * FROM magazine WHERE year = '$year' ORDER BY weight";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function getYear()
	{
		global $conn;
		
		$sql = "SElECT distinct year FROM magazine ORDER BY year";
		$result = $conn->exec($sql);
		
		return $result;
	}
	
	function updateImage($id, $image)
	{
		global $conn;
		
		$id = cleanQuery($id);
		$image = cleanQuery($image);
		
		$sql = "UPDATE diary SET image = '$image' WHERE id = '$id'";
		$conn->exec($sql);
	}
	
	function delete($id)
	{  
		global $conn;
		
		$id = cleanQuery($id);
		
		$result = $this->getById($id);
		$row = $conn->fetchArray($result);
		
		$file = "../" . CMS_FILES_DIR . $row['file'];
		
		if (file_exists($file) && !empty($row['file']))
			unlink($file);
			
		$sql = "DELETE FROM magazine WHERE id = '$id'";
		$conn->exec($sql);
	}
	
	function getLastWeight($year)
	{
		global $conn;
		$year = cleanQuery($year);
		
		$sql = "SElECT weight FROM magazine WHERE year='$year' ORDER BY weight DESC LIMIT 1";
		$result = $conn->exec($sql);
		$numRows = $conn -> numRows($result);
		if($numRows > 0)
		{
			$row = $conn->fetchArray($result);
			return $row['weight'] + 10;
		}
		else
			return 10;
	}
	
	function getMagazine()
	{
		global $conn;
		$sql="select * from magazine where publish='Yes' order by weight";
		$result=$conn->exec($sql);	
		return $result;
	}
	
}
?>
