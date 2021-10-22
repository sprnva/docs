# What's new?

- [Framework](#framework)
- [Sprnva File](#sprnva)
- [Fortify](#fortify)

Sprnva and its other first-party packages follow Semantic Versioning. No particular date when releasing Major updates to the framework, while minor and patch releases may be released as often as every week. Minor and patch releases should never contain breaking changes.

### Release v1.x
Released July 30, 2021

---

<a name="framework" style="padding-top: 30px;">&nbsp;</a>
#### sprnva/framework v1.3.28
changes in core/framework
- fix error page UI bugs
- added new validation ['`numeric`']
- rework validation response
- you can now pass validation response to json and return it to ajax call

<a name="sprnva" style="padding-top: 30px;">&nbsp;</a>
#### sprnva/sprnva v1.5.24
changes in core/app
- remove `layouts/profile.php` not used anymore because of fortify

<a name="fortify" style="padding-top: 30px;">&nbsp;</a>
#### sprnva/fortify v1.0.15
changes in package
- customizable authentication
- updated /auth files
- one time fortified

If you haven't ever try fortify, this is how to install fortify. Do this steps:

```bash
composer require sprnva/fortify

php vendor/sprnva/fortify/serve
```