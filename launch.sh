#!/bin/bash
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

