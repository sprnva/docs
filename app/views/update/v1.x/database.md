# Database
---
Sprnva has a query builder that is flexible and easy enough to use.
Sprnva database connection uses PDO and you don't have to do anything.

The database connection and querybuilder instance is accessible using the `DB()` helper.

Sprnva query builder has:
- select
- selectLoop
- insert
- update
- delete
- query
- seeder
- with
- andFilter
- withCount
- get

## How to use this database querybuilder? 
Declare the querybuilder and connection instance first then the method.

## select
select is for fetching a single row in the table.
```php
DB()->select($columns, $table, $whereParams = '')->get();

$user_data = DB()->select("*", "users", "id = 2")->get();
```
This is how you get the result of select.
```php
echo $user_data['fullname'];
```

## selectLoop
selectLoop is for retrieving many rows from the table.
```php
DB()->selectLoop($columns, $table, $whereParams);

$user_data = DB()->selectLoop('*', 'users', 'id > 0')->get();
```
This is how you get the result of selectLoop.
```php
foreach($user_data as $users){
    echo $users['fullname'];
}
```

## insert
This is for the inserting a row in the table. Where`$form_data` is array `[ "table column" => "value" ]`. The last parameter is optional only, default value is `"N"` means nothing to fetch and if it is set to `"Y"` the method will return the `last_insert_id`.
```php
DB()->insert($table, $formData, $lastInsertId = 'N');

$form_data = [
    'email' => 'j@testmail.com',
    'fullname' => 'Judywen Guapin'
];

DB()->insert('users', $form_data);
```
Take note that the `email` and `fullname` is the column name in your selected table which is `users`.

## update
This is for the updating a row in the table. Where `$form_data` is array `[ "table column" => "value" ]`. The `$whereParams` is optional only.
```php
DB()->update($table, $formData, $whereParams = '');

$form_data = [
    'email' => 'update@testmail.com',
    'fullname' => 'jagwarthegreat'
];

DB()->update('users', $form_data);
```
Take note that the `email` and `fullname` is the column name in your selected table which is `users`.

## delete
This is for the deleting a row in the table. The `$whereParams` is optional only.
```php
DB()->delete($table, $whereParams = '');

$user_id = Auth::user('id');
DB()->delete('users', "id = '$user_id'");
```

## query
This is for making a raw query against the database. The `$query` is the statement you need to execute. The `$fetch` parameter is optional only, if you want to retrieve the result of the statement just change the `$fetch = "Y"`.

If `$fetch = "Y"` then add the `->get();` mehod to get the result otherwise do not put `->get();`.
```php
// using the query or raw
DB()->query($query, $fetch = "N");

$test_query = DB()->query('SELECT * FROM users WHERE id > 0', 'Y')->get();

// retrieving the result
foreach($test_query as $test){
    echo $test['fullname'];
}

// Another example:
$updateUser = DB()->query('UPDATE users SET fullname = 'test name only' WHERE id = 1');
```

## seeder
Insert multiple data against the database or seed data to the database with a selected table and set the number of iterations and column values using the seeder method.
```php
DB()->seeder($table, $length, $tableColumns = []);

// using the seeder
Route::get('/seed', function () {
    $table = "customers";
    $length = 1000;
    $user_id = Auth::user('id');
    $tableColumns = [
        "name" => randChar(7),
        "address" => randChar(),
        "user_id" => $user_id
    ];

    $response = DB()->seeder($table, $length, $tableColumns);
    echo $response;
});
```
this will seed datas to the selected table which is `customers` with the number of `1000` iterations and a column names with values to seed.

## with
Sometimes we forgot the n+1 problem in developing and fetching datas in our application. This problem can cause tremendous amount of speed/memory consumption and creates a low performance application. Sprnva solve this problem using `with` method.

When using the `with` method this will add all the data of the foreign key to the result of the selected table.

