@echo off
cd homestead
set VAGRANT_HOME=C:\HashiCorp\Vagrant
vagrant box remove laravel/homestead --all
vagrant box add laravel/homestead -c
vagrant up
vagrant ssh -c 'cd laravel; composer install; php artisan migrate; php artisan db:seed; php artisan key:generate'
