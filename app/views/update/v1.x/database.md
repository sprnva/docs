# # Database
---
Sprnva has a query builder that is flexible and easy enough to use.
Sprnva database connection uses PDO and you don't have to do anything.

The database connection and querybuilder instance is already in The DI container, this container is just like a box the stores any information you want and then get it later.

Sprnva query builder has:

```
- select
- selectLoop
- insert
- update
- delete
- query
- seeder
- with
- get
```

## # How to use this database querybuilder? 
Declare the instance first then the method, like this example.

```
DB()->select($columns, $table, $whereParams);
DB()->selectLoop($columns, $table, $whereParams);
DB()->insert($table, $formData, $params);
DB()->update($table, $formData, $whereParams);
DB()->delete($table, $whereParams);
DB()->query($query, $fetch);
DB()->seeder($table, $length, $tableColumns = []);

DB()->selectLoop($columns, $table, $whereParams)
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
```
DB()->select($columns, $table, $whereParams = '')->get();
```

This is how you get the and display the values of select.
```
echo $user_data['fullname'];
```

### # selectLoop
This is for the fetching many rows in the table
```
$user_data = DB()->selectLoop('*', 'users', 'id > 0')->get();
```

This is how you get the and display the values of selectLoop.
```
foreach($user_data as $users){
    echo $users['fullname'];
}
```

### # insert
This is for the inserting a row in the table. Where`$form_data` is array `[ "table column" => "value" ]`. The $last_id is optional only, if set to `"Y"` the method will return the last_insert_id.
```
$form_data = [
    'email' => 'j@testmail.com',
    'fullname' => 'Judywen Guapin'
];

DB()->insert('users', $form_data);
```

### # update
This is for the updating a row in the table. Where `$form_data` is array `[ "table column" => "value" ]`. The `$whereParams` is optional only.
```
DB()->update($table, $formData, $whereParams = '');

$form_data = [
    'email' => 'update@testmail.com',
    'fullname' => 'jagwarthegreat'
];

DB()->update('users', $form_data);
```

### # delete
This is for the deleting a row in the table. The `$whereParams` is optional only.
```
DB()->delete($table, $whereParams = '');

$user_id = Auth::user('id');
DB()->delete('users', "id = '$user_id'");
```

### # query
This is for making a query against the database. The `$query` is the query you need to execute. `$fetch` is optional only, if you want to fetch the result of the `$query` just change the `$fetch = "Y"`.

If if `$fetch = "Y"` then add the `->get();` mehod to get the result otherwise do not put `->get();`.
```
$test_query = DB()->query('SELECT * FROM users WHERE id > 0', 'Y');

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
$router->get('/seed', function () {
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

When using the `with()` method this will add all the data of the foreign id to the result of the selected table.

Using this method is like saying as:  `get this selected table "with" all the data of it's selected foreign id`
```php
with([
    'relational-table' => [
        'foreign-id-in-the-selected-table',
        'primary-key-column-of-the-relational-table'
    ]
])
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

### # get
This will literaly get the slected data from our table. This will end the chain of `select()->get();`, `selectLoop()->get();`, `query()->get();` => if `$fetch = "Y"`

<br>

#### NOTE: `App::get('database')` and `DB()` is the same, you can use either. We recommend to use the helper function `DB()` for simplicity and a more readable code.
