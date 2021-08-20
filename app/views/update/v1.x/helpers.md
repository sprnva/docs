# Function Helpers

- [Introduction](#intro)
- [Public directory](#public-directory)
- [Generate random characters](#random-char)
- [Redirect](#redirect)
- [with_msg](#with-msg)
- [alert_msg](#alert-msg)
- [Dump and Die](#dd)
- [DB()](#db)
- [abort](#abort)
- [bcrypt](#bcrypt)
- [checkHash](#checkHash)

---

<a name="intro" style="padding-top: 30px;">&nbsp;</a>
### Introduction
Sprnva has a function helpers. It's just a normal functions that you can call in your controllers or in views.

You will find the function helpers at `config/function.helpers.php`. Then this is how you declare a helper function.

```php
<?php

function test(){
    return "Hello World";
}
```

You can now access and use these helper function in your controllers and views.

<a name="public-directory" style="padding-top: 30px;">&nbsp;</a>
### Public directory
This is how to access public directory with a helper function.
```php
public_url('/favicon.ico');
```

<a name="random-char" style="padding-top: 30px;">&nbsp;</a>
### Generate random characters
Sprnva has a helper function that can generate random characters good for `(ex: product_code, project_code etc.)`. Accepts a parameter `$length` which means how many characters you wanted to print.
```php
<?php

randChar($length = 6);
```

<a name="redirect" style="padding-top: 30px;">&nbsp;</a>
### Redirect
Redirect use to redirect to another page with a message.
```php
<?php
// redirect($route, $message = []);

redirect('/register', ["message" => "Success register", "status" => "success"]);
```

<a name="with-msg" style="padding-top: 30px;">&nbsp;</a>
### with_msg
Register an alert message
```php
<?php
// with_msg(["message" => "", "status" => ""]));

with_msg(["message" => "Success register", "status" => "success"]));
```

<a name="alert-msg" style="padding-top: 30px;">&nbsp;</a>
### alert_msg
Display the message as alert with color
```php
<?= alert_msg() ?>
```

<a name="dd" style="padding-top: 30px;">&nbsp;</a>
### Dump and Die
Sometime we need to dump something to know the value of that particular `$variable` so `dd()` helper comes to help.
```php
<?php

dd($_SERVER);
```

<a name="db" style="padding-top: 30px;">&nbsp;</a>
### DB()
For simplicity and more readable code we added a helper function to get the instance of our database connection.
```php
// DB()

$customerData = DB()->selectLoop('*', 'customers', "id > 0");
```

<a name="abort" style="padding-top: 30px;">&nbsp;</a>
### abort
redirect to an error page then die(). This will show the error page base on the error code.
```php
<?php
// abort($code, $customMessage = '');

abort(404);
abort(500, 'Internal Error');
```

<a name="bcrypt" style="padding-top: 30px;">&nbsp;</a>
### bcrypt
This will hash the given value and return a hash string
```php
// bcrypt($value);

bcrypt('adminpassword');
```

<a name="checkHash" style="padding-top: 30px;">&nbsp;</a>
### checkHash
Check the given plain value against a hash and return a bool
```php
// checkHash($value, $hashedValue);

checkHash('adminpassword', '$2y$10$Y4gA0DYX3djhWmMsUrHxL.sF.KVqz5xF37oh.GRVUVjoU9yS03Mia');
```