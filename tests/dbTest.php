<?php
//include ('../models/db.php');
function testInstance(){
$bdd = db::getInstance()->getConnexion();

if ($bdd instanceof PDO){
    echo "TEST success";
} else {
    echo "TEST failed";
}}
function testEmailExist(){
   include ('models/user.php');
    checkemail('ahlem');
}
testEmailExist();