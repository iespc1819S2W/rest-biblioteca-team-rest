<?php
// get autor
 $base = __DIR__;
 require_once("$base/model/autor.class.php");
 $autor=new Autor();
 $id_aut=$_GET["id"];
 $res=$autor->get($id_aut);
 header('Content-type: application/json');
 echo json_encode($res);

