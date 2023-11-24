<?php
class FirstPersonView extends Baseclass{

    protected $compass;

    public function __construct(){
        parent::__construct();
    }
    
    public function getView() 
    {
        $stmt = $this->dbh->prepare("SELECT * FROM action WHERE map_id =:map_id");
        $stmt->bindParam(':map_id', $this->currentMapID);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
        $status_action = $result['status'];
        }else{
            $status_action = 0;
        }        

        $stmt = $this->dbh->prepare("SELECT * FROM images WHERE map_id =:map_id AND status_action=:stact");
        $stmt->bindParam(':map_id', $this->currentMapID);
        $stmt->bindParam(':stact', $status_action);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result["path"])){
            $newMap =  $result["path"];
            $this->currentMap = $newMap; 
        }
        return $this->currentMap;
    }
      
    public function getAnimCompass() // fonction pour fair tourner le compas
    {
        $classe = $this->compass;
        switch( $this->currentAngle){ // quand langle de vue change ->
            case 0 : {
                $classe = "compass-0";// classe pour langle 0°
                break;
            }
            case 90 : {
                $classe = "compass-90"; // classe pour langle 90° 
                break;
            }
            case 180 : {
                $classe = "compass-180"; // classe pour langle 180°
                break;
            }
            case 270 : {
                $classe = "compass-270"; // classe pour langle 2700°
                break;
            }
        }
        $this->compass = $classe;
        return $this->compass;
    }

    // public function __toString()
    // {
    //     return "Coordinates (x=" . $this->currentX . ", y=" . $this->currentY . ", a= " . $this->currentAngle.")";
    // }
}