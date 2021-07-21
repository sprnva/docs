# # Installation
---
Sprnva is an open-source repository and is available at [github/sprnva](https://github.com/sprnva/sprnva/releases/tag/v1.4.0). You can just fork/download via zip/clone it to your local computer via git. No fancy command required to download sprnva. Go grab sprnva now!

## # Requirements
Php version supported: **PHP >= php5.5**

In order to run sprnova, you need to install [composer](https://getcomposer.org/installer). Composer is used for class autoloading and for future installation of different packages.

## # Setup your application
Open your application directory in the terminal/cmd and execute this 

```
$ composer dump-autoload
```

This will re-initialize the classes and store in a autoload file in the vendor directory. This autoload file will later be use as our class autoloader just like that, all the classes inside your entire application will be store and loaded automatically. EZ!

![alt text](public/storage/images/autoload-class.png)

## # Config
In order to protect your credentials we avoid to pass config.php to git. After downloading the sprnva kit, you cannot find the config.php by default. Just copy the `config.example.php` and rename the duplicated one to `config.php` . After that open `config.php` and then change it to your credentials.

![alt text](public/storage/images/update-config.png)

**base_url** - This palys the important role in this setup because it's used if your application is inside a folder in a domain like *example.com/sprnva/login* instead use `'base_url' => ''` if your application is in the root directory of a domain like *example.com/login*

**mysql_path** - For more flexible database migration please indicate the path of mysql in your machine including the trailing slashes.

**Environment** - this is to identify if your app is for development only or for production. Some modules may not work in production due to security reasons.

## # Database
Create a database identical to your config then go to */migration* to your URL
```
$ http://localhost/sprnva/migration
```

Now you are in the database migration page, click the "Fresh" button to generate default tables and start adding users. You can now run your application in your browser as easy as that.