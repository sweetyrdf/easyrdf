# EasyRdf (fork)

[![Build Status](https://travis-ci.com/sweetyrdf/easyrdf.svg?branch=master)](https://travis-ci.com/sweetyrdf/easyrdf)
[![Coverage Status](https://coveralls.io/repos/github/sweetyrdf/easyrdf/badge.svg?branch=master)](https://coveralls.io/github/sweetyrdf/easyrdf?branch=master)

:exclamation: This is a forked version of [EasyRdf](https://github.com/njh/easyrdf). 

## Why this fork?

EasyRdf is in maintenance mode since 2017 ([link](https://github.com/njh/easyrdf/issues/282)) and is not actively maintained since. There are 6+ pull requests pending with fixes and new features. Its sad to see another RDF PHP project die slowly, so i decided to clean house and give the code a new home ([further info](https://github.com/njh/easyrdf/issues/320)).

#### What can you expect as a user?

This fork aims to be a drop-in replacement for the `easyrdf/easyrdf` package, which means, you can use it without changing your code. But you should still read the notes of the latest release, to make sure nothing unexpected happens after an update.

#### What can you expect as an EasyRdf developer?

This repository is set up in a way to lower the maintenance overhead in comparison to the original version. For instance, by adding coveralls service (easier [test coverage overview](https://coveralls.io/github/sweetyrdf/easyrdf)) and reworked tooling (reduced bash code in Makefile, keep commands simple).

Furthermore, this repository is held by an organization instead of a user. This allows more flexible maintenance, like add further maintainer or helper.

**Contributions are welcome!** Please read [CONTRIBUTING.md](https://github.com/sweetyrdf/easyrdf/blob/master/CONTRIBUTING.md) for further information.

Further mainainers are possible, please send an email to [@k00ni](https://github.com/k00ni).

---

## About

EasyRdf is a PHP library designed to make it easy to consume and produce [RDF].
It was designed for use in mixed teams of experienced and inexperienced RDF
developers. It is written in Object Oriented PHP and has been tested
extensively using PHPUnit.

After parsing EasyRdf builds up a graph of PHP objects that can then be walked
around to get the data to be placed on the page. Dump methods are available to
inspect what data is available during development.

Data is typically loaded into an [`EasyRdf\Graph`] object from source RDF
documents, loaded from the web via HTTP. The [`EasyRdf\GraphStore`] class
simplifies loading and saving data to a SPARQL 1.1 Graph Store.

SPARQL queries can be made over HTTP to a Triplestore using the
[`EasyRdf\Sparql\Client`] class. `SELECT` and `ASK` queries will return an
[`EasyRdf\Sparql\Result`] object and `CONSTRUCT` and `DESCRIBE` queries will return
an [`EasyRdf\Graph`] object.

### Example ###

```php
$foaf = new \EasyRdf\Graph("http://njh.me/foaf.rdf");
$foaf->load();
$me = $foaf->primaryTopic();
echo "My name is: ".$me->get('foaf:name')."\n";
```

Downloads
---------

The latest _stable_ version of EasyRdf can be [downloaded from the EasyRdf website].


Links
-----

* [EasyRdf Homepage](http://www.easyrdf.org/)
* [API documentation](http://www.easyrdf.org/docs/api)
* [Change Log](http://github.com/njh/easyrdf/blob/master/CHANGELOG.md)
* [Source Code](http://github.com/njh/easyrdf)
* [Issue Tracker](http://github.com/njh/easyrdf/issues)


Requirements
------------

* PHP 5.5 or higher


Features
--------

* API documentation written in `phpdoc`
* Extensive unit tests written using `phpunit`
* Built-in parsers and serialisers: RDF/JSON, N-Triples, RDF/XML, Turtle
* Optional parsing support for: [ARC2], [rapper]
* Optional support for [`Zend\Http\Client`]
* No required external dependancies upon other libraries (PEAR, Zend, etc...)
* Complies with Zend Framework coding style.
* Type mapper - resources of type `foaf:Person` can be mapped into PHP object of class `Foaf_Person`
* Support for visualisation of graphs using [GraphViz]
* Comes with a number of examples


More Examples
-------------

* [`basic.php`](https://github.com/njh/easyrdf/blob/master/examples/basic.php#slider) - Basic "Hello World" type example
* [`basic_sparql.php`](https://github.com/njh/easyrdf/blob/master/examples/basic_sparql.php#slider) - Example of making a SPARQL `SELECT` query
* [`converter.php`](https://github.com/njh/easyrdf/blob/master/examples/converter.php#slider) - Convert RDF from one format to another
* [`dump.php`](https://github.com/njh/easyrdf/blob/master/examples/dump.php#slider) - Display the contents of a graph
* [`foafinfo.php`](https://github.com/njh/easyrdf/blob/master/examples/foafinfo.php#slider) - Display the basic information in a FOAF document
* [`foafmaker.php`](https://github.com/njh/easyrdf/blob/master/examples/foafmaker.php#slider) - Construct a FOAF document with a choice of serialisations
* [`graph_direct.php`](https://github.com/njh/easyrdf/blob/master/examples/graph_direct.php#slider) - Example of using `EasyRdf\Graph` directly without `EasyRdf\Resource`
* [`graphstore.php`](https://github.com/njh/easyrdf/blob/master/examples/graphstore.php#slider) - Store and retrieve data from a SPARQL 1.1 Graph Store
* [`graphviz.php`](https://github.com/njh/easyrdf/blob/master/examples/graphviz.php#slider) - GraphViz rendering example
* [`html_tag_helpers.php`](https://github.com/njh/easyrdf/blob/master/examples/html_tag_helpers.php#slider) - Rails Style html tag helpers to make the EasyRdf examples simpler
* [`httpget.php`](https://github.com/njh/easyrdf/blob/master/examples/httpget.php#slider) - No RDF, just test `EasyRdf\Http\Client`
* [`serialise.php`](https://github.com/njh/easyrdf/blob/master/examples/serialise.php#slider) - Basic serialisation example
* [`sparql_queryform.php`](https://github.com/njh/easyrdf/blob/master/examples/sparql_queryform.php#slider) - Form to submit SPARQL queries and display the result
* [`uk_postcode.php`](https://github.com/njh/easyrdf/blob/master/examples/uk_postcode.php#slider) - Example of resolving UK postcodes using uk-postcodes.com
* [`zend_framework.php`](https://github.com/njh/easyrdf/blob/master/examples/zend_framework.php#slider) - Example of using `Zend\Http\Client` with EasyRdf



Licensing
---------

The EasyRdf library and tests are licensed under the [BSD-3-Clause] license.
The examples are in the public domain, for more information see [UNLICENSE].



[`EasyRdf\Graph`]:http://www.easyrdf.org/docs/api/EasyRdf_Graph.html
[`EasyRdf\GraphStore`]:http://www.easyrdf.org/docs/api/EasyRdf_GraphStore.html
[`EasyRdf\Sparql\Client`]:http://www.easyrdf.org/docs/api/EasyRdf_Sparql_Client.html
[`EasyRdf\Sparql\Result`]:http://www.easyrdf.org/docs/api/EasyRdf_Sparql_Result.html

[ARC2]:http://github.com/semsol/arc2/
[BSD-3-Clause]:http://www.opensource.org/licenses/BSD-3-Clause
[downloaded from the EasyRdf website]:https://github.com/sweetyrdf/easyrdf/releases
[GraphViz]:http://www.graphviz.org/
[rapper]:http://librdf.org/raptor/rapper.html
[RDF]:http://en.wikipedia.org/wiki/Resource_Description_Framework
[SPARQL 1.1 query language]:http://www.w3.org/TR/sparql11-query/
[UNLICENSE]:http://unlicense.org/
[`Zend\Http\Client`]:http://framework.zend.com/manual/2.3/en/modules/zend.http.client.html
