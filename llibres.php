<?php
//
 $base = __DIR__;
 require_once("$base/model/llibre.class.php");
 $llibre=new Llibre();
 $res=$llibre->getAll();
 header('Content-type: application/json');
 echo json_encode($res->dades);
