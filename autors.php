<?php
 $base = __DIR__;
 require_once("$base/model/autor.class.php");
 $autor=new Autor();
 $res=$autor->getAll();
 header('Content-type: application/json');
 echo json_encode($res->dades);
