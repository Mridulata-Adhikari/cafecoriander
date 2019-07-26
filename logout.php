<?php

session_start();
require_once 'class.user.php';
$user = new USER();

if(!$user->is_logged_in()) //if user is not logged in redirect to sign in /index page
{
    $user->redirect('index.php');
}

if($user->is_logged_in()!="") //if the user is logged in and selects log out, they are redirected to the index page
{
    $user->logout();
    $user->redirect('index.php');
}
?>