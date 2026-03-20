<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use DateTime;
use Dom_Document;
use Dom_Xpath;
use horstoeko\mimedb\Mime_Db;
use horstoeko\stringmanagement\File_Utils;
use horstoeko\stringmanagement\String_Utils;
use horstoeko\zugferd\codelists\Zugferd_Invoice_Type;
use horstoeko\zugferd\exception\Zugferd_File_Not_Found_Exception;
use horstoeko\zugferd\exception\Zugferd_File_Not_Readable_Exception;
use horstoeko\zugferd\exception\Zugferd_Invalid_Argument_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Mimetype;
use setasign\Fpdi\Pdf_Parser\Stream_Reader as PdfStreamReader;
use Throwable;
/**
 * Class representing the base facillity adding XML data
 * to an existing PDF with conversion to PDF/A
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
abstract class Zugferd_Document_Pdf_Builder_Abstract
{
    /**
     * Constants for Relationship types
     * 'Data', 'Alternative', 'Source', 'Supplement', 'Unspecified'
     */
    public const AF_RELATIONSHIP_DATA = 'Data';
    public const AF_RELATIONSHIP_ALTERNATIVE = 'Alternative';
    public const AF_RELATIONSHIP_SOURCE = 'Source';
    public const AF_RELATIONSHIP_SUPPLEMENT = 'Supplement';
    public const AF_RELATIONSHIP_UNSPECIFIED = 'Unspecified';
    /**
     * Additional creator tool (e.g. the ERP software that called the PHP library)
     *
     * @var string
     */
    private $additional_creator_tool = '';
    /**
     * The relationship type to use for the XML attachment. Detault is Data
     *
     * @var string
     */
    private $attachment_relationship_type = 'Data';
    /**
     * Instance of the pdfwriter
     *
     * @var ZugferdPdfWriter
     */
    private $pdf_writer;
    /**
     * Contains the data of the original PDF document
     *
     * @var string
     */
    private $pdf_data = '';
    /**
     * List of files which should be additionally attached to PDF
     *
     * @var array
     */
    private $additional_files_to_attach = [];
    /**
     * User-defined template for the author-metainformation
     *
     * @var string
     */
    private $author_template = '';
    /**
     * User-defined template for the keyword-metainformation
     *
     * @var string
     */
    private $keyword_template = '';
    /**
     * User-defined template for the title-metainformation
     *
     * @var string
     */
    private $title_template = '';
    /**
     * User-defined template for the subject-metainformation
     *
     * @var string
     */
    private $subject_template = '';
    /**
     * User-defined callback function for all metainformation
     *
     * @var callable|null
     */
    private $meta_information_callback;
    /**
     * Internal flag which indicate, that attachment pane should be opened
     *
     * @var boolean
     */
    private $attachment_pane_visibility = true;
    /**
     * Constructor
     *
     * @param string $pdfData
     * The full filename or a string containing the binary pdf data. This
     * is the original PDF (e.g. created by a ERP system)
     */
    public function __construct(string $pdf_data)
    {
        $this->pdf_data = $pdf_data;
        $this->pdf_writer = new Zugferd_Pdf_Writer();
    }
    /**
     * Generates the final document
     *
     * @return static
     */
    public function generate_document()
    {
        $this->start_create_pdf();
        return $this;
    }
    /**
     * Saves the generated PDF document to a file
     *
     * @param  string $toFilename The full qualified filename to which the generated PDF (with attachment)is stored
     * @return static
     */
    public function save_document(string $to_filename)
    {
        $this->pdf_writer->Output('F', $to_filename);
        return $this;
    }
    /**
     * Starts a HTTP download of the generated PDF document
     */
    public function save_document_inline(string $to_filename): string
    {
        return $this->pdf_writer->Output('I', $to_filename);
    }
    /**
     * Returns the content of the generared PDF as a string
     */
    public function download_string(): string
    {
        return $this->pdf_writer->Output('S');
    }
    /**
     * Sets an additional creator tool (e.g. the ERP software that called the PHP library)
     *
     * @param  string $additionalCreatorTool The name of the creator
     * @return static
     */
    public function set_additional_creator_tool(string $additional_creator_tool)
    {
        $this->additional_creator_tool = $additional_creator_tool;
        return $this;
    }
    /**
     * Returns the creator tool name (the PHP library, and if given also the additional creator tool)
     */
    public function get_creator_tool_name(): string
    {
        $tool_name = sprintf('Factur-X PHP library v%s by HorstOeko', Zugferd_Package_Version::get_installed_version());
        if ($this->additional_creator_tool) {
            return $this->additional_creator_tool . ' / ' . $tool_name;
        }
        return $tool_name;
    }
    /**
     * Set the type of relationship for the XML attachment. Allowed
     * types are 'Data', 'Alternative' and 'Source'
     *
     * @param  string $relationshipType Type of relationship
     * @return static
     */
    public function set_attachment_relationship_type(string $relationship_type)
    {
        if (!in_array($relationship_type, [static::AF_RELATIONSHIP_DATA, static::AF_RELATIONSHIP_ALTERNATIVE, static::AF_RELATIONSHIP_SOURCE])) {
            $relationship_type = static::AF_RELATIONSHIP_DATA;
        }
        $this->attachment_relationship_type = $relationship_type;
        return $this;
    }
    /**
     * Returns the relationship type for the XML attachment. This
     * can return 'Data', 'Alternative'
     */
    public function get_attachment_relationship_type(): string
    {
        return $this->attachment_relationship_type;
    }
    /**
     * Set the type of relationship for the XML attachment to "Data"
     *
     * @return static
     */
    public function set_attachment_relationship_type_to_data()
    {
        return $this->set_attachment_relationship_type(static::AF_RELATIONSHIP_DATA);
    }
    /**
     * Set the type of relationship for the XML attachment to "Alternative"
     *
     * @return static
     */
    public function set_attachment_relationship_type_to_alternative()
    {
        return $this->set_attachment_relationship_type(static::AF_RELATIONSHIP_ALTERNATIVE);
    }
    /**
     * Set the type of relationship for the XML attachment to "Source"
     *
     * @return static
     */
    public function set_attachment_relationship_type_to_source()
    {
        return $this->set_attachment_relationship_type(static::AF_RELATIONSHIP_SOURCE);
    }
    /**
     * Attach an additional file to PDF. The file that is specified in $fullFilename
     * must exists
     *
     * @return static
     * @throws ZugferdInvalidArgumentException
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdUnknownMimetype
     */
    public function attach_additional_file_by_real_file(string $full_filename, string $display_name = '', string $relationship_type = '')
    {
        // Checks that the file really exists
        if ($full_filename === '') {
            throw new Zugferd_Invalid_Argument_Exception('You must specify a filename for the content to attach');
        }
        if (!file_exists($full_filename)) {
            throw new Zugferd_File_Not_Found_Exception($full_filename);
        }
        // Load content
        $content = file_get_contents($full_filename);
        if ($content === false) {
            throw new Zugferd_File_Not_Readable_Exception($full_filename);
        }
        // Add attachment
        $this->attach_additional_file_by_content($content, $full_filename, $display_name, $relationship_type);
        return $this;
    }
    /**
     * Attach an additional file to PDF by a content string
     *
     * @return static
     * @throws ZugferdInvalidArgumentException
     * @throws ZugferdUnknownMimetype
     */
    public function attach_additional_file_by_content(string $content, string $filename, string $display_name = '', string $relationship_type = '')
    {
        // Check content. The content must not be empty
        if ($content === '') {
            throw new Zugferd_Invalid_Argument_Exception('You must specify a content to attach');
        }
        // Check filename. The filename must not be empty
        if ($filename === '') {
            throw new Zugferd_Invalid_Argument_Exception('You must specify a filename for the content to attach');
        }
        // Mimetype for the file must exist
        $mime_type = (new Mime_Db())->find_first_mime_type_by_extension(File_Utils::get_file_extension($filename));
        if (is_null($mime_type)) {
            throw new Zugferd_Unknown_Mimetype();
        }
        // Sanatize relationship type
        if ($relationship_type === '') {
            $relationship_type = static::AF_RELATIONSHIP_SUPPLEMENT;
        }
        if (!in_array($relationship_type, [static::AF_RELATIONSHIP_DATA, static::AF_RELATIONSHIP_ALTERNATIVE, static::AF_RELATIONSHIP_SOURCE, static::AF_RELATIONSHIP_SUPPLEMENT, static::AF_RELATIONSHIP_UNSPECIFIED])) {
            $relationship_type = static::AF_RELATIONSHIP_SUPPLEMENT;
        }
        // Sanatize displayname
        if ($display_name === '') {
            $display_name = File_Utils::get_filename_with_extension($filename);
        }
        // Add to attachment list
        $this->additional_files_to_attach[] = [Pdf_Stream_Reader::create_by_string($content), File_Utils::get_filename_with_extension($filename), $display_name, $relationship_type, str_replace('/', '#2F', $mime_type)];
        return $this;
    }
    /**
     * Set the the deterministic mode. This mode should only be used
     * for testing purposes
     *
     * @return static
     */
    public function set_deterministic_mode_enabled(bool $deterministic_mode_enabled)
    {
        $this->pdf_writer->set_deterministic_mode_enabled($deterministic_mode_enabled);
        return $this;
    }
    /**
     * Set the template for the author meta information
     *
     * @return static
     */
    public function set_author_template(string $author_template)
    {
        $this->author_template = $author_template;
        return $this;
    }
    /**
     * Set the template for the keyword meta information
     *
     * @return static
     */
    public function set_keyword_template(string $keyword_template)
    {
        $this->keyword_template = $keyword_template;
        return $this;
    }
    /**
     * Set the template for the title meta information
     *
     * @return static
     */
    public function set_title_template(string $title_template)
    {
        $this->title_template = $title_template;
        return $this;
    }
    /**
     * Set the template for the subject meta information
     *
     * @return static
     */
    public function set_subject_template(string $subject_template)
    {
        $this->subject_template = $subject_template;
        return $this;
    }
    /**
     * Set the user defined callback for generating custom meta information
     *
     * @return static
     */
    public function set_meta_information_callback(?callable $callback = null)
    {
        $this->meta_information_callback = is_callable($callback) ? $callback : null;
        return $this;
    }
    /**
     * Sets the flag that indicates, that the attachment pane should be visible on start (True)
     * or hidden (False)
     *
     * @param boolean $attachmentPaneVisibility Flag that indicates, that the attachment pane should be visible or hidden
     * @return static
     */
    public function set_attachment_pane_visibility(bool $attachment_pane_visibility)
    {
        $this->attachment_pane_visibility = $attachment_pane_visibility;
        return $this;
    }
    /**
     * Returns true if the attachment pane is visible, otherwise false
     */
    public function get_attachment_pane_is_visible(): bool
    {
        return $this->attachment_pane_visibility;
    }
    /**
     * Show attachment pane on startup
     *
     * @return static
     */
    public function show_attachment_pane()
    {
        $this->set_attachment_pane_visibility(true);
        return $this;
    }
    /**
     * Hide attachment pane on startup
     *
     * @return static
     */
    public function hide_attachment_pane()
    {
        $this->set_attachment_pane_visibility(false);
        return $this;
    }
    /**
     * Get the content of XML to attach
     */
    abstract protected function get_xml_content(): string;
    /**
     * Get the filename of the XML to attach
     */
    abstract protected function get_xml_attachment_filename(): string;
    /**
     * Get the XMP name for the XML to attach
     */
    abstract protected function get_xml_attachment_xmp_name(): string;
    /**
     * Get the XMP version for the XML to attach
     */
    abstract protected function get_xml_attachment_xmp_version(): string;
    /**
     * Internal function which sets up the PDF
     */
    private function start_create_pdf(): void
    {
        // Get PDF data
        $pdf_data_ref = null;
        if ($this->is_file($this->pdf_data)) {
            $pdf_data_ref = $this->pdf_data;
        } elseif (is_string($this->pdf_data)) {
            $pdf_data_ref = Pdf_Stream_Reader::create_by_string($this->pdf_data);
        }
        // Get XML data from Builder
        $document_builder_xml_data_ref = Pdf_Stream_Reader::create_by_string($this->get_xml_content());
        // Start
        $this->pdf_writer->attach($document_builder_xml_data_ref, $this->get_xml_attachment_filename(), 'Factur-X Invoice', $this->get_attachment_relationship_type(), 'text#2Fxml');
        // Add additional attachments
        foreach ($this->additional_files_to_attach as $file_to_attach) {
            $this->pdf_writer->attach($file_to_attach[0], $file_to_attach[1], $file_to_attach[2], $file_to_attach[3], $file_to_attach[4]);
        }
        // Set flag to always show the attachment pane
        if ($this->get_attachment_pane_is_visible() === true) {
            $this->pdf_writer->open_attachment_pane();
        }
        // Copy pages from the original PDF
        $page_count = $this->pdf_writer->set_source_file($pdf_data_ref);
        for ($page_number = 1; $page_number <= $page_count; ++$page_number) {
            $page_content = $this->pdf_writer->import_page($page_number, '/MediaBox', true, true);
            $this->pdf_writer->add_page();
            $this->pdf_writer->use_template($page_content, 0, 0, null, null, true);
        }
        // Set PDF version 1.7 according to PDF/A-3 ISO 32000-1
        $this->pdf_writer->set_pdf_version('1.7', true);
        // Update meta data (e.g. such as author, producer, title)
        $this->update_pdf_metadata();
    }
    /**
     * Update PDF metadata to according to FacturX/ZUGFeRD XML data.
     */
    private function update_pdf_metadata(): void
    {
        $pdf_creator_tool_infos = $this->get_creator_tool_name();
        $pdf_metadata_infos = $this->prepare_pdf_metadata();
        $this->pdf_writer->set_pdf_metadata_infos($pdf_metadata_infos);
        $xmp = simplexml_load_file(Zugferd_Settings::get_full_xmp_meta_data_filename());
        $description_nodes = $xmp->xpath('rdf:Description');
        $desc_fx = $description_nodes[0];
        $desc_fx->children('fx', true)->{'ConformanceLevel'} = strtoupper($this->get_xml_attachment_xmp_name());
        $desc_fx->children('fx', true)->{'Version'} = strtoupper($this->get_xml_attachment_xmp_version());
        $desc_fx->children('fx', true)->{'DocumentFileName'} = $this->get_xml_attachment_filename();
        $this->pdf_writer->add_metadata_description_node($desc_fx->as_xml());
        $this->pdf_writer->add_metadata_description_node($description_nodes[1]->as_xml());
        $desc_pdf_aid = $description_nodes[2];
        $this->pdf_writer->add_metadata_description_node($desc_pdf_aid->as_xml());
        $desc_dc = $description_nodes[3];
        $desc_nodes = $desc_dc->children('dc', true);
        $desc_nodes->title->children('rdf', true)->Alt->li = $pdf_metadata_infos['title'];
        $desc_nodes->creator->children('rdf', true)->Seq->li = $pdf_metadata_infos['author'];
        $desc_nodes->description->children('rdf', true)->Alt->li = $pdf_metadata_infos['subject'];
        $this->pdf_writer->add_metadata_description_node($desc_dc->as_xml());
        $desc_adobe = $description_nodes[4];
        $desc_adobe->children('pdf', true)->{'Producer'} = 'FPDF';
        $this->pdf_writer->add_metadata_description_node($desc_adobe->as_xml());
        $desc_xmp = $description_nodes[5];
        $xmp_nodes = $desc_xmp->children('xmp', true);
        $xmp_nodes->{'CreatorTool'} = $pdf_creator_tool_infos;
        $xmp_nodes->{'CreateDate'} = $pdf_metadata_infos['createdDate'];
        $xmp_nodes->{'ModifyDate'} = $pdf_metadata_infos['modifiedDate'];
        $this->pdf_writer->add_metadata_description_node($desc_xmp->as_xml());
        $this->pdf_writer->set_author($pdf_metadata_infos['author'], true);
        $this->pdf_writer->set_keywords($pdf_metadata_infos['keywords'], true);
        $this->pdf_writer->set_title($pdf_metadata_infos['title'], true);
        $this->pdf_writer->set_subject($pdf_metadata_infos['subject'], true);
        $this->pdf_writer->set_creator($pdf_creator_tool_infos, true);
    }
    /**
     * Prepare PDF Metadata informations from FacturX/ZUGFeRD XML.
     */
    private function prepare_pdf_metadata(): array
    {
        $invoice_informations = $this->extract_invoice_informations();
        $date_string = date('Y-m-d', strtotime($invoice_informations['date']));
        $author = $invoice_informations['seller'];
        $keywords = sprintf('%s, FacturX/ZUGFeRD', $invoice_informations['docTypeName']);
        $title = sprintf('%s : %s %s', $invoice_informations['seller'], $invoice_informations['docTypeName'], $invoice_informations['invoiceId']);
        $subject = sprintf('FacturX/ZUGFeRD %s %s dated %s issued by %s', $invoice_informations['docTypeName'], $invoice_informations['invoiceId'], $date_string, $invoice_informations['seller']);
        return ['author' => $this->build_metadata_field('author', $author, $invoice_informations), 'keywords' => $this->build_metadata_field('keywords', $keywords, $invoice_informations), 'title' => $this->build_metadata_field('title', $title, $invoice_informations), 'subject' => $this->build_metadata_field('subject', $subject, $invoice_informations), 'createdDate' => $invoice_informations['date'], 'modifiedDate' => (new DateTime())->format('Y-m-d\TH:i:sP')];
    }
    /**
     * Extract major invoice information from FacturX/ZUGFeRD XML.
     */
    protected function extract_invoice_informations(): array
    {
        $dom_document = new Dom_Document();
        $dom_document->load_xml($this->get_xml_content());
        $xpath = new Domx_Path($dom_document);
        $date_xpath = $xpath->query('//rsm:ExchangedDocument/ram:IssueDateTime/udt:DateTimeString');
        $date = $date_xpath->item(0)->node_value;
        $date_reformatted = (new DateTime())->set_timestamp(strtotime($date))->format('Y-m-d\TH:i:sP');
        $invoice_id_xpath = $xpath->query('//rsm:ExchangedDocument/ram:ID');
        $invoice_id = $invoice_id_xpath->item(0)->node_value;
        $seller_xpath = $xpath->query('//ram:ApplicableHeaderTradeAgreement/ram:SellerTradeParty/ram:Name');
        $seller_name = $seller_xpath->item(0)->node_value;
        $doc_type_xpath = $xpath->query('//rsm:ExchangedDocument/ram:TypeCode');
        $doc_type_code = $doc_type_xpath->item(0)->node_value;
        switch ($doc_type_code) {
            case Zugferd_Invoice_Type::CREDITNOTE:
                $doc_type_name = 'Credit Note';
                break;
            default:
                $doc_type_name = 'Invoice';
                break;
        }
        return ['invoiceId' => $invoice_id, 'docTypeName' => $doc_type_name, 'seller' => $seller_name, 'date' => $date_reformatted];
    }
    /**
     * Returns true if the submittet parameter $pdfData is a valid file.
     * Otherwise it will return false
     *
     * @param  string $pdfData
     */
    protected function is_file($pdf_data): bool
    {
        try {
            return @is_file($pdf_data);
        } catch (Throwable $throwable) {
            return false;
        }
    }
    /**
     * Returns the parsed meta-field content
     */
    private function build_metadata_field(string $which, string $default, array $invoice_information): string
    {
        $xml_content = $this->get_xml_content();
        if (is_callable($this->meta_information_callback)) {
            $callback_result = call_user_func($this->meta_information_callback, $which, $xml_content, $invoice_information, $default);
            if (!String_Utils::string_is_null_or_empty($callback_result)) {
                return $callback_result;
            }
        }
        $templates = ['author' => $this->author_template, 'keywords' => $this->keyword_template, 'title' => $this->title_template, 'subject' => $this->subject_template];
        if (!isset($templates[$which])) {
            return $default;
        }
        if (String_Utils::string_is_null_or_empty($templates[$which])) {
            return $default;
        }
        return sprintf($templates[$which], $invoice_information['invoiceId'], $invoice_information['docTypeName'], $invoice_information['seller'], $invoice_information['date']);
    }
}