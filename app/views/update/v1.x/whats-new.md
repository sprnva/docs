# What's new?
Sprnva and its other first-party packages follow Semantic Versioning. No particular date when releasing Major updates to the framework, while minor and patch releases may be released as often as every week. Minor and patch releases should never contain breaking changes.
---

### DOWNLOAD SPRNVA ZIP NO COMPOSER REQUIRED
click here to download: [sprnva-no-composer.zip](https://github.com/sprnva/sprnva-no-composer/archive/refs/heads/main.zip)

- setup `config.php` credentials
- set `'base_url' => 'example-app'` *('example-app' is the directory name of your application)*
- Create a database identical to your config then go to  `/migration`module with this URL:
```
http://localhost/example-app/migration
```
- click fresh button to migrate default tables
- You can start building your application


### INSTALL VIA COMPOSER
```sh
composer create-project sprnva/sprnva example-app

cd example-app
```

- setup `config.php` credentials
- set `'base_url' => 'example-app'` *('example-app' is the directory name of your application)*
- Create a database identical to your config then go to  `/migration`module with this URL:
```
http://localhost/example-app/migration
```
- click fresh button to migrate default tables
- You can start building your application