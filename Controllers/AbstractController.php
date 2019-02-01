<?php

namespace Controllers;
class  AbstractController
{
    public function getParameter($parm, $default = null, $tab)
    {
        return isset($tab[$parm]) ? $tab[$parm] : $default;
    }

    public function render($name, $data)
    {
        $loader = new \Twig_Loader_Filesystem('templates');

        $twig = new \Twig_Environment($loader, [
            //'cache' => 'caches',
        ]);

        return $twig->render($name, $data);
    }

    public function getUserId()
    {
        return $this->getParameter(
            'id',
            null,
            $_SESSION['user']
        );
    }
}

?>