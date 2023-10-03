# Recipe
A simple recipe website because I am tired of remembering everything.

## Prerequisites
To run this project in a development you need to install [Docker](https://www.docker.com/), [Composer](https://getcomposer.org/) and [Laraval Sail](https://laravel.com/docs/8.x/sail).

**Installing Docker**
To install Docker on Linux run the following commands:

```bash
# Remove old installations
yes | sudo apt remove docker docker-engine docker.io containerd runc

# Install dependencies
yes | sudo apt install \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg-agent \
    software-properties-common

# Add docker repository
yes | curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
yes | sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) \
  stable"

# Install Docker
yes | sudo apt update
yes | sudo apt install docker-ce docker-ce-cli containerd.io

# Add a group so docker does not have to be run as sudo
yes | sudo groupadd docker
yes | sudo usermod -aG docker $USER
```

**Installing Composer**
To install composer on Linux run the following commands:

```bash
sudo apt install php 8.1 php8.1-curl php8.1-xml composer
```

## Getting started
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
