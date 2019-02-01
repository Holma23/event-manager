<?php

namespace Controllers;
class EventController extends AbstractController
{
    public function bookingeventAction()

    {
        $results = [];

        include("models/event.php");
        $userId = $this->getParameter('id', null, $_SESSION['user']);
        $results = getEventsBookedByUser($userId);
        include("templates/event/bookingeventlist.php");

    }

    public function cancelbookingAction()
    {
        include("helpers/js.php");
        include("models/event.php");
        $userId = $this->getParameter('id', null, $_SESSION['user']);
        $eventId = $this->getParameter('id', null, $_GET);

        cancelBooking($userId, $eventId);
        redirectJs('index.php?module=event&action=bookingevent');


    }

    public function addAction()
    {
        include_once('models/event.php');
        include_once('models/topic.php');
        include_once ('helpers/js.php');

        $message = null;
        $name = $this->getParameter('name', null, $_POST);
        $topicId = $this->getParameter('topic_id', null, $_POST);
        $beginAt = $this->getParameter('begin_at', null, $_POST);
        $endAt = $this->getParameter('end_at', null, $_POST);
        $maxPlace = $this->getParameter('max_place', null, $_POST);
        $isSent = $this->getParameter('is_sent', null, $_POST);
        $imageFiles = $this->getParameter('image', null, $_FILES);
        //echo "<pre>";
        //print_r($imageFiles);
        $topics = getTopics();
        if (!$name || !$topicId) {
            http_response_code(500);
            echo json_encode(["message" => "Error champs manquant"]);
        } else {
            addEvent([
                'name' => $name,
                'topic_id' => $topicId,
                'begin_at' => $beginAt,
                'end_at' => $endAt,
                'user_id' => 11,
                'max_place' => $maxPlace
            ], $imageFiles);
            header('Content-Type: application/json');

            echo json_encode(["message" => "Insertion effectué avec success"]);

        }

    }

    public function deleteAction()
    {
        include_once ('models/event.php');
        include_once ('helpers/js.php');
        $id = $this->getParameter('id', null, $_GET);
        $event = getEventById($id);
        removeEvent($event);
        
        //redirectJs("index.php?module=event&action=listuser");
    }

    public function editAction()
    {
    }

    public function listAction()
    {
    }

    public function searchAction()
    {
        include_once('models/event.php');
        include_once('models/topic.php');
        $column = isset($_GET['column']) ? $_GET['column'] : 'id';
        $direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';
        $name = isset($_GET['name']) ? $_GET['name'] : null;
        $topicId = isset($_GET['topic_id']) ? $_GET['topic_id'] : null;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 1;

        $topics = getTopics();
        $events = searchEvents(
            $name,
            $topicId,
            null,
            $column,
            $direction,
            $offset - 1,
            $limit
        );

        $pagesCount = searchEvents(
            $name,
            $topicId,
            null,
            $column,
            $direction,
            $offset - 1,
            $limit,
            true
        );
        $limitPagination = 3;
        $pages = range(0, $pagesCount);
        $step = count($pages) - $offset - $limitPagination;
        if (count($pages) - $offset - 1 < $limitPagination) {
            $pages = array_slice($pages, $offset - 1 + $step, $limitPagination);
        } else if ($offset == 0) {
            $pages = array_slice($pages, 0, $limitPagination);
        } else {
            $pages = array_slice($pages, $offset - 1, $limitPagination);
        }
        header('Content-Type: application/json');
        echo json_encode($events);
    }

    public function detailAction()
    {
        include_once("models/event.php");
        include_once("models/topic.php");
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $event = getEventById($id);
        //print_r($event);
        $topics = getTopics();

        include_once("templates/event/detail.php");
    }

    public function listuserAction()
    {
        include_once('models/event.php');
        include_once('models/topic.php');

        $column = isset($_GET['column']) ? $_GET['column'] : 'id';
        $direction = isset($_GET['direction']) ? $_GET['direction'] : 'asc';
        $name = isset($_GET['name']) ? $_GET['name'] : null;
        $topicId = isset($_GET['topic_id']) ? $_GET['topic_id'] : null;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 1;

        $topics = getTopics();
        $events = searchEvents(
            $name,
            $topicId,
            $_SESSION['user']['id'],
            $column,
            $direction,
            $offset - 1,
            $limit
        );

        $pagesCount = searchEvents(
            $name,
            $topicId,
            $_SESSION['user']['id'],
            $column,
            $direction,
            $offset - 1,
            $limit,
            true
        );
        $limitPagination = 3;
        $pages = range(0, $pagesCount);
        $step = count($pages) - $offset - $limitPagination;
        if (count($pages) - $offset - 1 < $limitPagination) {
            $pages = array_slice($pages, $offset - 1 + $step, $limitPagination);
        } else if ($offset == 0) {
            $pages = array_slice($pages, 0, $limitPagination);
        } else {
            $pages = array_slice($pages, $offset - 1, $limitPagination);
        }

        include('templates/event/listuser.php');
    }

    public function bookingAction()
    {
        include_once('models/event.php');
        include_once('models/user.php');
        include_once('helpers/js.php');
        $eventId = $this->getParameter('id', null, $_GET);
        $event = getEventById($eventId);
        $message = null;
        //Traitemenet
        if (isConnected()) {
            if (!isEventReservable($event)) {
                $message = "l'evennement n'est plus disponile";
            } else {
                $user = $this->getParameter('user', null, $_SESSION);
                eventBooking($user['id'], $event);
            }
            include('templates/event/booking.php');
        } else {
            $_SESSION['event_id'] = $eventId;
            redirectJs('index.php?module=user&action=login');
        }
    }
}
