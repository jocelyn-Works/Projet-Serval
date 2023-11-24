<?php
class Baseclass {
    protected $currentX; // coordonée X 
    protected $currentY;  // coordonnée Y 
    protected $currentAngle; // angle de vue 
    protected $currentMap; // position pour limage 
    protected $currentMapID; // emplacement sur la carte avec langle de vue
    protected $dbh; // conexion a la base de donnée 

    public function __construct() { // on atribut les valeurs de depart 
        $this->dbh = new Database();
        $this->currentX = 0; // position x 
        $this->currentY = 1;  // position y 
        $this->currentAngle = 0; // l'angle de vue 
        $this->currentMap = "01-0.jpg"; // la photo
        $this->currentMapID = 1; // emplacement sur la carte 

        $stmt = $this->dbh->prepare(" UPDATE action SET status = 0 ");
        $stmt->execute();
    }
    
    // les getters et setters permettent d'accéder aux propriétés protégées currentX , currentY et currentAngle
    
    public function setCurrentX(int $currentX) {  // on defini la valeur de coordoné X
        $this->currentX = $currentX;
    }
    public function getCurrentX() {  // on récupére la valeur de coordoné X
        return $this->currentX;
    }
    
    
    public function setCurrentY(int $currentY) {  // on defini la valeur de coordoné Y
        $this->currentY = $currentY;
    }
    public function getCurrentY() {  //on récupére la valeur de coordoné Y
        return $this->currentY;
    }
    

    public function setcurrentAngle(int $currentAngle)  // on defini la valeur de l'Angle de vue
    {
        $this->currentAngle = $currentAngle;
    }

    public function getcurrentAngle()  //on récupére la valeur de l'Angle de vue
    {
        return $this->currentAngle;
    }


    public function setcurrentMap(string $currentMap)
    {
        $this->currentMap = $currentMap;
    }

    public function getcurrentMap()
    {
        return $this->currentMap;
    }


    public function setcurrentMapID(int $currentMapID)
    {
        $this->currentMapID = $currentMapID;
    }

    public function getcurrentMapID()
    {
        return $this->currentMapID;
    } 
    
     //vérifie la possibilité de déplacement vers une position cible//
     // la fonction prend  les nouvelles coordonnées $newX et $newY et l'angle de direction actuel $_currentAngle.
    private function checkMove(int $newX, int $newY, int $currentAngle)
    { // connexion base de données ($this->dbh) ->prepare(SELECT ) on récupére id qui correspont en fonction des coordoné et la direction 
         $stmt = $this->dbh->prepare("SELECT id FROM map WHERE coordx =:x AND coordy =:y AND direction =:a");
         $stmt->bindParam(':x', $newX);
         $stmt->bindParam(':y', $newY);
         $stmt->bindParam(':a', $currentAngle);
         $stmt->execute();  //  execute la requéte 
         $result = $stmt->fetch(PDO::FETCH_ASSOC);// $resulta de la requête SELECT dans un tableau associatif où chaque clé correspond à un nom de colonne dans la table de la base de données
         if(!empty($result)){ // si le resultat n'est pas vide
             return true;// le joueur peut se déplacer vers la nouvelle position
        }
        return false;  // le joueur ne peut pas se déplacer vers la nouvelle position
    }
 
    // Six méthodes publiques permettant de tester si un déplacement dans les quatre directions ou le changement d’angle de vue est possible // 
    public function checkForward()//vérifie la possibilité de ce deplacé vers  l'avant
    { 
         $newX = $this->currentX;  // stocke la valeur coordonnée X actuelle dans $newX.
         $newY = $this->currentY;  // stocke la valeur coordonnée Y actuelle dans $newY.
         switch($this->currentAngle){ // switch pour modifier la valeur de $newX et $newY en fonction de l'angle
            case 0 : {
                $newX++; // angle est de 0°  (droite), $newX est augmenté de 1
                break;
            }
            case 90 : {
                $newY++;  // angle est de 90°  (en Haut ), $newY est augmenté de 1
                break;
            }
            case 180 : {
                $newX--; // angle est de 180°  (gauche), $newX est diminué de 1
                break;
            }
            case 270 : {
                $newY--;  // angle est de 270°  (en BAS), $newY est diminué de 1
                break;
            }
        }
        return $this->checkMove($newX, $newY, $this->currentAngle);  // appelle la méthode privée "checkMove" (nouvelles coordonnées )
        // avec les nouvelles coordonnées ($newX et $newY) et l'angle de direction actuel ($currentAngle)
    }

