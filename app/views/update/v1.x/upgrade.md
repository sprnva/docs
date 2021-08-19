# Upgrade Guide

- [High Impact Changes](#high-impact)
- [Medium Impact Changes](#medium-impact)

###### `Upgrading To v1.x`
---
Updating Dependencies via Composer
- First we need to update the `composer.json` file
    ```json
    "require": {
        "sprnva/fortify": "^1.0",
        "sprnva/framework": "^1.3"
    }
    ```

If `sprnva/fortify` is not present in your composer.json, maybe your application is not using login and registration or your application is not yet using the sprnva fortify package.

- if your application is not using login and registration skip this steps:
    - if your application is using login and registration but not the sprnva fortify: *`NOTE: only use fortify if you want to use it otherwise you are free to make your own login ang registration system.`*
        - run `composer require sprnva/fortify`
    - if your application is already using `sprnva/fortify`:
        - update version `"sprnva/fortify": "^1.0"` in composer.json
- to update dependencies open cmd and execute this command: `composer update`

<a name="high-impact" class='pt-5'></a>
### High Impact Changes
- needs internet to update
- refactor some of the old files if present in your current version
    - remove `auth` directory in :
        - app/controllers/Auth/
        - app/views/auth/
        - config/routes/auth.php
    - check if `app/views/layouts/profile.php` is present.
        - if not present:
            - create a file `app/views/layouts/profile.php`
            - then copy all the content of this file: [app/views/layouts/profile.php](https://github.com/sprnva/sprnva/blob/master/app/views/layouts/profile.php)
    - run `composer update` to update your version.

<a name="medium-impact" class='pt-5'></a>
### Medium Impact Changes
- remove the `system/` directory
- in `index.php` remove the boostrap require line:
    ```php
    require 'system/bootstrap.php'; //remove this
    ```
    - change the line `use App\Core\Router;` to `use App\Core\Routing\Route;`
    - change the `Router::load` registration to this:
    ```php
    Route::register(
        // request uri
        Request::uri(),
        // the method use of the uri
        Request::method()
    );
    ```
- everytime a new version is release just `composer update` to update your framework