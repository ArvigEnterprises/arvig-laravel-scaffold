Arvig Laravel Composer Package
=========================

This package should be included with all Arvig Laravel-based projects.

It does the following:

1. Implements a new Testing folder (Integrations) and allows for calling of Integration Tests via Artisan Commands
2. Adds a new arvig-laravel config file in the /configs folder


# Install
1. Add the following to your consumer app's composer.json file:
 
   `
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:ArvigEnterprises/repository_name.git"
        }
    ],
   `
2. Run the following command:
   
   `composer require arvig/arvig-laravel` 

3. Run the following command:
   
   `php artisan arvig-laravel:install`

# Using Package

## Integration Testing
`php artisan test --testsuite=Integration`