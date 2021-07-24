# # Alert Messages
---
Now we want users to know what's the status of the request by display an alert message.

![alt text](public/storage/images/alert.png)

### # Usage
Create a `with_msg(["message" => "", "status" => ""])`. Alert types example `[ default, primary, success, warning, danger ]` to give colors to the message to be shown.

After you set a `with_msg()` you can now show it to the views using the `alert_msg()` helper function. This helper function will display as alert and `unset/removes` the alert when refreshing the page.

### # How to display to views?
Just echo the `alert_msg()` helper function in your views like this.
```php
<?= alert_msg() ?>
```