# # Upgrade Guide
###### `Upgrading To v1.x From v1.4.0`
---
Updating Dependencies via Composer
- First we need to update the `composer.json` file
    ```
    "require": {
        "sprnva/framework": "^1.3"
    }
    ```
- change the version of "`sprnva/framework`" to `^1.3`
- to update dependencies open cmd and execute this command: `composer update`

### # High Impact Changes
- needs internet to update

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