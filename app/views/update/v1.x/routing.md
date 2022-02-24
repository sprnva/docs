# Routing

- [Routing](#routing)
  - [Introduction](#introduction)
  - [Route with parameter](#route-with-parameter)
  - [Route with multiple parameters](#route-with-multiple-parameters)
  - [Route with closure](#route-with-closure)
  - [Route Grouping](#route-grouping)
  - [Route Controller Grouping](#route-controller-grouping)

---

<a name="introduction" style="padding-top: 30px;">&nbsp;</a>

## Introduction

Sprnva has a beautiful routing built in. Route is our traffic control of our application that tells the entire application which page to be loaded when we hit a certain url. 

You will find the routes at `config/routes/web.php`. Then this is how you declare a basic route.
```php
Route::get('/uri', ['Controller@method', ['middleware']]);
```

**/uri** - the route you want to define.

**['Controller@method', ['middleware']]** - the action of the `/uri`

**middleware** - handles the protection of our routes basically our guardians.

**Middleware Present:**
- **auth** : is the route guardian to protect your routes from direct access in the URL without authentication. If not specified the route will be accessible without authentication.

Sprnva routing supports this following methods:
```php
Route::get($uri, $action);
Route::post($uri, $action);
Route::put($uri, $action);
Route::patch($uri, $action);
Route::delete($uri, $action);
Route::options($uri, $action);
```

This is what a basic route look like:
```php
// routes is accessible without authenticating
Route::get("/register", ['RegisterController@index']);
Route::post("/register", ['RegisterController@store']);

// routes is accessible only if authenticated
Route::get("/profile", ['ProfileController@index', ['auth']]);
Route::post('/profile', ['ProfileController@update', ['auth']]);
```
where profile route is protected by middleware auth. It means you cannot access this route directly in the URL without authenticating.

<a name="route-with-parameter" style="padding-top: 30px;">&nbsp;</a>

## Route with parameter

There's an instance that we need to pass a parameter to our routes. Just remember that inside the braces `{your-desired-name}` you can define your desired name for your id's or parameters.This is how we do it in sprnva.

```php
Route::get("/profile/detail/{id}", ['ProfileController@detail', ['auth']]);
```
Then the controller's method accepts a parameter.

```php
<?php

namespace App\Controllers;

class UsersController
{
    public function detail($id){
        //code here
    }
}
```

<a name="route-with-multiple-parameters" style="padding-top: 30px;">&nbsp;</a>

## Route with multiple parameters

There's an instance that we need to pass a multiple parameter to our route. Just remember that the `{your-desired-name}` is strict and does not allow same `{your-desired-name}` in the defined uri. Then this is how we do it in sprnva.
```php
Route::get("/project/view/{id}/test/{userid}", ['ProjectController@view', ['auth']]);
```
Then the controller's method accepts the parameters.
```php
<?php

namespace App\Controllers;

class UsersController
{
    public function view($id, $userid){
        //code here
    }
}
```

<a name="route-with-closure" style="padding-top: 30px;">&nbsp;</a>

## Route with closure

Sometimes we do not need a controller to display a view we just need to define a callable parameter in our routes.
```php
Route::get('/home', function () {
    $pageTitle = "Home";
    return view('/home', compact('pageTitle'));
});
```
With this callable parameter we can do some logic in our routes or even query our database to fetch some data and then pass to our views.

We can also pass the route with a parameter and access it inside our callable parameter in our route.
```php
Route::get('/profile/detail/{id}', function ($id) {
   echo $id;
});
```

<a name="route-grouping" style="padding-top: 30px;">&nbsp;</a>

## Route Grouping

We sometimes need to group our routes to save extra coding more prefixes and one-by-one tagging out middleware auth. Route groupings is here to save you.
```php
Route::group($param, $action);
```
**$param** : is an array that contains the prefix and the middleware of the group.

**$action** : is a function where we declare the routes inside.

For example, let's take a look with route grouping in our profile route.
```php
Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function () {
    Route::get("/", ['ProfileController@index']);
    Route::post('/', ['ProfileController@update']);
    Route::post('/changepass', ['ProfileController@changePass']);
    Route::post('/delete', ['ProfileController@delete']);
});
```
grouping is just like saying: `(/profile, /profile/changepass, /profile/delete)`.

First we need to define a prefix to our group by saying `['prefix' => 'your-desired-prefix']` and we define the middleware saying `['middleware' => ['auth']]`. Basically when saying `['middleware' => ['auth']]` all the routes the we define inside the group will be protected by auth. If you are not authenticated you cannot access this defined routes.

<a name="route-controller-grouping" style="padding-top: 30px;">&nbsp;</a>

## Route Controller Grouping

If a group of routes all utilize the same controller, you may use the controller method to define the common controller for all of the routes within the group. Then, when defining the routes, you only need to provide the controller method that they invoke.

```php
Route::controller($param, $action);

// grouping the common controller
// dont write same controller repeatedly
Route::controller(['WelcomeController'], function () {
		
    // you can set the controller method as string
    Route::get('/settings', 'settings');
	
    // you can also set the controller method as array
    Route::get('/settings/add', ['create']);
    
    // you can also add middleware auth to a grouped controller
    // if there's no global middleware set in the parent
    Route::get('/settings/add', ['create', ['auth']]);

});
```

This is how easy we declare and used routing in sprnva.