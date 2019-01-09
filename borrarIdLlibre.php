<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");
$llibre=new Llibre();

if(isset($_POST["id_llib"])){
    $id_llib = $_POST["id_llib"];
    $res = $llibre->delete($id_llib);

} else{
    $res=new Resposta();
    $res->SetCorrecta(false,"Error, ID incorrecte o no se ha pogut borrar");
}
header('Content-type: application/json');
echo json_encode($res);
?>