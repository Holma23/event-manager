<?php
include_once ('models/db.php');
include_once ('models/image.php');
function searchEvents($name, $topicId, $userId, $column,
$dir,
$offset,
$limit, $isCount = false){
    $bdd = db::getInstance()->getConnexion();

    $sql = "select %s from event where true=true";
    if ($isCount){
        $sql = sprintf($sql, "count(*) as pages_count");
    } else {
        $sql = sprintf($sql, "*");
    }
    $data = [];
    if ($userId){
        $sql .= " and user_id =:id";
        $data['id'] = $userId;
    }

    if ($name){
        $sql .= " and name like :name";
        $data['name'] = '%'.$name.'%';
    }

    if ($topicId){
        $sql .= " and topic_id=:topic_id";
        $data['topic_id'] = $topicId;
    }
    if (!$isCount){
        $sql .= sprintf(' 
            order by %s %s limit %s, %s
        ',$column, $dir,$offset, $limit);
    }
    $req = $bdd->prepare($sql);
    $req->execute($data);

    return $isCount?
        ceil($req->fetch()['pages_count']/$limit):
        $req->fetchAll();
}
function getEventsBookedByUser($userId){

    $bdd=db::getInstance()->getConnexion();
    $sql='select * from event e inner join booking b on e.id = b.event_id where b.user_id=:user_id';
    $res=$bdd->prepare($sql);
    $res->execute(
        [
            'user_id'=>$userId
        ]
    );
return $res->fetchAll();
}

function cancelBooking($userId,$eventId)
{
    $bdd=db::getInstance()->getConnexion();
    $sql='delete from booking where user_id=:user_id and event_id=:event_id';
    $res=$bdd->prepare($sql);
    $res->execute(
        [ "user_id"=>$userId,
            "event_id"=>$eventId
        ]
    );


}


function getEventById($eventId){
    $bdd = db::getInstance()->getConnexion();

    $sql = "select * from event where id=:id";

    $req = $bdd->prepare($sql);
    $req->execute(['id'=>$eventId]);

        return $req->fetch();
}
function addEvent($data, $imageFiles){

    $bdd=db::getInstance()->getConnexion();
    $sql="insert into event  
          (name,topic_id,user_id,begin_at,end_at,max_place)
          values (:name,:topic_id,:user_id,:begin_at,:end_at,:max_place)";
    $req=$bdd->prepare($sql);
    $req->execute($data);
    $eventId = $bdd->lastInsertId();
    
    for ($i=0; $i<count($imageFiles['name']); $i++){
        addImage($eventId, [
            'name' => $imageFiles['name'][$i],
            'tmp_name' => $imageFiles['tmp_name'][$i],
        ]);
    }
}
function removeEvent($event){
    if ($event['image'] && file_exists($filePath ="assets/upload/".$event['image'])){
        unlink($filePath);
    }
    $bdd=db::getInstance()->getConnexion();
    $sql="delete from event where id = :id";
    $req=$bdd->prepare($sql);
    $req->execute(['id' => $event['id']]);
}
function editEvent($data, $eventId){
}
function isEventReserved($eventId, $userId){
    $bdd = db::getInstance()->getConnexion();
    $sql = "select count(*) from booking where user_id=:user_id and event_id=:event_id";
    $req= $bdd->prepare($sql);
    $req->execute([
        'event_id' => $eventId,
        'user_id' => $userId,
    ]);

    return $req->fetch()[0];
}
function eventBooking($userId, $event){
    $bdd = db::getInstance()->getConnexion();
    $sql = "Insert into booking (user_id, event_id) values (:user_id, :event_id)";
    $req = $bdd->prepare($sql);

    $req->execute([
        'user_id' => $userId,
        'event_id' => $event['id'],
    ]);
    $req = $bdd->prepare("update event set booking_count = :booking_count where id=:id");
    $req->execute([
        'booking_count' => $event["booking_count"]+ 1,
        'id' => $event['id']
    ]);

}


function isEventReservable($event){
    if ($event['max_place'] <= $event['booking_count']){
        return false;
    }

    if (new DateTime($event['end_at']) <= new DateTime("now")){
        return false;
    }

    if (isEventReserved($event['id'], $_SESSION['user']['id'])){
        return false;
    }

    return true;
}
function eventStatus($event){
    $status = [
        'max_place' => ["css" =>"btn btn-warning", "message" => "Désolé nombred eplace atteind"],
        'expired' => ["css" =>"btn btn-secondary", "message" => "Date expiré"],
        'reserved' => ["css" =>"btn btn-info", "message" => "Vous etes déjà inscrits"],
        'available' => ["css" =>"btn btn-success", "message" => "Clicker pour réserver"]
    ];
    //Comparer le nombre de reservation actuel
    //avec le nombrede resrevation max authorisés
    if ($event['max_place'] <= $event['booking_count']){
        return $status['max_place'];
    }

    if (new DateTime($event['end_at']) <= new DateTime("now")){
        return $status['expired'];
    }

    if (isEventReserved($event['id'], $_SESSION['user']['id'])){
        return $status['reserved'];
    }








    return $status['available'];
}