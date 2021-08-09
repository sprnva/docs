# What's new?
Sprnva and its other first-party packages follow Semantic Versioning. No particular date when releasing Major updates to the framework, while minor and patch releases may be released as often as every week. Minor and patch releases should never contain breaking changes.

### Release v1.x
Released July 30, 2021

---
#### sprnva/framework v1.3.16
changes in core/framework
- added withCount helper
- dd now supports objects
- added new validation [`unique:{table}`]
- restructure routing [`$router→get()` to `Rout::get()`]
- refactor route middleware from string to array  `[{action}, 'auth']` to `[{action}, ['auth', 'register']]`

#### sprnva/sprnva v1.3.16
changes in core/app
- in `/index.php`
	- refactor `use App\Core\Router;` to: `use App\Core\Routing\Route;`
	- refactor `Router::load()` to:
		```php
		Route::register(
			// request uri
			Request::uri(),
			// the method use of the uri
			Request::method()
		);
		```

- in `config/routes/web.php`
	- below <?php add this: `use App\Core\Routing\Route;`
	- refactor `$router->` to: `Route::`
	- and when using auth middleware should be like this:
		```php
		Route::get('/home', ['WelcomeController@home', ['auth']]);
		```

#### sprnva/fortify v1.0.6
changes in package
- restructured routes from the latest released of the framework