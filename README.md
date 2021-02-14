# Hangman
## About Hangman
Randomly select a word from a file, have the user guess characters in the word.For each character they guess that is not in the word, have it draw another partof a man hanging in a noose.  If the picture is completed before they guess allthe characters, they lose.

## Screenshot

### Begin:
![image](https://i.imgur.com/QZUV1Te.png)

### In game:
#### Easy:
![image](https://i.imgur.com/3r9EG0Z.png)
#### Medium:
![image](https://i.imgur.com/W0FhUJY.png)
#### Hard:
![image](https://i.imgur.com/JdhNCCi.png)
### When win:
![image](https://i.imgur.com/fCg5Rgc.png)

### When game over:
![image](https://i.imgur.com/b2igMjO.png)

## Configuration
### First Step - create .env and modify for yourself
My example .env for SQLite database(Don't forget about create file `database.sqlite` in `database` directory)
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:MY_GENERATED_KEY
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=laravel
#DB_USERNAME=root
#DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```
### Second Step - composer install
Type `composer install` in main project directory.
### Third Step - Generate key
Type `php artisan key:generate` in main project directory.
### Fourth Step - Change permission for storage etc.
Type `chmod -R ug+rwx storage bootstrap/cache` in main project directory.
### Fifth Step - Migrate and Seed some data to database.
***Important!***
* If you use SQLite, make sure the file `database.sqlite` in `database` directory exists and has been installed `php7.3-sqlite3` package,
* If you use SQL on server make sure that connection is correct.

Type `php artisan migrate`,then `php artisan db:seed --class=WordSeeder`
