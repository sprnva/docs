# # Authentication
---
When booting up sprnva, you will get a login built in.

![alt text](public/storage/images/login.png)

You can see login controller in `controllers/Auth` and views in `views/auth`. In routes you can access it in `config/routes/auth.php`

### # Authenticate
In `AuthController.php` you can find a method `authenticate()` this is where login will process the username and password to authenticate.

First we need to get the request. It's the username and password.
```
$request = Request::validate('/login', [
    'username' => 'required',
    'password' => 'required'
]);
```

In this case, we validate the inputs and tag each one as required because it is required in authenticating. Before the validate method send the values to the $request variable it sanitize each of the values to avoid special characters. Now the $request variable has the values of the input fields.

Then we authenticate the request we get from out inputs and will store it later inside the `Auth::user()` and later be used in your entire application as authenticated user information. If the user does not exist we throw an error `"the user is not found"`.
```
Auth::authenticate($request);
```

### # Forgot Password
Sprnva has a forgot password for it's user and it's built in already in sprnva and powered by **PHPMailer**.
![alt text](public/storage/images/forgot-password.png)

Just enter the email you registered in the application and sprnva will send the password reset link. You need to click the link sent by sprnva application in your email provider. Click the link and you will be redirect here.
![alt text](public/storage/images/reset-password.png)

After that your password can now be changed.

<span style="color:red">**Note: Refer to E-mail in Digging Deeper documentation for further assistance in configuring your local workstation's php files.**</span>