    public function checkBack() // Vérifie si le joueur peut se déplacer vers l'arrière
    {
        $newX = $this->currentX;  // stocke la valeur coordonnée X actuelle dans $newX.
        $newY = $this->currentY;  // stocke la valeur coordonnée Y actuelle dans $newY.
        switch($this->currentAngle){ // switch pour modifier la valeur de $newX et $newY en fonction de l'angle
           case 0 : {  
               $newX --; // angle est de 0° (droite), $newX est diminué de 1 
               break;
           }
           case 90 : {  
               $newY --;  // angle est de 90° (en Haut ), $newY est diminué de 1
               break;
           }
           case 180 : {
               $newX ++; // angle est de 180° (gauche), $newX est augmenté de 1 
               break;
           }
           case 270 : {
               $newY ++;  // angle est de 270° (en BAS), $newY est augmenté de 1
               break;
           }
       }
       return $this->checkMove($newX, $newY, $this->currentAngle); // appelle la méthode privée "checkMove" (nouvelles coordonnées )
       // avec les nouvelles coordonnées ($newX et $newY) et l'angle de direction actuel ($currentAngle)
    }
    
    public function checkRight()  // Vérifie si le joueur peut se déplacer vers la droite
    {
        $newX = $this->currentX;  // stocke la valeur coordonnée X actuelle dans $newX.
        $newY = $this->currentY;  // stocke la valeur coordonnée Y actuelle dans $newY.
        switch($this->currentAngle){ // switch pour modifier la valeur de $newX et $newY en fonction de l'angle
           case 0 : {
               $newX --; // angle est de 0°  (droite), $newX est diminué de 1 
               break;
           }
           case 90 : {
               $newY ++;  // angle est de 90°  (en Haut ), $newY est augmenté de 1
               break;
           }
           case 180 : {
               $newX ++; // angle est de 180°  (gauche), $newX est augmenté de 1 
               break;
           }
           case 270 : {
               $newY --;  // angle est de 270°  (en BAS), $newY est  diminué de 1
               break;
           }
       }
       return $this->checkMove($newX, $newY, $this->currentAngle); // appelle la méthode privée "checkMove" (nouvelles coordonnées )
       // avec les nouvelles coordonnées ($newX et $newY) et l'angle de direction actuel ($currentAngle)
    }
    
    public function checkLeft()  // Vérifie si le joueur peut se déplacer vers la gauche
    {
        $newX = $this->currentX;  // stocke la valeur coordonnée X actuelle dans $newX.
        $newY = $this->currentY;  // stocke la valeur coordonnée Y actuelle dans $newY.
        switch($this->currentAngle){ // switch pour modifier la valeur de $newX et $newY en fonction de l'angle
           case 0 : {
               $newY ++; // angle est de 0° (droite), $newY est augmenté de 1 
               break;
           }
           case 90 : {
               $newX --;  // angle est de 90° (en Haut ), $newX est diminué  de 1
               break;
           }
           case 180 : {
               $newY --; // angle est de 180° (gauche), $newY est diminué  de 1 
               break;
           }
           case 270 : {
               $newX ++;  // angle est de 270° (en BAS), $newX est augmenté de 1
               break;
           }
       }
       return $this->checkMove($newX, $newY, $this->currentAngle);// appelle la méthode privée "checkMove" (nouvelles coordonnées )
       // avec les nouvelles coordonnées ($newX et $newY) et l'angle de direction actuel ($currentAngle)
    }
    
    // public function checkTurnRight()  // Vérifie si le joueur peut tourner à droite
    // {
    //     $newAngle = $this->currentAngle - 90; //newAngle = angle de vue - 90°   
    //     if ($newAngle < 0) { // si newAngle est inférieure 0° alors ->
    //         $newAngle = 270; // newAngle = 270°
    //     }
    //     return $this->checkMove($this->currentX, $this->currentY, $newAngle); // appelle la méthode privée "checkMove" (nouvelles coordonnées )
    //     // avec les nouvelles coordonnées de l'angle de direction actuel ($currentAngle)
    // }

    // public function checkTurnLeft()   // Vérifie si le joueur peut tourner à gauche
    // {
    //     $newAngle = $this->currentAngle + 90;//newAngle = angle de vue + 90°
    //     if ($newAngle > 270) {// si newAngle est superieure a 270° alors ->
    //         $newAngle = 0; // newAngle = 0°
    //     }
    //     return $this->checkMove($this->currentX, $this->currentY, $newAngle); // appelle la méthode privée "checkMove" (nouvelles coordonnées )
    //     // avec les nouvelles coordonnées de l'angle de direction actuel ($currentAngle)
    // }

    public function Move()
    {
        // connexion base de données ($this->dbh) ->prepare(SELECT ) on selectionne  id dans où coordx =:x et coordy =:y et direction =:a
        $stmt = $this->dbh->prepare("SELECT id FROM map WHERE coordx =:x AND coordy =:y AND direction =:a");
        $stmt->bindParam(':x', $this->currentX); // currentX est la valeur lié au paramettre :x
        $stmt->bindParam(':y', $this->currentY); // currentY est la valeur lié au paramettre :y
        $stmt->bindParam(':a', $this->currentAngle); // parametre :a et lié a la valeur currentAngle 
        $stmt->execute();  //  execute la requéte 
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // on recup les resultat dans un tableau associatifoù chaque clé correspond à un nom de colonne dans la table de la base de données
        $map_id = $result["id"]; // $map_id = resultat de l'id  par raport au cordonné trouver
        $this->currentMapID = $map_id;

        $stmt = $this->dbh->prepare("SELECT * FROM images WHERE map_id =:map_id");
        $stmt->bindParam(':map_id', $map_id );
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // on recup les resultat 
        $newMap = $result["path"];  // $newMap =  au resultat 
        $this->currentMap = $newMap;
        $this->currentMapID = $map_id;        
        $this->currentAngle = $this->currentAngle;
        
    }

   
    // Six méthodes publiques permettant d’effectuer un déplacement dans les quatre directions et de changer l’angle de vue //

