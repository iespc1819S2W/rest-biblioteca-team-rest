<?php
 $base = __DIR__;
 require_once("$base/model/autor.class.php");
 $autor=new Autor();
 if (isset($_POST["nom_aut"])) {
     $nom_aut=$_POST["nom_aut"];
     $nacionalitat=isset($_POST["nacionalitat"])?$_POST["nacionalitat"]:'';
     $res=$autor->insert(array("nom_aut"=>$nom_aut,"fk_nacionalitat"=>$nacionalitat));
 } else {
     $res=new Resposta();
     $res->SetCorrecta(false,"nom_aut requerit");
 }
 header('Content-type: application/json');
 echo json_encode($res);

