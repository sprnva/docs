# # Routing
---
Sprnva has a beautiful routing built in. You will find the routes at `config/routes/web.php`. Then this is how you declare a route.
```php
$router->get('/the-route-you-want', ['Controller@method', 'protection-with-auth']);
```

**/the-route-you-want** - the route you want to define.

**['Controller@method', 'protection-with-auth']** - array with 2 values `Controller@method` and `protection-with-auth`

**protection-with-auth** - is the route guardian to protect your routes from direct access in the URL without authentication. If not specified the route will be accessible without authentication.

Sprnva routing supports this following methods:
```php
$router->get($uri, $callback);
$router->post($uri, $callback);
$router->put($uri, $callback);
$router->patch($uri, $callback);
$router->delete($uri, $callback);
$router->options($uri, $callback);
```

This is what a basic route look like:
```php
$router->get("/register", ['RegisterController@index']);
$router->post("/register", ['RegisterController@store']);

$router->get("/profile", ['ProfileController@index', 'auth']);
$router->post('/profile', ['ProfileController@update', 'auth']);
```
where profile route is protected by auth. It means you cannot access this route directly in the URL without authenticating.

## # Route with parameter
There's an instance that we need to pass a parameter to our routes. This is how we do it in sprnva.
```php
$router->get("/profile/detail/{id}", ['ProfileController@detail', 'auth']);
```
Then the controller's method accepts a parameter.
```php
public function detail($id){
    //code here
}
```

## # Route with multiple parameters
There's an instance that we need to pass a multiple parameter to our route. This is how we do it in sprnva.
```php
$router->get("/project/view/{id}/test/{userid}", ['ProjectController@view', 'auth']);
```
Then the controller's method accepts the parameters.
```php
public function view($id, $userid){
    //code here
}
```

## # Route with function as callback
Sometimes we do not need a controller to display a view we just need to define a callable parameter in our routes.
```php
$router->get('/home', function () {
    $pageTitle = "Home";
    return view('/home', compact('pageTitle'));
});
```
With this callable parameter we can do some logic in our routes or even query our database to fetch some data and then pass to our views.

We can also get the route with a parameter and access it inside our callable parameter in our route.
```php
$router->get('/profile/detail/{id}', function ($id) {
   echo $id;
});
```

## # Route Grouping
We sometimes need to group our routes to save extra coding more prefixes and one-by-one tagging out middleware auth. Route groupings is here to save you.
```php
$router->group($param, $callback);
```
**$param** : is an array that contains the prefix and the middleware of the group.

**$callback** : is a function where we declare the routes inside.

For example, let's take a look with route grouping in our profile module.
```php
$router->group(['prefix' => 'profile', 'middleware' => ['auth']], function ($router) {
    $router->get("/", ['ProfileController@index']);
    $router->post('/', ['ProfileController@update']);
    $router->post('/changepass', ['ProfileController@changePass']);
    $router->post('/delete', ['ProfileController@delete']);
});
```
grouping is just like saying: `(/profile, /profile/changepass, /profile/delete)`.

First we need to define a prefix to our group by saying `['prefix' => 'your-desired-prefix']` and we define the middleware saying `['middleware' => ['auth']]`. Basically when saying `['middleware' => ['auth']]` all the routes the we define inside the group will be protected by auth. If you are not authenticated you cannot access this defined routes.

In `$callback` we pass the `$router` variable that contains our Router class instance with this, we can continue to register our routes inside our callback function.

This is how easy we declare and used routing in sprnva.