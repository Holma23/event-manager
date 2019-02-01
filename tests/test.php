<?php
//      include ('huge-coders/db.php');
//include ('github/db.php');

spl_autoload_register(function($class){
    echo $class;
    $file = str_replace('\\', '/', $class);
    require('../'.$file.".php");
});

use Tests\Github\db as githubDb;
use Tests\HugeCoders\db as hugecodersDb;

$db = new githubDb();
echo $db->sayHello();


$db = new hugecodersDb();
echo $db->sayHello();