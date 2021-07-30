# # Validations
---
Sprnva has a built in request validator and it's easy to use.

In order to protect informations to pass through we need to validate the user's request through a validator and extract and sanitized each request to avoid special characters and converts code to htmlentities.

```php
Request::validate($route, $input_to_validate = []);
```

Example of request validations

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
$request = Request::validate('/register', [
    'email' => ['required', 'email'],
    'username' => ['required', 'unique:users'],
    'password' => ['required'],
]);
```

**$route** - Is used to redirect if the validator detects an error in validating the request.

**$input_to_validate** - An array of input names with a value of the validation types.

### # Validation Types
Validation type is compose of parameters to validate your inputs like:
```php
['required', 'min:5', 'max:255', 'email', 'unique:{table}']
```

**required** - this will set the input as required and validate if the input has values.

**min** - this will validate and set a minimum `character/s` length to allow.

**max** - this will set a maximun `character/s` length to allow.

**email** - this will validate if the input is an email address.

**unique** - this will validate if the input is already existing in a table using the `:{table}`

![alt text](public/storage/images/validation_type.png)

```php
$request = Request::validate('/register', [
    'email' => ['required', 'email'],
    'username' => ['required', 'unique:users'],
    'password' => ['required', 'min:3', 'max:50'],
]);
```
Inside the validate method, we get the request and sanitize all the request to avoid storing an html code in our database. We sanitized it by removing white spaces. Unqouting the qouted strings, and convert special characters to HTML entities.

After the validation of requested data. We can now get the data:

```php
$register_user = [
    'email' => $request['email'],
    'fullname' => $request['name'],
    'username' => $request['username'],
    'password' => bcrypt($request['password']),
    'updated_at' => date("Y-m-d H:i:s"),
    'created_at' => date("Y-m-d H:i:s")
];

DB()->insert("users", $register_user);
```