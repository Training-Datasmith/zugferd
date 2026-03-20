<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use Exception;
use horstoeko\zugferd\exception\Zugferd_File_Not_Found_Exception;
use horstoeko\zugferd\exception\Zugferd_File_Not_Readable_Exception;
use horstoeko\zugferd\exception\Zugferd_No_Pdf_Attachment_Found_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Parameter_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Xml_Content_Exception;
use JMS\Serializer\Exception\RuntimeException;
use Smalot\Pdf_Parser\Parser as PdfParser;
/**
 * Class representing the extended document reader for incoming PDF/A-Documents with
 * attached XML data in BASIC-, EN16931- and EXTENDED profile. The Extended PDF reader
 * reads also additinal attached documents from PDF
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Pdf_Reader_Ext
{
    /**
     * List of filenames which are possible for an attached XML-Invoice-Document in PDF
     */
    public const ATTACHMENT_FILENAMES = ['ZUGFeRD-invoice.xml', 'zugferd-invoice.xml', 'factur-x.xml', 'xrechnung.xml'];
    /**
     * Identifier for a XML-Invoice-Docuemnt
     */
    private const ATTACHMENT_TYPE_XMLINVOICE = 0;
    /**
     * Identifier for an additional document
     */
    private const ATTACHMENT_TYPE_ADDITIONAL = 1;
    /**
     * Key of the type element in the internal attachment list
     */
    public const ATTACHMENT_KEY_TYPE = 'type';
    /**
     * Key of the content element in the internal attachment list
     */
    public const ATTACHMENT_KEY_CONTENT = 'content';
    /**
     * Key of the filename element in the internal attachment list
     */
    public const ATTACHMENT_KEY_FILENAME = 'filename';
    /**
     * Key of the filename element in the internal attachment list
     */
    public const ATTACHMENT_KEY_MIMETYPE = 'mimetype';
    /**
     * Array containing all the attached files found in PDF
     *
     * @var array<int, array{type: int, content: string, filename: string, mimetype: string}>
     */
    private $attachment_content_list = [];
    /**
     * (Hidden) Constructor
     */
    final protected function __construct()
    {
    }
    /**
     * Load a PDF file
     *
     * @param  string $pdfFilename Contains a full-qualified filename which must exist and must be readable
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws Exception
     */
    public static function from_file(string $pdf_filename): Zugferd_Document_Pdf_Reader_Ext
    {
        if (!file_exists($pdf_filename)) {
            throw new Zugferd_File_Not_Found_Exception($pdf_filename);
        }
        $pdf_content = file_get_contents($pdf_filename);
        if ($pdf_content === false) {
            throw new Zugferd_File_Not_Readable_Exception($pdf_filename);
        }
        return static::from_content($pdf_content);
    }
    /**
     * Load a PDF content string
     *
     * @param  string $pdfContent Contains the raw data of a PDF
     * @throws Exception
     */
    public static function from_content(string $pdf_content): Zugferd_Document_Pdf_Reader_Ext
    {
        return (new Zugferd_Document_Pdf_Reader_Ext())->collect_attachments_from_pdf_content($pdf_content);
    }
    /**
     * Load a PDF file and return a ZugferDocumentReader-Instance
     *
     * @param  string $pdfFilename Contains a full-qualified filename which must exist and must be readable
     * @throws Exception
     * @throws RuntimeException
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdNoPdfAttachmentFoundException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     * @throws ZugferdUnknownXmlContentException
     * @see    \horstoeko\zugferd\ZugferdDocumentPdfReader::readAndGuessFromFile() For a similar purpose in another context.
     */
    public static function read_and_guess_from_file(string $pdf_filename): Zugferd_Document_Reader
    {
        return static::from_file($pdf_filename)->resolve_invoice_document_reader();
    }
    /**
     * Load a PDF content and return a ZugferDocumentReader-Instance
     *
     * @param  string $pdfContent Contains the raw data of a PDF
     * @throws Exception
     * @throws RuntimeException
     * @throws ZugferdNoPdfAttachmentFoundException
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     * @see    \horstoeko\zugferd\ZugferdDocumentPdfReader::readAndGuessFromContent() For a similar purpose in another context.
     */
    public static function read_and_guess_from_content(string $pdf_content): Zugferd_Document_Reader
    {
        return static::from_content($pdf_content)->resolve_invoice_document_reader();
    }
    /**
     * Returns a invoice document XML content from a PDF file
     * similar to ZugferdDocumentPdfReader::getXmlFromContent
     *
     * @param  string $pdfFilename Contains a full-qualified filename which must exist and must be readable
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws Exception
     * @throws ZugferdNoPdfAttachmentFoundException
     * @see    \horstoeko\zugferd\ZugferdDocumentPdfReader::getXmlFromFile() For a similar purpose in another context.
     */
    public static function get_invoice_document_content_from_file(string $pdf_filename): string
    {
        return static::from_file($pdf_filename)->resolve_invoice_document_content();
    }
    /**
     * Returns a invoice document XML content from a PDF content string
     *
     * @param  string $pdfContent Contains the raw data of a PDF
     * @throws Exception
     * @throws ZugferdNoPdfAttachmentFoundException
     * @see    \horstoeko\zugferd\ZugferdDocumentPdfReader::getXmlFromContent() For a similar purpose in another context.
     */
    public static function get_invoice_document_content_from_content(string $pdf_content): string
    {
        return static::from_content($pdf_content)->resolve_invoice_document_content();
    }
    /**
     * Returns all additional documents (except the invoice document) from a PDF file
     *
     * @param  string $pdfFilename Contains a full-qualified filename which must exist and must be readable
     * @return array<int, array{type: int, content: string, filename: string, mimetype: string}>
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws Exception
     */
    public static function get_additional_document_contents_from_file(string $pdf_filename): array
    {
        return static::from_file($pdf_filename)->resolve_additional_document_contents();
    }
    /**
     * Returns all additional documents (except the invoice document) from a PDF content string
     *
     * @param  string $pdfContent Contains the raw data of a PDF
     * @return array<int, array{type: int, content: string, filename: string, mimetype: string}>
     * @throws Exception
     */
    public static function get_additional_document_contents_from_content(string $pdf_content): array
    {
        return static::from_content($pdf_content)->resolve_additional_document_contents();
    }
    /**
     * Returns an instance of ZugferdDocumentReader by a valid invoice attachment
     *
     * @throws ZugferdNoPdfAttachmentFoundException
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     * @throws RuntimeException
     */
    public function resolve_invoice_document_reader(): Zugferd_Document_Reader
    {
        return Zugferd_Document_Reader::read_and_guess_from_content($this->resolve_invoice_document_content());
    }
    /**
     * Returns the content as string if a valid invoice attachment was found, otherwise
     * an exception will be raised
     *
     * @throws ZugferdNoPdfAttachmentFoundException
     */
    public function resolve_invoice_document_content(): string
    {
        $invoice_content = array_values(array_filter($this->attachment_content_list, function (array $attachment_content_item): bool {
            return $attachment_content_item[Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_KEY_TYPE] === Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_TYPE_XMLINVOICE;
        }));
        if ($invoice_content === []) {
            throw new Zugferd_No_Pdf_Attachment_Found_Exception();
        }
        return $invoice_content[0][Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_KEY_CONTENT];
    }
    /**
     * Returns a list of all additional attached documents except the invoice document
     *
     * @return array<int, array{type: int, content: string, filename: string, mimetype: string}>
     */
    public function resolve_additional_document_contents(): array
    {
        return array_values(array_filter($this->attachment_content_list, function (array $attachment_content_item): bool {
            return $attachment_content_item[Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_KEY_TYPE] === Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_TYPE_ADDITIONAL;
        }));
    }
    /**
     * Get a list of all the attachments.
     *
     * @param  string $pdfContent Contains the raw data of a PDF
     * @throws Exception
     */
    protected function collect_attachments_from_pdf_content(string $pdf_content): Zugferd_Document_Pdf_Reader_Ext
    {
        $this->attachment_content_list = [];
        $pdf_parser = new Pdf_Parser();
        $pdf_parsed = $pdf_parser->parse_content($pdf_content);
        $file_specs = $pdf_parsed->get_objects_by_type('Filespec');
        $file_specs = array_filter($file_specs, function ($file_spec): bool {
            return $file_spec->has('F') && $file_spec->has('EF');
        });
        $file_specs = array_filter($file_specs, function ($file_spec) {
            return $file_spec->get('EF')->has('F');
        });
        foreach ($file_specs as $file_spec) {
            $this->attachment_content_list[] = [Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_KEY_TYPE => in_array($file_spec->get('F')->get_content(), Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_FILENAMES) ? Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_TYPE_XMLINVOICE : Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_TYPE_ADDITIONAL, Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_KEY_CONTENT => $file_spec->get('EF')->get('F')->get_content(), Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_KEY_FILENAME => $file_spec->get('F')->get_content(), Zugferd_Document_Pdf_Reader_Ext::ATTACHMENT_KEY_MIMETYPE => $file_spec->get('EF')->get('F')->has('Subtype') ? (string) $file_spec->get('EF')->get('F')->get('Subtype')->get_content() : ''];
        }
        return $this;
    }
}