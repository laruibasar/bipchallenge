# PHP Challenge

## Description

Base your code on the provided example.

It's job is to serve one json-encoded string in response to a http request. 

Use the file as data __turbines.csv__ for fetching turbines data to responde
to the request.

Use an easy CRUD service to operate on data on the file.

### Rules

* You __may not__ use any external library or framework
 __except from the ones used to Unit Test the solution__.
* After refactoring, this code __must__ do the same thing.
* You __have to__ use OOP.
* You __have to__ use at least PHP 7
* You __should__ introduce some framework-like feature (routing, dispatching, autoloading).
* You __can__ use psr-0 autoloading system.
* You __can__ put comments where you describe why you do certain things or just explaining some more high level decision.
* You __can__ change storage system for turbine data.

**Bonus**

Cover the code with Unit Tests or even better, build it using a TDD approach.

## Solution

The approach to solve this challenge will take a major overall of the
provided script, using a complete change into using OOP paradigm, with
autoloading to make all classes available to provide all features of
a web application, from http objects representing requests and responses,
to database models and storage.

The architecture will be similar to a similar MVC design, responding to
events cause by http requests - GET, POST, PUT, DELETE.

### Requirements

Code was developed using:
- php 8.1.4

This is using features that are only available after 8.1, e.g., `enum`, this will mean
that this will require this php version or it will no work. Only took warning after having
things mostly ready and I looked forward for using this.

### Code organization

Organizing code is important because allows the developer to easily guess
where some piece of the application might be place, as the application
grows.

```
- autoload.php - autoload classes for the application 
- index.php - application entry point
- Config.php - application configuration and setup
- Controller - controllers to make the interaction between components
  \ Controller.php
- Core - application general-use classes 
   \ Http - classes related to http requests and http responses
  |
   \ File - file operations
  |
   \ Database - layer to abstract CRUD operations between model and real data models
- Model - data object representation 
   \ Turbine.php
```
