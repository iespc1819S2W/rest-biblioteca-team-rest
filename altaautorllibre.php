<?php
// Not found
 $base = __DIR__;
 require_once("$base/model/llibre.class.php");
 $llibre=new Llibre();
 if (isset($_POST["id_aut"]) and isset($_POST["id_llib"])) {
     $id_aut=$_POST["id_aut"];
     $id_llib=$_POST["id_llib"];
     $rolaut=isset($_POST["rolaut"])?$_POST["rolaut"]:'';
     $res=$llibre->insertAutLlib(array("id_aut"=>$id_aut,"id_llib"=>$id_llib,"rolaut"=>$rolaut));
 } else {
     $res=new Resposta();
     $res->SetCorrecta(false,"id_aut and id_llib requerit");
 }
 header('Content-type: application/json');
 echo json_encode($res); 
