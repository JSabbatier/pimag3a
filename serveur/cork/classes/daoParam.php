<?php

require_once("param.php");
class DaoParam
{
	public function __construct()
	{
        //Récupération des variables issues du connect.php
        global $dsn;
        global $username;
        global $password;
         
        $this->dsn = $dsn;
        $this->pwd = $password;
        $this->username = $username;
 
        //Tentative de connexion       
        try
        {
            $this->dbh = new PDO($this->dsn, $this->username, $this->pwd);
        }
        catch (PDOException $e)
        {
            die( "Erreur ! : " . $e->getMessage() );
        }
    }	
	
	public function getParamById($id)
	{
		$query="select * from param where id=:id";
		$rs=$this->dbh->prepare($query);
		$rs->bin(':id',$id);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$param = new Param;
		
		$param->setNom($row['nom']);
		$param->setTypeParam($row['type_param']);
		$param->setValInt($row['val_int']);
		$param->setValInt2($row['val_int2']);
		$param->setValInt3($row['val_int3']);
		$param->setValchar($row['val_char']);
		$param->setValchar2($row['val_char2']);
		$param->setValchar3($row['val_char3']);
		$param->setfloat($row['val_float']);
		$param->setfloat2($row['val_float2']);
		$param->setfloat3($row['val_float3']);
		return $param;
	}
	
	public function getParamByTypeParam($id)
	{
		$query="select * from param where type_param=:type_param";
		$rs=$this->dbh->prepare($query);
		$rs->bin(':type_param',$type_param);
		
		$rs->execute();
		
		$row= $rs->fetch();
		
		$param = new Param;
		
		$param->setNom($row['nom']);
		$param->setId($row['id']);
		$param->setValInt($row['val_int']);
		$param->setValInt2($row['val_int2']);
		$param->setValInt3($row['val_int3']);
		$param->setValchar($row['val_char']);
		$param->setValchar2($row['val_char2']);
		$param->setValchar3($row['val_char3']);
		$param->setfloat($row['val_float']);
		$param->setfloat2($row['val_float2']);
		$param->setfloat3($row['val_float3']);
		return $param;
	}
	
public function updateParam ($param)
        {
            //mise a jour d'un opérateur
             
            $tmp = new Param;
            $tmp= $param;
             
            $query = "UPDATE param SET type_param=:typeParam, val_alpha=:valChar, val_alpha1= :valChar1, val_alpha2=:valChar2, val_int= :valInt, val_int2=:valInt2, val_int3=:valInt3 WHERE id= :id";
             
            $queryPrepared = $this->dbh->prepare($query);
            $queryPrepared->bindParam(':id',$tmp->getId());
			$queryPrepared->bindParam(':nom',$tmp->getNom());
            $queryPrepared->bindParam(':typeParam',$tmp->getTypeParam());
			$queryPrepared->bindParam(':valInt',$tmp->getValInt());
            $queryPrepared->bindParam(':valInt2',$tmp->getValInt2());
            $queryPrepared->bindParam(':valInt3',$tmp->getValInt3());
            $queryPrepared->bindParam(':valChar',$tmp->getvalChar());
            $queryPrepared->bindParam(':valChar2',$tmp->getvalChar2());
			$queryPrepared->bindParam(':valChar3',$tmp->getvalChar3());
			$queryPrepared->bindParam(':valFloat',$tmp->getvalFloat());
			$queryPrepared->bindParam(':valFloat2',$tmp->getvalFloat2());
			$queryPrepared->bindParam(':valFloat3',$tmp->getvalFloat3());

             
            return $queryPrepared->execute();
        }
	
}

?>