<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

/**
 * Class representing the export of a zugferd document
 * in JSON format
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Json_Exporter
{
    /**
     * The instance to the zugferd document
     *
     * @var ZugferdDocument
     */
    private $document;
    /**
     * Constructor
     */
    public function __construct(Zugferd_Document $document)
    {
        $this->document = $document;
    }
    /**
     * Returns the invoice object as a json string
     */
    public function to_json_string(): string
    {
        return $this->document->serialize_as_json();
    }
    /**
     * Returns the invoice object as a json object
     */
    public function to_json_object(): ?\stdClass
    {
        return json_decode($this->to_json_string());
    }
    /**
     * Returns the invoice object as a pretty printed json string
     *
     * @return string|boolean
     */
    public function to_pretty_json_string()
    {
        return json_encode($this->to_json_object(), JSON_PRETTY_PRINT);
    }
}