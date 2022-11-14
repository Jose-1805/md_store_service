echo "### Asignando permisos a archivos de la carpeta ./app"
find ./app -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./config"
find ./config -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./database"
find ./database -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./docker"
find ./docker -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./lang"
find ./lang -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./public"
find ./public -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./resources"
find ./resources -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./routes"
find ./routes -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./storage"
find ./storage -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./tests"
find ./tests -type f -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta raíz"
find ./ -type f -maxdepth 1 -exec chmod 0777 {} \;
echo "### Asignando permisos a archivos de la carpeta ./stubs"
find ./stubs -type f -exec chmod 0777 {} \;