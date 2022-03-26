<?php

use App\Core\Routing\Route;
use App\Core\Request;

Route::post('/change-version', function () {
    $request = Request::validate();
    $_SESSION['VERSION'] = $request['selectedVersion'];
});

// your routes goes here
Route::get('/', ['WelcomeController@introduction']);
Route::get('/whats-new', ['WelcomeController@whatsNew']);
Route::get('/introduction', ['WelcomeController@introduction']);
Route::get('/installation', ['WelcomeController@installation']);
Route::get('/upgrade-guide', ['WelcomeController@upgradeGuide']);
Route::get('/file-structure', ['WelcomeController@fileStructure']);
Route::get('/databases', ['WelcomeController@databases']);
Route::get('/querybuilder', ['WelcomeController@querybuilder']);
Route::get('/authentication', ['WelcomeController@authentication']);
Route::get('/registration', ['WelcomeController@registration']);
Route::get('/migration', ['WelcomeController@migration']);
Route::get('/routing', ['WelcomeController@routing']);
Route::get('/controllers', ['WelcomeController@controllers']);
Route::get('/views', ['WelcomeController@views']);
Route::get('/helpers', ['WelcomeController@helpers']);
Route::get('/alerts', ['WelcomeController@alerts']);
Route::get('/argon-template', ['WelcomeController@argonTemplate']);
Route::get('/adminty-template', ['WelcomeController@admintyTemplate']);
Route::get('/adminlte-template', ['WelcomeController@adminlteTemplate']);
Route::get('/email', ['WelcomeController@email']);
Route::get('/csrf', ['WelcomeController@csrf']);
Route::get('/validation', ['WelcomeController@validation']);
Route::get('/credits', ['WelcomeController@credits']);
Route::get('/deployment', ['WelcomeController@deployment']);

Route::group(["prefix" => "packages"], function () {
    Route::get('/fortify', ['WelcomeController@fortify']);
});
