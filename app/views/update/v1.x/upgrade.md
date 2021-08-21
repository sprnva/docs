# Upgrade Guide

- [Fortify](#fortify)
    - [Install Fortify](#install)
    - [Upgrade Fortify](#upgrade)
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
- please check the Fortify if you want to `Install Fortify` and use it to create a login and registration for your application or if you had an existing fortify install and want to upgrade it to the latest version refer to the `Upgrade Fortify` below.
- after you check or update the require option you have to run this command in your terminal :
```bash
composer update
```

<a name="fortify" style="padding-top: 30px;">&nbsp;</a>
## Fortify
If `sprnva/fortify` is not present in the require option in your `composer.json` file, then it's okay don't worry maybe your application is not using authentication system or login and registration system.

Fortify is the authentication scaffolding for your application. It contains login, registration, password-reset and profile out of the box. All the files can be customize depending on your need.

`NOTE: only use fortify if you want to use it otherwise you are free to make your own login ang registration system.`

<a name="install" style="padding-top: 30px;">&nbsp;</a>
#### Install Fortify
If you want to use `Fortify` to create an authentication scaffolding for your application do this step on your terminal:

```bash
composer require sprnva/fortify

php fortify
```

- all authentication files are customizable and can be view in this directories:
    - Controllers : `app/controllers/Auth/`
    - Views : `app/views/auth/`
    - Route : `config/routes/auth.php`

<a name="upgrade" style="padding-top: 30px;">&nbsp;</a>
#### Upgrade Fortify
If you already had fortify in your application and you want to upgrade them to the lates `1.x` version then do this step:
    - check `compose.json` if fortify is present in the require option
        - if fortify is not present, install fortify.
        - if fortify is present in the require option, check the version and then we can now update fortify on your terminal using:

        ```bash
        composer update

        php fortify
        ```
        - if `app/views/layouts/profile.php` exist then delete this file because we are no longer requiring this file when using our fortify scaffold.

<a name="high-impact" style="padding-top: 30px;">&nbsp;</a>
### High Impact Changes
- needs internet to update

<a name="medium-impact" style="padding-top: 30px;">&nbsp;</a>
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