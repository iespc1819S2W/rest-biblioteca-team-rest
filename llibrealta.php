<?php
$base = __DIR__;
require_once("$base/model/llibre.class.php");
$llibre=new Llibre();
if (isset($_POST["titol"])) {
    $titol=isset($_POST["titol"])?$_POST["titol"]:'';
    $numedicio=isset($_POST["numedicio"])?$_POST["numedicio"]:'';
    $llocedicio=isset($_POST["llocedicio"])?$_POST["llocedicio"]:'';
    $anyedicio=isset($_POST["anyedicio"])?$_POST["anyedicio"]:'';
    $descrip_llib=isset($_POST["descrip_llib"])?$_POST["descrip_llib"]:'';
    $isbn=isset($_POST["isbn"])?$_POST["isbn"]:'';
    $deplegal=isset($_POST["deplegal"])?$_POST["deplegal"]:'';
    $signtop=isset($_POST["signtop"])?$_POST["signtop"]:'';
    $databaixa_llib=isset($_POST["databaixa_llib"])?$_POST["databaixa_llib"]:'';
    $motiubaixa=isset($_POST["motiubaixa"])?$_POST["motiubaixa"]:'';
    $fk_coleccio=isset($_POST["fk_coleccio"])?$_POST["fk_coleccio"]:'';
    $fk_departament=isset($_POST["fk_departament"])?$_POST["fk_departament"]:'';
    $fk_idedit=isset($_POST["fk_idedit"])?$_POST["fk_idedit"]:'';
    $fk_llengua=isset($_POST["fk_llengua"])?$_POST["fk_llengua"]:'';
    $img_llib=isset($_POST["img_llib"])?$_POST["img_llib"]:'';

    $res=$llibre->insert(array("titol"=>$titol,"numedicio"=>$numedicio,"llocedicio"=>$llocedicio,
        "anyedicio"=>$anyedicio,"descrip_llib"=>$descrip_llib,"isbn"=>$isbn,"deplegal"=>$deplegal,"signtop"=>$signtop,
        "databaixa_llib"=>$databaixa_llib,"motiubaixa"=>$motiubaixa,"fk_coleccio"=>$fk_coleccio,"fk_departament"=>$fk_departament,
        "fk_idedit"=>$fk_idedit,"fk_llengua"=>$fk_llengua,"img_llib"=>$img_llib));
} else {
    $res=new Resposta();
    $res->SetCorrecta(false,"Titol Llibre requerit");
}

header('Content-type: application/json');
echo json_encode($res);