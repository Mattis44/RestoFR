<?php

namespace modele\dao;


use modele\dao\Bdd;
use modele\metier\Type;
use PDO;
use PDOException;
use Exception;


class TypeDAO {

    public static function getTypesByResto(?int $idr): array {
        $lesTypes = array();
        try {
            $requete = "SELECT * FROM type t INNER JOIN typeresto tr ON t.idTC = tr.idTC WHERE tr.idR = :idR";
            $stmt = Bdd::getConnexion()->prepare($requete);
            $stmt->bindParam(':idR', $idr);
            $ok = $stmt->execute();
            // attention, $ok = true pour un select ne retournant aucune ligne
            if ($ok) {
                // Pour chaque enregistrement
                while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //Instancier un nouveau restaurant et l'ajouter à la liste
                    $lesTypes[] = new Type($enreg['idR'], $enreg['libelleTC']);
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur dans la méthode " . get_called_class() . "::getAll : <br/>" . $e->getMessage());
        }
        return $lesTypes;
    }

    public static function getTypesByUtilsateur(?int $idU): array{
        $lesTypes = array();

        try{
            $requete = "SELECT * FROM type t INNER JOIN aimertype aty ON t.idTC = aty.idT INNER JOIN utilisateur u ON u.idU = aty.idU WHERE u.idU = :idU";
            $stmt = Bdd::getConnexion()->prepare($requete);
            $stmt->bindParam(':idU', $idU);
            $ok = $stmt->execute();

            if ($ok) {
                // Pour chaque enregistrement
                while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //Instancier un nouveau restaurant et l'ajouter à la liste
                    $lesTypes[] = new Type($enreg['idT'], $enreg['libelleTC']);
                }
            }

        }catch(PDOException $e){
            throw new Exception("Erreur dans la méthode " . get_called_class() . "::getAll : <br/>" . $e->getMessage());
        }
        return $lesTypes;
    }

    public static function getAllNonPreferesByIdU(?int $idU): array{
        $lesTypes = array();

        try{
            $requete = "SELECT * FROM type t WHEre t.idTC NOT IN ( SELECT aty.idT FROM aimertype aty WHERE aty.idU = :idU ); ";
            $stmt = Bdd::getConnexion()->prepare($requete);
            $stmt->bindParam(':idU', $idU);
            $ok = $stmt->execute();

            if ($ok) {
                // Pour chaque enregistrement
                while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //Instancier un nouveau restaurant et l'ajouter à la liste
                    $lesTypes[] = new Type($enreg['idTC'], $enreg['libelleTC']);
                }
            }

        }catch(PDOException $e){
            throw new Exception("Erreur dans la méthode " . get_called_class() . "::getAll : <br/>" . $e->getMessage());
        }
        return $lesTypes;
    }
    
    public static function getAllTypes() : array {
        $lesTypes = array();
        
        try{
            $requete = "SELECT * FROM type";
            $stmt = Bdd::getConnexion()->prepare($requete);
            $ok = $stmt->execute();
            
            if ($ok) {
                while ($enreg = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //Instancier un nouveau restaurant et l'ajouter à la liste
                    $lesTypes[] = new Type($enreg['idTC'], $enreg['libelleTC']);
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Erreur dans la méthode " . get_called_class() . "::getAll : <br/>" . $e->getMessage());
        }
        return $lesTypes;
    }

    public static function delete(int $idU, int $idT): bool {
        $resultat = false;
        try {
            $stmt = Bdd::getConnexion()->prepare("DELETE FROM aimertype WHERE idT=:idT and idU=:idU");
            $stmt->bindParam(':idT', $idT);
            $stmt->bindParam(':idU', $idU);
            $resultat = $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur dans la méthode " . get_called_class() . "::delete : <br/>" . $e->getMessage());
        }
        return $resultat;
    }

    public static function insert(int $idU, int $idT): bool {
        $resultat = false;
        try {
            $stmt = Bdd::getConnexion()->prepare("INSERT INTO aimertype (idU, idT) VALUES(:idU,:idT)");
            $stmt->bindParam(':idU', $idU, PDO::PARAM_INT);
            $stmt->bindParam(':idT', $idT, PDO::PARAM_INT);
            $resultat = $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur dans la méthode " . get_called_class() . "::insert : <br/>" . $e->getMessage());
        }
        return $resultat;
    }
    
    
    
 

}
?>
