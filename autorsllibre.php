<?php
$base = __DIR__;
require_once("$base/model/autor.class.php");
$autor=new Autor();
$id_llibre=$_GET["id"];
$res=$autor->autorsllibre($id_llibre);
header('Content-type: application/json');
echo json_encode($res);