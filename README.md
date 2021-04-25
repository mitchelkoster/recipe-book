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
sudo apt install php 7.4 php7.4-curl php-xml composer
```

## Getting started
To get started first install all depedencies

```bash
# Install back-end dependencies
composer update
```

With all dependencies installed you can now bring up the containers configure the project

```bash
cp .env.docker .env
./vendor/bin/sail up -d
```

Next connect the `sail` docker container and configure the project:

```bash
# Set up application key and database
php artisan key:generate
php artisan migrate:fresh --seed

# Install front-end dependencies
npm install && npm run dev
```

Outside of the containers over your project make sure you have the right permissions:

`sudo chown -R $USER:$USER .`

You should not be able to visit the website on `http://localhost`.