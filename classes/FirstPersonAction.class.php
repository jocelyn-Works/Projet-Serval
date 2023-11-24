<?php 
class FirstPersonAction extends Baseclass
{
    public function __construct(){
        parent::__construct();
    }
    public function checkAction() // verifie l'action en cours
    {
        // conexion bases de données // dans la table action on récupére toute les colonnes ou map_id ->
        $stmt = $this->dbh->prepare("SELECT * FROM action WHERE map_id =:map_id");
        $stmt->bindParam(':map_id', $this->currentMapID); // on lie les parametre au valeurs // = valeur currentMapid
        $stmt->execute(); // on execute la requéte 
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // on récupére le resultat de la première ligne de la requête SQL
        // var_dump($result['map_id']);
        if($result){ // si le requéte renvoi un resultat
        $map_id = $result['map_id']; // on le stocke dans une variable "$map_id"
            if(!empty($map_id) && ($result['status']!== $this->guessStatusAction($map_id))){ 
// si $map_id n'est pas vide  &&   si le resultat de"status" n'est pas egale  à la valeur retournée par la fonction "guessStatusAction"     
                // if (($map_id==="3") || ($map_id==="14")){
                    return true; // alors on retourne vrai
                }else{ // si non 
                    return false; // faux 
                }
            // }
        }else{ // pour le reste 
            return false; // faux 
        }
    }

    public function guessStatusAction($map_id)
    {
        // conexion bases de donnée // dans la table map on récupére l'id ->
        $stmt = $this->dbh->prepare("SELECT * FROM map WHERE id =:mapid");
        $stmt->bindParam(':mapid', $map_id); // on lie les parametre au valeurs // = valeur $map_id
        $stmt->execute(); // on execute la requéte 
    }

    public function doAction() // mettre a jour l'action 
    {   // conexion base de donné 
        $stmt = $this->dbh->prepare("SELECT * FROM action WHERE map_id =:map_id "); // on seléctionne 
        $stmt->bindParam(':map_id', $this->currentMapID);// on lie les parametre au valeurs //  valeur = currentMapID
        $stmt->execute(); // on execute la requéte 
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // on récupére le resultat de la première ligne de la requête SQL
        $SESSION[''] = $result['item_id']; // on stoke le resultat dans une variable $SESSION['']

        $stmt = $this->dbh->prepare("UPDATE action SET status ='1' WHERE map_id =:map_id "); // on me'est a jour
        $stmt->bindParam(':map_id', $this->currentMapID);// on lie les parametre au valeurs // valeur = currentMapID
        $stmt->execute();// on execute la requéte 
    }
}