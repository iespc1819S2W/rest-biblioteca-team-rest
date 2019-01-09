<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");
$llibre=new Llibre();

if (isset($_POST["id_llib"])) {
    $id_llib = $_POST["id_llib"];
    $titol=isset($_POST["titol"])?$_POST["titol"]:'';
    $numEdicio=isset($_POST["numEdicio"])?$_POST["numEdicio"]:'';
    $llocedicio=isset($_POST["llocedicio"])?$_POST["llocedicio"]:'';
    $anyedicio=isset($_POST["anyedicio"])?$_POST["anyedicio"]:'';
    $descrip_llib=isset($_POST["descrip_llib"])?$_POST["descrip_llib"]:'';
    $isbn=isset($_POST["isbn"])?$_POST["isbn"]:'';
    $deplegal=isset($_POST["deplegal"])?$_POST["deplegal"]:'';
    $signtop=isset($_POST["signtop"])?$_POST["signtop"]:'';
    $datbaixa_llib=isset($_POST["datbaixa_llib"])?$_POST["datbaixa_llib"]:'';
    $motiubaixa=isset($_POST["motiubaixa"])?$_POST["motiubaixa"]:'';
    $fk_colleccio=isset($_POST["fk_colleccio"])?$_POST["fk_colleccio"]:'';
    $fk_departament=isset($_POST["fk_departament"])?$_POST["fk_departament"]:'';
    $fk_idedit=isset($_POST["fk_idedit"])?$_POST["fk_idedit"]:'';
    $fk_llengua=isset($_POST["fk_llengua"])?$_POST["fk_llengua"]:'';
    $img_llib=isset($_POST["img_llib"])?$_POST["img_llib"]:'';

    $dades = array(
        "id_llib"=>$id_llib,
        "titol"=>$titol,
        "numEdicio"=>$numEdicio,
        "llocedicio"=>$llocedicio,
        "anyedicio"=>$anyedicio,
        "descrip_llib"=>$descrip_llib,
        "isbn"=>$isbn,
        "deplegal"=>$deplegal,
        "signtop"=>$signtop,
        "datbaixa_llib"=>$datbaixa_llib,
        "motiubaixa"=>$motiubaixa,
        "fk_colleccio"=>$fk_colleccio,
        "fk_departament"=>$fk_departament,
        "fk_idedit"=>$fk_idedit,
        "fk_llengua"=>$fk_llengua,
        "img_llib"=>$img_llib);

    $res = $llibre->update($dades);

} else{
    $res=new Resposta();
    $res->SetCorrecta(false,"Error, falten dades");
}
header('Content-type: application/json');
echo json_encode($res);
?>