# Installation

- [Installation](#installation)
  - [Requirements](#requirements)
    - [Download Sprnva zip no composer required](#download-sprnva-zip-no-composer-required)
  - [Install Sprnva Using Composer](#install-sprnva-using-composer)
  - [The Config](#the-config)

---
Sprnva is an open-source framework and repository is available at [github/sprnva](https://github.com/sprnva/sprnva). You can see what we sweat behind the scenes in Sprnva through this repository.

<a name="requirements" style="padding-top: 30px;">&nbsp;</a>
## Requirements
- **Php** version supported: **PHP >= php5.6** *`(latest version recommended)`*
- In order to run sprnva, you need to install **composer**. Composer is used for class autoloading and for future installation of different packages.
- **apache** and **mysql** server *(we can use xampp, wampServer and etc.)*

<a name="install-sprnva-zip" style="padding-top: 30px;">&nbsp;</a>
### Download Sprnva zip no composer required
click here to download: [sprnva-no-composer.zip](https://github.com/sprnva/sprnva-no-composer/archive/refs/heads/main.zip)

- duplicate `config.example` and rename it to `config.php`
- setup `config.php` credentials
- set `'base_url' => 'example-app'` *('example-app' is the directory name of your application)*
- Create a database identical to your config then go to  `/migration`module with this URL:
```
http://localhost/example-app/migration
```
- click fresh button to migrate default tables
- You can start building your application

<a name="install-sprnva" style="padding-top: 30px;">&nbsp;</a>
## Install Sprnva Using Composer
If your computer already has PHP and Composer installed, you may create a new Sprnva project by using Composer directly :

```bash
composer create-project sprnva/sprnva example-app

cd example-app
```

- After the application has been created, you may start setting up the config with your credentials.
- set `'base_url' => 'example-app'` *('example-app' is the directory name of your application)*
- <span style="color: red;">**if you don't want to add login and registration to your application**</span>:
    - in `config.php` set database `'name' => ''`
- <span style="color: red;">**if you want to add login and registration to your application**</span>:
    - after you're done setting up `config.php`, create a database and the name should be the same to your credentials in `config.php`
    - then we will migrate the default tables. In your browser type this in your url:
    ```bash
    localhost/example-app/migration
    ```
    - when the migration module shows, click the fresh button to migrate the default tables.
    - then add the authentication called fortify via composer :
    ```bash
        composer require sprnva/fortify

        php vendor/sprnva/fortify/serve

        # or you can use the
        php fortify_serve
    ```
- finally, you can now build your desired application using sprnva.

<a name="config" style="padding-top: 30px;">&nbsp;</a>
## The Config
In order to protect your sensitive credentials, we ignore `config.php` to be committed in the source control. After installation via composer, fill in your desired credentials and know more of it below.

```php
<?php

$config = [

    // DATABASE
    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => '',
    'username'  => 'root',
    'password'  => '',

    // APP CONFIG
    'base_url' => '',
    'app_name' => '',

    // for more flexible database migration please indicate 
    // the path of mysql in your machine including the trailing slashes.
    'mysql_path' => '',

    // choices: development, production
    'environment' => 'development',

    // EMAIL
    'smtp_host'     => '',
    'smtp_username' => '',
    'smtp_password' => '',
    'smtp_auth'     => true,
    'smtp_auto_tls' => true,
    'smtp_port'     => 25,

];
```

**base_url** - it's used to tell the router which is the starting point to read a given url. In local and in hosting it is quite similar:
    - **localhost development**
        - in htdocs we provide a folder name to store our application's files and directories right? then all we have to do is set the `'base_url' => 'example-app'` *("example-app" is the folder name of your app in htdocs)*
    - **hosting server deployment**
        - if your application is inside a folder in a hosting server's domain like *`example.com/sprnva/login`* then set `'base_url' => 'sprnva'`
        - if your application is in the root directory of a hosting server's domain like *`example.com/login`* then set `'base_url' => ''`

**mysql_path** - In order to maximize the use of database migration module please indicate the path of `mysql/bin` in your machine including the trailing slashes.

**Environment** - this is to identify if your app is for development only or for production. Note that in production mode, some modules may not work due to security reasons and to avoid conflicts and error in your application.
