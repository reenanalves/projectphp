Install Enviroment <dev, test, prod>
php install.php <enviroment>

Start Application
docker-compose up -d

Create New Migration
docker container exec userservice-php ./vendor/bin/phinx create <NameMigration>

Migrate Database
docker container exec userservice-php ./vendor/bin/phinx migrate