# EasyRdf (Fork)

## :exclamation: Outdated

This fork was created in 2020 to provide a new home for EasyRdf and to provide updates on a more regular basis. It is outdated, please use the following instead:

#### https://github.com/sweetrdf/easyrdf

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

* [EasyRdf Homepage **(outdated)**](http://www.easyrdf.org/)
* [API documentation **(outdated)**](http://www.easyrdf.org/docs/api)
* [Change Log **(outdated)**](http://github.com/sweetyrdf/easyrdf/blob/master/CHANGELOG.md)
* [Source Code](http://github.com/sweetyrdf/easyrdf)
* [Issue Tracker](http://github.com/sweetyrdf/easyrdf/issues)


Requirements
------------

* PHP 7.0 or higher


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

* [`basic.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/basic.php#slider) - Basic "Hello World" type example
* [`basic_sparql.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/basic_sparql.php#slider) - Example of making a SPARQL `SELECT` query
* [`converter.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/converter.php#slider) - Convert RDF from one format to another
* [`dump.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/dump.php#slider) - Display the contents of a graph
* [`foafinfo.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/foafinfo.php#slider) - Display the basic information in a FOAF document
* [`foafmaker.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/foafmaker.php#slider) - Construct a FOAF document with a choice of serialisations
* [`graph_direct.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/graph_direct.php#slider) - Example of using `EasyRdf\Graph` directly without `EasyRdf\Resource`
* [`graphstore.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/graphstore.php#slider) - Store and retrieve data from a SPARQL 1.1 Graph Store
* [`graphviz.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/graphviz.php#slider) - GraphViz rendering example
* [`html_tag_helpers.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/html_tag_helpers.php#slider) - Rails Style html tag helpers to make the EasyRdf examples simpler
* [`httpget.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/httpget.php#slider) - No RDF, just test `EasyRdf\Http\Client`
* [`serialise.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/serialise.php#slider) - Basic serialisation example
* [`sparql_queryform.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/sparql_queryform.php#slider) - Form to submit SPARQL queries and display the result
* [`uk_postcode.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/uk_postcode.php#slider) - Example of resolving UK postcodes using uk-postcodes.com
* [`zend_framework.php`](https://github.com/sweetyrdf/easyrdf/blob/master/examples/zend_framework.php#slider) - Example of using `Zend\Http\Client` with EasyRdf

* [`artistinfo.php`](/examples/artistinfo.php#slider) - Example of mapping an RDF class type to a PHP Class
* [`basic.php`](/examples/basic.php#slider) - Basic "Hello World" type example
* [`basic_sparql.php`](/examples/basic_sparql.php#slider) - Example of making a SPARQL `SELECT` query
* [`converter.php`](/examples/converter.php#slider) - Convert RDF from one format to another
* [`dump.php`](/examples/dump.php#slider) - Display the contents of a graph
* [`foafinfo.php`](/examples/foafinfo.php#slider) - Display the basic information in a FOAF document
* [`foafmaker.php`](/examples/foafmaker.php#slider) - Construct a FOAF document with a choice of serialisations
* [`graph_direct.php`](/examples/graph_direct.php#slider) - Example of using `EasyRdf\Graph` directly without `EasyRdf\Resource`
* [`graphstore.php`](/examples/graphstore.php#slider) - Store and retrieve data from a SPARQL 1.1 Graph Store
* [`graphviz.php`](/examples/graphviz.php#slider) - GraphViz rendering example
* [`html_tag_helpers.php`](/examples/html_tag_helpers.php#slider) - Rails Style html tag helpers to make the EasyRdf examples simpler
* [`httpget.php`](/examples/httpget.php#slider) - No RDF, just test `EasyRdf\Http\Client`
* [`open_graph_protocol.php`](/examples/open_graph_protocol.php#slider) - Extract Open Graph Protocol metadata from a webpage
* [`serialise.php`](/examples/serialise.php#slider) - Basic serialisation example
* [`sparql_queryform.php`](/examples/sparql_queryform.php#slider) - Form to submit SPARQL queries and display the result
* [`uk_postcode.php`](/examples/uk_postcode.php#slider) - Example of resolving UK postcodes using uk-postcodes.com
* [`wikidata_villages.php`](/examples/wikidata_villages.php#slider) - Fetch and information about villages in Fife from Wikidata
* [`zend_framework.php`](/examples/zend_framework.php#slider) - Example of using `Zend\Http\Client` with EasyRdf


Running Examples
----------------

The easiest way of trying out some of the examples is to use the PHP command to
run a local web server on your computer.

```
php -S localhost:8080 -t examples
```

Then open the following URL in your browser: http://localhost:8080/


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
