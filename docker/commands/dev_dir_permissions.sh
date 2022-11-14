echo "Asignando permisos al directorio ./app"
find ./app -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./config"
find ./config -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./database"
find ./database -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./docker"
find ./docker -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./lang"
find ./lang -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./public"
find ./public -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./resources"
find ./resources -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./routes"
find ./routes -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./storage"
find ./storage -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./tests"
find ./tests -type d -exec chmod 0777 {} \;
echo "Asignando permisos al directorio ./stubs"
find ./stubs -type d -exec chmod 0777 {} \;