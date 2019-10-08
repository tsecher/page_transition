#!/bin/bash

INSTALL="install"

# ########
# INSTALLATION DE L'APP (composer et yarn)
########
do_install()
{
    cd ./core && composer install
    yarn install
    cd ../ && rm -rf .git
}

# ########
# Lancement du serveur symfo et yarn
########
do_start()
{
    {   
        #Launch symfony
        cd core && symfony server:start
    }&    
    {
        #Launch yarn server
        cd core && yarn encore dev-server
    }&{
        #Launch browser
        sleep 5
        open http://localhost:8000
    }
}

# ########
# Lancement du serveur symfo et yarn
########
do_stop()
{
    cd core && symfony server:stop
}


#  MAIN.
if [ "$1" == "install" ]; then
    do_install
elif [ "$1" == "start" ]; then
    do_start
elif [ "$1" == "stop" ]; then
    do_stop
fi