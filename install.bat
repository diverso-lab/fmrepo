@echo off
cd homestead
set VAGRANT_HOME=C:\HashiCorp\Vagrant
vagrant box remove laravel/homestead --all
vagrant box add laravel/homestead -c
vagrant up
vagrant ssh -c 'cd fmrepo; rm composer.lock; composer install; php artisan fmrepo:start'
