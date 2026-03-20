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
/**
 * Class representing the document reader for incoming PDF/A-Documents with
 * attached XML data in BASIC-, EN16931- and EXTENDED profile
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Pdf_Reader
{
    /**
     * Tries to load a PDF file (ZUGFeRD/Factur-X) and return a ZugferdDocumentReader
     *
     * @throws Exception
     * @throws RuntimeException
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdNoPdfAttachmentFoundException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     * @throws ZugferdUnknownXmlContentException
     */
    public static function read_and_guess_from_file(string $pdf_filename): Zugferd_Document_Reader
    {
        return Zugferd_Document_Pdf_Reader_Ext::read_and_guess_from_file($pdf_filename);
    }
    /**
     * Tries to load an attachment content from PDF and return a ZugferdDocumentReader
     *
     * @throws Exception
     * @throws RuntimeException
     * @throws ZugferdNoPdfAttachmentFoundException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     * @throws ZugferdUnknownXmlContentException
     */
    public static function read_and_guess_from_content(string $pdf_content): Zugferd_Document_Reader
    {
        return Zugferd_Document_Pdf_Reader_Ext::read_and_guess_from_content($pdf_content);
    }
    /**
     * Returns a XML content from a PDF file
     *
     * @throws Exception
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdNoPdfAttachmentFoundException
     */
    public static function get_xml_from_file(string $pdf_filename): string
    {
        return Zugferd_Document_Pdf_Reader_Ext::get_invoice_document_content_from_file($pdf_filename);
    }
    /**
     * Returns a XML content from a PDF binary stream (string)
     *
     * @throws Exception
     * @throws ZugferdNoPdfAttachmentFoundException
     */
    public static function get_xml_from_content(string $pdf_content): string
    {
        return Zugferd_Document_Pdf_Reader_Ext::get_invoice_document_content_from_content($pdf_content);
    }
}