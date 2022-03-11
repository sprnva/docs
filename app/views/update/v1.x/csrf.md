# CSRF Protection
---
**Cross-Site Request Forgery (CSRF)** is an attack that forces an end user to execute unwanted actions on a web application in which they're currently authenticated. Thankfully, Sprnva makes it easy to protect your application from `cross-site request forgery (CSRF)` attacks.

### The Vulnerability
In case you're not familiar with cross-site request forgeries, let's discuss an example of how this vulnerability can be exploited. Imagine your application has a `/user/email` route that accepts a `POST` request to change the authenticated user's email address. Most likely, this route expects an `email` input field to contain the email address the user would like to begin using.

Without CSRF protection, a malicious website could create an HTML form that points to your application's `/user/email` route and submits the malicious user's own email address:

```
<form action="https://your-application.com/user/email" method="POST">
    <input type="email" value="malicious-email@example.com">
</form>

<script>
    document.forms[0].submit();
</script>
```

If the malicious website automatically submits the form when the page is loaded, the malicious user only needs to lure an unsuspecting user of your application to visit their website and their email address will be changed in your application.

To prevent this vulnerability, we need to inspect every incoming request for a secret session value that the malicious application is unable to access.

### Preventing CSRF Request
Sprnva automatically generates a CSRF `"token"` for each active user session managed by the application. This token is used to verify that the authenticated user is the person actually making the requests to the application. Since this token is stored in the user's session and changes each time the session is regenerated, a malicious application is unable to access it.

Secure your request by adding a csrf.

```
<form method="POST" action="<?= route('/reset/password') ?>">

    <?= csrf(); ?>

</form>
```

`csrf()` helper is same as saying:
```
<input type='hidden' name='csrf_token' value='$2y$10$NCwqep6AgCIJGoSLVfMbm.svXCAtwrVX7uUG4nrp.z7LZQ2owrZ6a'>
```

Sprnva will check and match your tokens and keep other servers from executing unwanted actions to your application.
