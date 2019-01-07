<?php
$base = __DIR__;
/* require_once("$base/model/autor.class.php");
 $autor=new Autor();
 $res=$autor->getAll();
 if ($res->correcta) {
    foreach ($res->dades as $row){
        echo $row['id_aut']."-".$row['nom_aut']." ".$row["fk_nacionalitat"]."<br>";
    }
 } else {
     echo $res->missatge;
 }
/*
 $autor->insert(array("nom_aut"=>"Tomeu Campaner","fk_nacionalitat"=>"MURERA"));   //produira un error
 if (!$res->correcta) {
    echo "Error insertant";  // Error per l'usuari
   // error_log($res->missatge,3,"$base/log/errors.log");  // Error per noltros
 }
*/
require_once("$base/model/llibre.class.php");
$llibre=new Llibre();

$llibre->insert(array("titol"=> "Felip Xavier Reynes"));   //produira un error
if (!$res->correcta) {
    echo "Error insertant";  // Error per l'usuari
  //  error_log($res->missatge, 3, "$base/log/errors.log");  // Error per noltros
}

