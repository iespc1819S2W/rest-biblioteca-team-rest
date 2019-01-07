<?php
$base = __DIR__ . '/..';
require_once("$base/lib/resposta.class.php");
require_once("$base/lib/database.class.php");

class Autor
{
    private $conn;       //connexió a la base de dades (PDO)
    private $resposta;   // resposta
    
    public function __CONSTRUCT()
    {
        $this->conn = Database::getInstance()->getConnection();      
        $this->resposta = new Resposta();
    }
    
    public function getAll($orderby="id_aut")
    {
		try
		{
			$result = array();                        
			$stm = $this->conn->prepare("SELECT id_aut,nom_aut,fk_nacionalitat FROM AUTORS ORDER BY $orderby");
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
            $stm = $this->conn->prepare("SELECT id_aut,nom_aut,fk_nacionalitat FROM AUTORS where id_aut=:id_aut");
            $stm->bindValue(':id_aut',$id);
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
    	 try {
            $nom_aut=$data['NOM_AUT'];
            $fk_nacionalitat=$data['FK_NACIONALITAT'];
            $id_aut=$data["ID_AUT"];
        
        
        $sql = "UPDATE AUTORS SET NOM_AUT = :nom_aut , FK_NACIONALITAT = :fk_nacionalitat where ID_AUT = :id_aut";
        $stm=$this->conn->prepare($sql);
        $stm->bindValue(':id_aut',$id_aut);
        $stm->bindValue(':nom_aut',$nom_aut);
        $stm->bindValue(':fk_nacionalitat',!empty($fk_nacionalitat)?$fk_nacionalitat:NULL,PDO::PARAM_STR);
        $stm->execute();
          $this->resposta->setCorrecta(true);
                return $this->resposta;
        }
        catch (Exeption $e)
        {
             $this->resposta->setCorrecta(false, "Error insertant: ".$e->getMessage());
                return $this->resposta;
        }
    }

    
    
    public function delete($id)
    {
        try {
            $sql="DELETE from AUTORS where ID_AUT=:id";
            $stm=$this->conn->prepare($sql);
            $stm->bindValue(':id',$id);
            $stm->execute();
              $this->resposta->setCorrecta(true);
                return $this->resposta;

        } catch (Exeption $e){
             $this->resposta->setCorrecta(false, "Error insertant: ".$e->getMessage());
                return $this->resposta;
        }
    }

    public function filtra($where,$orderby,$offset,$count)
    {
        try {
            $bWhere=true;
            $limit=false;
            $bOffset=false;
            $sql="SELECT * from AUTORS";
            if(strlen($where)==0){
                $bWhere=false;
            } else {
                $sql=$sql." WHERE nom_aut like :w";
            }
            
            if(strlen($orderby)==0){
            } else {
                $orderby = filter_var($orderby, FILTER_SANITIZE_STRING);
                $sql=$sql." ORDER BY $orderby desc";
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
                $stm->bindValue(':count',$count,PDO::PARAM_INT); 
            }
            if($bOffset){
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

    public function autorsllibre($id_llibre)
    {
        try
        {
            $result = array();
            $stm = $this->conn->prepare("SELECT llib.ID_LLIB,llib.TITOL,NOM_AUT as Autors from AUTORS au
            left join LLI_AUT llia on au.ID_AUT=llia.FK_IDAUT
            left join LLIBRES llib on llia.FK_IDLLIB=llib.ID_LLIB where llib.id_LLIB=:id_LLIB");

            $stm->bindValue(':id_LLIB',$id_llibre);
            $stm->execute();
            $tupla=$stm->fetchAll();
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
          
}
