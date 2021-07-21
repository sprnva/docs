# # Alert Messages
---
Now we want users to know what's the status of the request by display an alert message.

![alt text](public/storage/images/alert.png)

### # Usage
Create a `$_SESSION` and set the value to an array with 2 values like this. The first value should be the message and the second value should be the alert type we have `[ default, primary, success, warning, danger ]` to give colors to the message to be shown in the views.

```
$_SESSION["RESPONSE_MSG"] = ["No data found.", "danger"];
```

After you set a `$_SESSION` you can now show it to the views using the `msg()` helper function.

This is the alert helper function called msg. This helper function accepts a session message that then `unset/removes` when refreshing the page.

```
msg($sessionMessage);
```

**Why unset it?** 

It's because we don't want messages to stack up in the session.

**Why session?** It's because re redirect pages using a header and in order to keep the message to the destination page, we need to put it in a session and display it on the page we want. Then we unset the passed session to the msg helper function so that it will remove when the page is reloaded.

### # How to display to views?
Just echo the msg helper function in your views then pass the session parameter like this.
```
msg('RESPONSE_MSG');
```