# Database Migration

- [Introduction](#intro)
- [INSTANCES](#instances)
- [INSTANCE USAGE](#instances-usage)
	- [NEW](#new)
	- [RENAMETABLE](#renametable)
	- [DROP](#drop)
	- [CHANGE](#change)
- [Migration Buttons](#migration-buttons)
	- [Migrate](#migrate)
	- [Fresh](#fresh)
	- [Rollback](#rollback)
	- [Make](#make)
	- [Dumps](#dumps)
		- [Dump](#dump)
		- [Dump Prune](#dump-prune)


---

<a name="intro" style="padding-top: 30px;">&nbsp;</a>
## Introduction
##### <span style="color:red">**THIS DATABASE MIGRATION IS ONLY USED IN LOCAL DEVELOPMENT AND MIGHT CAUSE DOWNTIME AND ERRORS WHEN USED IN PRODUCTION.**</span>

> Migrations are like version control for your database, allowing your team to define and share the application's database schema definition. If you have ever had to tell a teammate to manually add a column to their local database schema after pulling in your changes from source control, you've faced the problem that database migrations solve. &mdash; Laravel

Access database migration by visiting this URL: `localhost/example-app/migration`

Here's the look of our database migration module.
![alt text](public/storage/images/migration.png)

<a name="instances" style="padding-top: 30px;">&nbsp;</a>
## INSTANCES
Instances is the mode that we set and then use to identify a migration file.
- **NEW** - This will create a new table in the database
- **RENAMETABLE** - Will rename a table in the database
- **DROP** - This will drop a table in the database
- **CHANGE** - This is like altering the table columns

<a name="instances-usage" style="padding-top: 30px;">&nbsp;</a>
## INSTANCE USAGE
Let's take a look how to use this instances.
- The **up** is always used in migrating the migration files.
- The **down** is used in the rollback of the migration or like a reverse of the **up**

<a name="new" style="padding-top: 30px;">&nbsp;</a>
### NEW
The example below is the new instance which will create a table that you fill in the `"table" => ""` line.
- **up**: will be use in the migration to create the table you fill in the `"table"`.
- **down**: is the reverse of the `"up"` option which will drop the table in the database. In this case we just leave the down data to `"" => ""` because the migrator already know that when using the `NEW` instance the reverse is always to drop the table that you specify. 

![alt text](public/storage/images/new_instance.png)

<a name="renametable" style="padding-top: 30px;">&nbsp;</a>
### RENAMETABLE
The example below is the renametable instance which will rename a table that you fill in the `"table" => ""` line.
- **up**: rename the table `"from-name" => "to-name"`.
- **down**: is the reverse of the `"up"`. 

![alt text](public/storage/images/renametable_instance.png)

<a name="drop" style="padding-top: 30px;">&nbsp;</a>
### DROP
The example below is the drop instance which will drop a table that you fill in the `"table" => ""` line.
- **up**: as you can see in the example below the up is set to `"" => ""` it is because the migrator already knows what to do and it's job is to drop the table that you fill in the `"table"` line.
- **down**: is the reverse of the `"up"`. In this instance this should be creating the table that we drop beacause once again it's the reverse of the **up**.

![alt text](public/storage/images/drop_instance.png)

<a name="change" style="padding-top: 30px;">&nbsp;</a>
### CHANGE
The example below is the change instance which will alter a table that you fill in the `"table" => ""` line.
- **up**: the changes you want to a table column.
	- you can add a column and set it's data types
	- you can change column or change it's data types
	- you can also drop a column
- **down**: is the reverse of the `"up"`.

![alt text](public/storage/images/change_instance.png)

<a name="migration-buttons" style="padding-top: 30px;">&nbsp;</a>
## Migration Buttons
Is the button you see at the left side of the migration module. How these button really works?

<a name="migrate" style="padding-top: 30px;">&nbsp;</a>
### Migrate
This will migrate the migration files against the database. This is how the migrate button process the migration:
- will make sure database repository exist *`talks about the migrations table`*
- attach a migration batch number
- will prepare the pending migrations or "outstanding migrations"
- after that we build the migration schema
- we run the schema that we built
- we log the migration to database repository

<a name="fresh" style="padding-top: 30px;">&nbsp;</a>
### Fresh
This is where we drop all tables and replace a new one base on our migration and stored database if present.
- First we drop all the tables in database
- we create the database repository if does not exist
- after that, we load the stored database schema if exist
- then we run the pending migrations on our local repository
- insert the views schema

<a name="rollback" style="padding-top: 30px;">&nbsp;</a>
### Rollback
This will rollback 1 step down base on last batch number. This will use the `"down"` option in your migration file. This is how the rollback button process the migration:
- ensure database repository exist
- we get the completed migrations on our database repository base on the last batch number
- then we build the schema of the completed migrations
- after that, we remove the migrations from the database repository

<a name="make" style="padding-top: 30px;">&nbsp;</a>
### Make
This will add a new migration file base on the default migration stub. Migration stub contains the scaffolding of the migration file.
```php
${{ varName }} = [
	"mode" => "",
	"table"	=> "",
	"primary_key" => "",
	"up" => [
		"" => ""
	],
	"down" => [
		"" => ""
	]
];
```
- `{{ varName }}` will be automatically replaced by the migration file name you enter in the input before you click the make button.
- The `dabase/migrations/` is the directory which our migration files will be stored. This is we called our local repository.

The migration file accepts: 
1. **mode**: "NEW", "DROP", "CHANGE", "RENAMETABLE"
2. **table**: the target table
3. **primary_key**: the primary key of the table
4. **up**: Run the migrations
5. **down**: Reverse the migrations

<a name="dumps" style="padding-top: 30px;">&nbsp;</a>
## Dumps
As time goes by, migrations will be immense. We need to shrink it down, and dump is the answer for that. We have dumps to clear out migrations while migration schemas is dump in a .sql file that will be soon loaded as we migrate or need a fresh database environment.

In `config.php` the `mysql_path` help the dump to do it's thing correctly, beacause if we forgot to set the `mysql_path`, we cannot dump the database correctly that's why we need to locate our `mysql/bin` to tell the dump that we are using the `mysql` to dump the database.

The process of the dumps:
- ensure database repository exist
- we get the completed migrations on our database repository base on the last batch number
- then we build the schema of the completed migrations
- after that, we remove the migrations from the database repository
- and dump the schme to a `.sql` file

<a name="dump" style="padding-top: 30px;">&nbsp;</a>
### Dump
This will dump the database to an `.sql` file base on your database config.
- **output**: `.sql` file in the `database/schema` dir

<a name="dump-prune" style="padding-top: 30px;">&nbsp;</a>
### Dump Prune
This will dump the database to an `.sql` file base on your database config and prune migration files.
- **output**: `.sql` file in the `database/schema` dir
- this `removes all the migration files` in your local repository

##### <span style="color:red">**THIS DATABASE MIGRATION IS ONLY USED IN LOCAL DEVELOPMENT AND MIGHT CAUSE DOWNTIME AND ERRORS WHEN USED IN PRODUCTION.**</span>