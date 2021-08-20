# Validations

- [Introduction](#intro)
- [Validation Types](#validation-type)
    - [unique:table](#unique-db)
    - [unique:table,column,except,id](#unique-custom)
        - [Specifying A Custom Column Name](#custom-column)
        - [No column option specified](#no-column)
- [validation example](#example)

---

<a name="intro" style="padding-top: 30px;">&nbsp;</a>
### Introduction
Sprnva has a built in request validator and it's easy to use.

In order to protect informations to pass through, we need to validate the user's request through a validator and extract and sanitize each request to avoid special characters and converts code to htmlentities.

```php
Request::validate($route, $input_to_validate = []);
```
**$route** - Is used to redirect if the validator detects an error in validating the request.

**$input_to_validate** - An array of input names with a value of the validation types.

Let's look some example of request validations

In views:
```html
<form method="POST" action="<?= route("/register") ?>">
    <?= csrf() ?>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="email" class="form-control" name="email" autocomplete="off" autofocus>
    </div>
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" autocomplete="off">
    </div>

    <div class="d-flex justify-content-end">
        <a href="<?= route("/login"); ?>" style="font-size: 18px;">
            <small id="emailHelp" class="form-text text-muted mb-1">Already registered?</small>
        </a>
        <button type="submit" class="btn btn-secondary btn-sm text-rigth ml-2">REGISTER</button>
    </div>
</form>
```

In routes:
```php
Route::post("/register", ['RegisterController@store']);
```

In controller:
```php
<?php

namespace App\Controllers;

class RegisterController
{
    public function store()
    {
        $request = Request::validate('/register', [
            'email' => ['required', 'email'],
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
        ]);
    }
}

```

<a name="validation-type" style="padding-top: 30px;">&nbsp;</a>
### Validation Types
Validation type is compose of parameters to validate your inputs like:
- **required** : this will set the input as required and validate if the input has values.
- **min** : this will validate and set a minimum `character/s` length to allow.
- **max** : this will set a maximun `character/s` length to allow.
- **email** : this will validate if the input is an email address.
- **unique:{table}** : this will validate if the input is already exist in a table using the `:{table}` option.

<a name="unique-db" style="padding-top: 30px;">&nbsp;</a>
### unique:table
The field under validation must not exist within the given database table.

```php
$request = Request::validate('/register', [
    'email' => ['required', 'email'],
    'username' => ['required', 'unique:users'],
    'password' => ['required'],
]);
```
The above example is when we validate a field using unique. Validation error will be thrown everytime if the validator detects that the user's' request is already existing in the database table. Note that if the `column` option is not specified, the name of the field under validation will be used. In the above case, it's the `username` field.

<a name="unique-custom" style="padding-top: 30px;">&nbsp;</a>
### unique:table,column,except,id
Sometimes, you may wish to ignore a given ID  during the unique validation. For example consider an "update profile" page that include the user's username, email address, and location. You will probably want to verify that the username is unique. However, if the user only changes the email address field and not the username, you do not want a validation error to be thrown because the user is already the owner of the username.

To instruct the validator to ignore the user's ID, we'll use the `except` and the `id` option to define the rule.

The `unique` validation type has a variety of options:
 - **table** : the table used to check for validation
 - **column** : the column used to check if the request is unique.
 - **except** : the column to ignore.
 - **id** : the specific value or id of the column to ignore.

<a name="custom-column" style="padding-top: 30px;">&nbsp;</a>
#### Specifying A Custom Column Name:
The `column` option may be used to specify the field's corresponding database column.
```php
$user_id = Auth::user('id');

$request = Request::validate('/register', [
    'email' => ['required', 'email'],
    'username' => ['required', 'unique:users,username,id,'. $user_id],
    'password' => ['required'],
]);
```
The above example will ignore the user if the user update the email address or the password not the username. Then the validation error will not be thrown. The validator used the `username` option as the `column` to check for the unique validation.

<a name="no-column" style="padding-top: 30px;">&nbsp;</a>
#### No column option specified:
Note that if the `column` option is not specified, the name of the field under validation will be used. Also take note that the name of the field under validation should be the same as the database column.
```php
$user_id = Auth::user('id');

$request = Request::validate('/register', [
    'email' => ['required', 'email'],
    'username' => ['required', 'unique:users,id,'. $user_id],
    'password' => ['required'],
]);
```
The above example is when we do not pass the `column` option in the validator. If the `column` option is not specified, the name of the field under validation will be used. In the above case, it's the `username` field. Then the validator will ignore the user if the user update the email address or the password not the username. Then the validation error will not be thrown.

![alt text](public/storage/images/validation_type.png)

<a name="example" style="padding-top: 30px;">&nbsp;</a>
```php
$request = Request::validate('/register', [
    'email' => ['required', 'email'],
    'username' => ['required', 'unique:users'],
    'password' => ['required', 'min:3', 'max:50'],
]);
```
Inside the validate method, we get the request and sanitize all the request to avoid storing an html code in our database. We sanitized it by removing white spaces. Unqouting the qouted strings, and convert special characters to HTML entities.

After the validation of requested data. We can now get the data and use this to insert to our database:

```php
<?php

namespace App\Controllers;

class RegisterController
{
    public function store()
    {
        $request = Request::validate('/register', [
            'email' => ['required', 'email'],
            'username' => ['required', 'unique:users'],
            'password' => ['required'],
        ]);

        $register_user = [
            'email' => $request['email'],
            'fullname' => $request['name'],
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
            'updated_at' => date("Y-m-d H:i:s"),
            'created_at' => date("Y-m-d H:i:s")
        ];

        DB()->insert("users", $register_user);
    }
}

```