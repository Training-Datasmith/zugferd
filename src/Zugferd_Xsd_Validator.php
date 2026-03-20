<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use Dom_Document;
use Exception;
use horstoeko\stringmanagement\Path_Utils;
use horstoeko\zugferd\exception\Zugferd_File_Not_Found_Exception;
use Lib_Xml_Error;
use Throwable;
/**
 * Class representing the validator against XSD for documents
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Xsd_Validator
{
    /**
     * The invoice document reference
     *
     * @var ZugferdDocument
     */
    private $document;
    /**
     * Internal error bag
     *
     * @var array
     */
    private $error_bag = [];
    /**
     * Constructor
     */
    public function __construct(Zugferd_Document $document)
    {
        $this->document = $document;
    }
    /**
     * Perform validation of document
     */
    public function validate(): Zugferd_Xsd_Validator
    {
        $this->clear_error_bag();
        $this->init_lib_xml();
        try {
            if (!$this->get_document_content_as_dom_document()->schema_validate($this->get_document_xsd_filename())) {
                $this->push_lib_xml_errors_to_error_bag();
            }
        } catch (Exception $exception) {
            $this->add_to_error_bag($exception);
        } finally {
            $this->finalize_lib_xml();
        }
        return $this;
    }
    /**
     * Returns true if validation passed otherwise false
     *
     * @deprecated 1.0.65 Use hasNoValidationErrors instead
     */
    public function validation_pased(): bool
    {
        return $this->error_bag === [];
    }
    /**
     * Returns true if validation failed otherwise false
     *
     * @deprecated 1.0.65 Use hasValidationErrors instead
     */
    public function validation_failed(): bool
    {
        return !$this->validation_pased();
    }
    /**
     * Returns true if validation passed otherwise false
     */
    public function has_no_validation_errors(): bool
    {
        return $this->error_bag === [];
    }
    /**
     * Returns true if validation errors are present otherwise false
     */
    public function has_validation_errors(): bool
    {
        return !$this->has_no_validation_errors();
    }
    /**
     * Returns an array of all validation errors
     */
    public function validation_errors(): array
    {
        return $this->error_bag;
    }
    /**
     * Initialize LibXML
     */
    private function init_lib_xml(): void
    {
        libxml_use_internal_errors(true);
    }
    /**
     * Finalize LibXML
     */
    private function finalize_lib_xml(): void
    {
        libxml_clear_errors();
        libxml_use_internal_errors(false);
    }
    /**
     * Get the content of the document
     */
    private function get_document_content(): string
    {
        return $this->document->serialize_as_xml();
    }
    /**
     * Get the content of the document as a DOMDocument
     */
    private function get_document_content_as_dom_document(): Dom_Document
    {
        $doc = new Dom_Document();
        $doc->load_xml($this->get_document_content());
        return $doc;
    }
    /**
     * Get the XSD file (schema definition) for the document
     */
    private function get_document_xsd_filename(): string
    {
        $xsd_filename = Path_Utils::combine_all_paths(Zugferd_Settings::get_schema_directory(), $this->document->get_profile_definition_parameter('xsdfilename'));
        if (!file_exists($xsd_filename)) {
            throw new Zugferd_File_Not_Found_Exception($xsd_filename);
        }
        return $xsd_filename;
    }
    /**
     * Clear the internal error bag
     */
    private function clear_error_bag(): void
    {
        $this->error_bag = [];
    }
    /**
     * Add message to error bag
     *
     * @param  string|Exception|Throwable|LibXMLError $error
     */
    private function add_to_error_bag($error): void
    {
        if (is_string($error)) {
            $this->error_bag[] = $error;
        } elseif ($error instanceof Exception) {
            $this->error_bag[] = $error->get_message();
        } elseif ($error instanceof Throwable) {
            $this->error_bag[] = $error->get_message();
        } elseif ($error instanceof Lib_Xml_Error) {
            $this->error_bag[] = sprintf('[line %d] %s : %s', $error->line, $error->code, $error->message);
        }
    }
    /**
     * Pushes validation errors to error bag
     */
    private function push_lib_xml_errors_to_error_bag(): void
    {
        foreach (libxml_get_errors() as $xml_error) {
            $this->add_to_error_bag($xml_error);
        }
    }
}