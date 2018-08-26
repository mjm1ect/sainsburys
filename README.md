# Sainsburys Test App.

> sainsburys

## Installation / Build Setup

## Prerequisites
To run this project, you must have PHP 7 and composer installed. (This app uses the Laravel 5.6 framework).
You should setup a host on your web server for your local domain. You should be able to run using the command 'php artisan serve'. Alternatively, for this you could also configure Laravel Homestead or Valet.

The API has one Post endpoint ```/api/totals```, which takes a JSON request body containing the products to be totalled and returns a total price for the basket.

To access the API endpoint /api/totals, it would be advised to use Postman or similar software for easy of use.

``` bash
# Clone repo
git clone git@github.com:mjm1ect/sainsburys.git

composer install

# serve the application, alternatively this can be configured using laravel Homestead or Valet.
php artisan serve

# phpunit test
php vendor/phpunit/phpunit/phpunit
```

Once the application to serving, you will be able to POST the JSON examples provided in the brief to the API endpoint: ```/api/totals```

## Testing
Some basic automated testing of POST requests to the Api ```/api/totals``` and checking the response total has been implemented using phpunit feature tests, ideally some unit tests would also be completed to test specific funtions etc.

``` bash
# phpunit test
php vendor/phpunit/phpunit/phpunit
```

## Additonal Notes
With more time it would be ideal to implement some clean user-friendly documentation for the API e.g. possibly using APIDoc (http://apidocjs.com/) or similar.

Plus before starting implementation wrote some basic Gherkin stories to help with testing the app/api.

Also, should the items included in a meal deal be prefered in some way? e.g. if there are 3 drinks and only 2 meal deals, the 2 lowest price drinks would be in the meal deal. The examples given appeared to ignore any rulings such as this.



