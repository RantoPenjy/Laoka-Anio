# Laoka-Anio

Laoka Anio is a Symfony 6 project that selects a random Malagasy dish from a database of Malagasy dishes. The website also serves as a cuisine blog that showcases all the Malagasy dishes in the database along with their recipes.

## Installation:

- Clone the repository from Github: `git clone https://github.com/your-username/malagasy-dish-selector.git`
- Install dependencies: `composer install`
- Create a database: `php bin/console doctrine:database:create`
- Run database migrations: `php bin/console doctrine:migrations:migrate`
- Load fixtures: `php bin/console doctrine:fixtures:load`
- Start the development server: `symfony server:start` or `symfony serve`

## Usage:

- To select a random Malagasy dish, click on the "Random Dish" button on the homepage.
- To view all Malagasy dishes and their recipes, or to add a new dish or to edit or delete an existing dish, you must register and login

## Configuration:

- To configure the database connection, edit the .env file.
- To configure the application settings, edit the config/packages/app.yaml file.

## Contributing:
If you would like to contribute to this project, please fork the repository, make your changes, and submit a pull request.

## Credits:
This project was created by RantoPenjy and is licensed under the MIT license.
