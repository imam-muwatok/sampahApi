<?php
require_once "methodMaterials.php";
$typ = new Materials();
$request_method=$_SERVER["REQUEST_METHOD"];
switch ($request_method) {
	case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$typ->get($id);
			}
			else
			{
				$typ->gets();
			}
			break;
	case 'POST':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				$typ->update($id);
			}
			else
			{
				$typ->insert();
			}		
			break; 
	case 'DELETE':
		    $id=intval($_GET["id"]);
            $typ->delete($id);
            break;
	default:
		// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
		break;
}




?>