#!/bin/bash

cd /home/easyrdf/fuseki && bash fuseki-server --port 3030 --debug --update --mem /ds &> fuseki.log &
