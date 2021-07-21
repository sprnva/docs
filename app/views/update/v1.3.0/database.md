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
```

## # How to use this database querybuilder? 
Declare the instance first then the method, like this example.

```
App::get('database')->select($columns, $table, $whereParams);
App::get('database')->selectLoop($columns, $table, $whereParams);
App::get('database')->insert($table, $formData, $params);
App::get('database')->update($table, $formData, $whereParams);
App::get('database')->delete($table, $whereParams);
App::get('database')->query($query, $fetch);
App::get('database')->seeder($table, $length, $tableColumns = []);
```

### # select
This is for the fetching single row in the table
```
App::get('database')->select($columns, $table, $whereParams = '');
```

This is how you get the and display the values of select.
```
echo $user_data['fullname'];
```

### # selectLoop
This is for the fetching many rows in the table
```
$user_data = App::get('database')->selectLoop('*', 'users', 'id > 0');
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

App::get('database')->insert('users', $form_data);
```

### # update
This is for the updating a row in the table. Where `$form_data` is array `[ "table column" => "value" ]`. The `$where_clause` is optional only.
```
$form_data = [
    'email' => 'update@testmail.com',
    'fullname' => 'jagwarthegreat'
];

App::get('database')->update('users', $form_data);
```

### # delete
This is for the deleting a row in the table. The `$where_clause` is optional only.
```
$user_id = Auth::user('id');
App::get('database')->delete('users', "id = '$user_id'");
```

### # query
This is for making a query against the database. The `$query` is the query you need to execute. `$fetch` is optional only, if you want to fetch the result of the `$query` just change the `$fetch = "Y"`.
```
$test_query = App::get('database')->query('SELECT * FROM users WHERE id > 0', 'Y');

foreach($test_query as $test){
    echo $test['fullname'];
}

Another example:

$test_query = App::get('database')->query('UPDATE users SET fullname = 'test name only' WHERE id = 1');
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

<br>

#### NOTE: `App::get('database')` and `DB()` is the same, you can use either. We recommend to use the helper function `DB()` for simplicity and a more readable code.
