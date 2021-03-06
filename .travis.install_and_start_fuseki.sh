#!/bin/bash

set -v

# script copied from https://github.com/RDFLib/rdflib/blob/master/.travis.fuseki_install_optional.sh
# by RDFLib/rdflib

uri="http://archive.apache.org/dist/jena/binaries/apache-jena-fuseki-3.14.0.tar.gz"

if wget "$uri" &&
       tar -zxf *jena*fuseki*.tar.gz &&
       mv *jena*fuseki*/ fuseki &&
       cd fuseki ; then
    # normal SPARQLStore & Dataset tests:
    bash fuseki-server --port 3030 --debug --update --mem /ds &>fuseki.log &
    sleep 2
    cd ..
else
    echo "fuseki install failed, skipping... please check URI" >&2
fi
