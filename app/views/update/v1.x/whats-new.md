# # What's new?
<br>
### Release v1.x
Released July 15, 2021

---
- fortified routes
- change csrf tokens to bcrypt algorithm
- change welcome page
- fix no showing of login page after deployed in a hosting server

#### Patch
- new
    - login and registration is not built in anymore
    - add option to integrate login and registration
    - added a package auth scaffolding named fortify : `composer require sprnva/fortify`

---

- old
    - install sprnva via composer. The command: "`composer create-project sprnva/sprnva example-app`"
    - refactor framework for centralized application updates
    - update your sprnva application via composer. The command: "`composer update`"
    - removed directory `system/`
    - removed unused css and js files
    - changed sprnva logo
    - `redirect()` with message will be formatted as `["message" => "", "status" => ""]`
    - added helper `with_msg()` with 2 params `["message" => "", "status" => ""]`
    - response message is now disposable
    - `msg()` helper is renamed to `alert_msg()` helper
    - added recommendation for controller method naming
    - added a new directory `public/storage`
    - renamed `config.example.php` to `config.example`