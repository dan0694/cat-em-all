
# Laravel Cat Tracker App

In this Laravel App, you can keep track of your cats, manage their information and keep track of the recent locations of your pets.

## Features

- Login and register system.
- Add a new Cat.
- Remove Cats.
- Edit Cats.
- List all of his Cats.
- Map screen showing the location of each cat.
- Persist data .
- Back End and Front End are made with Laravel. For the Frontend the project uses Laravel Blade and Tailwind for styles.

## Previous steps

First, you must make sure you have composer, php, MySql and laravel on your device.

- Composer download: https://getcomposer.org/download/

- XAMPP download: https://www.apachefriends.org/download.html

- Laravel installation document: https://laravel.com/docs/7.x/installation

In MySql you must to create a database for the project.


## Installation

- Clone the repository with git clone
- Move to the root of the project folder and install dependencies:

```bash
$ composer install
```

- Copy .env.example file to .env and edit database credentials there
- Generate a random key for the project:

```bash
$ php artisan key:generate
```

- Run the migrations and seeder:

```bash
$ php artisan migrate --seed
```

- Run the project:

```bash
$ php artisan serve
```

- Open the app by entering the url generated in the console. A register page apears, you can register a new user or use this user generated:

    - email: danielnuso@gmail.com
    - pass: demo94






