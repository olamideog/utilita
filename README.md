# Utilita-Technical Test

Built on Laravel 10 and Laravel Sanctum package

# Setup

- Copy the `env.example` file to `.env`
- Run the command `composer install`
- Run the command php artisan key:generate
- Create the database `utilita`
- Update the env file with the necessary database connection credentials
- Update the app url in the `.env` file
- Run the commands `php artisan migrate` and `php artisan db:seed`
- Import the post man collection and environment in the `postman` directory into your own Postman application
- Before using any endpoint, execute the CSRF Token endpoint
- After creating a new user and adding a few meter readings, you can generate the bill using the artisan command `php artisan utilita:generate-bills`

# Assumptions

- A User can have only 1 meter
- All meters are new, without prior usage.
- Meters will send data hourly.
- Meters won't send missing or corrupted data.
