
## How to deploy
- git clone, and go to the project directory
- run command "composer install"
- rename '.env.example' to '.env' and set connection to created new database
- run next command:
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- run command "npm install" and 'npm run watch'
- Start server with command 'php artisan serve'. For default site open in  'http://127.0.0.1:8000' but if you have another address you need to change 'axios.defaults.baseURL' in 'resources/js/app.js' .



