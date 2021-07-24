# # Database Migration
---
##### <span style="color:red">**THIS DATABASE MIGRATION IS ONLY USED IN LOCAL DEVELOPMENT AND MIGHT CAUSE DOWNTIME AND ERRORS WHEN USED IN PRODUCTION.**</span>

> Migrations are like version control for your database, allowing your team to define and share the application's database schema definition. If you have ever had to tell a teammate to manually add a column to their local database schema after pulling in your changes from source control, you've faced the problem that database migrations solve. &mdash; Laravel

Access database migration by visiting this URL: `http://localhost/sprnva/migration`

Here's what database migration UI look like.
![alt text](public/storage/images/migration.png)

## # INSTANCES
Instances is the mode that we use to identify a migration file.

```text
NEW - This will create the table specified
RENAMETABLE - Will rename the table specified
DROP - This will drop the table specified
CHANGE - It's like altering the table columns
```

## # INSTANCE USAGE
Let's take a look how to use this instances.

#### # NEW
```text
up: will create the table
down: will drop the table
```
![alt text](public/storage/images/new_instance.png)

#### # RENAMETABLE
```text
up: will rename the table "from" => "to"
down: reverse the up "from" => "to"
```
![alt text](public/storage/images/renametable_instance.png)

#### # DROP
```text
up: "" => "" will drop the specified table
down: create the dropped table
```
![alt text](public/storage/images/drop_instance.png)

#### # CHANGE
```text
up: "column name" => "changes" this will change the column name and datatypes
down: reverse the up "column name" => "changes"

Column Changes:
- ADD COLUMN column name DATATYPES HERE

- CHANGE COLUMN column name column name DATATYPES HERE 
(note that there are 2 column names, the next column name is for renaming a column)

- DROP COLUMN column name
```
![alt text](public/storage/images/change_instance.png)

<br>
## # Migration Buttons
How these button really works?

### # Migrate
This will migrate the migration files database is intact no data will be overidden.
```text
- will make sure database repository exist
- attach a migration batch number
- will prepare the pending migrations or "outstanding migrations"
- after that we build the migration schema
- we run the schema that we built
- we log the migration to database repository
```

### # Fresh
This is where we drop all tables and replace a new one base on our migration and stored database.
```text
- First we drop all the tables in database
- and if the database repository does not exist, we create
- after that, we load the stored database schema if exist
- then we run the pending migrations on our local repository
- insert the views schema
```

### # Rollback
This will rollback 1 step down base on last batch number.
```text
- ensure database repository exist
- we get the completed migrations on our database repository base on the last batch number
- then we build the schema of the completed migrations
- after that, we remove the migrations from the database repository
```

### # Make
This will add a new migration file.
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

- This is where we add a migration file in our local repository
- {{ varName }} will be automatically replaced by the name you specified
- DIR: database/migrations/

this accepts: 
1 mode: "NEW", "DROP", "CHANGE", "RENAMETABLE"
2 table: the target table
3 primary_key: the primary key of the table
4 up: Run the migrations
5 down: Reverse the migrations
```

## # Dumps
As time goes by, migrations will be immense. We need to shrink it down, and dump is the answer for that. We have dumps to clear out migrations while migration schemas is dump in a .sql file that will be soon loaded as we migrate or need a fresh database environment.
```text
- ensure database repository exist
- we get the completed migrations on our database repository base on the last batch number
- then we build the schema of the completed migrations
- after that, we remove the migrations from the database repository
```

#### # Dump
This will dump the database to an .sql file base on your database config.
```text
- output: .sql file in the database/schema dir
```

#### # Dump Prune
This will dump the database to an .sql file base on your database config and prune migration files.
```text
- output: .sql file in the database/schema dir
- this removes all the migration files in your local repository
```

##### <span style="color:red">**THIS DATABASE MIGRATION IS ONLY USED IN LOCAL DEVELOPMENT AND MIGHT CAUSE DOWNTIME AND ERRORS WHEN USED IN PRODUCTION.**</span>