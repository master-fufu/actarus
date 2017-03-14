ACTARUS
===================

Purpose
============== 
I started the development of Actarus to learn Symfony framework.

Description
============== 
Actarus is a tool designed to help ~~hackers~~ bounty hunters in their task of performing information gathering about their ~~targets~~ clients.

Features
============== 
project managment - create, edit, delete  
server managment - create, edit, delete, search  
domain managment - create, edit, delete, search  
host (subdomain) managment - create, edit, delete, search  
task managment - create, edit, delete, search  
task automation - when an entity is created some tasks are immediatly performed. See `parameters/entity/recon`
result interpretation and callback - when a task is finished a callback is immediatly executed and performed some actions. See "Settings/Manage Task and their Callback" and `src/AppBundle/Command/InterpretTaskCommand.php`
alert managment - create, edit, delete, search
alert generation - the callbacks can generate alert, 4 levels available: info, low, medium, high. See `parameters/alerts/level`
technology managment - add, delete
technology gathering - Actarus can link an entity with certain technology. See `db.actarus.arus_technology`
multi processing - the three daemons fork to many childs. See `parameters/*_max_child`
clustering - Actarus can be installed on many servers, while the frontend gui in enabled on only one, the daemon (task runner) can be launched on all of them, admitting that all servers can acccess the database

Required
============== 
Mysql
Apache
PHP and php-dev
libyaml and libyaml-dev
pecl yaml

Installation
============
git clone https://github.com/gwen001/actarus.git
php composer.phar install
php app/console doctrine:schema:update --dump-sql
php app/console doctrine:schema:update --force
chmod -R 500 .
chmod -R 700 app/cache app/logs

Create an user
============== 
php app/console fos:user:create <username> <email> <password> --super-admin

Faq
============== 
What the purpose of the table `db.actarus.requete`
Supposed to be a feature to performed tasks on specific url, like sqlmap. It's not currently used, you can delete it.

What the purpose of the table `db.actarus.arus_entity_loot`
Supposed to be the data collected, like credentials, I finally decide to merge those datas with alerts, so it's not used anymore.

Finally
============== 
This tool help me a lot. It performed basics redundant actions. It keeps things classified.  
It's pretty interesting when you deals with many targets. 
Unfortunately I don't like Symfony and I am to lazy now to continue this project.
I don't believe in license.  
Feel free to do whatever you want with this program.