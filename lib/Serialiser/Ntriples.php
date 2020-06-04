<?php

namespace EasyRdf\Serialiser;

/**
 * EasyRdf
 *
 * LICENSE
 *
 * Copyright (c) 2009-2013 Nicholas J Humfrey.  All rights reserved.
 * Copyright (c) 2020 Austrian Centre for Digital Humanities.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 1. Redistributions of source code must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 * 3. The name of the author 'Nicholas J Humfrey" may be used to endorse or
 *    promote products derived from this software without specific prior
 *    written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    EasyRdf
 * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
use EasyRdf\Exception;
use EasyRdf\Graph;
use EasyRdf\Serialiser;

/**
 * Class to serialise an EasyRdf\Graph to N-Triples
 * with no external dependancies.
 *
 * @package    EasyRdf
 * @copyright  Copyright (c) 2009-2013 Nicholas J Humfrey
 * @license    http://www.opensource.org/licenses/bsd-license.php
 */
class Ntriples extends Serialiser
{

    /**
     * Characters forbidden in n-triples literals according to
     * https://www.w3.org/TR/n-triples/#grammar-production-IRIREF
     * 
     * Initialized by the first escapeIri() method call.
     * 
     * @var string[]
     */
    static private $iriEscapeMap;

    /**
     * Characters forbidden in n-triples literals according to
     * https://www.w3.org/TR/n-triples/#grammar-production-STRING_LITERAL_QUOTE
     * @var string[]
     */
    static private $literalEscapeMap = array(
        "\n" => '\\n',
        "\r" => '\\r',
        '"' => '\\"',
        '\\' => '\\\\'
    );

    public static function escapeLiteral($str)
    {
        return strtr($str, self::$literalEscapeMap);
    }

    public static function escapeIri($str)
    {
        if (self::$iriEscapeMap === null) {
            // the only forbidden characters according to 
            // https://www.w3.org/TR/n-triples/#grammar-production-IRIREF
            self::$iriEscapeMap = array();
            foreach (array('<', '>', '"', '{', '}', '|', '^', '`', '\\') as $i) {
                self::$iriEscapeMap[$i] = sprintf('\\u%04X', ord($i));
            }
            for ($i = 0; $i <= 32; $i++) {
                self::$iriEscapeMap[chr($i)] = sprintf('\\u%04X', ord($i));
            }
        }
        return strtr($str, self::$iriEscapeMap);
    }

    /**
     * @ignore
     */
    protected function serialiseResource($res)
    {
        $escaped = self::escapeIri($res);
        if (substr($res, 0, 2) == '_:') {
            return $escaped;
        } else {
            return "<$escaped>";
        }
    }

    /**
     * Serialise an RDF value into N-Triples
     *
     * The value can either be an array in RDF/PHP form, or
     * an EasyRdf\Literal or EasyRdf\Resource object.
     *
     * @param array|object  $value   An associative array or an object
     *
     * @throws Exception
     *
     * @return string The RDF value serialised to N-Triples
     */
    public function serialiseValue($value)
    {
        if (is_object($value)) {
            $value = $value->toRdfPhp();
        }

        if ($value['type'] == 'uri' or $value['type'] == 'bnode') {
            return $this->serialiseResource($value['value']);
        } elseif ($value['type'] == 'literal') {
            $escaped = self::escapeLiteral($value['value']);
            if (isset($value['lang'])) {
                $lang = $value['lang'];
                return '"' . $escaped . '"' . '@' . $lang;
            } elseif (isset($value['datatype'])) {
                $datatype = self::escapeIri($value['datatype']);
                return '"' . $escaped . '"' . "^^<$datatype>";
            } else {
                return '"' . $escaped . '"';
            }
        } else {
            throw new Exception(
                    "Unable to serialise object of type '" . $value['type'] . "' to ntriples: "
            );
        }
    }

    /**
     * Serialise an EasyRdf\Graph into N-Triples
     *
     * @param Graph  $graph  An EasyRdf\Graph object.
     * @param string $format The name of the format to convert to.
     * @param array  $options
     *
     * @return string The RDF in the new desired format.
     * @throws Exception
     */
    public function serialise(Graph $graph, $format, array $options = array())
    {
        parent::checkSerialiseParams($format);

        if ($format == 'ntriples') {
            $nt = '';
            foreach ($graph->toRdfPhp() as $resource => $properties) {
                foreach ($properties as $property => $values) {
                    foreach ($values as $value) {
                        $nt .= $this->serialiseResource($resource) . " ";
                        $nt .= "<" . self::escapeIri($property) . "> ";
                        $nt .= $this->serialiseValue($value) . " .\n";
                    }
                }
            }
            return $nt;
        } else {
            throw new Exception(
                    __CLASS__ . " does not support: $format"
            );
        }
    }
}
