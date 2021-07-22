# # Upgrade Guide
###### `Upgrading To v1.x`
---
Updating Dependencies via Composer
- First we need to update the `composer.json` file
    ```
    "require": {
        "sprnva/fortify": "^1.0",
        "sprnva/framework": "^1.3"
    }
    ```

If `sprnva/fortify` is not present in your composer.json, maybe your application is not using login and registration or your application is not yet using the sprnva fortify package.

- if your application is not using login and registration skip this steps:
    - if your application is using login and registration but not yet sprnva fortify:
        - run `composer require sprnva/fortify`
    - if your application is already using `sprnva/fortify`:
        - update version `"sprnva/fortify": "^1.0"` in composer.json
- to update dependencies open cmd and execute this command: `composer update`

### # High Impact Changes
- needs internet to update
- restructure old login and registration. We are now using sprnva fortify
    - remove `auth/` directory in :
        - app/controllers/Auth/
        - app/views/auth/
        - config/routes/auth.php
    - check if `app/views/layouts/profile.php` is present.
        - if not present:
            - create a file `app/views/layouts/profile.php`
            - then copy all the content of this file: [app/views/layouts/profile.php](https://github.com/sprnva/sprnva/blob/master/app/views/layouts/profile.php)
    - if you are using login and registration run `composer update` skip otherwise.

### # Medium Impact Changes
- remove the `system/` directory
- in `index.php` remove the boostrap include:
```
require 'system/bootstrap.php';
```
- in `index.php` change the `Router::load` parameter to:
```
Router::load(__DIR__ . '/vendor/sprnva/framework/src/Routes.php')
```
- everytime a new version is release just `composer update` to update your framework