<p align="center">
    <img src="https://i.ibb.co/8rdfXrh/imageonline-co-textimage.png" width="400">
</p>



## About EMI-Generation Project

<strong>Project Title:</strong> 
```Equated Monthly Installment (EMI) Generation```

<strong>Author:</strong> ```Dear Roy```

<strong>Version:</strong> ```1.0.0```

<strong>Stack:</strong> [Laravel 8]('https://laravel.com/'), [VueJs]('https://vuejs.org/'), [MySQL]('https://www.mysql.com/'), [TailwindCSS]('https://tailwindcss.com/')

## Project requirements:

1. There are two types of users. One is a general user and the other is Admin.
2. Create a login page for Admin and login and registration page for user
3. Users can login and apply for a loan by submitting a form containing amount, duration (in
months) and interest rate.
4. Admin can login and in a panel/dashboard see all the loan applications users have submitted.
Admin should be able to reject or approve the applications. If Admin rejects the application, the
user can see the status change on user’s panel. And If the admin approves the application, the
user can see the approved status with EMI details.
5. EMI will be implemented using flat rate method.
6. EMI payment or due date will be 1 month from the date and time admin has approved the loan
application and payment end date will be 1 month from the payment date.

<p align="center">
    <img src="https://i.ibb.co/BfrRc3j/EMI-Generation.png">
</p>


## Installation Guide
Please install [Composer]('https://getcomposer.org/') and other essential tools for setting up the environment to run and/or create a Laravel project.
If your computer already has PHP, MySQL or XAMPP and Composer installed then follow the instructions bellow:
* Clone the project ```git clone git@github.com:johndearroy/EMI-Generation.git```
* Navigate to the project directory ```cd EMI-Generation```
* Run ```cp .env .env.example``` or manually copy the ```.env.example``` to ```.env``` at the root
* Configure the database credentials
`````yaml
DB_DATABASE=<YOUR_DATABASE_NAME>
DB_USERNAME=<YOUR_DATABASE_USERNAME>
DB_PASSWORD=<YOUR_DATABASE_PASSWORD>
`````
* Run ```composer install```
* Run ```npm install && npm run dev``` [N.B: Make sure you have nodejs installed on your machine]
* Run ```php artisan migrate --seed``` or ```php artisan migrate:fresh --seed```
* Finally run ```php artisan serve``` and navigate to "http://127.0.0.1:8000/" at your browser.
* If you seeded the data properly by command ```php artisan migrate --seed``` then you can now login as admin by using the following credentials:

```yaml
Username / Email: admin@admin.com
Password: password
```
* And for login as normal User, please register a user first from "http://127.0.0.1:8000/register"
and login.

