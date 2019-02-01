<?php
function addImage($eventId, $imageFile){
    $targetDir = "assets/upload/";
    $targetFile = $targetDir . $imageFile['name'];
    move_uploaded_file($imageFile['tmp_name'], $targetFile);

    $bdd=db::getInstance()->getConnexion();
    $sql="insert into image  
          (name,event_id)
          values (:name,:event_id)";
    $req=$bdd->prepare($sql);
    $req->execute([
        'name'=>$imageFile['name'],
        'event_id' => $eventId
    ]);
}