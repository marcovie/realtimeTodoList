## Laravel (v7.24.0)


<p><b>Stack</b></p>

<p>Laravel (v7.24.0)</p>
<p>Laravel auth</p>
<p>Laravel passport</p>
<p>Laravel mix</p>
<p>Laravel-echo</p>
<p>Vuejs</p>
<p>Pusher</p>
<p>Axios</p>

## Description

<p>Basic project where can currently create a user(anyone), then can create a Todo task that would show up in realtime on another browser. The task can also be deleted/completed (soft deleted) which then in realtime removes from all browsers.</p>

## Git Repository

- [realtimeTodoList](https://github.com/marcovie/realtimeTodoList)

## Installation
<p>Step 1 - git clone https://github.com/marcovie/realtimeTodoList </p>
<p>Step 2 - go to terminal/cmd to the project root folder, type: composer install, follow by npm install.</p>
<p>Step 3 - Make copy of the .env.example file and change the copy name to .env, open file and change settings required.</p>
<p>Step 3 - Make database same name as you stated in .env file.</p>
<p>Step 5 - Once .env file created you will need to run following commands that is between quotes:</p>
<p>"php artisan key:generate" - (generates security key for laravel) </p>
<p>"php artisan migrate --seed" - (creates all tables and data required) </p>
<p>"php artisan passport install" - (passport is laravel plugin used to use the internal api, this will generate key needed to access internalApi) </p>

## NB info if running on linux
<p>You will have to give certain folder rights for project to work, please run commands between the quotes below:</p>
<p>"sudo chgrp -R www-data storage boostrap/cache"</p>
<p>"sudo chmod -R ug+rwx storage boostrap/cache"</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
