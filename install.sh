#!/bin/bash
sudo /bin/bash -c 'echo -e "192.168.10.10 evidentia.test" >> /etc/hosts'
cd homestead
vagrant box remove laravel/homestead --all
vagrant box add laravel/homestead -c
vagrant up
vagrant ssh -c 'cd laravel; composer install; php artisan migrate; php artisan db:seed; php artisan key:generate'