Using this method is like saying as:  `get this selected table "with" all the data of it's selected foreign key`
```php
with([
    'relational-table' => [
        'foreign-key-in-the-selected-table',
        'primary-key-column-of-the-relational-table'
    ]
])

// when using the with method
Route::get('/with', function () {

    // the selected table which is "projects"
    $projects = DB()->selectLoop("*","projects", "id > 0")
        ->with([
            // relation-table "users"
            "users" => [
                // foreign-key-in-the-selected-table
                'user_id', 

                // primary-key-column-of-the-relational-table
                'id'
            ],

            // relation-table "roles"
            "roles" => [
                // foreign-key-in-the-selected-table
                'roles_id',

                // primary-key-column-of-the-relational-table
                'id'
            ]
        ])->get();

    // this is how we retrieve the result of our query
    foreach($projects as $project){

        echo "Project Name: " . $project['project_name'];
        echo "<br>";

        // this is how we retrieve the data of the relation table
        echo "Assigned Person : ". $project['users']['fullname'];

        echo "<br>";
        echo "The Role : ". $project['roles']['role'];

    };

});
```
Take note when retrieving the relational table datas use the `relation-table` that you specify in the `with` method followed by the column name you want to retrieve from the `relation-table` like this : `$project['users']['fullname']`

![alt text](public/storage/images/with-method.png)

This is an example how to use with and get all the values of the foreign id. 

WHERE : 
- `projects` is the selected table
- `users` is the relational-table
- `roles` is the relational-table
- `user_id` is the foreign-id-in-the-selected-table
- `roles_id` is the foreign-id-in-the-selected-
- `id` is the primary-key-column-of-the-relational-table

Behind the scenes, first the `with()` method will get all the selected table datas and it makes our 1st query. Then it collects the `foreign-id-in-the-selected-table` and then fetch all the data from the `users relational-table` and this makes our 2nd query and fetch all the data from the `roles relational-table` and this makes our 3rd query. Finally it combines the `relational-table` datas to the corresponding iteration of the `projects` loop.

This also applies and tested on `select()` method same process same logic and the result is the same.

This way we avoid the querying data to our database inside our loop and makes our query repeats until the end of the iteration. Put in mind that if you have a 100,000 items in our table and we iterate all of it then we query inside the loop to get the foreign key data, imagine the pain that our server gets. Cheer up! sprnva got this under the hood.

## andFilter
An additional `where` parameter to the `with()` method. Placement of this method is before the `->with()` method.

```php
andFilter([
    'relational-table' => "additonal-where-parameters"
])

// using the andFilter to filter the relational-table "tbl_task"
Route::get('/get-user-task', function () {

    $userid = Auth::user('id');
    $projectCode = 'J6K5L4MB21';

    $tasks = DB()->selectLoop("*","tbl_task_member", "projectCode = '$projectCode' and user_id = '$userid'")
        ->andFilter([
            "tbl_task" => "status = 2 and priority_stats = 2"
        ])
        ->with([
            "tbl_task" => ['task_id', 'task_id'],
            "roles" => ['user_id', 'id']
        ])
        ->get();

    dd($tasks);

});
```
![alt text](public/storage/images/andFilter-method.png)

## withCount
Sometimes we forgot the n+1 problem in developing and fetching datas in our application. This problem can cause tremendous amount of speed/memory consumption and creates a low performance application. Sprnva solve this problem using `withCount` method.

When using the `withCount` method this will count the total number of rows of the foreign table to the result set of the selected table.

Using this method is like saying as:  `get this selected table "withCount" all the rows of it's selected foreign key`
```php
withCount([
    'relational-table' => [
        'foreign-id-in-the-selected-table',
        'primary-key-column-of-the-relational-table'
    ]
])

// using the withCount
Route::get('/withCount', function () {
    $users = DB()->selectLoop("*","users")
        ->withCount([
            "projects" => ['id', 'user_id']
        ])
        ->get();

    foreach($users as $user){
        echo "Total Project of ".$user['fullname'].": ". $user['projects_count'];
    };
});
```
Take note that when retrieving the count of the realtional-table which is `projects` you can get it by concatenating or combining the `ralation-table` + `_count` like this ` $user['projects_count']`

![alt text](public/storage/images/withCount-method.png)

## get
This will literaly get the result of our query and this will end the chain of: 
- **select()**->get();
- **selectLoop()**->get();
- **query()**
    - if `$fetch = "Y"` put `->get()`
    - if `$fetch = "N"` do not put `->get()`

