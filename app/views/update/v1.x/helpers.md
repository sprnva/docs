# Function Helpers
---
Sprnva has a function helpers. It's just a normal functions that you can call in your controllers or in views.

You will find the function helpers at `config/function.helpers.php`. Then this is how you declare a helper function.

```php
<?php

function test(){
    return "Hello World";
}
```

You can now access and use these helper function in your controllers and views.

### Public directory
This is how to access public directory with a helper function.
```php
public_url('/favicon.ico');
```

### Generate random characters
Sprnva has a helper function that can generate random characters good for `(ex: product_code, project_code etc.)`. Accepts a parameter `$length` which means how many characters you wanted to print.
```php
randChar($length = 6);
```

### Redirect
Redirect use to redirect to another page with a message.
```php
redirect($route, $message = []);

redirect('/register', ["message" => "Success register", "status" => "success"]);
```

### with_msg
Register an alert message
```php
with_msg(["message" => "", "status" => ""]));

with_msg(["message" => "Success register", "status" => "success"]));
```

### alert_msg
Display the message as alert with color
```php
<?= alert_msg() ?>
```

### Dump and Die
Sometime we need to dump something to know the value of that particular `$variable` so `dd()` helper comes to help.
```php
dd($_SERVER);
```

### DB()
For simplicity and more readable code we added a helper function to get the instance of our database connection.
```php
DB()

// usage:
$customerData = DB()->selectLoop('*', 'customers', "id > 0");
```

### abort
redirect to an error page then die(). This will show the error page base on the error code.
```php
abort($code, $customMessage = '');

// usage:
abort(404);
```

### bcrypt
This will hash the given value and return a hash string
```php
bcrypt($value);

// usage:
bcrypt('adminpassword');
```

### checkHash
Check the given plain value against a hash and return a bool
```php
checkHash($value, $hashedValue);

// usage:
checkHash('adminpassword', '$2y$10$Y4gA0DYX3djhWmMsUrHxL.sF.KVqz5xF37oh.GRVUVjoU9yS03Mia');
```