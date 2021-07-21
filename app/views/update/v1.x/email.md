# # E-mail
---
Sprnva has a built in email helper function powered by PHPMailer.

In order to send mail from your local computer you need to configure your apache's `php.ini`. Uncomment the `extension=php_openssl.dll` and restart your apache.

Then configure your gmail account to act like our email server and turn on less secure apps access.

![alt text](public/storage/images/gmail_config.png)

Configure smtp credentials on `config.php`
```
// EMAIL
'smtp_host' => '',
'smtp_username' => '',
'smtp_password' => '',
'smtp_auth' => true,
'smtp_auto_tls' => true,
'smtp_port' => 25
```

As for the `smtp_host` you can use `smtp.gmail.com` and for the `smtp_username` use your gmail account email address also your gmail account password as `smtp_password` and the `smtp_port` is best with `587`.

Then the email helper function look like this:
```
sendMail($subject, $body, $recipients);
```

Where **$subject** is string, **$body** is text or html, **$recipients** string email of the recipient.

The `sendMail()` helper return an array with 2 values.
```
["message" => "Message has been sent", "status" => "success"]
```