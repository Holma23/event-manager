<?php
include_once ('db.php');
function getTopics(){
    $bdd = db::getInstance()->getConnexion();
    $sql = "select * from topic";

    return $bdd->query($sql)->fetchAll();

}
function addTopic($name, $imageFile){
    // Dossier oule fichier finale sera uploadé
    $targetDir = "assets/upload/";
    // Path complet vers le fichiers de destination
    $targetFile = $targetDir . $imageFile['name'];
    // fonction natif php pour déplacer le fichier du dossier temporaire
    // vers ledossier upload
    move_uploaded_file($imageFile['tmp_name'], $targetFile);

    $bdd=db::getInstance()->getConnexion();
    $sql="insert into topic(name, image) values(:name, :image)";
    $req=$bdd->prepare($sql);
    $req->execute([
        "name"=>$name,
        "image" => $imageFile['name']
    ]);

}
function checkTopicIsUsed($topicId){}