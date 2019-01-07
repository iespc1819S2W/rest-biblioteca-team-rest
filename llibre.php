<?php
 $base = __DIR__;
 require_once("$base/model/llibre.class.php");
 if (isset($_GET["id"])) {
 $llibre=new Llibre();
 $id_llibre=$_GET["id"];
 $res=$llibre->get($id_llibre);
} else {
	$res=new Resposta();
     $res->SetCorrecta(false,"id_llibre requerit");
}
 header('Content-type: application/json');
 echo json_encode($res);
