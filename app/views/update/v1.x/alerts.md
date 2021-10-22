# Alert Messages
---
Now we want users to know what's the status of their request by displaying an alert message.

![alt text](public/storage/images/alert.png)

### Using alert_msg($status);
Create a `with_msg(["message" => ""])`. Alert types example `[ default, primary, success, warning, danger ]` to give colors to the message to be shown.

After you set a `with_msg()` you can now show it to the views using the `alert_msg()` helper function. This helper function will display as alert and `unset/removes` the alert when refreshing the page.

### How to display to views?
Just echo the `alert_msg()` helper function in your views like this.
- `Note:` that the default color of the alert message is `info`
```php
<?= alert_msg('danger') ?>
```

### Using Error::any();
You can display errors using the loop to customized the looks of the alerts. `Error:any()` contains all the message produce by the applciation.
```html
<?php if (!empty(Error::any())) { ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= implode("<br>", Error::any()) ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>
```

when using this method, make sure the alert message is dismissable everytime you refresh the page. To do that we need to add a `clear()` method above the footer include at the bottom of our file.
```html
  </div>
    </div>
</div>
<?php Error::clear() ?>
<?php require __DIR__ . '/../layouts/footer.php'; ?>
```