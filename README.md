<p align="center"><img src="https://raw.githubusercontent.com/imran786asus/assignment/master/Blacksmith.png" width="400" alt="ECom Logo"></p>

## About Project

Aim of this project is to provide ease of management of categories.

## Details

- Added Admin Login with middleware to for admin and other user can assess that route.
- Added Category Page with pagination and Action for Edit and Delete Category
- Added Category Mapping for New Category as well Old Category(By Editing it).
- Homepage Category Listing Present with parent child relation.
- Deleting any category will map its all child categories to ites parent category.
- Added Event and Listner for Category Delete Event.

## How to run the application
=============================
1. Your System should have composer installed(https://getcomposer.org/)
2. PHP Should be present in system and Version should be 8.2 or higher. 
3. Copy .env.examplate and rename to .env
4. Update databse credention or keep it default 
```sh
DB_CONNECTION=sqlite
```
5. Run Command
```sh
composer install
```
6. Run Command to migrate database and seed with with defauld username and password for login to admin dashboard.
```sh
php artisan migrate --seed
```
7. Run command to start the application in local machine
```sh
php artisan serve
```
8. Go to url showing in the terminal or (http://127.0.0.1:8000)
9. Deafult username and password for admin login is

email :
```sh
test@example.com
```
password: 
```sh
12345678
```

11. Contact me for any quaries on (mailto: imran786asus@gmail.com)
