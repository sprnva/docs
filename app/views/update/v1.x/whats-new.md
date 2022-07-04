# What's new?

<div class="alert alert-secondary" role="alert">
 Sprnva and its other first-party packages follow Semantic Versioning. No particular date when releasing Major updates to the framework, while minor and patch releases may be released as often as every week. Minor and patch releases should never contain breaking changes.
</div>

* * *

## v1.4.23
- refactor migration with more robust query builder

* * *
## v1.4.22
- bump version
- [ADDED] robust database query builder

* * *
## v1.4.19
- [SOLVED] issue in upload single and multiple files 
- [SOLVED] error in selectLoop chain with get
- [SOLVED] paginate links not counting all query issue

* * *
## v1.4.13
- [SOLVED] error in chaining selectLoop()->paginate()->with()->get()
- [SOLVED] error in select()->get()

* * *
## v1.4.12
- refactor not found `config.php`
- refactor selective str in blast
- Blast always listens
- update blast ui
- blast refactor
- [ADDED] highlight blast code viewer
- [SOLVED] chmod error in migration
- [SOLVED] migration chmod issue
- [SOLVED] query builder with() method chain with select
- [SOLVED] migration chmod issue
- [SOLVED] bugs in filesystem and fortify

* * *
## v1.4.0
- [ADDED] storage class to handle file uploads
- [CHANGED] `Request::storeAs() -> Storage::storeAs()`
- [CHANGED] `Request::hasFile() -> Storage::hasFile()`
- [FIXED] paginate links issue
- [ADDED] user avatar
- [FIXED] issue in chmod migration and filesystem class
- [ADDED] avatar upload as example in user profile
- [ADDED] avatar in users migration file
- [FIXED] query builder `with() method` and `withCount()`

* * *
## v1.3.39

- [FIX] in prod mode abort page will be fired
- [FIX] dd not showing in devtools preview tab

#### Download sprnva without composer

- develop faster without composer
- just download the zip file and configure your credentials
- manually adding of classes in the class autoloader

* * *
## v1.3.38

- [FIX] no error msg in session if validate method parameter 1 (which is the url) is empty

* * *
## v1.3.37

- [FIX] validation unique:{table}
