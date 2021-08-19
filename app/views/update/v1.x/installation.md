# Installation

- [Requirements](#requirements)
    - [Installing composer](#install-composer)
- [Install Sprnva Using Composer](#install-sprnva)
- [The Config](#config)

---
Sprnva is an open-source framework and repository is available at [github/sprnva](https://github.com/sprnva/sprnva). You can see what we sweat behind the scenes in Sprnva through this repository.

<a name="requirements" class='pt-5'></a>
## Requirements
- **Php** version supported: **PHP >= php5.6** *`(latest version recommended)`*
- In order to run sprnva, you need to install **composer**. Composer is used for class autoloading and for future installation of different packages.
- **apache** and **mysql** server *(we can use xampp, wampServer and etc.)*

<a name="install-composer" class='pt-5'></a>
## Installing composer
<span style="color: red;">*(if not yet installed in your machine)*</span>

- **Windows** 
    - click here: [https://getcomposer.org/Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)
- **MacOS** 
    - copy this to your terminal:
        ```bash
        php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
        php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
        php composer-setup.php
        php -r "unlink('composer-setup.php');"
        ```
    - after the above command is done, copy and paste this to your terminal to make composer global:
        ```bash
        sudo mv composer.phar /usr/local/bin/composer
        ```

<a name="install-sprnva" class='pt-5'></a>
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
    ```
- finally, you can now build your desired application using sprnva.

<a name="config" class='pt-5'></a>
## The Config
In order to protect your sensitive credentials, we ignore `config.php` to be committed in the source control. After installation via composer, fill in your desired credentials and know more of it below.

![alt text](public/storage/images/update-config.png)

**base_url** - it's used to tell the router which is the starting point to read a given url. In local and in hosting it is quite similar:
    - **localhost development**
        - in htdocs we provide a folder name to store our application's files and directories right? then all we have to do is set the `'base_url' => 'example-app'` *("example-app" is the folder name of your app in htdocs)*
    - **hosting server deployment**
        - if your application is inside a folder in a hosting server's domain like *`example.com/sprnva/login`* then set `'base_url' => 'sprnva'`
        - if your application is in the root directory of a hosting server's domain like *`example.com/login`* then set `'base_url' => ''`

**mysql_path** - In order to maximize the use of database migration module please indicate the path of `mysql/bin` in your machine including the trailing slashes.

**Environment** - this is to identify if your app is for development only or for production. Note that in production mode, some modules may not work due to security reasons and to avoid conflicts and error in your application.
