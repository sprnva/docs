# # Function Helpers
---
Sprnva has a function helpers. It's just a normal functions.

You will find the fucntion helpers at `config/function.helpers.php`. Then this is how you declare a helper function.

```
function test(){
    return "Hello World";
}
```

You can now access and use these helper function in your controllers and views.

### # Public directory
This is how to access public directory with a helper function.
```
public_url('/favicon.ico');
```

### # Generate random characters
Sprnva has a helper function that can generate random characters good for `(ex: product_code, project_code etc.)`. Accepts a parameter `$length` which means how many characters you wanted to print.
```
randChar($length = 6);
```

### # Redirect
Redirect use to redirect to another page with a messaage.
```
redirect($route, $message = []);

redirect('/register', ["Success register", "success"]);
```

In example the $message is array and has 2 values on it. This is what a message should look like `[$message, $message_type]`. `$message_type` is the color of the alert `"primary, warning, danger, success"`.

**Why $message is an array?** because it soon be loaded in the `$_SESSION["RESPONSE_MSG"]` and displayed in the views by `msg('RESPONSE_MSG');` and `msg()` helper accepts a `$_SESSION` array with 2 values. Then it will extract values to fill the alert with message and alert type.

### # Dump and Die
Sometime we need to dump something to know the value of that particular `$variable` so `dd()` helper comes to help.
```
dd($_SERVER);
```

### # DB()
For simplicity and more readable code we added a helper function to get the instance of our database connection.
```
DB()

usage:

$customerData = DB()->selectLoop('*', 'customers', "id > 0");
```

### # abort
redirect to an error page then die(). This will show the error page base on the error code.
```
abort($code, $customMessage = '');

usage:

abort(404);
```

### # bcrypt
This will hash the given value and return a hash string
```
bcrypt($value);

usage:

bcrypt('adminpassword');
```

### # checkHash
Check the given plain value against a hash and return a bool
```
checkHash($value, $hashedValue);

usage:

checkHash('adminpassword', '$2y$10$Y4gA0DYX3djhWmMsUrHxL.sF.KVqz5xF37oh.GRVUVjoU9yS03Mia');
```