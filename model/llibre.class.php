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
                $sql = "SELECT max(id_aut) as N from autors";
                $stm=$this->conn->prepare($sql);
                $stm->execute();
                $row=$stm->fetch();
                $id_aut=$row["N"]+1;
                $nom_aut=$data['nom_aut'];
                $fk_nacionalitat=$data['fk_nacionalitat'];

                $sql = "INSERT INTO autors
                            (id_aut,nom_aut,fk_nacionalitat)
                            VALUES (:id_aut,:nom_aut,:fk_nacionalitat)";
                
                $stm=$this->conn->prepare($sql);
                $stm->bindValue(':id_aut',$id_aut);
                $stm->bindValue(':nom_aut',$nom_aut);
                $stm->bindValue(':fk_nacionalitat',!empty($fk_nacionalitat)?$fk_nacionalitat:NULL,PDO::PARAM_STR);
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
               try {
            $bWhere=true;
            $limit=false;
            $bOffset=false;
            $sql="SELECT * from LLIBRES";
            if(strlen($where)==0){
                $bWhere=false;
            } else {
                $sql=$sql." WHERE titol like :w";
            }
            
            if(strlen($orderby)==0){
            } else {
                $orderby = filter_var($orderby, FILTER_SANITIZE_STRING);
                $sql=$sql." ORDER BY $orderby";
            }


            if($count!=""){
                $limit=true;
                if($offset!=""){
                    $bOffset=true;
                    $sql=$sql." limit :offset,:count";
                } else {
                    $sql=$sql." limit :count";
                }
            }
             $stm=$this->conn->prepare($sql);
 
             if($bWhere){
                $stm->bindValue(':w','%'.$where.'%');
             }
             if($limit){
                $count=(int)$count;
                $stm->bindValue(':count',$count,PDO::PARAM_INT); 
            }
            if($bOffset){
                $offset=(int)$offset;
                 $stm->bindValue(':offset',$offset,PDO::PARAM_INT); 
            }
            
            $stm->execute();
            $tuples=$stm->fetchAll();



            
            $this->resposta->setDades($tuples); 
            $this->resposta->setCorrecta(true);           
            return $this->resposta;
        } catch (Exeption $e){
            $this->resposta->setCorrecta(false, "Error insertant: ".$e->getMessage());
                return $this->resposta;
        }
    }
    
    public function insertAutLlib($data)
    {
		try 
		{
                $fk_idllib=(int)$data['id_llib'];
                $fk_idaut=(int)$data['id_aut'];
                $fk_rolaut=$data['rolaut'];

                $sql = "INSERT INTO lli_aut
                            (fk_idllib,fk_idaut,fk_rolaut)
                            VALUES (:fk_idllib,:fk_idllib,:fk_rolaut)";
                
                $stm=$this->conn->prepare($sql);
                $stm->bindValue(':fk_idllib',$fk_idllib);
                $stm->bindValue(':fk_idaut',$fk_idaut);
                $stm->bindValue(':fk_rolaut',!empty($fk_rolaut)?$fk_rolaut:NULL,PDO::PARAM_STR);
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
      
}
