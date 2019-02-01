<?php

namespace Controllers;

class UserController extends AbstractController
{

    public function signupAction()
    {
        include_once('models/user.php');
        include_once('helpers/js.php');
         $name = $this->getParameter('name', null, $_POST);
        $email = $this->getParameter('email', null, $_POST) ;
        $password =$this-> getParameter('password', null, $_POST);
        $age = $this->getParameter('age', null, $_POST) ;
        $sent = $this->getParameter('sent', null, $_POST);
        $message=null;
        if ($sent && $name && $email && $password && $age) {
            if(!isEmail($email)){
           signup($name, $email, $password, $age);
           redirectJs('index.php?module=user&action=login');}
            else{
                $message="email existe";

            }

        }
        include("templates/user/signup.php");

    }

    public function loginAction()
    {
        include_once('models/user.php');
        include_once('helpers/js.php');

        $message = null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $isSent = isset($_POST['is_sent']) ? $_POST['is_sent'] : null;

        if ($isSent && $email && $password) {
            if (login($email, $password)) {
                $url = 'index.php?module=user&action=dashboard';
                if ($eventId=$this->getParameter('event_id',null, $_SESSION)){
                    $url = 'index.php?module=event&action=booking&id='.$eventId;
                }
                redirectJs($url);
            } else {
                $message = "Utilisateur non valide";
            }
        }

        include('templates/user/login.php');
    }

    public function logoutAction()
    {
        include_once('models/user.php');
        include_once('helpers/js.php');
        logout();
        redirectJs('index.php');
    }

    public function dashboardAction()
    {
        include('templates/user/dashboard.php');
    }

    public function accessdeniedAction(){
        echo "vous n'etes pas authorisé à acceder à cette page";
    }
}