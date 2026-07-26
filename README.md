# Recipe

A simple recipe website because I am tired of remembering everything.

## Running in Production

Pull the latest image fromt the Docker registry and run the container  after copying the production `.env` file.

```bash
docker pull thunarez/recipe-cookbook
docker run -d -p 8080:80 --env-file .env thunarez/recipe-cookbook
```

Because Laravels scheduler is used to remove duplicate tags you can add a single cron configuration to the server that runs the `schedule:run` command every minute.

```bash
* * * * * cd <your-project> && php artisan schedule:run >> /dev/null 2>&1
```

## Setting up a Development Environment

Make sure all permissions are set correctly:

```bash
sudo chown -R $USER:$USER .
sudo chmod -R o+w storage/logs
sudo chmod -R o+w storage/framework/sessions
```

Install all dependencies:

```bash
# Install back-end dependencies.
composer install
```

Copy over the site specific configuration and modify it based on your setup. For example, alter if *registration* is available by modifying the `REGISTRATION_ENABLED` flag.

```bash
cp .env.docker .env
```

Once the docker containers are running you can configure Laravel, populate the database & install front-end dependencies.

```bash
# Set up application key and database
php artisan key:generate
php artisan migrate:fresh --seed

# Install front-end dependencies
npm install

```

If you want to run tests, follow the example below:

```bash
# Run all tests
test

# For a specific test only
test --filter RecipeTest
```

To start the local Vite Sever (front-end) and serve the page using Artisan (back-end) run the following commands:

```bash
npm run dev
php artisan serve
```

You should not be able to visit the website on [http://localhost:8000](http://localhost:8000).
