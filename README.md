# Recipe
A simple recipe website because I am tired of remembering everything.

## Getting started
Configure [Laraval Sail](https://laravel.com/docs/8.x/sail) to start developing and configure your environment in `.env.sample`.

```bash
composer require laravel/sail --dev
php artisan sail:install
```

To start the development environment run:

```bash
./vendor/bin/sail up
```

Once you are set up, connect to the Laravel container, update all dependencies & create/fill the database

```bash
    # Update dependencies
    npm install && npm run dev

    # Create database structure
    php artisan migrate
    php artisan db:seed
```

Happy coding!