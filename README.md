# OC-Tasks
Simple task list using Symfony and XAMPP

For setting up the database, use doctrine:

php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate

To import sample data import the sql file task-oc.sql
