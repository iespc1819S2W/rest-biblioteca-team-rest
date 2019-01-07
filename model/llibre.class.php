<?php
$base = __DIR__ . '/..';
require_once("$base/lib/resposta.class.php");
require_once("$base/lib/database.class.php");

class Llibre
{
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   // resposta
    
    public function __CONSTRUCT()
    {
        $this->conn = Database::getInstance()->getConnection();      
        $this->resposta = new Resposta();
    }
    
    public function getAll($orderby="id_llib")
    {
		try
		{
			$result = array();                        
			$stm = $this->conn->prepare("SELECT ID_LLIB,TITOL,ISBN FROM LLIBRES ORDER BY $orderby");
			$stm->execute();
            $tuples=$stm->fetchAll();
            $this->resposta->setDades($tuples);    // array de tuples
			$this->resposta->setCorrecta(true);       // La resposta es correcta        
            return $this->resposta;
		}
        catch(Exception $e)
		{   // hi ha un error posam la resposta a fals i tornam missatge d'error
			$this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
		}
    }
    
    public function get($id)
    {
        try
		{
			$result = array();                        
            $stm = $this->conn->prepare("SELECT ID_LLIB,TITOL,ISBN FROM LLIBRES where id_LLIB=:id_LLIB");
            $stm->bindValue(':id_LLIB',$id);
			$stm->execute();
            $tupla=$stm->fetch();
            $this->resposta->setDades($tupla);    // array de tuples
			$this->resposta->setCorrecta(true);       // La resposta es correcta        
            return $this->resposta;
		}
        catch(Exception $e)
		{   // hi ha un error posam la resposta a fals i tornam missatge d'error
			$this->resposta->setCorrecta(false, $e->getMessage());
            return $this->resposta;
		}
    }

    
    public function insert($data)
    {
		try 
		{
                $sql = "SELECT max(id_llib) as N from LLIBRES";
                $stm=$this->conn->prepare($sql);
                $stm->execute();
                $row=$stm->fetch();
            $id_llibre=$row["N"]+1;
            $titol=$data['titol'];
            $numedicio=$data['numedicio'];
            $llocedicio=$data['llocedicio'];
            $anyedicio=$data['anyedicio'];
            $descrip_llib=$data['descrip_llib'];
            $isbn=$data['isbn'];
            $deplegal=$data['deplegal'];
            $signtop=$data['signtop'];
            $databaixa_llib=$data['databaixa_llib'];
            $motiubaixa=$data['motiubaixa'];
            $fk_coleccio=$data['fk_coleccio'];
            $fk_departament=$data['fk_departament'];
            $fk_idedit=$data['fk_idedit'];
            $fk_llengua=$data['fk_llengua'];
            $img_llib=$data['img_llib'];

                $sql = " INSERT INTO LLIBRES (ID_LLIB, TITOL, NUMEDICIO, LLOCEDICIO, 
                          ANYEDICIO, DESCRIP_LLIB, ISBN, DEPLEGAL, SIGNTOP, DATBAIXA_LLIB, MOTIUBAIXA, 
                          FK_COLLECCIO, FK_DEPARTAMENT, FK_IDEDIT, FK_LLENGUA, IMG_LLIB)
                            VALUES (:id_llib,:titol,:numedicio,:llocedicio,:anyedicio,
                            :descrip_llib,:isbn,:deplegal,:signtop,:databaixa_llib,:motiubaixa,
                            :fk_coleccio,:fk_departament,:fk_idedit,:fk_llengua,:img_llib)";
                
                $stm=$this->conn->prepare($sql);
                $stm->bindValue(':id_llib',$id_llibre);
                $stm->bindValue(':titol',$titol);
                $stm->bindValue(':numedicio',!empty($numedicio)?$numedicio:NULL,PDO::PARAM_STR);
                $stm->bindValue(':llocedicio',!empty($llocedicio)?$llocedicio:NULL,PDO::PARAM_STR);
                $stm->bindValue(':anyedicio',!empty($anyedicio)?$anyedicio:NULL,PDO::PARAM_STR);
                $stm->bindValue(':descrip_llib',!empty($descrip_llib)?$descrip_llib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':isbn',!empty($isbn)?$isbn:NULL,PDO::PARAM_STR);
                $stm->bindValue(':deplegal',!empty($deplegal)?$deplegal:NULL,PDO::PARAM_STR);
                $stm->bindValue(':signtop',!empty($signtop)?$signtop:NULL,PDO::PARAM_STR);
                $stm->bindValue(':databaixa_llib',!empty($databaixa_llib)?$databaixa_llib:NULL,PDO::PARAM_STR);
                $stm->bindValue(':motiubaixa',!empty($motiubaixa)?$motiubaixa:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_coleccio',!empty($fk_coleccio)?$fk_coleccio:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_departament',!empty($fk_departament)?$fk_departament:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_idedit',!empty($fk_idedit)?$fk_idedit:NULL,PDO::PARAM_STR);
                $stm->bindValue(':fk_llengua',!empty($fk_llengua)?$fk_llengua:NULL,PDO::PARAM_STR);
                $stm->bindValue(':img_llib',!empty($img_llib)?$img_llib:NULL,PDO::PARAM_STR);
                $stm->execute();
            
       	        $this->resposta->setCorrecta(true);
                return $this->resposta;
        }
        catch (Exception $e) 
		{
                $this->resposta->setCorrecta(false, "Error insertant: ".$e->getMessage());
                return $this->resposta;
		}
    }   
    
    public function update($data)
    {
        // TODO
    }

    
    
    public function delete($id)
    {
        // TODO
    }

    public function filtra($where,$orderby,$offset,$count)
    {
        // TODO
    }
    
          
}