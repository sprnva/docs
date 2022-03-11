# Function Helpers

- [Function Helpers](#function-helpers)
    - [Introduction](#introduction)
    - [Public directory](#public-directory)
    - [Generate random characters](#generate-random-characters)
    - [Redirect](#redirect)
    - [with_msg](#with_msg)
    - [alert_msg](#alert_msg)
    - [Dump and Die](#dump-and-die)
    - [DB()](#db)
    - [abort](#abort)
    - [bcrypt](#bcrypt)
    - [checkHash](#checkhash)
    - [error_page_code](#error_page_code)
    - [gate_denies](#gate_denies)
    - [sanitizeString](#sanitizestring)
    - [route](#route)
    - [view](#view)
    - [appversion](#appversion)
    - [csrf](#csrf)
    - [basepath](#basepath)
    - [vendorpath](#vendorpath)

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

<a name="error_page_code" style="padding-top: 30px;">&nbsp;</a>
### error_page_code
List of all error codes.
```php
$codes = [
    100 => 'Continue',
    101 => 'Switching Protocols',
    102 => 'Processing',
    103 => 'Early Hints',
    200 => 'OK',
    201 => 'Created',
    202 => 'Accepted',
    203 => 'Non-Authoritative Information',
    204 => 'No Content',
    205 => 'Reset Content',
    206 => 'Partial Content',
    207 => 'Multi-Status',
    208 => 'Already Reported',
    226 => 'IM Used',
    300 => 'Multiple Choices',
    301 => 'Moved Permanently',
    302 => 'Found',
    303 => 'See Other',
    304 => 'Not Modified',
    305 => 'Use Proxy',
    306 => 'Switch Proxy',
    307 => 'Temporary Redirect',
    308 => 'Permanent Redirect',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    405 => 'Method Not Allowed',
    406 => 'Not Acceptable',
    407 => 'Proxy Authentication Required',
    408 => 'Request Timeout',
    409 => 'Conflict',
    410 => 'Gone',
    411 => 'Length Required',
    412 => 'Precondition Failed',
    413 => 'Request Entity Too Large',
    414 => 'Request-URI Too Long',
    415 => 'Unsupported Media Type',
    416 => 'Requested Range Not Satisfiable',
    417 => 'Expectation Failed',
    418 => "I'm a teapot",
    421 => 'Misdirected Request',
    422 => 'Unprocessable Entity',
    423 => 'Locked',
    424 => 'Failed Dependency',
    425 => 'Too Early',
    426 => 'Upgrade Required',
    428 => 'Precondition Required',
    429 => 'Too Many Requests',
    431 => 'Request Header Fields Too Large',
    451 => 'Unavailable For Legal Reasons',
    499 => 'Client Closed Request',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    502 => 'Bad Gateway',
    503 => 'Service Unavailable',
    504 => 'Gateway Timeout',
    505 => 'HTTP Version Not Supported',
    506 => 'Variant Also Negotiates',
    507 => 'Insufficient Storage',
    508 => 'Loop Detected',
    510 => 'Not Extended',
    511 => 'Network Authentication Required',
    599 => 'Network Connect Timeout Error',
];
```

<a name="gate_denies" style="padding-top: 30px;">&nbsp;</a>
### gate_denies
check if user role has permission
```php
// return boolean true and false
gate_denies($access = '', $message = '')
```

<a name="sanitizeString" style="padding-top: 30px;">&nbsp;</a>
### sanitizeString
Sanitize strings trim, stripslashes, htmlspecialchars
```php
sanitizeString($data, $stripslashes = true, $trim = true)
```

<a name="route" style="padding-top: 30px;">&nbsp;</a>
### route
Set a route to redirect
```php
route($route, $data = "")
```

<a name="view" style="padding-top: 30px;">&nbsp;</a>
### view
Require a view.php page
```php
// you can use compact() method on the second parameter
view($name, $data = [])
```

<a name="appversion" style="padding-top: 30px;">&nbsp;</a>
### appversion
Show the current version of the framework
```php
appversion()
```

<a name="csrf" style="padding-top: 30px;">&nbsp;</a>
### csrf
This will add a hidden input with csrf token
```php
csrf()
```

<a name="basepath" style="padding-top: 30px;">&nbsp;</a>
### basepath
Get the app root path
```php
basepath()
```

<a name="vendorpath" style="padding-top: 30px;">&nbsp;</a>
### vendorpath
Get the app vendor path
```php
vendorpath()
```