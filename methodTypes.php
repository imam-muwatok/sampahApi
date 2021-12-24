<?php
require_once "koneksi.php";
class Types 
{

	public  function gets()
	{
		global $mysqli;
		$query="SELECT * FROM tbl_types";
		$data=array();
		$result=$mysqli->query($query);
		while($row=mysqli_fetch_object($result))
		{
			$data[]=$row;
		}
		$response=array(
							'types' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function get($id=0)
	{
		global $mysqli;
		$query="SELECT * FROM tbl_types";
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
							'types' => $data
						);
		header('Content-Type: application/json');
		echo json_encode($response);
		 
	}

	public function insert()
		{
			global $mysqli;
			$arrcheckpost = array('material' => '','nama' => '');
			$hitung = count(array_intersect_key($_POST, $arrcheckpost));
			if($hitung == count($arrcheckpost)){
			
					$result = mysqli_query($mysqli, "INSERT INTO tbl_types SET
					material = '$_POST[material]',
					nama = '$_POST[nama]'
					");
					
					if($result)
					{
						$response=array(
							'status' => 1,
							'message' =>'Types Added Successfully.'
						);
					}
					else
					{
						$response=array(
							'status' => 0,
							'message' =>'Types Addition Failed.'
						);
					}
			}else{
				$response=array(
							'status' => 0,
							'message' =>'Parameter Do Not Match'
						);
			}
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			header('Content-Type: application/json');
			echo json_encode($response);
			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}


	function delete($id)
	{
		global $mysqli;
		$query="DELETE FROM tbl_types WHERE id=".$id;
		if(mysqli_query($mysqli, $query))
		{
			$response=array(
				'status' => 1,
				'message' =>'Types Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'message' =>'Types Deletion Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}

 ?>
