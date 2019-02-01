<?php
function login($email, $password)
{
    $bdd = db::getInstance()->getConnexion();
    $sql = "select * from user where email=:email and password=:password";
    $req = $bdd->prepare($sql);

    $req->execute([
        'email' => $email,
        'password' => $password
    ]);

    $user = $req->fetch();
    if ($user) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'age' => $user['age'],
            'role' => $user['role']
        ];

        return true;
    } else {
        return false;
    }
}

function logout()
{
    unset($_SESSION['user']);
}

function isConnected()
{
    return isset($_SESSION['user'])
        && $_SESSION['user']['role'] != "anonyme";
}

function isSecuredActionRequested($module, $action)
{
    $securedActions = [
        ['module' => 'event', 'action' => 'listuser'],
        ['module' => 'user', 'action' => 'dashboard']
    ];

    foreach ($securedActions as $securedAction) {
        if (($securedAction['module'] == $module)
            && ($securedAction['action'] == $action)) {
            return true;
        }
    }
    return false;
}

function isUserAuthorisedOnModuleAction($module, $action, $role)
{
    $rolesTree = [
        'admin' => ['admin','event_manager', 'anonyme'],
        'event_manager' => ['anonyme','event_manager'],
        'anonyme' => ['anonyme'],
    ];

    $securedActions = [
        'admin' => [
            ['module' => 'topic', 'action' => 'add']
        ],
        'event_manager' => [
            [
                'module' => 'event',
                'action' => 'listuser'
            ],
            [
                'module' => 'event',
                'action' => 'add'
            ],
            [
                'module' => 'event',
                'action' => 'edit'
            ],
            [
                'module' => 'event',
                'action' => 'update'
            ],
            [
                'module' => 'event',
                'action' => 'delete'
            ],
            [
                'module' => 'event',
                'action' => 'bookingevent'
            ],
            [
                'module' => 'user',
                'action' => 'logout'
            ],
            [
                'module' => 'user',
                'action' => 'dashboard'
            ],[
                'module' => 'event',
                'action' => 'booking'
            ]
        ],
        'anonyme' => [
            [
                'module' => 'default',
                'action' => 'index'
            ],
            [
                'module' => 'event',
                'action' => 'search'
            ],
            [
                'module' => 'user',
                'action' => 'login'
            ]
        ]
    ];

    $roles = [];
    //print '<pre>';

    foreach ($rolesTree[$role] as $item){
        $roles = array_merge($roles, $securedActions[$item]);
    }

    //print_r($roles);
    //exit();
    foreach ($roles as $securedAction) {
        if (($securedAction['module'] == $module)
            && ($securedAction['action'] == $action)) {
            return true;
        }
    }

    return false;
}

function signup($name, $email, $password, $age)
{
    $dbb = db::getInstance()->getConnexion();

    $sql = "insert into user (name,email,password,age) values (:name,:email,:password,:age)";
    $req = $dbb->prepare($sql);
    $req->execute(
        [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'age' => $age
        ]
    );
}

 function isEmail($email){
    $dbb = db::getInstance()->getConnexion();
    $sql= 'select count(*) from user where email=:email';
    $req = $dbb->prepare($sql);
     $req->execute(['email'=>$email]);
   $reslt= $req->fetch();
    return $reslt[0] ;
}

function editProfile()
{
}
