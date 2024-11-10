## NOTE

This template uses composer packages which are in the vendor folder
This template is usable even if copied into xammp server computers with no composer installed, as long as the vendor folder is also copied

## COMPOSER DEPENDENCIES ()

- Twig templating
- Vlucac dotenv
- AdminLTE

## INSTALL DEPENDENCIES

## Run only when the vendor folder does not exist (or just copy the vendor folder whereever you copied this template)

composer require "twig/twig:^3.0" vlucas/phpdotenv "almasaeed2010/adminlte=~3.2"
composer install

# RUN WHEN AUTOLOADING IS EXPERIENCING PROBLEMS

composer dump-autoload

##

## DEV SETUP

1. Update .env for env variables

## DEV PROCESS

1. Add a route (in index.php)
2. Duplicate the BaseController and rename it your specific route (in src/controller)
3. Link the controller to your new route (in index.php)
4. In your controller, change the render value of TwigLoader ( ex: TwigLoader::render('yourTwigFile.twig'); )
5. In src/views, duplicate the BaseTwig folder and rename all files to yourTwigFile
