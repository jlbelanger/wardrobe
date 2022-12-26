# Jenny's Wardrobe

View the app at https://wardrobe.jennybelanger.com/

## Development

### Requirements

- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)
- [Yarn](https://classic.yarnpkg.com/en/docs/install)
- Database
- Web server with PHP

### Setup

``` bash
# Clone the repo
git clone https://github.com/jlbelanger/wardrobe.git
cd wardrobe

# Configure the environment settings
cp .env.example .env
cp cypress.config.example.js cypress.config.js

# Install dependencies
composer install
yarn install

# Generate key
php artisan key:generate

# Run database migrations
php artisan migrate

# Set permissions
chown -R www-data:www-data storage

# Create account with username "test" and password "test" (or reset existing account password to "test")
php artisan reset-auth
```

Copy `/public/uploads` from the live site.

### Run

``` bash
yarn watch
```

### Lint

``` bash
./vendor/bin/phpcs
yarn lint
```

### Test

``` bash
./vendor/bin/phpunit
```

### Generate splash screens

``` bash
npx pwa-asset-generator public/icon.png ./public/assets/img/splash --background "#000" --splash-only --type png --portrait-only --padding "20%"
```

## Deployment

Essentially, to set up the repo on the server:

``` bash
git clone https://github.com/jlbelanger/wardrobe.git
cd wardrobe
cp .env.example .env
# Then configure the values in .env.
composer install
php artisan key:generate
php artisan migrate
chown -R www-data:www-data storage
```

For subsequent deploys, push changes to the main branch, then run the following on the server:

``` bash
cd wardrobe
git fetch origin
git pull
composer install
php artisan config:clear
```

### Deploy script

Note: The deploy script included in this repo depends on other scripts that only exist in my private repos. If you want to deploy this repo, you'll have to create your own script.

``` bash
./deploy.sh
```
