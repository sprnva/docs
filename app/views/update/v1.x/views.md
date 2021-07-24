# # Views
---
Sprnva is a MVC approach so we also have a Views.

You will find the views at `app/views`. Views in sprnva have a naming convention, we added a `.view.php` in order for you to declare a more beautiful parameter using the `view()` helper. Example: `login.view.php`

Then this is how you declare a views inside the controller.
```php
return view('/login');
```

### # Passing parameters
We can pass a parameter to our views from controller using view() helper. This helper accepts 2 parameters like this:
```php
view($view_name, $params = [])
```
**compact()** - is a php function that creates array containing variables and their values. 

In very simple explaination, passing parameters to views using compact look like this:
```php
$pageTitle = "Login";
return view('login', compact('pageTitle'));

// The same as saying:
return view('login', ['pageTitle' => $pageTitle]));

// You can also add multiple like this:
return view('login', compact('pageTitle', 'users_data'));
```
Inside the `view()` helper function it will `extract()` the parameters so that you can use the parameters in your views.

**extract()** - Is the opposite of compact, this will import variables into the current symbol table from an array.
```php
$pageTitle = "Login";
return view('login', compact('pageTitle'));

// In your views you can access the parameter by:
echo $pageTitle;
```

Views is the front-end side of your application. Where you fetch all of the logic from the controller. The first paramerter is the view you want to load. The second parameter is optional and it's the data you want to pass to a view.

The view contains the following:
```php
require 'layouts/head.php';

    ...views content here

require 'layouts/footer.php';
```