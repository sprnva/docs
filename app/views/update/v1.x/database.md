# # Database
---
Sprnva has a query builder that is flexible and easy enough to use.
Sprnva database connection uses PDO and you don't have to do anything.

The database connection and querybuilder instance is already in The DI container, this container is just like a box the stores any information you want and then get it later.

Sprnva query builder has:

```php
- select()
- selectLoop()
- insert()
- update()
- delete()
- query()
- seeder()
- with()
- andFilter()
- withCount()
- get()
```

## # How to use this database querybuilder? 
Declare the instance first then the method, like this example.

```php
DB()->select($columns, $table, $whereParams);
DB()->selectLoop($columns, $table, $whereParams);
DB()->insert($table, $formData, $params);
DB()->update($table, $formData, $whereParams);
DB()->delete($table, $whereParams);
DB()->query($query, $fetch);
DB()->seeder($table, $length, $tableColumns = []);

DB()->selectLoop($columns, $table, $whereParams)
    -andFilter([
        'relational-table' => 'additional-where-parameters'
    ])
    ->with([
        'relational-table' => [
            'foreign-id-in-the-selected-table',
            'primary-column-of-the-relational-table'
        ]
    ])->get();

DB()->selectLoop($columns, $table, $whereParams)
    ->get();
```

### # select
This is for the fetching single row in the table
```php
DB()->select($columns, $table, $whereParams = '')->get();
```

This is how you get the and display the values of select.
```php
echo $user_data['fullname'];
```

### # selectLoop
This is for the fetching many rows in the table
```php
$user_data = DB()->selectLoop('*', 'users', 'id > 0')->get();
```

This is how you get the and display the values of selectLoop.
```php
foreach($user_data as $users){
    echo $users['fullname'];
}
```

### # insert
This is for the inserting a row in the table. Where`$form_data` is array `[ "table column" => "value" ]`. The $last_id is optional only, if set to `"Y"` the method will return the last_insert_id.
```php
$form_data = [
    'email' => 'j@testmail.com',
    'fullname' => 'Judywen Guapin'
];

DB()->insert('users', $form_data);
```

### # update
This is for the updating a row in the table. Where `$form_data` is array `[ "table column" => "value" ]`. The `$whereParams` is optional only.
```php
DB()->update($table, $formData, $whereParams = '');

$form_data = [
    'email' => 'update@testmail.com',
    'fullname' => 'jagwarthegreat'
];

DB()->update('users', $form_data);
```

### # delete
This is for the deleting a row in the table. The `$whereParams` is optional only.
```php
DB()->delete($table, $whereParams = '');

$user_id = Auth::user('id');
DB()->delete('users', "id = '$user_id'");
```

### # query
This is for making a query against the database. The `$query` is the query you need to execute. `$fetch` is optional only, if you want to fetch the result of the `$query` just change the `$fetch = "Y"`.

If if `$fetch = "Y"` then add the `->get();` mehod to get the result otherwise do not put `->get();`.
```php
$test_query = DB()->query('SELECT * FROM users WHERE id > 0', 'Y')->get();

foreach($test_query as $test){
    echo $test['fullname'];
}

Another example:

$test_query = DB()->query('UPDATE users SET fullname = 'test name only' WHERE id = 1');
```
---
### # seeder
Insert multiple data against the database with a selected table and set the number of iterations and column values.
```php
DB()->seeder($table, $length, $tableColumns = []);
```
example:
```php
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
this will seed datas to the selected table with the number of iteration with the variable `$length`.

### # with
Sometimes we forgot the n+1 problem in developing and fetching datas in our application. This problem can cause tremendous amount of speed/memory consumption and creates a low performance application. Sprnva solve this problem using `with()` method.

When using the `with()` method this will add all the data of the foreign key to the result of the selected table.

Using this method is like saying as:  `get this selected table "with" all the data of it's selected foreign key`
```php
with([
    'relational-table' => [
        'foreign-id-in-the-selected-table',
        'primary-key-column-of-the-relational-table'
    ]
])
```

This is how we fetch the result of the `with()` method:
```php
Route::get('/with', function () {

    $projects = DB()->selectLoop("*","projects", "id > 0")
        ->with([
            "users" => ['user_id', 'id'],
            "roles" => ['roles_id', 'id']
        ])
        ->get();

    foreach($projects as $project){

        echo "Project Name: " . $project['project_name'];
        echo "<br>";
        echo "Assigned Person : ". $project['users']['fullname'];
        echo "<br>";
        echo "The Role : ". $project['roles']['role'];

    };

});
```

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

### # andFilter
An additional `where` parameter to the `with()` method. Placement of this method is before the `->with()` method.

```php
andFilter([
    'relational-table' => "additonal-where-parameters"
])
```

This is how we use the `andFilter()` method:
```php
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

### # withCount
Sometimes we forgot the n+1 problem in developing and fetching datas in our application. This problem can cause tremendous amount of speed/memory consumption and creates a low performance application. Sprnva solve this problem using `withCount()` method.

When using the `withCount()` method this will add the total number of rows of the foreign table to the result of the selected table.

Using this method is like saying as:  `get this selected table "withCount" all the rows of it's selected foreign key`
```php
withCount([
    'relational-table' => [
        'foreign-id-in-the-selected-table',
        'primary-key-column-of-the-relational-table'
    ]
])
```

This is how we fetch the result of the `withCount()` method:
```php
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

![alt text](public/storage/images/withCount-method.png)

### # get
This will literaly get the slected data from our table. This will end the chain of: 
```php
select()->get();
selectLoop()->get();
query()->get(); // if $fetch = "Y"
```
<br>

#### NOTE: `App::get('database')` and `DB()` is the same, you can use either. We recommend to use the helper function `DB()` for simplicity and a more readable code.
