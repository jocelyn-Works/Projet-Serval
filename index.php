<?php
session_start();
function autoloader($class_name) {
    include './classes/' . $class_name . '.class.php';
}

spl_autoload_register('autoloader');
// connexion 
$db = new Database();
// les fonctions
$bc = new BaseClass();
$fpv = new FirstPersonView();
$fpt = new FirstPersonText();
$fpa = new FirstPersonAction();


if (!empty($_POST)){ 
    $fpv->setcurrentX($_POST['X']);
    $fpv->setcurrentY($_POST['Y']);
    $fpv->setcurrentAngle($_POST['Angle']);
    $fpv->setcurrentMapID($_POST['MapID']);
    $fpt->setcurrentX($_POST['X']);
    $fpt->setcurrentY($_POST['Y']);
    $fpt->setcurrentAngle($_POST['Angle']);
    $fpt->setcurrentMapID($_POST['MapID']);
   
}


// // tourner a gauche
if (isset($_POST['turnLeft'])) {
    $fpv->turnLeft();
    $fpv->getAnimCompass();
}

// // déplacer le joueur vers l'avant
if (isset($_POST['goForward'])) {
    $fpv->goForward();
}

// // tourner a droite
if (isset($_POST['turnRight'])) {
    $fpv->turnRight();
    $fpv->getAnimCompass();
}

// // déplacer le joueur vers la gauche
if (isset($_POST['go-left'])) {
    $fpv->goLeft();
}
// prendre l'objet
if (isset($_POST['catch'])) {
    $fpa->doAction();
}

// // déplacer le joueur vers la droite
if (isset($_POST['go-right'])) {
    $fpv->goRight();
}

// // déplacer le joueur vers le bas
if (isset($_POST['goBack'])) {
    $fpv->goBack();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <title>Serval</title>
</head>
<body>
    <div class="container">
        <div class="first-view" method="post">
        <img src="./images/<?= $fpv->getView();?>">
        </div>
        <div class="play">
            <form class="boutons" method="post" action="index.php">
                <div class="mouve">
                    <div class="up">
                        <button name="turnLeft"><ion-icon  name="return-up-back-outline"></ion-icon></button>
                        <button name="goForward" <?php if(!$fpv->checkForward())  { ?> disabled <?php } ?> ><ion-icon name="chevron-up-outline"></ion-icon></button>
                        <button name="turnRight"><ion-icon name="return-up-forward-outline"></ion-icon></button>
                    </div>
                    <div class="middle">
                        <button name="go-left" <?php if(!$fpv->checkLeft())  { ?> disabled <?php } ?>><ion-icon name="chevron-back-outline"></ion-icon></button>
                        <button name="catch"  <?php if(!$fpa->checkAction())  { ?> disabled <?php } ?>><ion-icon name="hand-right-outline"></ion-icon></button>
                        <button name="go-right" <?php if(!$fpv->checkRight())  { ?> disabled <?php } ?>><ion-icon name="chevron-forward-outline"></ion-icon></button>
                    </div>
                    <div class="down">
                        <button name="goBack" <?php if(!$fpv->checkBack())  { ?> disabled <?php } ?>><ion-icon name="chevron-down-outline"></ion-icon></button>
                    </div>
                    <input type="hidden" name="X" value="<?= $fpv->getcurrentX(); ?>">
                    <input type="hidden" name="Y" value="<?= $fpv->getcurrentY(); ?>">
                    <input type="hidden" name="Angle" value="<?= $fpv->getcurrentAngle(); ?>">
                    <input type="hidden" name="MapID" value="<?= $fpv->getcurrentMapID(); ?>">
                </div>
                <div class="compass">
                    <div class="<?= $fpv->getAnimCompass() ?>"> <img src="./assets/compass.png" alt="" width="170px" height="170px"></div>
                </div>
            </form>
            <div class="text">
                <?= $fpt->getText()?>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
// var_dump($bc);
var_dump($fpv);
var_dump($fpt);
// var_dump($fpa);
?>
