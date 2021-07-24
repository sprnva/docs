<?php

use App\Core\App;
use App\Core\Auth;
use App\Core\Request;

$router->post('/change-version', function () {
    $request = Request::validate();
    $_SESSION['VERSION'] = $request['selectedVersion'];
});

// your routes goes here
$router->get('/', ['WelcomeController@whatsNew']);
$router->get('/introduction', ['WelcomeController@introduction']);
$router->get('/installation', ['WelcomeController@installation']);
$router->get('/upgrade-guide', ['WelcomeController@upgradeGuide']);
$router->get('/file-structure', ['WelcomeController@fileStructure']);
$router->get('/databases', ['WelcomeController@databases']);
$router->get('/authentication', ['WelcomeController@authentication']);
$router->get('/registration', ['WelcomeController@registration']);
$router->get('/migration', ['WelcomeController@migration']);
$router->get('/routing', ['WelcomeController@routing']);
$router->get('/controllers', ['WelcomeController@controllers']);
$router->get('/views', ['WelcomeController@views']);
$router->get('/helpers', ['WelcomeController@helpers']);
$router->get('/alerts', ['WelcomeController@alerts']);
$router->get('/argon-template', ['WelcomeController@argonTemplate']);
$router->get('/adminty-template', ['WelcomeController@admintyTemplate']);
$router->get('/adminlte-template', ['WelcomeController@adminlteTemplate']);
$router->get('/email', ['WelcomeController@email']);
$router->get('/csrf', ['WelcomeController@csrf']);
$router->get('/validation', ['WelcomeController@validation']);
$router->get('/credits', ['WelcomeController@credits']);
$router->get('/deployment', ['WelcomeController@deployment']);

$router->group(["prefix" => "packages"], function ($router) {
    $router->get('/fortify', ['WelcomeController@fortify']);
});
