#!/bin/sh

ssh-keygen -t rsa -b 2048 -m PEM -f pair.sec -N ""
openssl rsa -in pair.sec -pubout -outform PEM -out pair.pub
