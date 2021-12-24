<?php
require_once "koneksi.php";
class Materials 
{

	public  function gets()
	{
		global $mysqli;
		$query="SELECT * FROM tbl_materials";
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result))
		{
			$data[]=$row;
		}
		$response=array(
							'materials' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get($id=0)
	{
		global $mysqli;
		$query="SELECT * FROM tbl_materials";
		if($id != 0)
		{
			$query.=" WHERE id=".$id." LIMIT 1";
		}
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result))
		{
			$data[]=$row;
		}
		$response=array(
							
							'materials' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

	public function insert()
		{
			global $mysqli;
			$arrcheckpost = array('nama' => '');
			$hitung = count(array_intersect_key($_POST, $arrcheckpost));
			if($hitung == count($arrcheckpost)){
			
					$result = mysqli_query($mysqli, "INSERT INTO tbl_materials SET
					nama = '$_POST[nama]'
					");
					
					if($result)
					{
						$response=array(
							'status' => 1,
							'message' =>'Materials Added Successfully.'
						);
					}
					else
					{
						$response=array(
							'status' => 0,
							'message' =>'Materials Addition Failed.'
						);
					}
			}else{
				$response=array(
							'status' => 0,
							'message' =>'Parameter Do Not Match'
						);
			}
			header('Content-Type: application/json');
			echo json_encode($response);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}


	function delete($id)
	{
		global $mysqli;
		$query="DELETE FROM tbl_materials WHERE id=".$id;
		if(mysqli_query($mysqli, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Materials Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Materials Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}

 ?>
