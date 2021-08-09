# Sprnva Fortify
---

### Introduction
What is Fortify? 

Sprnva Fortify is a authentication backend implementation for Sprnva. Fortify registers the routes and controllers needed to implement all of Sprnva's authentication features, including login, registration, password reset, and more.

You are not required to use Fortify in order to use Sprnva's authentication features. You are always free to make your own authentication using your skills and the sprnva authentication helpers.

#### When Should I Use Fortify?
You may be wondering when it is appropriate to use Sprnva Fortify. If your application needs authentication features, you have two options: manually implement your application's authentication features or use Sprnva Fortify to provide the implementation of these features.

If you choose to install Fortify, you do not have to make a user inteface, controllers and route everything is built backend for you.

If you choose to manually create an authentication instead of using Fortify, you may do so by creating login, registration and profile from scratch using the Sprnva authentication helpers.

### Installation
To get started, install Fortify using the Composer package manager:
```bash
composer require sprnva/fortify
```
