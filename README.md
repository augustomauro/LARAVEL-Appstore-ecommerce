<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About This Proyect

This project represents a relatively basic ecommerce in terms of its table structure but fully functional.

The guidelines of the challenge here developed by me are presented below.

### Requirements

You must create an application in PHP using a framework. The goal is to simulate a web application like the Google PlayStore: an application market where users can list apps, view additional information and add them to a cart and / or wish list.

### Database

Reading the requirements, you must build the database that you consider appropriate so that everything works correctly. The database type must be relational, it does not matter if it is MySQL, Maria DB or Postgres. All table, column and index names must be in English and use underscore to separate words.

### Register

There are two types of users in the application: developer and client. Both are registered through the same form, but they must specify if they are developers or clients.

### Developer User

The user registered as a developer can carry out the following actions: 

+ Register an application indicating:
    - category
    - name
    - sale price
    - image or logo

+ Edit the data of an application.
    - The category and the name cannot be modified.

+ Unsubscribe an application

### Client User

The user registered as a customer can perform the following actions:
+ List all categories of apps
+ Enter a category and see the apps in that category
+ Enter the details of an app

### JavaScript FrontEnd

We need you to integrate JavaScript in the front but only to make calls through
AJAX. You can use the fetch method or some library like axios (desirable), or else
use jQuery ajax. When the client user clicks on "Buy" you must send by
AJAX the id of the app and save it in the database.
For this, you must create an endpoint that is accessed in the following way:
https: // localhost: 3000 / api / buy

That URL can only be invoked by:
+ POST if it is to buy or add to the wish list.
+ DELETE if it is to cancel the purchase or remove it from the wish list.
Important: Only the app_id should be communicated in the request body

### Routes and Security

All routes that only authenticated users can navigate must be under the
prefix / me, for example:
In the path http: // localhost: 3000 / me / apps, if the logged in user is the developer, you will see
the apps you created, while if you are the customer user, you will see the apps you purchased. In
change, if you enter http: // localhost: 3000 / apps (without the prefix) you will see all the apps without
distinction. If an unauthenticated user tries to enter a route that does not
corresponds, for example to the url to create applications, then it must be redirected to where it came from.

### Conclusion

We hope to have a registration screen and a login screen. Then, entering the system as a developer, I want to see the list of applications that I published, enter the details of each one, edit information or delete it. However, if I login as a customer user, I want to see the list of applications that I bought and see the detail. Users who are not registered or logged in can go through the categories, see the apps, the details and add it to buy.

## Criteria to evaluate

+ Responsive, modern, intuitive design: 
    - It can be something minimalist, simple, but functional. 
    - Any CSS framework can be used: Bootstrap, Materialize, Bulma.

+ General knowledge of PHP.
+ Basic / intermediate knowledge of Laravel: 
    - Correct use of controllers. 
    - Correct use of models, relationships, attributes.

+ Validation of all forms.
+ Security: 
    - That developer users do not enter common user routes.

+ Good coding practices.
+ Good practices for naming routes.
+ Correct use of HTTP verbs.
+ Correct design of the database.
+ Optimization of the tables.

## Bonus

You are required to implement at least one of these points (your choice). The more and better you implement, the better score you will get. These are some extra points that you can implement:

+ In the list of categories: 
    - That they appear in alphabetical order. 
    - Show the number of related apps. 

+ In the list of apps: 
    - Each 10 results must be paginated. 
    - By default they should appear in the order of creation, from most recent to oldest. 
    - Add an option to see only the most voted and when listing them that appear in the order of the most voted to the least, but those with a score below 2 should not appear. 

+ In the app detail: 
    - Two buttons should appear here, one that says "Buy!" and another that says "Add to wish list". 
    - These two buttons should only appear if the visitor is not the same developer user of the app. 
    - If a user has already bought the app, they cannot buy it again and if they have already added it to the wish list, neither can they.

+ Perform the assembly of the database through migrations. 
+ Add seeders to popular database. 
+ When the developer user edits the price of an app, the historical record of all the prices of the application must be saved, including the date when the change occurred. 

Good luck!

Augusto Mauro
www.github.com/augustomauro

