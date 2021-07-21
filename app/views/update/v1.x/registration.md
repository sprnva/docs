# # Registration
---
When booting up sprnva, you will get also a register form built in.

![alt text](public/storage/images/register.png)

### # Registration Files
This is the registration files:
```
- controllers/Auth/RegisterController.php
- views/auth/register.view.php
```

### # Storing forms
You can found the storing logic on the `RegisterController.php`

First we need to get the all the request. It's the form that have a method of POST then we validate the inputs required.
```
$request = Request::validate('/register', [
    'email' => ['required'],
    'username' => ['required'],
    'password' => ['required'],
]);
```

We validate the inputs and tag each one as required because it is required in storing credentials. Before the validated method send the values to the $request variable, it sanitize each of the values to avoid special characters. Now the $request variable has the values of the input fields.

We can now store our sanitized input's data to an array.

```
$register_user = [
    'email' => $request['email'],
    'fullname' => $request['name'],
    'username' => $request['username'],
    'password' => bcrypt($request['password']),
    'updated_at' => date("Y-m-d H:i:s"),
    'created_at' => date("Y-m-d H:i:s")
];
```

Then we can now store this array in the database.
```
DB()->insert("users", $register_user);
```

After the data is stored, we now redirect with a message.
```
redirect('/register', ["message" => "Success register", "status" => "success"]);
```