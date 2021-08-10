# Deployment
--- 
It's easy to deploy Sprnva application to a hosting server no need to scratch your head with all of the configurations.

**Instructions**:
1. Select all files and directories of your Sprnva application except for `.git` directory if present.
2. Paste or drag the selected files and directories to your hosting's domain directory
3. If `config.php` is not present, duplicate `config.example.php` and rename it to `config.php`.
4. edit the `config.php` and fill in your credentials. Please check the `base_url` and match it to your hosting's domain directory
5. If your application require a database, then add a database to your hosting.
6. If you have migration file to migrate, you can migrate it using the migration module and click the migrate button.
7. Change the `environment` to `production` in `config.php`
8. You can now access your application.

Enjoy your sprnva flavoured application in a hosted server.