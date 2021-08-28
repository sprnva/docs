# What's new?

- [Framework](#framework)
- [Sprnva File](#sprnva)
- [Fortify](#fortify)

Sprnva and its other first-party packages follow Semantic Versioning. No particular date when releasing Major updates to the framework, while minor and patch releases may be released as often as every week. Minor and patch releases should never contain breaking changes.

### Release v1.x
Released July 30, 2021

---

<a name="framework" style="padding-top: 30px;">&nbsp;</a>
#### sprnva/framework v1.3.16
changes in core/framework
- added withCount helper
- dd now supports objects
- added new validation [`unique:{table}`]
- restructure routing [`$router→get()` to `Rout::get()`]
- refactor route middleware from string to array  `[{action}, 'auth']` to `[{action}, ['auth', 'register']]`

<a name="sprnva" style="padding-top: 30px;">&nbsp;</a>
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

<a name="fortify" style="padding-top: 30px;">&nbsp;</a>
#### sprnva/fortify v1.0.6
changes in package
- restructured fortify to be more dynamic and customizable
- all authentication files are customizable and can be view in this directories:
	- Controllers : `app/controllers/Auth/`
	- Views : `app/views/auth/`
	- Route : `config/routes/auth.php`

To install fortify do this steps:

```bash
composer require sprnva/fortify

php vendor/sprnva/fortify/serve
```

To update existing fortify do this steps:

- check `compose.json` if fortify is present in the require option
	- if fortify is not present, install fortify.
	- if fortify is present in the require option, check the version and then we now update fortify using:

	```bash
	composer update
	```
	- delete the `app/views/layouts/profile.php` because we are no longer requiring this file using our fortify.
