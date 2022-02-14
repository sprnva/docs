# The Structure

- [Introduction](#intro)
- [The `App` Directory](#app)
	- [Controllers Directory](#controllers)
	- [Views Directory](#views)
- [The `Config` Directory](#config)
	- [Routes Directory](#routes)
	- [Function Helpers](#helpers)
- [The `Database` Directory](#database)
	- [Migrations Directory](#migrations)
	- [Schema Directory](#schema)
- [The `Public` Directory](#public)
	- [Assets Directory](#assets)
	- [Storage Directory](#storage)

---
<!-- ![alt text](public/storage/images/file_structure.png) -->

<a name="intro" style="padding-top: 30px;">&nbsp;</a>
### Introduction
Sprnva file structure is tailored to be a MVC framework so that if you step into the massive frameworks like Laravel or CodeIgniter you are familiar with the structure.

```sh
SPRNVA/
├── app/
│   ├── controller/
│   ├── views/
├── config/
│   ├── routes/
│   ├── function.helpers.php
├── database/
│   ├── migrations/
│   ├── schema/
├── public/
│   ├── assets/
│   ├── storage/
│   ├── favicon.ico
├── vendor/
├── .gitignore
├── .htaccess
├── compose.json
├── composer.lock
├── config.example
├── config.php
├── index.php
├── LICENSE
├── README.md
```

<a name="app" style="padding-top: 30px;">&nbsp;</a>
### The `App` Directory
The majority of your application is housed in the `app` directory. By default, all the logics and the user interface is stored in this directory.

The `app` directory contains additional directories such as `controllers` and `views`.

<a name="controllers" style="padding-top: 30px;">&nbsp;</a>
#### Controllers Directory
The `controllers` directory contains the almost all of the logic of your application. Request entering your application will be handled with this directory.

<a name="views" style="padding-top: 30px;">&nbsp;</a>
#### Views Directory
The `views` directory is the user's perspective of your application. All the graphical representation is placed in this directory.

Always remember in Sprnva Framework, when adding a view it has a naming convention. To declare or add a view just add the name of your view file then add a `.view.php` convention. This convention will tell the framework to identify that this file is a view file.

<a name="config" style="padding-top: 30px;">&nbsp;</a>
### The `Config` Directory
The traffic control and the additional helpers is stored in the `config` directory. By default, routes and function helpers is stored in this directory.

<a name="routes" style="padding-top: 30px;">&nbsp;</a>
#### Routes Directory
The routes directory contains all of the route definitions for your application. By default, one route file are included with Sprnva: `web.php`.

The `web.php` file contains routes that the user define for the entire application. It is likely that all of your routes will most likely be defined in the `web.php` file.

<a name="helpers" style="padding-top: 30px;">&nbsp;</a>
#### Function Helpers
The `function.helpers.php` is the file where you can add a callable function and later be used in the controllers or in views. 

<a name="database" style="padding-top: 30px;">&nbsp;</a>
### The `Database` Directory
The `database` directory contains your database migrations and schema. If you wish, you may also use this directory to hold an SQLite database.

<a name="migrations" style="padding-top: 30px;">&nbsp;</a>
#### Migrations Directory
All of your migration files are stored in the `migrations` directory. This migration directory is the repository for your database version control. This migration files is the file that contains the schema of your database tables.

<a name="schema" style="padding-top: 30px;">&nbsp;</a>
#### Schema Directory
In the migration module, the result of the files generated when using the dump buttons is stored in this directory. This directory contains the `.sql` file with the schema of your database inside.

<a name="public" style="padding-top: 30px;">&nbsp;</a>
### The `Public` Directory
All your `css`, `js`, `images` and other plugins are stored in the `public` directory. By default, public directory has two more directories inside. The `assets` and the `storage` directory is where plugins are stored.

Tip: create a new directory when adding a new plugin to segregate the files.

<a name="assets" style="padding-top: 30px;">&nbsp;</a>
#### Assets Directory
The storage directory of all the assets of the entire application.

<a name="storage" style="padding-top: 30px;">&nbsp;</a>
#### Storage Directory
The recommended directory to store the images of the application.