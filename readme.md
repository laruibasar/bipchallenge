# PHP Challenge

## Description

Base your code on the provided example.

Its job is to serve one json-encoded string in response to a http request. 

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
autoloading to make all classes available per request to provide all features of
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

### Install and run

This is a simple php web application, without any 3rd-party libraries or extra code requirements.

Simply clone the code from github and launch a php server inside the folder.

```
$ git clone git@github.com:laruibasar/bipchallenge.git bipchallenge

$ cd bipchanllenge

$ php -S localhost:8000

$ curl -v http://localhost:8000/address?id=1
*  Trying 127.0.0.1:8000...
* connect to 127.0.0.1 port 8000 failed: Connection refused
*   Trying ::1:8000...
* Connected to localhost (::1) port 8000 (#0)
> GET /address?id=1 HTTP/1.1
> Host: localhost:8000
> User-Agent: curl/7.82.0
> Accept: */*
>
* Mark bundle as not supporting multiuse
< HTTP/1.1 200 OK
< Host: localhost:8000
< Date: Tue, 19 Apr 2022 21:29:01 GMT
< Connection: close
< X-Powered-By: PHP/8.1.4
< Content-type: text/json;charset=UTF-8
<

* Closing connection 0
{"identifier":" Amaral1-1","latitude":39.026628121,"longitude":-9.048632539}
```

### Code organization

Organizing code is important because allows the developer to easily guess
where some piece of the application might be place, as the application
grows.

```
- autoload.php - autoload classes for the application 
- index.php - application entry point
- Controller - controllers to make the interaction between components
   \ Controller.php - Base (abstract) class intended to base all other controllers, best place to place common code
   \ AddressController.php - business logic extracted and adapted from initial example
- Core - application general-use classes 
   \ App.php - application configuration and setup
  |
   \ DataModel - specific code for interaction with data layer (plumbing from storage and driver interaction to data connection)
     \ Data.php - base (abstract) class intended to be base to every data connection required for accessing the data connection, csv to sql-base storage
     \ DataInterface.php - Interface required to implement by every data connection, this means a find(), store(), update(), delete() with their signature
     \ DataCsv.php - Data connection implementation permiting to interact with csv files
     \ Model.php - base (abstract) class intended to base all data modeling (similar to ORM, that can be useful through the application)
  |
   \ Http - classes related to http requests and http responses
     \ HttpMethod.php - enum representing all application-handled http methods (GET, POST, ...)
     \ HttpResponse.php - base (abstract) class that represent a generic http response object
     \ JsonResponse.php - specific http response with json response
     \ Request.php - object representing the HTTP request arriving at the application
  |
   \ Route - routing for the application
     \ Route.php - representation for a route in our application
     \ Router.php - container to handle our routes in the application
- Model - data object representation 
   \ Turbine.php - representing a turbine model with the fields available in our csv file
- Datasets - folder to place our datasets

```

### Other improvements


#### Database 

The data layer and handling was the least touched, as was saved for last, no CRUD operations and no, at least sqlite
instance to run on a real database.

Next steps would be, add setup and prepare a sqlite database with setting and insert a database
with the table turbine:

```sql
CREATE TABLE turbine (
    id INT PRIMARY KEY,
    identifier TEXT,
    producer TEXT,
    latitude REAL,
    longitude REAL
);
```

Then create a data connection that allow to have methods to do CRUD operations:
- create() using prepare statement as ways to filter content
- update() using prepare statement as ways to filter content
- delete() using prepare statement as ways to filter content
- select() using prepare statement as ways to filter content
- query() allowing to write something like a sql raw query

This would be built using PDO library abstraction and our custom class connector.

#### Validations

Regarding input validation and sanitization would be implementable setting up specific classes
allowing for custom but standard methods for handling input. Note that most would use the 
built-in php available functions and some regex mix-in.

#### Unit testing

Last time I use was with Laravel included batteries, so adapting the model would also be great.