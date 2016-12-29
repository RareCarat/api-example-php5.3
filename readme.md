# Rare Carat API Examples - PHP

This projects demonstrates a very simple example on how to communicate with the Rare Carat API, using PHP 5.3. The current version of guzzlehttp/guzzle requires PHP >=5.5, so on this example we are using nategood/httpful.

## What it includes

- Basic Composer project
- Basic functions to list, create, update, and delete resources.
- Sample data used in the examples.

## Using this demo

Simply clone using one of the following methods:

**SSH**

    git clone git@github.com:rarecarat/api-example-php5.3.git YourProjectName
    
**HTTPS**

    git clone https://github.com/rarecarat/api-example-php5.3.git YourProjectName
    
Then edit the composer.json file to set your own project meta information and define your dependencies as normal. To run this example, simply configure your web server to this folder, or use the PHP built-in server with
```php -S localhost:8000```. After that, open ```http://localhost:8000``` on your browser.

## Notes

The .gitignore file lists composer.lock, which you may wish to commit to source control for your own project.