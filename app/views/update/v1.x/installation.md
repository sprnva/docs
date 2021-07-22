# # Installation
---
Sprnva is an open-source repository and is available at [github/sprnva](https://github.com/sprnva/sprnva/releases). You can just fork or download via zip/clone sprnva to your local computer via git or via composer. Go grab sprnva now!

## # Requirements
- Php version supported: **PHP >= php5.5** *`(latest version recommended)`*
- In order to run sprnva, you need to install `composer`. Composer is used for class autoloading and for future installation of different packages.
- apache and mysql server *(we can use xampp, wampServer and etc.)*

## # Installation Via Composer
If your computer already has PHP and Composer installed, you may create a new Sprnva project by using Composer directly :
```
composer create-project sprnva/sprnva example-app

cd example-app
```
- After the application has been created, you may start setting up the config with your credentials.
- <span style="color: red;">**if you don't want to add login and registration to your application**</span>:
    - in `config.php` set database `'name' => ''`
- <span style="color: red;">**if you want to add login and registration to your application**</span>:
    - after you're done setting up `config.php`, create a database name identical to your credentials in `config.php`
    - then go to migration in your url:
    ```
    localhost/example-app/migration
    ```
    - and click fresh button to migrate the default tables.
    - add auth scaffolding via composer :
    ```
    composer require sprnva/fortify
    ```
- finally, you can now build your desired applciation using sprnva.

## # Installing composer
##### <span style="color: red;">*(if not yet installed in your machine)*</span>

- Windows 
    - click here: [https://getcomposer.org/installer](https://getcomposer.org/installer)
- MacOS 
    - copy this to your terminal:
        ```
        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
        php composer-setup.php
        php -r "unlink('composer-setup.php');"
        ```
    - after the above command is done, copy and paste this to your terminal to make composer global:
        ```
        sudo mv composer.phar /usr/local/bin/composer
        ```

## # Config
In order to protect your credentials we avoid to pass config.php to git. After installation via composer change `config.php` to your credentials.

![alt text](public/storage/images/update-config.png)

**base_url** - it's used to tell the router which is the starting point to read a given url. In local and in hosting it is quite similar:
    - localhost
        - in htdocs we provide a folder name to store our application's files then we set `'base_url' => 'mySprnvaApp'` *("mySprnvaApp" is the folder name of your app)*
    - hosting server
        - if your application is inside a folder in a hosting server's domain like *`example.com/sprnva/login`* then set `'base_url' => 'sprnva'`
        - if your application is in the root directory of a hosting server's domain like *`example.com/login`* then set `'base_url' => ''`

**mysql_path** - For more flexible database migration please indicate the path of mysql in your machine including the trailing slashes.

**Environment** - this is to identify if your app is for development only or for production. Some modules may not work in production due to security reasons.