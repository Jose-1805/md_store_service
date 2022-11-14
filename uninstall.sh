app_name="service_name"
default_path="/var/www/html"
#default_path="/home/jose/Descargas/new/template"
tmp_path="/tmp/$app_name"

echo '#### mkdir $tmp_path'
mkdir $tmp_path

echo '#### mv $default_path/docker $tmp_path/'
mv $default_path/docker $tmp_path/

echo '#### mv $default_path/lang/es $tmp_path/'
mv $default_path/lang/es $tmp_path/

echo '#### mv $default_path/app/Helpers $tmp_path/'
mv $default_path/app/Helpers $tmp_path/

echo '#### mv $default_path/stubs $tmp_path/'
mv $default_path/stubs $tmp_path/

echo '#### mv $default_path/app/Http/Kernel.php $tmp_path/Kernel.php'
mv $default_path/app/Http/Kernel.php $tmp_path/Kernel.php

echo '#### mv $default_path/app/Services/ApiGateway.php $tmp_path/ApiGateway.php'
mv $default_path/app/Services/ApiGateway.php $tmp_path/ApiGateway.php

echo '#### mv $default_path/app/Traits/ApiResponser.php $tmp_path/ApiResponser.php'
mv $default_path/app/Traits/ApiResponser.php $tmp_path/ApiResponser.php

echo '#### mv $default_path/app/Http/Middleware/AuthenticateAccessMiddleware.php $tmp_path/AuthenticateAccessMiddleware.php'
mv $default_path/app/Http/Middleware/AuthenticateAccessMiddleware.php $tmp_path/AuthenticateAccessMiddleware.php

echo '#### mv $default_path/app/Exceptions/Handler.php $tmp_path/Handler.php'
mv $default_path/app/Exceptions/Handler.php $tmp_path/Handler.php

echo '#### mv $default_path/config/services.php $tmp_path/services.php'
mv $default_path/config/services.php $tmp_path/services.php

echo '#### mv $default_path/app/Console/Commands/MakeResourceCommand.php $tmp_path/MakeResourceCommand.php'
mv $default_path/app/Console/Commands/MakeResourceCommand.php $tmp_path/MakeResourceCommand.php

echo '#### mv $default_path/config/app.php $tmp_path/app.php'
mv $default_path/config/app.php $tmp_path/app.php

echo '#### mv $default_path/dev_commands.txt $tmp_path/dev_commands.txt'
mv $default_path/dev_commands.txt $tmp_path/dev_commands.txt

echo '#### mv $default_path/instrucciones.txt $tmp_path/instrucciones.txt'
mv $default_path/instrucciones.txt $tmp_path/instrucciones.txt

echo '#### mv $default_path/install.sh $tmp_path/install.sh'
mv $default_path/install.sh $tmp_path/install.sh

echo '#### cp $default_path/uninstall.sh $tmp_path/uninstall.sh'
cp $default_path/uninstall.sh $tmp_path/uninstall.sh

echo '#### chmod +x /tmp/seller_service/uninstall.sh'
chmod +x /tmp/seller_service/uninstall.sh

echo '#### rm -r $default_path/*'
rm -r $default_path/*

echo '#### rm -r $default_path/.*'
rm -r $default_path/.*

echo '#### mv $tmp_path/* $default_path/'
mv $tmp_path/* $default_path/

