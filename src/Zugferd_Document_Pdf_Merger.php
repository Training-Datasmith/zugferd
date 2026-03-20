<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use horstoeko\zugferd\exception\Zugferd_File_Not_Readable_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Parameter_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Xml_Content_Exception;
use Throwable;
/**
 * Class representing the facillity adding existing XML data (file or data-string)
 * to an existing PDF with conversion to PDF/A
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Pdf_Merger extends Zugferd_Document_Pdf_Builder_Abstract
{
    /**
     * Internal reference to the xml data (file or data-string)
     *
     * @var string
     */
    private $xml_data_or_filename = '';
    /**
     * Cached XML data
     *
     * @var string
     */
    private $xml_data_cache = '';
    /**
     * Constructor
     *
     * @param string $xmlDataOrFilename
     * The XML data as a string or the full qualified path to an XML-File
     * containing the XML-data
     * @param string $pdfData
     * The full filename or a string containing the binary pdf data. This
     * is the original PDF (e.g. created by a ERP system)
     */
    public function __construct(string $xml_data_or_filename, string $pdf_data)
    {
        $this->xml_data_or_filename = $xml_data_or_filename;
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
        if ($this->xml_data_is_file()) {
            $xml_content = file_get_contents($this->xml_data_or_filename);
            if ($xml_content === false) {
                throw new Zugferd_File_Not_Readable_Exception($this->xml_data_or_filename);
            }
        } else {
            $xml_content = $this->xml_data_or_filename;
        }
        $this->xml_data_cache = $xml_content;
        return $xml_content;
    }
    /**
     * @inheritDoc
     */
    protected function get_xml_attachment_filename(): string
    {
        return $this->get_profile_definition_parameter('attachmentfilename');
    }
    /**
     * @inheritDoc
     */
    protected function get_xml_attachment_xmp_name(): string
    {
        return $this->get_profile_definition_parameter('xmpname');
    }
    /**
     * @inheritDoc
     */
    protected function get_xml_attachment_xmp_version(): string
    {
        return $this->get_profile_definition_parameter('xmpversion');
    }
    /**
     * Returns true if the submitted $xmlDataOrFilename is a valid file.
     * Otherwise it will return false
     */
    protected function xml_data_is_file(): bool
    {
        try {
            return @is_file($this->xml_data_or_filename);
        } catch (Throwable $throwable) {
            return false;
        }
    }
    /**
     * Guess the profile type of the readden xml document
     *
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     */
    private function get_profile_definition(): array
    {
        return Zugferd_Profile_Resolver::resolve_profile_def($this->get_xml_content());
    }
    /**
     * Get a parameter from profile definition
     *
     * @return mixed
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     */
    private function get_profile_definition_parameter(string $parameter_name)
    {
        $profile_definition = $this->get_profile_definition();
        if (isset($profile_definition[$parameter_name])) {
            return $profile_definition[$parameter_name];
        }
        throw new Zugferd_Unknown_Profile_Parameter_Exception($parameter_name);
    }
}