    public function goForward()  // déplacer le joueur vers l'avant
    {
        if ($this->checkForward()) { // si checkForward et vérifier alors ->
            switch($this->currentAngle){
                case 0 : {
                    $this->currentX++; // angle est de 0° (droite), currentX est augmenté de 1 
                    break;
                }
                case 90 : {
                    $this->currentY++;  // angle est de 90° (en Haut ), currentY est augmenté de 1
                    break;
                }
                case 180 : {
                    $this->currentX--; // angle est de 180° (gauche), currentX est  diminué de 1 
                    break;
                }
                case 270 : {
                    $this->currentY--;  // angle est de 270° (en BAS), currenty est diminué de 1 
                    break;
                }
            }
            return $this->Move();  // appelle la méthode privée "Move" (nouveaux deplacement )
            // pour deplacer currentX , currentY et l'angle de direction actuel ($_currentAngle)
        } 
    }

    public function goBack()  // déplacer le joueur vers l'arriére
    {
        
        if ($this->checkBack()) { // si checkBack et vérifier alors ->
            switch($this->currentAngle){
                case 0 : {
                    $this->currentX--; // angle est de 0° (droite), currentX est diminué de 1 
                    break;
                }
                case 90 : {
                    $this->currentY--;  // angle est de 90° (en Haut ), currentY est diminué de 1
                    break;
                }
                case 180 : {
                    $this->currentX++; // angle est de 180° (gauche), currentX est  augmenté de 1 
                    break;
                }
                case 270 : {
                    $this->currentY++;  // angle est de 270° (en BAS), currentY est augmenté de 1 
                    break;
                }
            }
            return $this->Move(); // appelle la méthode privée "Move" (nouveaux deplacement)
            // pour deplacer currentX , currentY et l'angle de direction actuel ($_currentAngle)  
        }
        
    }
    public function goRight()  // déplacer le joueur vers la droite
    {
        if ($this->checkRight()) { // si checkRight et vérifier alors ->
            switch($this->currentAngle){
                case 0 : {
                    $this->currentY--; // angle est de 0° (droite), currentY est diminué de 1 
                    break;
                }
                case 90 : {
                    $this->currentX++;  // angle est de 90° (en Haut ), currentX est augmenté de 1
                    break;
                }
                case 180 : {
                    $this->currentY++; // angle est de 180° (gauche), currentY est augmenté  de 1 
                    break;
                }
                case 270 : {
                    $this->currentX--;  // angle est de 270° (en BAS), currentX est diminué de 1 
                    break;
                }
            }
            return $this->Move(); // appelle la méthode privée "Move" (nouveaux deplacement)
            // pour deplacer currentX , currentY et l'angle de direction actuel ($currentAngle)  
        }
        
    }
    public function goLeft()  // déplacer le joueur vers la gauche
    {
        if ($this->checkLeft()) { // si checkLeft et vérifier alors ->
            switch($this->currentAngle){
                case 0 : {
                    $this->currentY++; // angle est de 0° (droite), currentY est augmenté de 1 
                    break;
                }
                case 90 : {
                    $this->currentX--;  // angle est de 90° (en Haut ), currentX est diminué de 1
                    break;
                }
                case 180 : {
                    $this->currentY--; // angle est de 180° (gauche), currentY est diminué  de 1 
                    break;
                }
                case 270 : {
                    $this->currentX++;  // angle est de 270° (en BAS), currentX est augmenté de 1 
                    break;
                }
            }
            return $this->Move();// appelle la méthode privée "goMove" (nouveaux deplacement)
            // pour deplacer currentX , currentY et l'angle de direction actuel ($currentAngle)   
        } 
    }

    public function turnRight() // Tourne le joueur sur la droite
    {
          
          $this->currentAngle = $this->currentAngle - 90;// on enléve  90° a notre  angle
            if ($this->currentAngle < 0) { // si l'Angle est inférieure 0° alors ->
                $this->currentAngle = 270; // l'Angle = 270°
            }
            return $this->Move();
        }

    public function turnLeft() // Tourne le joueur sur la gauche
    {
        
          $this->currentAngle = $this->currentAngle + 90;// on ajoute  90° a notre  angle
            if ($this->currentAngle > 270) { // si l'Angle est superieure 270° alors ->
                $this->currentAngle = 0; // l'Angle = 0°
            }
            return $this->Move();
        }  
}