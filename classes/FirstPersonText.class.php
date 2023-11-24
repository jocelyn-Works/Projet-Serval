<?php
class FirstPersonText extends Baseclass{

    public function __construct(){
        // $this->dbh = new Database();
        // $this->currentX = 0; // position x 
        // $this->currentY = 1;  // position y 
        // $this->currentAngle = 0; // l'angle de vue 
        // $this->currentMap = "01-0.jpg"; // la photo
        // $this->currentMapID = 2; // emplacement sur la carte 
        parent::__construct();
    }
    public function getText()
    {
     $stmt = $this->dbh->prepare("SELECT * FROM action WHERE map_id =:map_id ");
        $stmt->bindParam(':map_id',$this->currentMapID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
        $status_action = $result['status'];
        }else{
            $status_action = 0;
        }        
            // table text
        $stmt = $this->dbh->prepare("SELECT * FROM text WHERE map_id =:map_id AND status_action=:status_action");
        $stmt->bindParam(':map_id',$this->currentMapID);
        $stmt->bindParam(':status_action', $status_action);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($result["text"])){
                $newText =  $result["text"];

                return $newText;
            }
            return "";
        } 
    }