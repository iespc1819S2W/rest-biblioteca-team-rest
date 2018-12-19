<?php
//
 $base = __DIR__;
 require_once("$base/model/llibre.class.php");
 $llibre=new Llibre();

if(empty($_GET)){
	$res=new Resposta();
     $res->SetCorrecta(false,"Tens que enviar algo per fer el filtre");
} else{
	// $where,$orderby,$offset,$count
	$where=isset($_GET["where"])?$_GET["where"]:'';
	$orderby=isset($_GET["orderby"])?$_GET["orderby"]:'';
	$offset=isset($_GET["offset"])?$_GET["offset"]:'';
	$count=isset($_GET["count"])?$_GET["count"]:'';
	 $res=$llibre->filtra($where,$orderby,$offset,$count);
}

 header('Content-type: application/json');
 echo json_encode($res); 