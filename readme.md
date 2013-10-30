For Runtriz
===========

This little application is designed to demonstrate my API writing skills and back-end dev abilities through a simple JSON API utility for Creating, Updating, Reading and Deleting basic hotel information.

Features
--------
* Basic user authentication
* CRUD w/ GET, POST, PUT, and DELETE
* Restful flavor controller
* DB migrations and seeds
* Pre-configured composer.json file
* Unit tests
* Data validation service
* Interface Driven data implementation
* JSON responses

Use
-----
To run the accompanying unit tests simply clone this repo through Git, run composer install, and execute PHPUnit. Before use, you should also run migrations with

`php artisan migrate`

and all seeds with

`php artisan db:seed`

For manual testing, all of the Restful controller methods are accesible via the CURL command line tool. Alternatively, the Chrome-based Postman app can make testing (for all verbs except PUT) really simple.

For example, to test getting all records simply execute the following command
`curl -i localhost/simple_api/public/api/v1/hotels --user Basic@Fake.com:secret`


Suggestions For Improvement
---------------------------
* Update method does not allow for individual fields to be saved
* Integration tests (especially of the Restful controller)
* Data format agnostic repositories (i.e. convert all output to Arrays or JSON)
* More secure user authentication - access to certain methods by user level for example
