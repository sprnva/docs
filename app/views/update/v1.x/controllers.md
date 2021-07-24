# # Controllers
---
Sprnva is a MVC approach so we also have a Controller.

You will find the controller at app/controllers. Then this is how you declare a controller.
```php
<?php

namespace App\Controllers;

class WelcomeController
{
    protected $pageTitle;

    public function index()
    {
        $pageTitle = "Home";

        return view('/home', compact('pageTitle'));
    }
}
```
##### <span style="color:red">**ALWAYS REMEMBER WHEN ADDING A CLASS, DON'T FORGET TO ADD IT'S NAMESPACE AND RE-INITIALIZE THE CLASS AUTOLOADER USING COMPOSER.**</span>

This is how you re-initialize class autoloader using composer.
```bash
composer dump-autoload
```

### # Recommended controller Method Name

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Verb</th>
            <th>URI</th>
            <th>Method</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>GET</td>
            <td>/project</td>
            <td>index</td>
        </tr>
        <tr>
            <td>GET</td>
            <td>/project/create</td>
            <td>create</td>
        </tr>
        <tr>
            <td>POST</td>
            <td>/project</td>
            <td>store</td>
        </tr>
        <tr>
            <td>GET</td>
            <td>/project/{project_id}</td>
            <td>show</td>
        </tr>
        <tr>
            <td>GET</td>
            <td>/project/{project_id}/edit</td>
            <td>edit</td>
        </tr>
        <tr>
            <td>POST</td>
            <td>/project/{project_id}</td>
            <td>update</td>
        </tr>
        <tr>
            <td>POST</td>
            <td>/project/{project_id}/delete</td>
            <td>destroy</td>
        </tr>
        <tr>
            <th colspan="3" class="text-center">WORKS ON AJAX ONLY AND SOME BROWSERS</th>
        </tr>
        <tr>
            <td>PUT/PATCH</td>
            <td>/project/{project_id}</td>
            <td>update</td>
        </tr>
        <tr>
            <td>DELETE</td>
            <td>/project/{project_id}</td>
            <td>destroy</td>
        </tr>
    </tbody>
</table>

**`GET`, `POST`, `PUT`/`PATCH` and `DELETE` (there are others) are a part of the HTTP standard, but you are limited to `GET` and `POST` in HTML forms at this time. You can use `PUT`/`PATCH` and `DELETE` in `AJAX` requests; however, this only works in some browsers.**

##### <span style="color:red">**ALWAYS REMEMBER WHEN ADDING A CLASS, DON'T FORGET TO ADD IT'S NAMESPACE AND RE-INITIALIZE THE CLASS AUTOLOADER USING COMPOSER.**</span>

This is how you re-initialize class autoloader using composer.
```bash
composer dump-autoload
```

### # Purpose of Controller?
Controller is the medium where logic, database and view meet.<br> Controller also is the processing area of all the logics to be fetch later in the views.