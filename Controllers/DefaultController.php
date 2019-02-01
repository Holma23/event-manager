<?php
namespace Controllers;
class DefaultController extends AbstractController {
    public function indexAction(){
        echo $this->render('default/index.html',
            [
                'xyz' => "test",
                'name' => 'Huge-coders',
                'events' => [[
                    "name" => "new Event",
                    "created_at" => new \DateTime()
                ]]
            ]
        );
    }
    public function notfoundAction(){
        echo $this->render('default/notfound.html',
            [
                'xyz' => "test",
                'name' => 'Huge-coders',
                'events' => [[
                    "name" => "new Event",
                    "created_at" => new \DateTime()
                ]]
            ]
        );
    }
}
