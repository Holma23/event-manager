<?php
spl_autoload_register(function($class){
    //echo $class;
    //echo "<br>";
    $file = str_replace('\\', '/', $class);
    require($file.".php");
});