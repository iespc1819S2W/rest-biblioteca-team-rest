<?php
 $base = __DIR__;
 require_once("$base/model/llibre.class.php");
 $llibre=new Llibre();
 $id_llibre=$_GET["id"];
 $res=$llibre->get($id_llibre);
 header('Content-type: application/json');
 echo json_encode($res);

