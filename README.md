# Recipe
A simple recipe website because I am tired of remembering everything.

## Pushing a new image
Release a new docker image:

```bash
docker login
docker build -t thunarez/recipe-cookbook:1.0.0 .
docker push thunarez/recipe-cookbook:1.0.0
```

## Running in Production
Pull the latest image fromt the Docker registry and run the container  after copying the production `.env` file.

```bash
docker pull thunarez/recipe-cookbook:1.0.0
docker run -d -p 8080:80 --env-file .env thunarez/recipe-cookbook:1.0.0
```

## Setting up a Development Environment
It is recommended to create a bash alias for `sail`:
```bash
# Add to ~/.bashrc
alias sail='bash vendor/bin/sail'
```

Make sure all permissions are set correctly:
```bash
sudo chown -R $USER:$USER .
sudo chmod -R o+w storage/logs
sudo chmod -R o+w storage/framework/sessions
```

To get started first install all depedencies

```bash
# Install back-end dependencies
composer update

# If you use Docker
docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install
```

With all dependencies installed you can now bring up the containers configure the project. You can alter if *registration* is available by modifying the `REGISTRATION_ENABLED` flag

```bash
cp .env.docker .env
sail up -d
```

Once the docker containers are running you can configure Laravel, populate the database & install front-end dependencies

```bash
# Set up application key and database
sail php artisan key:generate
sail php artisan migrate:fresh --seed

# Install front-end dependencies
sail npm install
sail npm update vue-loader
sail npm run dev

# To keep monitoring for changes
sail npm run watch

# Run all tests
sail test

# For a specific test only
sail test --filter RecipeTest
```

Outside of the containers over your project make sure you have the right permissions:

```bash
sudo chown -R $USER:$USER .
```

You should not be able to visit the website on [http://localhost](http://localhost).
