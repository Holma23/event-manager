<?php

namespace Controllers;
class TopicController extends AbstractController {
    public function listAction(){}
    public function addAction(){
        include_once('models/topic.php');
        $name=$this->getParameter('name',null,$_POST);
        $isSent=$this->getParameter('is_sent',null,$_POST);
        $imageFile = $this->getParameter('image', null, $_FILES);
        print_r($_FILES);
        if($isSent){
               addTopic($name, $imageFile);
           }


        include('templates/topic/add.php');
        
    }
}
?>