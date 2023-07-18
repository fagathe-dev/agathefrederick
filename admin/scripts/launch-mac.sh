#!/bin/sh
app_dir='/Users/fagathe/workspace/perso/agathefrederick.fr/admin'
app_host='dev.admin.agathefrederick.fr'
port='5500'
db_driver='mysql'
# enregistrer le nouveau nom de domaine dans le host de la machine 
# >> Uncomment line bellow on mac 
# echo "127.0.0.1\t${app_host}" | sudo tee -a /etc/hosts

# lance le service mysql
brew services start $db_driver
cd $app_dir
echo 'cd app dir'
echo 'ouvrir le projet sur vscode'
code .
bin/console c:c -n
while getopts ':b' options; do
    case $options in 
        b) 
            echo "open http://${app_host}:${port} in browser"
            open http://$app_host:$port;;
    esac
done
            
# lance le serveur interne de php
php -S $app_host:$port -t public

# stop le service mysql lorsqu'on stop le script
trap "brew services stop ${db_driver}" EXIT
