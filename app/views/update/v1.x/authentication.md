# Authentication
---
Add a login and registration to your Sprnva application using the authentication fortify. To install the fortify package, the command is plain simple:
```
composer require sprnva/fortify

php fortify
```
And it will add login and registration to your application in the backend.

![alt text](public/storage/images/login.png)

### Forgot Password
Sprnva has a forgot password for it's user and it's built in already in sprnva and powered by **PHPMailer**.
![alt text](public/storage/images/forgot-password.png)

Just enter the email you registered in the application and sprnva will send the password reset link. You need to click the link sent by sprnva application in your email provider. Click the link and you will be redirect here.
![alt text](public/storage/images/reset-password.png)

After that your password can now be changed.

<span style="color:red">**Note: Refer to E-mail in Digging Deeper documentation for further assistance in configuring your local workstation's php files.**</span>