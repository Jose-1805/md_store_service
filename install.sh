app_name="service_name"
default_path="/var/www/html"
#default_path="/home/jose/Descargas/new/template"
tmp_path="/tmp/$app_name"

echo "shopt -s dotglob"
shopt -s dotglob

echo '### find $default_path/ -type f -exec chmod 0777 {} \;'
find $default_path/ -type f -exec chmod 0777 {} \;

echo '### find $default_path/ -type d -exec chmod 0777 {} \;'
find $default_path/ -type d -exec chmod 0777 {} \;

echo '### composer create-project laravel/laravel $tmp_path'
composer create-project laravel/laravel $tmp_path

echo '### mv $tmp_path/.* $default_path/'
mv $tmp_path/.* $default_path/

echo '### mv $tmp_path/* $default_path/'
mv $tmp_path/* $default_path/

echo '### rm -r $tmp_path/'
rm -r $tmp_path/

echo '### mv $default_path/Helpers/ $default_path/app/'
mv $default_path/Helpers/ $default_path/app/

echo '### mkdir $default_path/app/Traits'
mkdir $default_path/app/Traits

echo '### mkdir $default_path/app/Services'
mkdir $default_path/app/Services

echo '### mkdir $default_path/app/Console/Commands'
mkdir $default_path/app/Console/Commands

echo '### mv Kernel.php $default_path/app/Http/Kernel.php'
mv Kernel.php $default_path/app/Http/Kernel.php

echo '### mv ApiGateway.php $default_path/app/Services/ApiGateway.php'
mv ApiGateway.php $default_path/app/Services/ApiGateway.php

echo '### mv ApiResponser.php $default_path/app/Traits/ApiResponser.php'
mv ApiResponser.php $default_path/app/Traits/ApiResponser.php

echo '### mv AuthenticateAccessMiddleware.php $default_path/app/Http/Middleware/AuthenticateAccessMiddleware.php'
mv AuthenticateAccessMiddleware.php $default_path/app/Http/Middleware/AuthenticateAccessMiddleware.php

echo '### mv Handler.php $default_path/app/Exceptions/Handler.php'
mv Handler.php $default_path/app/Exceptions/Handler.php

echo '### mv services.php $default_path/config/services.php'
mv services.php $default_path/config/services.php

echo '### mv MakeResourceCommand.php $default_path/app/Console/Commands/MakeResourceCommand.php'
mv MakeResourceCommand.php $default_path/app/Console/Commands/MakeResourceCommand.php

echo '### mv $default_path/es/ $default_path/lang/'
mv $default_path/es/ $default_path/lang/

echo '### mv $default_path/app.php $default_path/config/app.php'
mv $default_path/app.php $default_path/config/app.php

echo '### composer require laravel/octane'
composer require laravel/octane

echo '### printf '0\nyes' | php artisan octane:install'
printf '0\nyes' | php artisan octane:install

echo '### chmod +x $default_path/rr'
chmod +x $default_path/rr

echo '### rm -r $default_path/database/migrations'
rm -r $default_path/database/migrations

echo '### find $default_path/ -type f -exec chmod 0777 {} \;'
find $default_path/ -type f -exec chmod 0777 {} \;

echo '### find $default_path/ -type d -exec chmod 0777 {} \;'
find $default_path/ -type d -exec chmod 0777 {} \;
