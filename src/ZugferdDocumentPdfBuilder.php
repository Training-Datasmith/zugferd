<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use horstoeko\zugferd\exception\Zugferd_File_Not_Found_Exception;
/**
 * Class representing the facillity adding XML data from ZugferdDocumentBuilder
 * to an existing PDF with conversion to PDF/A
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Pdf_Builder extends Zugferd_Document_Pdf_Builder_Abstract
{
    /**
     * Internal reference to the xml builder instance
     *
     * @var ZugferdDocumentBuilder
     */
    private $document_builder;
    /**
     * Cached XML data
     *
     * @var string
     */
    private $xml_data_cache = '';
    /**
     * @see self::__construct
     */
    public static function from_pdf_file(Zugferd_Document_Builder $document_builder, string $pdf_file_name): self
    {
        if (!is_file($pdf_file_name)) {
            throw new Zugferd_File_Not_Found_Exception($pdf_file_name);
        }
        return new self($document_builder, $pdf_file_name);
    }
    /**
     * @see self::__construct
     */
    public static function from_pdf_string(Zugferd_Document_Builder $document_builder, string $pdf_content): self
    {
        return new self($document_builder, $pdf_content);
    }
    /**
     * Constructor
     *
     * @param ZugferdDocumentBuilder $documentBuilder The instance of the document builder. Needed to get the XML data
     * @param string                 $pdfData         The full filename or a string containing the binary pdf data. This is the original PDF (e.g. created by a ERP system)
     */
    public function __construct(Zugferd_Document_Builder $document_builder, string $pdf_data)
    {
        $this->document_builder = $document_builder;
        parent::__construct($pdf_data);
    }
    /**
     * @inheritDoc
     */
    protected function get_xml_content(): string
    {
        if ($this->xml_data_cache) {
            return $this->xml_data_cache;
        }
        $this->xml_data_cache = $this->document_builder->get_content();
        return $this->xml_data_cache;
    }
    /**
     * @inheritDoc
     */
    protected function get_xml_attachment_filename(): string
    {
        return $this->document_builder->get_profile_definition_parameter('attachmentfilename');
    }
    /**
     * @inheritDoc
     */
    protected function get_xml_attachment_xmp_name(): string
    {
        return $this->document_builder->get_profile_definition_parameter('xmpname');
    }
    /**
     * @inheritDoc
     */
    protected function get_xml_attachment_xmp_version(): string
    {
        return $this->document_builder->get_profile_definition_parameter('xmpversion');
    }
}