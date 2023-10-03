# Recipe
A simple recipe website because I am tired of remembering everything.

## Setting up a Development Environment
It is recommended to create a bash alias for `sail`:
```bash
# Add to ~/.bashrc
alias sail='bash vendor/bin/sail'
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

With all dependencies installed you can now bring up the containers configure the project

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
npx browserslist@latest --update-db
sail npm run dev

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
