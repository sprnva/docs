# # Controllers
---
Sprnva is a MVC approach so we also have a Controller.

You will find the controller at app/controllers. Then this is how you declare a controller.
![alt text](public/storage/images/controllers.png)

##### <span style="color:red">**ALWAYS REMEMBER WHEN ADDING A CLASS, DON'T FORGET TO ADD IT'S NAMESPACE AND RE-INITIALIZE THE CLASS AUTOLOADER USING COMPOSER.**</span>

This is how you re-initialize class autoloader using composer.
```
$ composer dump-autoload
```

### # Purpose of Controller?
Controller is the medium where logic, database and view meet.<br> Controller also is the processing area of all the logics to be fetch later in the views.