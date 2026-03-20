<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use Closure;
use DateTime;
use horstoeko\stringmanagement\File_Utils;
use horstoeko\stringmanagement\Path_Utils;
use horstoeko\stringmanagement\String_Utils;
use horstoeko\zugferd\exception\Zugferd_File_Not_Found_Exception;
use horstoeko\zugferd\exception\Zugferd_File_Not_Readable_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Date_Format_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Parameter_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Xml_Content_Exception;
use JMS\Serializer\Exception\RuntimeException;
/**
 * Class representing the document reader for incoming XML-Documents with
 * XML data in BASIC-, EN16931- and EXTENDED profile
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Reader extends Zugferd_Document
{
    /**
     * Internal pointer for documents additional documents
     *
     * @var integer
     */
    private $document_add_ref_doc_pointer = 0;
    /**
     * Undocumented variable
     *
     * @var integer
     */
    private $document_ultimate_customer_order_referenced_document_pointer = 0;
    /**
     * Internal pointer for documents allowance charges
     *
     * @var integer
     */
    private $document_allowance_charge_pointer = 0;
    /**
     * Internal pointer for documents logistic service charges
     *
     * @var integer
     */
    private $document_logistic_service_charge_pointer = 0;
    /**
     * Internal pointer for documents payment terms
     *
     * @var integer
     */
    private $document_payment_terms_pointer = 0;
    /**
     * Internal pointer for document payment means
     *
     * @var integer
     */
    private $document_payment_means_pointer = 0;
    /**
     * Internal pointer for the document taxes
     *
     * @var integer
     */
    private $document_tax_pointer = 0;
    /**
     * Internal pointer for seller contacts
     *
     * @var integer
     */
    private $document_seller_contact_pointer = 0;
    /**
     * Internal pointer for byuer contacts
     *
     * @var integer
     */
    private $document_buyer_contact_pointer = 0;
    /**
     * Internal pointer for seller tax representativ party contacts
     *
     * @var integer
     */
    private $document_seller_tax_representative_contact_pointer = 0;
    /**
     * Internal pointer for product enduser contacts
     *
     * @var integer
     */
    private $document_product_end_user_contact_pointer = 0;
    /**
     * Internal pointer for Ship-To contacts
     *
     * @var integer
     */
    private $document_ship_to_contact_pointer = 0;
    /**
     * Internal pointer for Ultimate-Ship-To contacts
     *
     * @var integer
     */
    private $document_ultimate_ship_to_contact_pointer = 0;
    /**
     * Internal pointer for Ship-From contacts
     *
     * @var integer
     */
    private $document_ship_from_contact_pointer = 0;
    /**
     * Internal pointer for invoicer contacts
     *
     * @var integer
     */
    private $document_invoicer_contact_pointer = 0;
    /**
     * Internal pointer for invoicee contacts
     *
     * @var integer
     */
    private $document_invoicee_contact_pointer = 0;
    /**
     * Internal pointer for payee contacts
     *
     * @var integer
     */
    private $document_payee_contact_pointer = 0;
    /**
     * Internal pointer for documents invoice reference documents
     *
     * @var integer
     */
    private $document_inv_ref_doc_pointer = 0;
    /**
     * Internal pointer for documents trade accounting accounts
     *
     * @var integer
     */
    private $document_trade_accounting_account_pointer = 0;
    /**
     * Internal pointer for the position
     *
     * @var integer
     */
    private $position_pointer = 0;
    /**
     * Internal pointer for the position note
     *
     * @var integer
     */
    private $position_note_pointer = 0;
    /**
     * Internal pointer for the position's gross price allowances/charges
     *
     * @var integer
     */
    private $position_gross_price_allowance_charge_pointer = 0;
    /**
     * Internal pointer for the position taxes
     *
     * @var integer
     */
    private $position_tax_pointer = 0;
    /**
     * Internal pointer for the position's allowances/charges
     *
     * @var integer
     */
    private $position_allowance_charge_pointer = 0;
    /**
     * Internal pointer for the position's additional referenced document
     *
     * @var integer
     */
    private $position_add_ref_doc_pointer = 0;
    /**
     * Internal pointer for the position's additional referenced document (Object reference)
     *
     * @var integer
     */
    private $position_add_ref_obj_doc_pointer = 0;
    /**
     * Internal pointer for the positions product characteristics
     *
     * @var integer
     */
    private $position_product_characteristic_pointer = 0;
    /**
     * Internal pointer for the positions product classification
     *
     * @var integer
     */
    private $position_product_classification_pointer = 0;
    /**
     * Internal pointer for the positions referenced product
     *
     * @var integer
     */
    private $position_referenced_product_pointer = 0;
    /**
     * @var string
     */
    private $binarydatadirectory = '';
    /**
     * Guess the profile type of a xml file.
     *
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     * @throws RuntimeException
     */
    public static function read_and_guess_from_file(string $xml_filename): Zugferd_Document_Reader
    {
        if (!file_exists($xml_filename)) {
            throw new Zugferd_File_Not_Found_Exception($xml_filename);
        }
        $xml_content = file_get_contents($xml_filename);
        if ($xml_content === false) {
            throw new Zugferd_File_Not_Readable_Exception($xml_filename);
        }
        return self::read_and_guess_from_content($xml_content);
    }
    /**
     * Guess the profile type of the readden xml document.
     *
     * @param  string $xmlContent The XML content as a string to read the invoice data from
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileParameterException
     * @throws RuntimeException
     */
    public static function read_and_guess_from_content(string $xml_content): Zugferd_Document_Reader
    {
        $profile_id = Zugferd_Profile_Resolver::resolve_profile_id($xml_content);
        return (new static($profile_id))->read_content($xml_content);
    }
    /**
     * Set the directory where the attached binary data from additional referenced documents are temporary stored.
     */
    public function set_binary_data_directory(string $binary_data_directory): Zugferd_Document_Reader
    {
        if ($binary_data_directory !== '' && $binary_data_directory !== '0' && is_dir($binary_data_directory)) {
            $this->binarydatadirectory = $binary_data_directory;
        }
        return $this;
    }
    /**
     * Read content of a zuferd/xrechnung xml from a string.
     *
     * @param  string $xmlContent The XML content as a string to read the invoice data from
     * @throws ZugferdUnknownProfileParameterException
     * @throws RuntimeException
     */
    protected function read_content(string $xml_content): Zugferd_Document_Reader
    {
        $this->deserialize($xml_content);
        return $this;
    }
    /**
     * Read general information about the document.
     *
     * @param  string|null   $documentNo               __BT-1, From MINIMUM__ The document no issued by the seller
     * @param  string|null   $documentTypeCode         __BT-3, From MINIMUM__ The type of the document, See \horstoeko\codelists\ZugferdInvoiceType for details
     * @param  DateTime|null $documentDate             __BT-2, From MINIMUM__ Date of invoice. The date when the document was issued by the seller
     * @param  string|null   $invoiceCurrency          __BT-5, From MINIMUM__ Code for the invoice currency
     * @param  string|null   $taxCurrency              __BT-6, From BASIC WL__ Code for the currency of the VAT entry
     * @param  string|null   $documentName             __BT-X-2, From EXTENDED__ Document Type. The documenttype (free text)
     * @param  string|null   $documentLanguage         __BT-X-4, From EXTENDED__ Language indicator. The language code in which the document was written
     * @param  DateTime|null $effectiveSpecifiedPeriod __BT-X-6-000, From EXTENDED__ The contractual due date of the invoice
     * @throws ZugferdUnknownDateFormatException
     */
    public function get_document_information(?string &$document_no, ?string &$document_type_code, ?DateTime &$document_date, ?string &$invoice_currency, ?string &$tax_currency, ?string &$document_name, ?string &$document_language, ?DateTime &$effective_specified_period): Zugferd_Document_Reader
    {
        $document_no = $this->get_invoice_value_by_path('getExchangedDocument.getID.value', '');
        $document_type_code = $this->get_invoice_value_by_path('getExchangedDocument.getTypeCode.value', '');
        $document_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getExchangedDocument.getIssueDateTime.getDateTimeString', ''), $this->get_invoice_value_by_path('getExchangedDocument.getIssueDateTime.getDateTimeString.getFormat', ''));
        $invoice_currency = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceCurrencyCode.value', '');
        $tax_currency = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getTaxCurrencyCode.value', '');
        $document_name = $this->get_invoice_value_by_path('getExchangedDocument.getName.value', '');
        $document_language = $this->get_invoice_value_by_path('getExchangedDocument.getLanguageID.value', '');
        $effective_specified_period = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getExchangedDocument.getEffectiveSpecifiedPeriod.getDateTimeString', ''), $this->get_invoice_value_by_path('getExchangedDocument.getEffectiveSpecifiedPeriod.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Read general payment information.
     *
     * @param  string|null $creditorReferenceID __BT-90, From BASIC WL__ Identifier of the creditor
     * @param  string|null $paymentReference    __BT-83, From BASIC WL__ Intended use for payment
     */
    public function get_document_general_payment_information(?string &$creditor_reference_id, ?string &$payment_reference): Zugferd_Document_Reader
    {
        $creditor_reference_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getCreditorReferenceID.value', '');
        $payment_reference = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPaymentReference.value', '') ?? '';
        return $this;
    }
    /**
     * Get the identifier assigned by the buyer and used for internal routing.
     *
     * @param  string|null $buyerReference __BT-10, From MINIMUM__ An identifier assigned by the buyer and used for internal routing
     */
    public function get_document_buyer_reference(?string &$buyer_reference): Zugferd_Document_Reader
    {
        $buyer_reference = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerReference.value', '');
        return $this;
    }
    /**
     * Get the routing-id (needed for German XRechnung).
     *
     * This is an alias-method for getDocumentBuyerReference.
     *
     * @param  string $routingId __BT-10, From MINIMUM__ An identifier assigned by the buyer and used for internal routing
     */
    public function get_document_routing_id(string $routing_id): Zugferd_Document_Reader
    {
        return $this->get_document_buyer_reference($routing_id);
    }
    /**
     * Get the copy-identifier.
     *
     * @param  boolean|null $copyIndicator __BT-X-3-00, BT-X-3, From EXTENDED__ Returns true if this document is a copy from the original document
     */
    public function get_is_document_copy(?bool &$copy_indicator): Zugferd_Document_Reader
    {
        $copy_indicator = $this->get_invoice_value_by_path('getExchangedDocument.getCopyIndicator.getIndicator', false);
        return $this;
    }
    /**
     * Get the test-docukent-identifier.
     *
     * @param  boolean|null $testDocumentIndicator Returns true if this document is only for test purposes
     */
    public function get_is_test_document(?bool &$test_document_indicator): Zugferd_Document_Reader
    {
        $test_document_indicator = $this->get_invoice_value_by_path('getExchangedDocumentContext.getTestIndicator.getIndicator', false);
        return $this;
    }
    /**
     * Retrieve document notes.
     *
     * @param  array|null $notes __BT-22, From BASIC WL__, __BT-X-5, From EXTENDED__, __BT-21, From BASIC WL__ Returns an array with all document notes. Each array element contains an assiociative array containing the following keys: _contentcode_, _subjectcode_ and _content_
     */
    public function get_document_notes(?array &$notes): Zugferd_Document_Reader
    {
        $notes = $this->get_invoice_value_by_path('getExchangedDocument.getIncludedNote', []);
        $notes = $this->convert_to_array($notes, ['contentcode' => ['getContentCode.value', ''], 'subjectcode' => ['getSubjectCode.value', ''], 'content' => ['getContent.value', '']]);
        return $this;
    }
    /**
     * Get detailed information about the seller (=service provider).
     *
     * @param  string|null $name        __BT-27, From MINIMUM__ The full formal name under which the seller is registered in the National Register of Legal Entities, Taxable Person or otherwise acting as person(s)
     * @param  array|null  $id          __BT-29, From BASIC WL__ An array of identifiers of the seller. In many systems, seller identification is key information. Multiple seller IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged, buyer-assigned identifier of the seller
     * @param  string|null $description __BT-33, From EN 16931__ Further legal information that is relevant for the seller
     */
    public function get_document_seller(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifiers of the seller.
     *
     * @param  array|null $globalID __BT-29/BT-29-0/BT-29-1, From BASIC WL__ Array of the sellers global ids indexed by the identification scheme.
     */
    public function get_document_seller_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on the seller's tax information.
     *
     * @param  array|null $taxReg _BT-31/32, From MINIMUM/EN 16931__ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_seller_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get the address of seller trade party.
     *
     * @param  string|null $lineOne     __BT-35, From BASIC WL__ The main line in the sellers address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-36, From BASIC WL__ Line 2 of the seller's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-162, From BASIC WL__ Line 3 of the seller's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-38, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-37, From BASIC WL__ Usual name of the city or municipality in which the seller's address is located
     * @param  string|null $country     __BT-40, From MINIMUM__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-39, From BASIC WL__ The sellers state
     */
    public function get_document_seller_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get the legal organisation of seller trade party.
     *
     * @param  string|null $legalOrgId   __BT-30, From MINIMUM__ An identifier issued by an official registrar that identifies the seller as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer and seller
     * @param  string|null $legalOrgType __BT-30-1, From MINIMUM__ The identifier for the identification scheme of the legal registration of the seller. If the identification scheme is used, it must be selected from ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-28, From BASIC WL__ A name by which the seller is known, if different from the seller's name (also known as the company name). Note: This may be used if different from the seller's name.
     */
    public function get_document_seller_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first seller contact of the document. Returns true if a first seller contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentSellerContact.
     */
    public function first_document_seller_contact(): bool
    {
        $this->document_seller_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_seller_contact_pointer]);
    }
    /**
     * Seek to the next available seller contact of the document. Returns true if another seller contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentSellerContact.
     */
    public function next_document_seller_contact(): bool
    {
        $this->document_seller_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_seller_contact_pointer]);
    }
    /**
     * Get detailed information on the seller's contact person.
     *
     * @param  string|null $contactPersonname     __BT-41, From EN 16931__ Such as personal name, name of contact person or department or office
     * @param  string|null $contactDepartmentname __BT-41-0, From EN 16931__ If a contact person is specified, either the name or the department must be transmitted.
     * @param  string|null $contactPhoneNo        __BT-42, From EN 16931__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-107, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-43, From EN 16931__ An e-mail address of the contact point
     */
    public function get_document_seller_contact(?string &$contact_personname, ?string &$contact_departmentname, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_seller_contact_pointer];
        $contact_personname = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_departmentname = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information on the seller's electronic communication information.
     *
     * @param  string|null $uriScheme __BT-34-1, From BASIC WL__ The identifier for the identification scheme of the seller's electronic address
     * @param  string|null $uri       __BT-34, From BASIC WL__ Specifies the electronic address of the seller to which the response to the invoice can be sent at application level
     */
    public function get_document_seller_communication(?string &$uri_scheme, ?string &$uri): Zugferd_Document_Reader
    {
        $uri = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getURIUniversalCommunication.getURIID.value', '');
        $uri_scheme = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTradeParty.getURIUniversalCommunication.getURIID.getSchemeID', '');
        return $this;
    }
    /**
     * Get detailed information about the buyer (service recipient).
     *
     * @param  string|null $name        __BT-44, From MINIMUM__ The full name of the buyer
     * @param  array|null  $id          __BT-46, From BASIC WL__ An identifier of the buyer. In many systems, buyer identification is key information. Multiple buyer IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and buyer, e.g. a previously exchanged, seller-assigned identifier of the buyer
     * @param  string|null $description __BT-X-334, From EXTENDED__ Further legal information about the buyer
     */
    public function get_document_buyer(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifiers of the buyer.
     *
     * @param  array|null $globalID __BT-46-0, BT-46-1, From BASIC WL__ Array of the buyers global ids indexed by the identification scheme.
     */
    public function get_document_buyer_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on the buyer's tax information.
     *
     * @param  array|null $taxReg _BT-48, From MINIMUM/EN 16931__ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_buyer_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get the address of buyer trade party.
     *
     * @param  string|null $lineOne     __BT-50, From BASIC WL__ The main line in the buyers address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-51, From BASIC WL__ Line 2 of the buyers address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-163, From BASIC WL__ Line 3 of the buyers address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-53, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-52, From BASIC WL__ Usual name of the city or municipality in which the buyers address is located
     * @param  string|null $country     __BT-55, From BASIC WL__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-54, From BASIC WL__ The buyers state
     */
    public function get_document_buyer_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get the legal organisation of buyer trade party.
     *
     * @param  string|null $legalOrgId   __BT-47, From MINIMUM__ An identifier issued by an official registrar that identifies the buyer as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer and buyer
     * @param  string|null $legalOrgType __BT-47-1, From MINIMUM__ The identifier for the identification scheme of the legal registration of the buyer. If the identification scheme is used, it must be selected from ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-45, From EN 16931__ A name by which the buyer is known, if different from the buyers name (also known as the company name)
     */
    public function get_document_buyer_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first buyer contact of the document. Returns true if a first buyer contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentBuyerContact
     */
    public function first_document_buyer_contact(): bool
    {
        $this->document_buyer_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_buyer_contact_pointer]);
    }
    /**
     * Seek to the next available Buyer contact of the document. Returns true if another Buyer contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentBuyerContact.
     */
    public function next_document_buyer_contact(): bool
    {
        $this->document_buyer_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_buyer_contact_pointer]);
    }
    /**
     * Get contact information of buyer trade party.
     *
     * @param  string|null $contactPersonName     __BT-56, From EN 16931__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-56-0, From EN 16931__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-57, From EN 16931__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-115, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-58, From EN 16931__ An e-mail address of the contact point
     */
    public function get_document_buyer_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_buyer_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information on the seller's electronic communication information.
     *
     * @param  string|null $uriScheme __BT-49-1, From BASIC WL__ The identifier for the identification scheme of the buyer's electronic address
     * @param  string|null $uri       __BT-49, From BASIC WL__ Specifies the buyer's electronic address to which the invoice is sent
     */
    public function get_document_buyer_communication(?string &$uri_scheme, ?string &$uri): Zugferd_Document_Reader
    {
        $uri = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getURIUniversalCommunication.getURIID.value', '');
        $uri_scheme = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerTradeParty.getURIUniversalCommunication.getURIID.getSchemeID', '');
        return $this;
    }
    /**
     * Get detailed information about the seller's tax agent.
     *
     * @param  string|null $name        __BT-62, From BASIC WL__ The full name of the seller's tax agent
     * @param  array|null  $id          __BT-X-116, From EXTENDED__ An array of identifiers of the sellers tax agent.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the sellers tax agent
     */
    public function get_document_seller_tax_representative(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get document seller tax agent global ids.
     *
     * @param  array|null $globalID __BT-X-117/BT-X-117-1, From EXTENDED__ Returns an array of the seller's tax agent identifiers indexed by the identification scheme.
     */
    public function get_document_seller_tax_representative_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on the seller's tax agent tax information.
     *
     * @param  array|null $taxReg __BT-63/BT-63-0, From BASIC WL__ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_seller_tax_representative_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get the address of sellers tax agent.
     *
     * @param  string|null $lineOne     __BT-64, From BASIC WL__ The main line in the sellers tax agent address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-65, From BASIC WL__ Line 2 of the sellers tax agent address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-164, From BASIC WL__ Line 3 of the sellers tax agent address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-67, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-66, From BASIC WL__ Usual name of the city or municipality in which the sellers tax agent address is located
     * @param  string|null $country     __BT-69, From BASIC WL__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-68, From BASIC WL__ The sellers tax agent state
     */
    public function get_document_seller_tax_representative_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get the legal organisation of sellers tax agent.
     *
     * @param  string|null $legalOrgId   __BT-, From __ An identifier issued by an official registrar that identifies the seller tax agent as a legal entity or legal person.
     * @param  string|null $legalOrgType __BT-, From __ The identifier for the identification scheme of the legal registration of the sellers tax agent. If the identification scheme is used, it must be selected from  ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-, From __ A name by which the sellers tax agent is known, if different from the  sellers tax agent name (also known as the company name)
     */
    public function get_document_seller_tax_representative_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first seller tax representative contact of the document. Returns true if a first Seller Tax Representative contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentSellerTaxRepresentativeContact.
     */
    public function first_document_seller_tax_representative_contact(): bool
    {
        $this->document_seller_tax_representative_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_seller_tax_representative_contact_pointer]);
    }
    /**
     * Seek to the next available seller tax representative contact of the document. Returns true if another seller contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentSellerContact.
     */
    public function next_document_seller_tax_representative_contact(): bool
    {
        $this->document_seller_tax_representative_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_seller_tax_representative_contact_pointer]);
    }
    /**
     * Get contact information of sellers tax agent.
     *
     * @param  string|null $contactPersonName     __BT-X-120, From EXTENDED__ Such as personal name, name of contact person or department or office
     * @param  string|null $contactDepartmentName __BT-X-121, From EXTENDED__ If a contact person is specified, either the name or the department must be transmitted.
     * @param  string|null $contactPhoneNo        __BT-X-122, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-123, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-124, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_seller_tax_representative_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerTaxRepresentativeTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_seller_tax_representative_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information on the product end user (general information).
     *
     * @param  string      $name        __BT-X-128, From EXTENDED__ Name/company name of the end user
     * @param  array|null  $id          __BT-X-126, From EXTENDED__ An array of identifiers of the product end user
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the product end user
     */
    public function get_document_product_end_user(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifier of the product end user.
     *
     * @param  array|null $globalID __BT-X-127/BT-X-127-0, From EXTENDED__ Array of the product end users global ids indexed by the identification scheme.
     */
    public function get_document_product_end_user_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on the tax number of the product end user.
     *
     * @param  array|null $taxReg __BT-, From __ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_product_end_user_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get the address of product end user.
     *
     * @param  string|null $lineOne     __BT-X-397, From EXTENDED__ The main line in the product end users address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-398, From EXTENDED__ Line 2 of the product end users address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-399, From EXTENDED__ Line 3 of the product end users address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-396, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-400, From EXTENDED__ Usual name of the city or municipality in which the product end users address is located
     * @param  string|null $country     __BT-X-401, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-X-402, From EXTENDED__ The product end users state
     */
    public function get_document_product_end_user_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get the legal organisation of product end user.
     *
     * @param  string|null $legalOrgId   __BT-X-129, From EXTENDED__ An identifier issued by an official registrar that identifies the product end user as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to all trade parties
     * @param  string|null $legalOrgType __BT-X-129-0, From EXTENDED__The identifier for the identification scheme of the legal registration of the product end user. If the identification scheme is used, it must be selected from ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-X-130, From EXTENDED__ A name by which the product end user is known, if different from the product end users name (also known as the company name)
     */
    public function get_document_product_end_user_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first product end-user contact of the document. Returns true if a first product end-user contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentProductEndUserContact.
     */
    public function first_document_product_end_user_contact_contact(): bool
    {
        $this->document_product_end_user_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_product_end_user_contact_pointer]);
    }
    /**
     * Seek to the next available product end-user contact of the document. Returns true if another product end-user contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentProductEndUserContact.
     */
    public function next_document_product_end_user_contact_contact(): bool
    {
        $this->document_product_end_user_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_product_end_user_contact_pointer]);
    }
    /**
     * Get detailed information on the product end user's contact person.
     *
     * @param  string|null $contactPersonName     __BT-X-131, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-132, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-133, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-134, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-135, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_product_end_user_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getProductEndUserTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_product_end_user_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information on the Ship-To party.
     *
     * @param  string|null $name        __BT-70, From BASIC WL__ The name of the party to whom the goods are being delivered or for whom the services are being performed. Must be used if the recipient of the goods or services is not the same as the buyer.
     * @param  array|null  $id          __BT-71, From BASIC WL__ An array of identifiers
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function get_document_ship_to(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifier for the Ship-To party.
     *
     * @param  array|null $globalID __BT-71-0/BT-71-1, From BASIC WL__ Array of global ids indexed by the identification scheme.
     */
    public function get_document_ship_to_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on tax details of the Ship-To party.
     *
     * @param  array|null $taxReg __BT-X-161/BT-X-161-0, From EXTENDED__ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_ship_to_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get the postal address of the Ship-To party.
     *
     * @param  string|null $lineOne     __BT-75, From BASIC WL__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-76, From BASIC WL__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-165, From BASIC WL__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-78, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-77, From BASIC WL__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-80, From BASIC WL__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-79, From BASIC WL__ The party's state
     */
    public function get_document_ship_to_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Legal organisation of Ship-To trade party.
     *
     * @param  string|null $legalOrgid   __BT-X-153, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-153-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-154, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function get_document_ship_to_legal_organisation(?string &$legal_orgid, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_orgid = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first Ship-To contact of the document. Returns true if a first ship-to contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentShipToContact.
     */
    public function first_document_ship_to_contact(): bool
    {
        $this->document_ship_to_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_ship_to_contact_pointer]);
    }
    /**
     * Seek to the next available ship-to contact of the document. Returns true if another ship-to contact is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentShipToContact.
     */
    public function next_document_ship_to_contact(): bool
    {
        $this->document_ship_to_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_ship_to_contact_pointer]);
    }
    /**
     * Get detailed information on the contact person of the goods recipient.
     *
     * @param  string|null $contactPersonName     __BT-X-155, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-156, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-157, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-158, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-159, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_ship_to_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipToTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_ship_to_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information on the different end recipient.
     *
     * @param  string|null $name        __BT-X-164, From EXTENDED__ Name or company name of the different end recipient
     * @param  array|null  $id          __BT-X-162, From EXTENDED__ An array of identifiers
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the different end recipient
     */
    public function get_document_ultimate_ship_to(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getID.value', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifiers of the different end recipient party.
     *
     * @param  array|null $globalID __BT-X-163/BT-X-163-0, From EXTENDED__ Array of global ids indexed by the identification scheme.
     */
    public function get_document_ultimate_ship_to_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on tax details of the different end recipient party.
     *
     * @param  array|null $taxReg __BT-X-180/BT-X-180-0, From EXTENDED__ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_ultimate_ship_to_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get detailed information on the address of the different end recipient party.
     *
     * @param  string|null $lineOne     __BT-X-173, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box. For major customer addresses, this field must be filled with "-".
     * @param  string|null $lineTwo     __BT-X-174, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-175, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-172, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-176, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-177, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-X-178, From EXTENDED__ The party's state
     */
    public function get_document_ultimate_ship_to_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get detailed information about the Legal organisation of the different end recipient party.
     *
     * @param  string|null $legalOrgId   __BT-X-165, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-165-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-166, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function get_document_ultimate_ship_to_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first contact person of the different end recipient party. Returns true if a first contact person of the different end recipient party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentUltimateShipToContact.
     */
    public function first_document_ultimate_ship_to_contact(): bool
    {
        $this->document_ultimate_ship_to_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_ultimate_ship_to_contact_pointer]);
    }
    /**
     * Seek to the next available contact person of the different end recipient party. Returns true if another contact person of the different end recipient party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentUltimateShipToContact.
     */
    public function next_document_ultimate_ship_to_contact(): bool
    {
        $this->document_ultimate_ship_to_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_ultimate_ship_to_contact_pointer]);
    }
    /**
     * Get detailed information on the contact person of the different end recipient party.
     *
     * @param  string|null $contactPersonName     __BT-X-167, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-168, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-169, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-170, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-171, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_ultimate_ship_to_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getUltimateShipToTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_ultimate_ship_to_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information of the deviating consignor party.
     *
     * @param  string|null $name        __BT-X-183, From EXTENDED__ The name of the party
     * @param  array|null  $id          __BT-X-181, From EXTENDED__ An array of identifiers
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function get_document_ship_from(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifier of the deviating consignor party.
     *
     * @param  array|null $globalID __BT-X-182/BT-X-182-0, From EXTENDED__ Array of global ids indexed by the identification scheme.
     */
    public function get_document_ship_from_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on tax details of the deviating consignor party.
     *
     * @param  array|null $taxReg __BT-, From __ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_ship_from_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get Detailed information on the address of the deviating consignor party.
     *
     * @param  string|null $lineOne     __BT-X-192, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-193, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-194, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-191, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-195, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-196, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-X-197, From EXTENDED__ The party's state
     */
    public function get_document_ship_from_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getPostalTradeAddress.getCountryID.value.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get information about the legal organisation of the deviating consignor party.
     *
     * @param  string|null $legalOrgId   __BT-X-184, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-184-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-185, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function get_document_ship_from_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first contact information of the deviating consignor party of the document. Returns true if a first contact information of the deviating consignor party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentShipFromContact.
     */
    public function first_document_ship_from_contact(): bool
    {
        $this->document_ship_from_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_ship_from_contact_pointer]);
    }
    /**
     * Seek to the next available contact information of the deviating consignor party of the document. Returns true if another contact information of the deviating consignor party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentShipFromContact.
     */
    public function next_document_ship_from_contact(): bool
    {
        $this->document_ship_from_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_ship_from_contact_pointer]);
    }
    /**
     * Get contact information of the deviating consignor party.
     *
     * @param  string|null $contactPersonName     __BT-X-186, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-187, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-188, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-189, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-190, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_ship_from_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getShipFromTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_ship_from_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information of the invoicer party.
     *
     * @param  string      $name        __BT-X-207, From EXTENDED__ The name of the party
     * @param  array|null  $id          __BT-X-205, From EXTENDED__ An array of identifiers
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function get_document_invoicer(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifier of the invoicer party.
     *
     * @param  array|null $globalID __BT-X-206/BT-X-206-0, From EXTENDED__ Array of global ids indexed by the identification scheme.
     */
    public function get_document_invoicer_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on tax details of the invoicer party.
     *
     * @param  array|null $taxReg __BT-, From __ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_invoicer_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get Detailed information on the address of the invoicer party.
     *
     * @param  string|null $lineOne     __BT-X-216, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-217, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-218, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-215, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-219, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-220, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  array|null  $subDivision __BT-X-221, From EXTENDED__ The party's state
     */
    public function get_document_invoicer_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get information about the legal organisation of the invoicer party.
     *
     * @param  string|null $legalOrgId   __BT-X-208, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-208-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN,* 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-209, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function get_document_invoicer_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first contact information of the invoicer party of the document. Returns true if a first contact information of the invoicer party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentInvoicerContact.
     */
    public function first_document_invoicer_contact(): bool
    {
        $this->document_invoicer_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_invoicer_contact_pointer]);
    }
    /**
     * Seek to the next available contact information of the invoicer party of the document. Returns true if another contact information of the invoicer party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentInvoicerContact.
     */
    public function next_document_invoicer_contact(): bool
    {
        $this->document_invoicer_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_invoicer_contact_pointer]);
    }
    /**
     * Get contact information of the invoicer party.
     *
     * @param  string|null $contactPersonName     __BT-X-210, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-211, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-212, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-213, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-214, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_invoicer_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoicerTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_invoicer_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information on the different invoice recipient party.
     *
     * @param  string      $name        __BT-X-226, From EXTENDED__ The name of the party
     * @param  array|null  $id          __BT-X-224, From EXTENDED__ An array of identifiers
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function get_document_invoicee(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifier of the different invoice recipient party.
     *
     * @param  array|null $globalID __BT-X-225/BT-X-225-0, From EXTENDED__ Array of global ids indexed by the identification scheme.
     */
    public function get_document_invoicee_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on tax details of the different invoice recipient party.
     *
     * @param  array|null $taxReg __BT-X-242/BT-X-242-0, From EXTENDED__ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_invoicee_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get Detailed information on the address of the different invoice recipient party.
     *
     * @param  string|null $lineOne     __BT-X-235, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-236, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-237, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-234, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-238, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-239, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their
     *                                  subdivisions”
     * @param  array|null  $subDivision __BT-X-240, From EXTENDED__ The party's state
     */
    public function get_document_invoicee_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get information about the legal organisation of the different invoice recipient party.
     *
     * @param  string|null $legalOrgId   __BT-X-227, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-227-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-228, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function get_document_invoicee_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first contact information of the different invoice recipient party of the document. Returns true if a first contact information of the different invoice recipient party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentInvoiceeContact.
     */
    public function first_document_invoicee_contact(): bool
    {
        $this->document_invoicee_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_invoicee_contact_pointer]);
    }
    /**
     * Seek to the next available contact information of the different invoice recipient party of the document. Returns true if another contact information of the different invoice recipient party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentInvoiceeContact.
     */
    public function next_document_invoicee_contact(): bool
    {
        $this->document_invoicee_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_invoicee_contact_pointer]);
    }
    /**
     * Get contact information of the different invoice recipient party.
     *
     * @param  string|null $contactPersonName     __BT-X-229, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-230, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-231, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-232, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-233, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_invoicee_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceeTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_invoicee_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information about the payee, i.e. about the place that receives the payment.
     * The role of the payee may also be performed by a party other than the seller, e.g. by a factoring service.
     *
     * @param  string      $name        __BT-59, From BASIC WL__ The name of the party. Must be used if the payee is not the same as the seller. However, the name of the payee may match the name of the seller.
     * @param  array|null  $id          __BT-60, From BASIC WL__ An array of identifiers
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function get_document_payee(?string &$name, ?array &$id, ?string &$description): Zugferd_Document_Reader
    {
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getName.value', '');
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getID', []);
        $description = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getDescription.value', '');
        $id = $this->convert_to_array($id, ['id' => 'value']);
        return $this;
    }
    /**
     * Get global identifier of the payee party.
     *
     * @param  array|null $globalID __BT-60-0/BT-60-1, From BASIC WL__ Array of global ids indexed by the identification scheme.
     */
    public function get_document_payee_global_id(?array &$global_id): Zugferd_Document_Reader
    {
        $global_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Get detailed information on tax details of the payee party.
     *
     * @param  array|null $taxReg __BT-X-257/BT-X-257-0, From EXTENDED__ Array of tax numbers indexed by the schemeid (VA, FC, etc.)
     */
    public function get_document_payee_tax_registration(?array &$tax_reg): Zugferd_Document_Reader
    {
        $tax_reg = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getSpecifiedTaxRegistration', []);
        $tax_reg = $this->convert_to_associative_array($tax_reg, 'getID.getSchemeID', 'getID.value');
        return $this;
    }
    /**
     * Get Detailed information on the address of the payee party.
     *
     * @param  string|null $lineOne     __BT-X-250, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-251, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-252, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-249, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-253, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-254, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their
     *                                  subdivisions”
     * @param  array|null  $subDivision __BT-X-255, From EXTENDED__ The party's state
     */
    public function get_document_payee_address(?string &$line_one, ?string &$line_two, ?string &$line_three, ?string &$post_code, ?string &$city, ?string &$country, ?array &$sub_division): Zugferd_Document_Reader
    {
        $line_one = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getPostalTradeAddress.getLineOne.value', '');
        $line_two = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getPostalTradeAddress.getLineTwo.value', '');
        $line_three = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getPostalTradeAddress.getLineThree.value', '');
        $post_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getPostalTradeAddress.getPostcodeCode.value', '');
        $city = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getPostalTradeAddress.getCityName.value', '');
        $country = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getPostalTradeAddress.getCountryID.value', '');
        $sub_division = $this->convert_to_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getPostalTradeAddress.getCountrySubDivisionName', []), ['value']);
        return $this;
    }
    /**
     * Get information about the legal organisation of the payee party.
     *
     * @param  string|null $legalOrgId   __BT-61, From BASIC WL__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-61-1, From BASIC WL__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-243, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function get_document_payee_legal_organisation(?string &$legal_org_id, ?string &$legal_org_type, ?string &$legal_org_name): Zugferd_Document_Reader
    {
        $legal_org_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getSpecifiedLegalOrganization.getID.value', '');
        $legal_org_type = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getSpecifiedLegalOrganization.getID.getSchemeID', '');
        $legal_org_name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getSpecifiedLegalOrganization.getTradingBusinessName.value', '');
        return $this;
    }
    /**
     * Seek to the first contact information of the payee party of the document. Returns true if a first contact information of the payee party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentPayeeContact.
     */
    public function first_document_payee_contact(): bool
    {
        $this->document_payee_contact_pointer = 0;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_payee_contact_pointer]);
    }
    /**
     * Seek to the next available contact information of the payee party of the document. Returns true if another contact information of the payee party is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentPayeeContact.
     */
    public function next_document_payee_contact(): bool
    {
        $this->document_payee_contact_pointer++;
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getDefinedTradeContact', []));
        return isset($contacts[$this->document_payee_contact_pointer]);
    }
    /**
     * Get contact information of the payee party.
     *
     * @param  string|null $contactPersonName     __BT-X-244, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-245, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-246, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-247, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-248, From EXTENDED__ An e-mail address of the contact point
     */
    public function get_document_payee_contact(?string &$contact_person_name, ?string &$contact_department_name, ?string &$contact_phone_no, ?string &$contact_fax_no, ?string &$contact_email_address): Zugferd_Document_Reader
    {
        $contacts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getPayeeTradeParty.getDefinedTradeContact', []));
        $contact = $contacts[$this->document_payee_contact_pointer];
        $contact_person_name = $this->get_invoice_value_by_path_from($contact, 'getPersonName.value', '');
        $contact_department_name = $this->get_invoice_value_by_path_from($contact, 'getDepartmentName.value', '');
        $contact_phone_no = $this->get_invoice_value_by_path_from($contact, 'getTelephoneUniversalCommunication.getCompleteNumber.value', '');
        $contact_fax_no = $this->get_invoice_value_by_path_from($contact, 'getFaxUniversalCommunication.getCompleteNumber.value', '');
        $contact_email_address = $this->get_invoice_value_by_path_from($contact, 'getEmailURIUniversalCommunication.getURIID.value', '');
        return $this;
    }
    /**
     * Get detailed information on the delivery conditions.
     *
     * @param  string|null $code __BT-X-145, From EXTENDED__ The code indicating the type of delivery for these commercial delivery terms. To be selected from the entries in the list UNTDID 4053 + INCOTERMS
     */
    public function get_document_delivery_terms(?string &$code): Zugferd_Document_Reader
    {
        $code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getApplicableTradeDeliveryTerms.getDeliveryTypeCode.value', '');
        return $this;
    }
    /**
     * Get details of the associated order confirmation.
     *
     * @param  string|null   $issuerAssignedId __BT-14, From EN 16931__ An identifier issued by the seller for a referenced sales order (Order confirmation number)
     * @param  DateTime|null $issueDate        __BT-X-146, From EXTENDED__ Order confirmation date
     */
    public function get_document_seller_order_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $issuer_assigned_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerOrderReferencedDocument.getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSellerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get details of the related buyer order.
     *
     * @param  string|null   $issuerAssignedId __BT-13, From MINIMUM__ An identifier issued by the buyer for a referenced order (order number)
     * @param  DateTime|null $issueDate        __BT-X-147, From EXTENDED__ Date of order
     */
    public function get_document_buyer_order_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $issuer_assigned_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerOrderReferencedDocument.getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getBuyerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get details of the associated offer.
     *
     * @param  string|null   $issuerAssignedId __BT-X-403, From EXTENDED__ Offer number
     * @param  DateTime|null $issueDate        __BT-X-404, From EXTENDED__ Date of offer
     */
    public function get_document_quotation_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $issuer_assigned_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getQuotationReferencedDocument.getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getQuotationReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getQuotationReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get details of the associated contract.
     *
     * @param  string|null   $issuerAssignedId __BT-12, From BASIC WL__ The contract reference should be assigned once in the context of the specific trade relationship and for a defined period of time (contract number)
     * @param  DateTime|null $issueDate        __BT-X-26, From EXTENDED__ Contract date
     */
    public function get_document_contract_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $issuer_assigned_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getContractReferencedDocument.getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getContractReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getContractReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get first additional referenced document for the document. Returns true if an additional referenced document is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentAdditionalReferencedDocument.
     */
    public function first_document_additional_referenced_document(): bool
    {
        $this->document_add_ref_doc_pointer = 0;
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getAdditionalReferencedDocument', []);
        return isset($add_ref_doc[$this->document_add_ref_doc_pointer]);
    }
    /**
     * Get next additional referenced document for the document. Returns true when another additional referenced document is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentAdditionalReferencedDocument.
     */
    public function next_document_additional_referenced_document(): bool
    {
        $this->document_add_ref_doc_pointer++;
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getAdditionalReferencedDocument', []);
        return isset($add_ref_doc[$this->document_add_ref_doc_pointer]);
    }
    /**
     * Get information about billing documents that provide evidence of claims made in the bill.
     *
     * __Notes__
     *  - The documents justifying the invoice can be used to reference a document number, which should be
     *    known to the recipient, as well as an external document (referenced by a URL) or an embedded document (such
     *    as a timesheet as a PDF file). The option of linking to an external document is e.g. required when it comes
     *    to large attachments and / or sensitive information, e.g. for personal services, which must be separated
     *    from the bill
     *  - Use ZugferdDocumentReader::firstDocumentAdditionalReferencedDocument and
     *    ZugferdDocumentReader::nextDocumentAdditionalReferencedDocument to seek between multiple additional referenced
     *    documents
     *
     * @param  string        $issuerAssignedId   __BT-122, From EN 16931__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param  string        $typeCode           __BT-122-0, From EN 16931__ Type of referenced document (See codelist UNTDID 1001)
     *                                           - Code 916 "reference paper" is used to reference the identification of the
     *                                           document on which the invoice is based - Code 50 "Price / sales catalog response"
     *                                           is used to reference the tender or the lot - Code 130 "invoice data sheet" is used
     *                                           to reference an identifier for an object specified by the seller.
     * @param  string|null   $uriId              __BT-124, From EN 16931__ A means of locating the resource, including the primary access method intended for it, e.g. http:// or ftp://. The storage location of the external document must be used if the buyer requires further information as
     *                                           supporting documents for the invoiced amounts. External documents are not part of the invoice. Invoice processing should be possible without access to external documents. Access to external documents can entail certain risks.
     * @param  array|null    $name               __BT-123, From EN 16931__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     * @param  string|null   $refTypeCode        __BT-, From __ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     * @param  DateTime|null $issueDate          __BT-X-149, From EXTENDED__ Document date
     * @param  string|null   $binaryDataFilename __BT-125, From EN 16931__ Contains a file name of an attachment document embedded as a binary object
     */
    public function get_document_additional_referenced_document(?string &$issuer_assigned_id, ?string &$type_code, ?string &$uri_id, ?array &$name, ?string &$ref_type_code, ?DateTime &$issue_date, ?string &$binary_data_filename): Zugferd_Document_Reader
    {
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getAdditionalReferencedDocument', []);
        $add_ref_doc = $add_ref_doc[$this->document_add_ref_doc_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($add_ref_doc, 'getIssuerAssignedID.value', '');
        $type_code = $this->get_invoice_value_by_path_from($add_ref_doc, 'getTypeCode.value', '');
        $uri_id = $this->get_invoice_value_by_path_from($add_ref_doc, 'getURIID.value', '');
        $name = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($add_ref_doc, 'getName.value', null));
        $ref_type_code = $this->get_invoice_value_by_path_from($add_ref_doc, 'getReferenceTypeCode.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($add_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path_from($add_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        $binary_data_filename = $this->get_invoice_value_by_path_from($add_ref_doc, 'getAttachmentBinaryObject.getFilename', '');
        $binarydata = $this->get_invoice_value_by_path_from($add_ref_doc, 'getAttachmentBinaryObject.value', '');
        if (String_Utils::string_is_null_or_empty($binary_data_filename) === false && String_Utils::string_is_null_or_empty($binarydata) === false && String_Utils::string_is_null_or_empty($this->binarydatadirectory) === false) {
            $binary_data_filename = Path_Utils::combine_path_with_file($this->binarydatadirectory, $binary_data_filename);
            File_Utils::base64to_file($binarydata, $binary_data_filename);
        } else {
            $binary_data_filename = '';
        }
        return $this;
    }
    /**
     * Get all additional referenced documents.
     *
     * @param  array|null $refDocs Array contains all additional referenced documents, but without extracting attached binary objects. If you want to access attached binary objects you have to use ZugferdDocumentReader::getDocumentAdditionalReferencedDocument
     */
    public function get_document_additional_referenced_documents(?array &$ref_docs): Zugferd_Document_Reader
    {
        $ref_docs = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getAdditionalReferencedDocument', []);
        $ref_docs = $this->convert_to_array($ref_docs, ['IssuerAssignedID' => ['getIssuerAssignedID.value', ''], 'URIID' => ['getURIID.value', ''], 'LineID' => ['getLineID.value', ''], 'TypeCode' => ['getTypeCode.value', ''], 'ReferenceTypeCode' => ['getReferenceTypeCode.value', ''], 'FormattedIssueDateTime' => ['getFormattedIssueDateTime.getDateTimeString.value', '']]);
        return $this;
    }
    /**
     * Get first reference to the previous invoice. Returns true if an invoice reference document is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentInvoiceReferencedDocument.
     */
    public function first_document_invoice_referenced_document(): bool
    {
        $this->document_inv_ref_doc_pointer = 0;
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceReferencedDocument', []);
        return isset($add_ref_doc[$this->document_inv_ref_doc_pointer]);
    }
    /**
     * Get next reference to the previous invoice Returns true when another invoice reference document is available, otherwise false
     * You may use this together with ZugferdDocumentReader::getDocumentInvoiceReferencedDocument.
     */
    public function next_document_invoice_referenced_document(): bool
    {
        $this->document_inv_ref_doc_pointer++;
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceReferencedDocument', []);
        return isset($add_ref_doc[$this->document_inv_ref_doc_pointer]);
    }
    /**
     * Get reference to the previous invoice.
     *
     * @param string        $issuerAssignedId __BT-25, From BASIC WL__ The identification of an invoice previously sent by the seller
     * @param string|null   $typeCode         __BT-X-555, From EXTENDED__ Type of previous invoice (code)
     * @param DateTime|null $issueDate        __BT-26, From BASIC WL__ Date of the previous invoice
     */
    public function get_document_invoice_referenced_document(?string &$issuer_assigned_id, ?string &$type_code, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $invoice_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceReferencedDocument', []);
        $invoice_ref_doc = $invoice_ref_doc[$this->document_inv_ref_doc_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($invoice_ref_doc, 'getIssuerAssignedID.value', '');
        $type_code = $this->get_invoice_value_by_path_from($invoice_ref_doc, 'getTypeCode.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($invoice_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path_from($invoice_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get all references to the previous invoice.
     *
     * @param  array|null $invoiceRefDocs
     * Array contains all invoice referenced documents, but without extracting attached binary objects. If you
     * want to access attached binary objects you have to use ZugferdDocumentReader::getDocumentInvoiceReferencedDocument
     */
    public function get_document_invoice_referenced_documents(?array &$invoice_ref_docs): Zugferd_Document_Reader
    {
        $invoice_ref_docs = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceReferencedDocument', []);
        $invoice_ref_docs = $this->convert_to_array($invoice_ref_docs, ['IssuerAssignedID' => ['getIssuerAssignedID.value', ''], 'TypeCode' => ['getTypeCode.value', ''], 'FormattedIssueDateTime' => ['getFormattedIssueDateTime.getDateTimeString.value', '']]);
        return $this;
    }
    /**
     * Get Details of a project reference.
     *
     * @param  string|null $id   __BT-11, From EN 16931__ The identifier of the project to which the invoice relates
     * @param  string|null $name __BT-11-0, From EN 16931__  The name of the project to which the invoice relates
     */
    public function get_document_procuring_project(?string &$id, ?string &$name): Zugferd_Document_Reader
    {
        $id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSpecifiedProcuringProject.getID.value', '');
        $name = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getSpecifiedProcuringProject.getName.value', '');
        return $this;
    }
    /**
     * Get first additional referenced document for the document. Returns true if the first position is available, otherwise false.
     * Use wuth getDocumentUltimateCustomerOrderReferencedDocument.
     */
    public function first_document_ultimate_customer_order_referenced_document(): bool
    {
        $this->document_ultimate_customer_order_referenced_document_pointer = 0;
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getUltimateCustomerOrderReferencedDocument', []);
        return isset($add_ref_doc[$this->document_ultimate_customer_order_referenced_document_pointer]);
    }
    /**
     * Get next additional referenced document for the document. Returns true if the first position is available, otherwise false
     * Use wuth getDocumentUltimateCustomerOrderReferencedDocument.
     */
    public function next_document_ultimate_customer_order_referenced_document(): bool
    {
        $this->document_ultimate_customer_order_referenced_document_pointer++;
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getUltimateCustomerOrderReferencedDocument', []);
        return isset($add_ref_doc[$this->document_ultimate_customer_order_referenced_document_pointer]);
    }
    /**
     * Get details of the ultimate customer order.
     *
     * @param  string|null   $issuerAssignedId __BT-X-150, From EXTENDED__ Order number of the end customer
     * @param  DateTime|null $issueDate        __BT-X-151, From EXTENDED__ Date of the order issued by the end customer
     */
    public function get_document_ultimate_customer_order_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $add_ref_doc = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeAgreement.getUltimateCustomerOrderReferencedDocument', []);
        $add_ref_doc = $add_ref_doc[$this->document_ultimate_customer_order_referenced_document_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($add_ref_doc, 'getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($add_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path_from($add_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Details of the ultimate customer order.
     */
    public function get_document_ultimate_customer_order_referenced_documents(): Zugferd_Document_Reader
    {
        // TODO: Implemente method getDocumentUltimateCustomerOrderReferencedDocuments
        return $this;
    }
    /**
     * Get detailed information on the actual delivery.
     *
     * @param  DateTime|null $date __BT-72, From BASIC WL__ Actual delivery time
     */
    public function get_document_supply_chain_event(?DateTime &$date): Zugferd_Document_Reader
    {
        $date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getActualDeliverySupplyChainEvent.getOccurrenceDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getActualDeliverySupplyChainEvent.getOccurrenceDateTime.getDateTimeString.getformat', ''));
        return $this;
    }
    /**
     * Get detailed information on the associated shipping notification.
     *
     * @param  string|null   $issuerAssignedId __BT-16, From BASIC WL__ Shipping notification reference
     * @param  DateTime|null $issueDate        __BT-X-200, From EXTENDED__ Shipping notification date
     */
    public function get_document_despatch_advice_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $issuer_assigned_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getDespatchAdviceReferencedDocument.getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getDespatchAdviceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getDespatchAdviceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get detailed information on the associated goods receipt notification.
     *
     * @param  string|null   $issuerAssignedId __BT-15, From EN 16931__ An identifier for a referenced goods receipt notification (Goods receipt number)
     * @param  DateTime|null $issueDate        __BT-X-201, From EXTENDED__ Goods receipt date
     */
    public function get_document_receiving_advice_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $issuer_assigned_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getReceivingAdviceReferencedDocument.getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getReceivingAdviceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getReceivingAdviceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get detailed information on the associated delivery note.
     *
     * @param  string        $issuerAssignedId __BT-X-202, From EXTENDED__ Delivery slip number
     * @param  DateTime|null $issueDate        __BT-X-203, From EXTENDED__ Delivery slip date
     */
    public function get_document_delivery_note_referenced_document(?string &$issuer_assigned_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $issuer_assigned_id = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getDeliveryNoteReferencedDocument.getIssuerAssignedID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getDeliveryNoteReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeDelivery.getDeliveryNoteReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Seek to the first payment means of the document. Returns true if a first payment mean is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentPaymentMeans.
     */
    public function first_get_document_payment_means(): bool
    {
        $this->document_payment_means_pointer = 0;
        $payment_means = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementPaymentMeans', []));
        return isset($payment_means[$this->document_payment_means_pointer]);
    }
    /**
     * Seek to the next payment means of the document. Returns true if another payment mean is available, otherwise false
     * You may use this together with ZugferdDocumentReader::getDocumentPaymentMeans
     */
    public function next_get_document_payment_means(): bool
    {
        $this->document_payment_means_pointer++;
        $payment_means = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementPaymentMeans', []));
        return isset($payment_means[$this->document_payment_means_pointer]);
    }
    /**
     * Get detailed information on the payment method.
     *
     * @param  string      $typeCode         __BT-81, From BASIC WL__ The expected or used means of payment, expressed as a code. The entries from the UNTDID 4461 code list must be used. A distinction should be made between SEPA and non-SEPA payments as well as between credit payments, direct debits, card payments and other means of payment In particular, the following codes can be used:
     *                                       - 10: cash
     *                                       - 20: check
     *                                       - 30: transfer
     *                                       - 42: Payment to bank account
     *                                       - 48: Card payment
     *                                       - 49: direct debit
     *                                       - 57: Standing order
     *                                       - 58: SEPA Credit Transfer
     *                                       - 59: SEPA Direct Debit
     *                                       - 97: Report
     * @param  string|null $information      __BT-82, From EN 16931__ The expected or used means of payment expressed in text form, e.g. cash, bank transfer, direct debit, credit card, etc.
     * @param  string|null $cardType         __BT-, From __ The type of the card
     * @param  string|null $cardId           __BT-87, From EN 16931__ The primary account number (PAN) to which the card used for payment belongs. In accordance with card payment security standards, an invoice should never contain a full payment card master account number. The following specification of the PCI Security Standards Council currently applies: The first 6 and last 4 digits at most are to be displayed
     * @param  string|null $cardHolderName   __BT-88, From EN 16931__ Name of the payment card holder
     * @param  string|null $buyerIban        __BT-91, From BASIC WL__ The account to be debited by the direct debit
     * @param  string|null $payeeIban        __BT-84, From BASIC WL__ A unique identifier for the financial account held with a payment service provider to which the payment should be made
     * @param  string|null $payeeAccountName __BT-85, From BASIC WL__ The name of the payment account held with a payment service provider to which the payment should be made
     * @param  string|null $payeePropId      __BT-84-0, From BASIC WL__ National account number (not for SEPA)
     * @param  string|null $payeeBic         __BT-86, From EN 16931__ An identifier for the payment service provider with which the payment account is held
     */
    public function get_document_payment_means(?string &$type_code, ?string &$information, ?string &$card_type, ?string &$card_id, ?string &$card_holder_name, ?string &$buyer_iban, ?string &$payee_iban, ?string &$payee_account_name, ?string &$payee_prop_id, ?string &$payee_bic): Zugferd_Document_Reader
    {
        $payment_means = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementPaymentMeans', []));
        $payment_means = $payment_means[$this->document_payment_means_pointer];
        $type_code = $this->get_invoice_value_by_path_from($payment_means, 'getTypeCode.value', '');
        $information = $this->get_invoice_value_by_path_from($payment_means, 'getInformation.value', '');
        $card_type = $this->get_invoice_value_by_path_from($payment_means, 'getApplicableTradeSettlementFinancialCard.getID.getSchemeID', '');
        $card_id = $this->get_invoice_value_by_path_from($payment_means, 'getApplicableTradeSettlementFinancialCard.getID.value', '');
        $card_holder_name = $this->get_invoice_value_by_path_from($payment_means, 'getApplicableTradeSettlementFinancialCard.getCardholderName.value', '');
        $buyer_iban = $this->get_invoice_value_by_path_from($payment_means, 'getPayerPartyDebtorFinancialAccount.getIBANID.value', '');
        $payee_iban = $this->get_invoice_value_by_path_from($payment_means, 'getPayeePartyCreditorFinancialAccount.getIBANID.value', '');
        $payee_account_name = $this->get_invoice_value_by_path_from($payment_means, 'getPayeePartyCreditorFinancialAccount.getAccountName.value', '');
        $payee_prop_id = $this->get_invoice_value_by_path_from($payment_means, 'getPayeePartyCreditorFinancialAccount.getProprietaryID.value', '');
        $payee_bic = $this->get_invoice_value_by_path_from($payment_means, 'getPayeeSpecifiedCreditorFinancialInstitution.getBICID.value', '');
        return $this;
    }
    /**
     * Seek to the first document tax. Returns true if a first tax (at document level) is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentTax.
     */
    public function first_document_tax(): bool
    {
        $this->document_tax_pointer = 0;
        $taxes = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getApplicableTradeTax', []));
        return isset($taxes[$this->document_tax_pointer]);
    }
    /**
     * Seek to the next document tax. Returns true if another tax (at document level) is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentTax.
     */
    public function next_document_tax(): bool
    {
        $this->document_tax_pointer++;
        $taxes = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getApplicableTradeTax', []));
        return isset($taxes[$this->document_tax_pointer]);
    }
    /**
     * Get current VAT breakdown (at document level).
     *
     * @param string|null   $categoryCode               __BT-118, From BASIC WL__ Coded description of a sales tax category
     * @param string|null   $typeCode                   __BT-118-0, From BASIC WL__ Coded description of a sales tax category. Note: Fixed value = "VAT"
     * @param float|null    $basisAmount                __BT-116, From BASIC WL__ Tax base amount, Each sales tax breakdown must show a category-specific tax base amount.
     * @param float|null    $calculatedAmount           __BT-117, From BASIC WL__ The total amount to be paid for the relevant VAT category. Note: Calculated by multiplying the amount to be taxed according to the sales tax category by the sales tax rate applicable for the sales tax category concerned
     * @param float|null    $rateApplicablePercent      __BT-119, From BASIC WL__ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param string|null   $exemptionReason            __BT-120, From BASIC WL__ Reason for tax exemption (free text)
     * @param string|null   $exemptionReasonCode        __BT-121, From BASIC WL__ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility.
     * @param float|null    $lineTotalBasisAmount       __BT-X-262, From EXTENDED__ An amount used as the basis for calculating sales tax, duty or customs duty
     * @param float|null    $allowanceChargeBasisAmount __BT-X-263, From EXTENDED__ Total amount Additions and deductions to the tax rate at document level
     * @param DateTime|null $taxPointDate               __BT-7-00, From EN 16931__ Date on which tax is due. This is not used in Germany. Instead, the delivery and service date must be specified.
     * @param string|null   $dueDateTypeCode            __BT-8, From BASIC WL__ The code for the date on which the VAT becomes relevant for settlement for the seller and for the buyer
     */
    public function get_document_tax(?string &$category_code, ?string &$type_code, ?float &$basis_amount, ?float &$calculated_amount, ?float &$rate_applicable_percent, ?string &$exemption_reason, ?string &$exemption_reason_code, ?float &$line_total_basis_amount, ?float &$allowance_charge_basis_amount, ?DateTime &$tax_point_date, ?string &$due_date_type_code): Zugferd_Document_Reader
    {
        $taxes = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getApplicableTradeTax', []));
        $taxes = $taxes[$this->document_tax_pointer];
        $category_code = $this->get_invoice_value_by_path_from($taxes, 'getCategoryCode.value', '');
        $type_code = $this->get_invoice_value_by_path_from($taxes, 'getTypeCode.value', '');
        $basis_amount = $this->get_invoice_value_by_path_from($taxes, 'getBasisAmount.value', 0.0);
        $calculated_amount = $this->get_invoice_value_by_path_from($taxes, 'getCalculatedAmount.value', 0.0);
        $rate_applicable_percent = $this->get_invoice_value_by_path_from($taxes, 'getRateApplicablePercent.value', 0.0);
        $exemption_reason = $this->get_invoice_value_by_path_from($taxes, 'getExemptionReason.value', '');
        $exemption_reason_code = $this->get_invoice_value_by_path_from($taxes, 'getExemptionReasonCode.value', '');
        $line_total_basis_amount = $this->get_invoice_value_by_path_from($taxes, 'getLineTotalBasisAmount.value', 0.0);
        $allowance_charge_basis_amount = $this->get_invoice_value_by_path_from($taxes, 'getAllowanceChargeBasisAmount.value', 0.0);
        $tax_point_date = $this->get_object_helper()->to_date_time($this->get_object_helper()->try_call_by_path_and_return($taxes, 'getTaxPointDate.getDateString.value'), $this->get_object_helper()->try_call_by_path_and_return($taxes, 'getTaxPointDate.getDateString.getFormat'));
        $due_date_type_code = $this->get_invoice_value_by_path_from($taxes, 'getDueDateTypeCode.value', '');
        return $this;
    }
    /**
     * Get detailed information on the billing period.
     *
     * @param  DateTime|null $startDate __BT-73, From BASIC WL__ Start of the billing period
     * @param  DateTime|null $endDate   __BT-74, From BASIC WL__ End of the billing period
     */
    public function get_document_billing_period(?DateTime &$start_date, ?DateTime &$end_date): Zugferd_Document_Reader
    {
        $start_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getBillingSpecifiedPeriod.getStartDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getBillingSpecifiedPeriod.getStartDateTime.getDateTimeString.getFormat', null));
        $end_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getBillingSpecifiedPeriod.getEndDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getBillingSpecifiedPeriod.getEndDateTime.getDateTimeString.getFormat', null));
        return $this;
    }
    /**
     * Get information about surcharges and charges applicable to the bill as a whole, Deductions, such as for withheld taxes may also be specified in this group.
     */
    public function get_document_allowance_charges(?array &$allowance_charge): Zugferd_Document_Reader
    {
        $allowance_charge = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeAllowanceCharge', []);
        $allowance_charge = $this->convert_to_array($allowance_charge, ['chargeindicator' => ['getChargeIndicator.getIndicator', false], 'sequencenumeric' => ['getSequenceNumeric.value', 0], 'calculationpercent' => ['getCalculationPercent.value', 0.0], 'basisamount' => ['getBasisAmount.value', 0.0], 'basisquantity' => ['getBasisQuantity.value', 0.0], 'actualAmount' => ['getActualAmount.value', 0.0], 'reasoncode' => ['getReasonCode.value', ''], 'reason' => ['getReason.value', ''], 'taxcalculatedamount' => ['getCategoryTradeTax.getCalculatedAmount.value', 0.0], 'taxtypecode' => ['getCategoryTradeTax.getTypeCode.value', ''], 'taxexemptionreason' => ['getCategoryTradeTax.getExemptionReason.value', ''], 'taxbasisamount' => ['getCategoryTradeTax.getBasisAmount.value', 0.0], 'taxlinetotalbasisamount' => ['getCategoryTradeTax.getLineTotalBasisAmount.value', 0.0], 'taxallowancechargebasisamount' => ['getCategoryTradeTax.getAllowanceChargeBasisAmount.value', 0.0], 'taxcategorycode' => ['getCategoryTradeTax.getCategoryCode.value', ''], 'taxexemptionreasoncode' => ['getCategoryTradeTax.getExemptionReasonCode.value', ''], 'taxpointdate' => function ($item) {
            return $this->get_object_helper()->to_date_time($this->get_object_helper()->try_call_by_path_and_return($item, 'getCategoryTradeTax.getTaxPointDate.getDateString.value'), $this->get_object_helper()->try_call_by_path_and_return($item, 'getCategoryTradeTax.getTaxPointDate.getDateString.getFormat'));
        }, 'taxduedatetypecode' => ['getCategoryTradeTax.getDueDateTypeCode.value', ''], 'taxrateapplicablepercent' => ['getCategoryTradeTax.getRateApplicablePercent.value', 0.0]]);
        return $this;
    }
    /**
     * Seek to the first documents allowance charge. Returns true if the first position is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentAllowanceCharge.
     */
    public function first_document_allowance_charge(): bool
    {
        $this->document_allowance_charge_pointer = 0;
        $allowance_charge = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeAllowanceCharge', []);
        return isset($allowance_charge[$this->document_allowance_charge_pointer]);
    }
    /**
     * Seek to the next documents allowance charge. Returns true if a other position is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentAllowanceCharge.
     */
    public function next_document_allowance_charge(): bool
    {
        $this->document_allowance_charge_pointer++;
        $allowance_charge = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeAllowanceCharge', []);
        return isset($allowance_charge[$this->document_allowance_charge_pointer]);
    }
    /**
     * Get information about the currently seeked surcharges and charges applicable to the bill as a whole, Deductions, such as for withheld taxes may also be specified in this group.
     *
     * @param  float|null   $actualAmount          __BT-92/BT-99, From BASIC WL__ Amount of the surcharge or discount at document level
     * @param  boolean|null $isCharge              __BT-20-1/BT-21-1, From BASIC WL__ Switch that indicates whether the following data refer to an surcharge or a discount, true means that this an charge
     * @param  string|null  $taxCategoryCode       __BT-95/BT-102, From BASIC WL__ A coded indication of which sales tax category applies to the surcharge or deduction at document level
     * @param  string|null  $taxTypeCode           __BT-95-0/BT-102-0, From BASIC WL__ Code for the VAT category of the surcharge or charge at document level. Note: Fixed value = "VAT"
     * @param  float|null   $rateApplicablePercent __BT-96/BT-103, From BASIC WL__ VAT rate for the surcharge or discount on document level. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param  float|null   $sequence              __BT-X-265, From EXTENDED__ Calculation order
     * @param  float|null   $calculationPercent    __BT-94/BT-101, From BASIC WL__ Percentage surcharge or discount at document level
     * @param  float|null   $basisAmount           __BT-93/BT-100, From BASIC WL__ The base amount that may be used in conjunction with the percentage of the surcharge or discount at document level to calculate the amount of the discount at document level
     * @param  float|null   $basisQuantity         __BT-X-266, From EXTENDED__ Base quantity of the discount
     * @param  string|null  $basisQuantityUnitCode __BT-X-267, From EXTENDED__ Unit of the price base quantity
     * @param  string|null  $reasonCode            __BT-98/BT-105, From BASIC WL__ The reason given as a code for the surcharge or discount at document level. Note: Use entries from the UNTDID 5189 code list. The code of the reason for the surcharge or discount at document level and the reason for the surcharge or discount at document level must correspond to each other
     * @param  string|null  $reason                __BT-97/BT-104, From BASIC WL__ The reason given in text form for the surcharge or discount at document level
     */
    public function get_document_allowance_charge(?float &$actual_amount, ?bool &$is_charge, ?string &$tax_category_code, ?string &$tax_type_code, ?float &$rate_applicable_percent, ?float &$sequence, ?float &$calculation_percent, ?float &$basis_amount, ?float &$basis_quantity, ?string &$basis_quantity_unit_code, ?string &$reason_code, ?string &$reason): Zugferd_Document_Reader
    {
        $allowance_charge = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeAllowanceCharge', []);
        $allowance_charge = $allowance_charge[$this->document_allowance_charge_pointer];
        $actual_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getActualAmount.value', 0.0);
        $is_charge = $this->get_invoice_value_by_path_from($allowance_charge, 'getChargeIndicator.getIndicator', false);
        $tax_category_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getCategoryCode.value', '');
        $tax_type_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getTypeCode.value', '');
        $rate_applicable_percent = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getRateApplicablePercent.value', 0.0);
        $sequence = $this->get_invoice_value_by_path_from($allowance_charge, 'getSequenceNumeric.value', 0);
        $calculation_percent = $this->get_invoice_value_by_path_from($allowance_charge, 'getCalculationPercent.value', 0.0);
        $basis_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisAmount.value', 0.0);
        $basis_quantity = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisQuantity.value', 0.0);
        $basis_quantity_unit_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisQuantity.getUnitCode', '');
        $reason_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getReasonCode.value', '');
        $reason = $this->get_invoice_value_by_path_from($allowance_charge, 'getReason.value', '');
        return $this;
    }
    /**
     * Seek to the first documents service charge position. Returns true if the first position is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentLogisticsServiceCharge.
     */
    public function first_document_logistics_service_charge(): bool
    {
        $this->document_logistic_service_charge_pointer = 0;
        $service_charge = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedLogisticsServiceCharge', []);
        return isset($service_charge[$this->document_logistic_service_charge_pointer]);
    }
    /**
     * Seek to the next documents service charge position. Returns true if a other position is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentLogisticsServiceCharge.
     */
    public function next_document_logistics_service_charge(): bool
    {
        $this->document_logistic_service_charge_pointer++;
        $service_charge = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedLogisticsServiceCharge', []);
        return isset($service_charge[$this->document_logistic_service_charge_pointer]);
    }
    /**
     * Get currently seeked logistical service fees (On document level).
     *
     * @param  string|null $description            __BT-X-271, From EXTENDED__ Identification of the service fee
     * @param  float|null  $appliedAmount          __BT-X-272, From EXTENDED__ Amount of the service fee
     * @param  array|null  $taxTypeCodes           __BT-X-273-0, From EXTENDED__ Code of the Tax type. Note: Fixed value = "VAT"
     * @param  array|null  $taxCategoryCodes       __BT-X-273, From EXTENDED__ Code of the VAT category
     * @param  array|null  $rateApplicablePercents __BT-X-274, From EXTENDED__ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function get_document_logistics_service_charge(?string &$description, ?float &$applied_amount, ?array &$tax_type_codes, ?array &$tax_category_codes, ?array &$rate_applicable_percents): Zugferd_Document_Reader
    {
        $service_charge = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedLogisticsServiceCharge', []);
        $service_charge = $service_charge[$this->document_logistic_service_charge_pointer];
        $description = $this->get_invoice_value_by_path_from($service_charge, 'getDescription.value', '');
        $applied_amount = $this->get_invoice_value_by_path_from($service_charge, 'getAppliedAmount.value', 0.0);
        $applied_trade_tax = $this->get_invoice_value_by_path_from($service_charge, 'getAppliedTradeTax', []);
        $tax_type_codes = $this->convert_to_array($applied_trade_tax, ['typecode' => ['getTypeCode.value', '']]);
        $tax_category_codes = $this->convert_to_array($applied_trade_tax, ['categorycode' => ['getCategoryCode.value', '']]);
        $rate_applicable_percents = $this->convert_to_array($applied_trade_tax, ['percent' => ['getRateApplicablePercent.value', 0.0]]);
        return $this;
    }
    /**
     * Get all documents payment terms.
     */
    public function get_document_payment_terms(?array &$payment_terms): Zugferd_Document_Reader
    {
        $payment_terms = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradePaymentTerms', []);
        $payment_terms = $this->convert_to_array($payment_terms, ['description' => ['getDescription.value', ''], 'duedate' => function ($item) {
            return $this->get_object_helper()->to_date_time($this->get_object_helper()->try_call_by_path_and_return($item, 'getDueDateDateTime.getDateTimeString.value'), $this->get_object_helper()->try_call_by_path_and_return($item, 'getDueDateDateTime.getDateTimeString.getFormat'));
        }, 'directdebitmandateid' => ['getDirectDebitMandateID.value', ''], 'partialpaymentamount' => ['getPartialPaymentAmount.value', 0.0]]);
        return $this;
    }
    /**
     * Seek to the first documents payment terms position. Returns true if the first position is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentPaymentTerm.
     */
    public function first_document_payment_terms(): bool
    {
        $this->document_payment_terms_pointer = 0;
        $payment_terms = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradePaymentTerms', []));
        return isset($payment_terms[$this->document_payment_terms_pointer]);
    }
    /**
     * Seek to the next documents payment terms position. Returns true if a other position is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentPaymentTerm.
     */
    public function next_document_payment_terms(): bool
    {
        $this->document_payment_terms_pointer++;
        $payment_terms = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradePaymentTerms', []));
        return isset($payment_terms[$this->document_payment_terms_pointer]);
    }
    /**
     * Get currently seeked payment term.
     *
     * @param  string|null   $description          __BT-20, From _BASIC WL__ A text description of the payment terms that apply to the payment amount due (including a description of possible penalties). Note: This element can contain multiple lines and multiple conditions.
     * @param  DateTime|null $dueDate              __BT-9, From BASIC WL__ The date by which payment is due Note: The payment due date reflects the net payment due date. In the case of partial payments, this indicates the first due date of a net payment. The corresponding description of more complex payment terms can be given in BT-20.
     * @param  string|null   $directDebitMandateID __BT-89, From BASIC WL__ Unique identifier assigned by the payee to reference the direct debit authorization.
     */
    public function get_document_payment_term(?string &$description, ?DateTime &$due_date, ?string &$direct_debit_mandate_id): Zugferd_Document_Reader
    {
        $payment_terms = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradePaymentTerms', []));
        $payment_terms = $payment_terms[$this->document_payment_terms_pointer];
        $description = $this->get_invoice_value_by_path_from($payment_terms, 'getDescription.value', '');
        $due_date = $this->get_object_helper()->to_date_time($this->get_object_helper()->try_call_by_path_and_return($payment_terms, 'getDueDateDateTime.getDateTimeString.value'), $this->get_object_helper()->try_call_by_path_and_return($payment_terms, 'getDueDateDateTime.getDateTimeString.getFormat'));
        $direct_debit_mandate_id = $this->get_invoice_value_by_path_from($payment_terms, 'getDirectDebitMandateID.value', '');
        return $this;
    }
    /**
     * Get detailed information on payment discounts.
     *
     * @param  float|null    $calculationPercent         __BT-X-286, From EXTENDED__ Percentage of the down payment
     * @param  DateTime|null $basisDateTime              __BT-X-282, From EXTENDED__ Due date reference date
     * @param  float|null    $basisPeriodMeasureValue    __BT-X-284, From EXTENDED__ Maturity period (basis)
     * @param  string|null   $basisPeriodMeasureUnitCode __BT-X-284, From EXTENDED__ Maturity period (unit)
     * @param  float|null    $basisAmount                __BT-X-284, From EXTENDED__ Base amount of the payment discount
     * @param  float|null    $actualDiscountAmount       __BT-X-287, From EXTENDED__ Amount of the payment discount
     */
    public function get_discount_terms_from_payment_term(?float &$calculation_percent, ?DateTime &$basis_date_time, ?float &$basis_period_measure_value, ?string &$basis_period_measure_unit_code, ?float &$basis_amount, ?float &$actual_discount_amount): Zugferd_Document_Reader
    {
        $payment_terms = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradePaymentTerms', []));
        $payment_terms = $payment_terms[$this->document_payment_terms_pointer];
        $calculation_percent = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentDiscountTerms.getCalculationPercent.value', 0.0);
        $basis_date_time = $this->get_object_helper()->to_date_time($this->get_object_helper()->try_call_by_path_and_return($payment_terms, 'getApplicableTradePaymentDiscountTerms.getBasisDateTime.getDateTimeString.value'), $this->get_object_helper()->try_call_by_path_and_return($payment_terms, 'getApplicableTradePaymentDiscountTerms.getBasisDateTime.getDateTimeString.getFormat'));
        $basis_period_measure_value = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentDiscountTerms.getBasisPeriodMeasure.value', 0.0);
        $basis_period_measure_unit_code = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentDiscountTerms.getBasisPeriodMeasure.getUnitCode', '');
        $basis_amount = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentDiscountTerms.getBasisAmount.value', 0.0);
        $actual_discount_amount = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentDiscountTerms.getActualDiscountAmount.value', 0.0);
        return $this;
    }
    /**
     * Get detailed information on payment penalties.
     *
     * @param  float|null    $calculationPercent         __BT-X-280, From EXTENDED__ Percentage of the payment surcharge
     * @param  DateTime|null $basisDateTime              __BT-X-276, From EXTENDED__ Due date reference date
     * @param  float|null    $basisPeriodMeasureValue    __BT-X-277, From EXTENDED__ Maturity period (basis)
     * @param  string|null   $basisPeriodMeasureUnitCode __BT-X-277, From EXTENDED__ Maturity period (unit)
     * @param  float|null    $basisAmount                __BT-X-279, From EXTENDED__ Basic amount of the payment surcharge
     * @param  float|null    $actualPenaltyAmount        __BT-X-281, From EXTENDED__ Amount of the payment surcharge
     */
    public function get_penalty_terms_from_payment_term(?float &$calculation_percent, ?DateTime &$basis_date_time, ?float &$basis_period_measure_value, ?string &$basis_period_measure_unit_code, ?float &$basis_amount, ?float &$actual_penalty_amount): Zugferd_Document_Reader
    {
        $payment_terms = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradePaymentTerms', []));
        $payment_terms = $payment_terms[$this->document_payment_terms_pointer];
        $calculation_percent = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentPenaltyTerms.getCalculationPercent.value', 0.0);
        $basis_date_time = $this->get_object_helper()->to_date_time($this->get_object_helper()->try_call_by_path_and_return($payment_terms, 'getApplicableTradePaymentPenaltyTerms.getBasisDateTime.getDateTimeString.value'), $this->get_object_helper()->try_call_by_path_and_return($payment_terms, 'getApplicableTradePaymentPenaltyTerms.getBasisDateTime.getDateTimeString.getFormat'));
        $basis_period_measure_value = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentPenaltyTerms.getBasisPeriodMeasure.value', 0.0);
        $basis_period_measure_unit_code = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentPenaltyTerms.getBasisPeriodMeasure.getUnitCode', '');
        $basis_amount = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentPenaltyTerms.getBasisAmount.value', 0.0);
        $actual_penalty_amount = $this->get_invoice_value_by_path_from($payment_terms, 'getApplicableTradePaymentPenaltyTerms.getActualPenaltyAmount.value', 0.0);
        return $this;
    }
    /**
     * Seek to the first trade accounting account of the document. Returns true if a first account is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentSellerContact.
     */
    public function first_document_receivable_specified_trade_accounting_account(): bool
    {
        $this->document_trade_accounting_account_pointer = 0;
        $acccounts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getReceivableSpecifiedTradeAccountingAccount', []));
        return isset($acccounts[$this->document_trade_accounting_account_pointer]);
    }
    /**
     * Seek to the next trade accounting account of the document. Returns true if another account is available, otherwise false.
     * You may use this together with ZugferdDocumentReader::getDocumentSellerContact.
     */
    public function next_document_receivable_specified_trade_accounting_account(): bool
    {
        $this->document_trade_accounting_account_pointer++;
        $acccounts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getReceivableSpecifiedTradeAccountingAccount', []));
        return isset($acccounts[$this->document_trade_accounting_account_pointer]);
    }
    /**
     * Get information on the booking reference (on document level).
     *
     * @param  null|string &$id       __BT-19, From BASIC WL__ Posting reference of the byuer. If required, this reference shall be provided by the Buyer to the Seller prior to the issuing of the Invoice.
     * @param  null|string &$typeCode __BT-X-290, From EXTENDED__ Type of the posting reference
     */
    public function get_document_receivable_specified_trade_accounting_account(?string &$id, ?string &$type_code): Zugferd_Document_Reader
    {
        $acccounts = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getReceivableSpecifiedTradeAccountingAccount', []));
        $acccounts = $acccounts[$this->document_trade_accounting_account_pointer];
        $id = $this->get_invoice_value_by_path_from($acccounts, 'getId.value', '');
        $type_code = $this->get_invoice_value_by_path_from($acccounts, 'getTypeCode.value', '');
        return $this;
    }
    /**
     * Read Document money summation.
     *
     * @param  float|null $grandTotalAmount     __BT-112, From MINIMUM__ Total invoice amount including sales tax
     * @param  float|null $duePayableAmount     __BT-115, From MINIMUM__ Payment amount due
     * @param  float|null $lineTotalAmount      __BT-106, From BASIC WL__ Sum of the net amounts of all invoice items
     * @param  float|null $chargeTotalAmount    __BT-108, From BASIC WL__ Sum of the surcharges at document level
     * @param  float|null $allowanceTotalAmount __BT-107, From BASIC WL__ Sum of the discounts at document level
     * @param  float|null $taxBasisTotalAmount  __BT-109, From MINIMUM__ Total invoice amount excluding sales tax
     * @param  float|null $taxTotalAmount       __BT-110/111, From MINIMUM/BASIC WL__ if BT-6 is not null $taxTotalAmount = BT-111. Total amount of the invoice sales tax, Total tax amount in the booking currency
     * @param  float|null $roundingAmount       __BT-114, From EN 16931__ Rounding amount
     * @param  float|null $totalPrepaidAmount   __BT-113, From BASIC WL__ Prepayment amount
     */
    public function get_document_summation(?float &$grand_total_amount, ?float &$due_payable_amount, ?float &$line_total_amount, ?float &$charge_total_amount, ?float &$allowance_total_amount, ?float &$tax_basis_total_amount, ?float &$tax_total_amount, ?float &$rounding_amount, ?float &$total_prepaid_amount): Zugferd_Document_Reader
    {
        $invoice_currency_code = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getInvoiceCurrencyCode.value', '');
        $grand_total_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getGrandTotalAmount.value', 0);
        $tax_basis_total_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getTaxBasisTotalAmount.value', 0);
        $tax_total_amount_element = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getTaxTotalAmount', []);
        foreach ($tax_total_amount_element as $tax_total_amount_element_item) {
            $tax_total_amount_currency_code = $this->get_object_helper()->try_call_and_return($tax_total_amount_element_item, 'getCurrencyID') ?? '';
            if ($tax_total_amount_currency_code == $invoice_currency_code || $tax_total_amount_currency_code == '') {
                $tax_total_amount = $this->get_object_helper()->try_call_and_return($tax_total_amount_element_item, 'value') ?? 0;
                break;
            }
        }
        $due_payable_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getDuePayableAmount.value', 0);
        $line_total_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getLineTotalAmount.value', 0);
        $charge_total_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getChargeTotalAmount.value', 0);
        $allowance_total_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getAllowanceTotalAmount.value', 0);
        $rounding_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getRoundingAmount.value', 0);
        $total_prepaid_amount = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getApplicableHeaderTradeSettlement.getSpecifiedTradeSettlementHeaderMonetarySummation.getTotalPrepaidAmount.value', 0);
        return $this;
    }
    /**
     * Seek to the first document position. Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionGenerals.
     */
    public function first_document_position(): bool
    {
        $this->position_pointer = 0;
        $this->position_note_pointer = 0;
        $this->position_gross_price_allowance_charge_pointer = 0;
        $this->position_tax_pointer = 0;
        $this->position_allowance_charge_pointer = 0;
        $this->position_add_ref_doc_pointer = 0;
        $this->position_add_ref_obj_doc_pointer = 0;
        $this->position_product_characteristic_pointer = 0;
        $this->position_product_classification_pointer = 0;
        $this->position_referenced_product_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        return isset($trade_line_item[$this->position_pointer]);
    }
    /**
     * Seek to the next document position. Returns true if another position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionGenerals.
     */
    public function next_document_position(): bool
    {
        $this->position_pointer++;
        $this->position_note_pointer = 0;
        $this->position_gross_price_allowance_charge_pointer = 0;
        $this->position_tax_pointer = 0;
        $this->position_allowance_charge_pointer = 0;
        $this->position_add_ref_doc_pointer = 0;
        $this->position_add_ref_obj_doc_pointer = 0;
        $this->position_product_characteristic_pointer = 0;
        $this->position_product_classification_pointer = 0;
        $this->position_referenced_product_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        return isset($trade_line_item[$this->position_pointer]);
    }
    /**
     * Get general information of the current position.
     *
     * @param  string      $lineId               __BT-126, From BASIC__ Identification of the invoice item
     * @param  string|null $lineStatusCode       __BT-X-7, From EXTENDED__ Indicates whether the invoice item contains prices that must be taken into account when calculating the invoice amount or whether only information is included.
     * @param  string|null $lineStatusReasonCode __BT-X-8, From EXTENDED__ Adds the type to specify whether the invoice line is:
     */
    public function get_document_position_generals(?string &$line_id, ?string &$line_status_code, ?string &$line_status_reason_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getAssociatedDocumentLineDocument.getLineID.value', '');
        $line_status_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getAssociatedDocumentLineDocument.getLineStatusCode.value', '');
        $line_status_reason_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getAssociatedDocumentLineDocument.getLineStatusReasonCode.value', '');
        return $this;
    }
    /**
     * Seek to the first document position. Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionNote.
     */
    public function first_document_position_note(): bool
    {
        $this->position_note_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_note = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getAssociatedDocumentLineDocument.getIncludedNote', []));
        return isset($trade_line_item_note[$this->position_note_pointer]);
    }
    /**
     * Seek to the next document position. Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionNote.
     */
    public function next_document_position_note(): bool
    {
        $this->position_note_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_note = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getAssociatedDocumentLineDocument.getIncludedNote', []));
        return isset($trade_line_item_note[$this->position_note_pointer]);
    }
    /**
     * Get detailed information on the free text on the position.
     *
     * @param  string      $content     __BT-127, From BASIC__ A free text that contains unstructured information that is relevant to the invoice item
     * @param  string|null $contentCode __BT-X-9, From EXTENDED__ A code to classify the content of the free text of the invoice. The code is agreed bilaterally and must have the same meaning as BT-127.
     * @param  string|null $subjectCode __BT-X-10, From EXTENDED__ Code for qualifying the free text for the invoice item (Codelist UNTDID 4451)
     */
    public function get_document_position_note(?string &$content, ?string &$content_code, ?string &$subject_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_note = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getAssociatedDocumentLineDocument.getIncludedNote', []));
        $trade_line_item_note = $trade_line_item_note[$this->position_note_pointer];
        $content = $this->get_invoice_value_by_path_from($trade_line_item_note, 'getContent.value', '');
        $content_code = $this->get_invoice_value_by_path_from($trade_line_item_note, 'getContentCode.value', '');
        $subject_code = $this->get_invoice_value_by_path_from($trade_line_item_note, 'getSubjectCode.value', '');
        return $this;
    }
    /**
     * Get information about the goods and services billed.
     *
     * @param  string|null $name             __BT-153, From BASIC__ A name of the item (item name)
     * @param  string|null $description      __BT-154, From EN 16931__ A description of the item, the item description makes it possible to describe the item and its properties in more detail than is possible with the item name.
     * @param  string|null $sellerAssignedID __BT-155, From EN 16931__ An identifier assigned to the item by the seller
     * @param  string|null $buyerAssignedID  __BT-156, From EN 16931__ An identifier assigned to the item by the buyer. The article number of the buyer is a clear, bilaterally agreed identification of the product. It can, for example, be the customer article number or the article number assigned by the manufacturer.
     * @param  string|null $globalIDType     __BT-157-1, From BASIC__ The scheme for $globalID
     * @param  string|null $globalID         __BT-157, From BASIC__ Identification of an article according to the registered scheme (Global identifier of the product, GTIN, ...)
     */
    public function get_document_position_product_details(?string &$name, ?string &$description, ?string &$seller_assigned_id, ?string &$buyer_assigned_id, ?string &$global_id_type, ?string &$global_id): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $name = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getName.value', '');
        $description = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getDescription.value', '');
        $seller_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getSellerAssignedID.value', '');
        $buyer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getBuyerAssignedID.value', '');
        $global_id_type = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getGlobalID.getSchemeID', '');
        $global_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getGlobalID.value', '');
        return $this;
    }
    /**
     * Get information about the goods and services billed (Enhanced, with Model, Brand, etc.).
     *
     * @param  string|null $name               __BT-153, From BASIC__ A name of the item (item name)
     * @param  string|null $description        __BT-154, From EN 16931__ A description of the item, the item description makes it possible to describe the item and its properties in more detail than is possible with the item name.
     * @param  string|null $sellerAssignedID   __BT-155, From EN 16931__ An identifier assigned to the item by the seller
     * @param  string|null $buyerAssignedID    __BT-156, From EN 16931__ An identifier assigned to the item by the buyer. The article number of the buyer is a clear, bilaterally agreed identification of the product. It can, for example, be the customer article number or the article number assigned by the manufacturer.
     * @param  string|null $globalIDType       __BT-157-1, From BASIC__ The scheme for $globalID
     * @param  string|null $globalID           __BT-157, From BASIC__ Identification of an article according to the registered scheme (Global identifier of the product, GTIN, ...)
     * @param  string|null $industryAssignedID __BT-X-309, From EXTENDED__ ID assigned by the industry to the contained referenced product
     * @param  string|null $modelID            __BT-X-533, From EXTENDED__ A unique model identifier for this product
     * @param  string|null $batchID            __BT-X-534. From EXTENDED__ Identification of the batch (lot) of the product
     * @param  string|null $brandName          __BT-X-535. From EXTENDED__ The brand name, expressed as text, for this product
     * @param  string|null $modelName          __BT-X-536. From EXTENDED__ Model designation of the product
     */
    public function get_document_position_product_details_ext(?string &$name, ?string &$description, ?string &$seller_assigned_id, ?string &$buyer_assigned_id, ?string &$global_id_type, ?string &$global_id, ?string &$industry_assigned_id, ?string &$model_id, ?string &$batch_id, ?string &$brand_name, ?string &$model_name): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $name = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getName.value', '');
        $description = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getDescription.value', '');
        $seller_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getSellerAssignedID.value', '');
        $buyer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getBuyerAssignedID.value', '');
        $global_id_type = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getGlobalID.getSchemeID', '');
        $global_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getGlobalID.value', '');
        $industry_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getIndustryAssignedID.value', '');
        $model_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getModelID.value', '');
        $batch_i_ds = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getBatchID', '');
        $batch_id = isset($batch_i_ds[0]) ? $this->get_object_helper()->try_call_and_return($batch_i_ds[0], 'value') : '';
        $brand_name = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getBrandName.value', '');
        $model_name = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getModelName.value', '');
        return $this;
    }
    /**
     * Seek to the first document position's product characteristic. Returns true if the first position propduct characteristic is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionProductCharacteristic.
     */
    public function first_document_position_product_characteristic(): bool
    {
        $this->position_product_characteristic_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_product_characteristic = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getApplicableProductCharacteristic', []));
        return isset($trade_line_item_product_characteristic[$this->position_product_characteristic_pointer]);
    }
    /**
     * Seek to the next document position's product characteristic. Returns true if more position propduct characteristics are available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionProductCharacteristic.
     */
    public function next_document_position_product_characteristic(): bool
    {
        $this->position_product_characteristic_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_product_characteristic = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getApplicableProductCharacteristic', []));
        return isset($trade_line_item_product_characteristic[$this->position_product_characteristic_pointer]);
    }
    /**
     * Get extra characteristics to the formerly added product. Contains information about the characteristics of the goods and services invoiced.
     *
     * @param  string      $description          __BT-160, From EN 16931__ The name of the attribute or property of the product such as "Colour"
     * @param  string      $value                __BT-161, From EN 16931__ The value of the attribute or property of the product such as "Red"
     * @param  string|null $typeCode             __BT-X-11, From EXTENDED__ Type of product characteristic (code). The codes must be taken from the UNTDID 6313 codelist.
     * @param  float|null  $valueMeasure         __BT-X-12, From EXTENDED__ Value of the product property (numerical measured variable)
     * @param  string|null $valueMeasureUnitCode __BT-X-12-0, From EXTENDED__ Unit of measurement code
     */
    public function get_document_position_product_characteristic(?string &$description, ?string &$value, ?string &$type_code, ?float &$value_measure, ?string &$value_measure_unit_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_product_characteristic = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getApplicableProductCharacteristic', []));
        $trade_line_item_product_characteristic = $trade_line_item_product_characteristic[$this->position_product_characteristic_pointer];
        $description = $this->get_invoice_value_by_path_from($trade_line_item_product_characteristic, 'getDescription.value', '');
        $value = $this->get_invoice_value_by_path_from($trade_line_item_product_characteristic, 'getValue.value', '');
        $type_code = $this->get_invoice_value_by_path_from($trade_line_item_product_characteristic, 'getTypeCode.value', '');
        $value_measure = $this->get_invoice_value_by_path_from($trade_line_item_product_characteristic, 'getValueMeasure.value', 0.0);
        $value_measure_unit_code = $this->get_invoice_value_by_path_from($trade_line_item_product_characteristic, 'getValueMeasure.getUnitCode', '');
        return $this;
    }
    /**
     * Seek to the first document position's product classification. Returns true if the first position propduct classification is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionProductClassification.
     */
    public function first_document_position_product_classification(): bool
    {
        $this->position_product_classification_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_product_classification = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getDesignatedProductClassification', []));
        return isset($trade_line_item_product_classification[$this->position_product_classification_pointer]);
    }
    /**
     * Seek to the next document position's product classification. Returns true if more position propduct classifications are available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionProductClassification.
     */
    public function next_document_position_product_classification(): bool
    {
        $this->position_product_classification_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_product_classification = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getDesignatedProductClassification', []));
        return isset($trade_line_item_product_classification[$this->position_product_classification_pointer]);
    }
    /**
     * Get detailed information on product classification.
     *
     * @param  string      $classCode     __BT-158, From EN 16931__ Item classification identifier. Classification codes are used for grouping similar items that can serve different purposes, such as public procurement (according to the Common Procurement Vocabulary ([CPV]), e-commerce (UNSPSC), etc.
     * @param  string|null $className     __BT-X-138, From EXTENDED__ Name with which an article can be classified according to type or quality.
     * @param  string|null $listID        __BT-158-1, From EN 16931__ The identifier for the identification scheme of the item classification identifier. The identification scheme must be selected from the entries in UNTDID 7143 [6].
     * @param  string|null $listVersionID __BT-158-2, From EN 16931__ The version of the identification scheme
     */
    public function get_document_position_product_classification(?string &$class_code, ?string &$class_name, ?string &$list_id, ?string &$list_version_id): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_product_classification = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getDesignatedProductClassification', []));
        $trade_line_item_product_classification = $trade_line_item_product_classification[$this->position_product_classification_pointer];
        $class_code = $this->get_invoice_value_by_path_from($trade_line_item_product_classification, 'getClassCode.value', '');
        $class_name = $this->get_invoice_value_by_path_from($trade_line_item_product_classification, 'getClassName.value', '');
        $list_id = $this->get_invoice_value_by_path_from($trade_line_item_product_classification, 'getClassCode.getListID', '');
        $list_version_id = $this->get_invoice_value_by_path_from($trade_line_item_product_classification, 'getClassCode.getListVersionID', '');
        return $this;
    }
    /**
     * Seek to the first document position's referenced product. Returns true if the first position referenced product is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionReferencedProduct.
     */
    public function first_document_position_referenced_product(): bool
    {
        $this->position_referenced_product_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_referenced_product = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getIncludedReferencedProduct', []));
        return isset($trade_line_item_referenced_product[$this->position_referenced_product_pointer]);
    }
    /**
     * Seek to the next document position's referenced product. Returns true if more position referenced products are available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionReferencedProduct.
     */
    public function next_document_position_referenced_product(): bool
    {
        $this->position_referenced_product_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_referenced_product = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getIncludedReferencedProduct', []));
        return isset($trade_line_item_referenced_product[$this->position_referenced_product_pointer]);
    }
    /**
     * Get detailed information on included products. This information relates to the product that has just been added.
     *
     * @param  string      $name               __BT-X-18, From EXTENDED__ Name of the referenced product contained
     * @param  string|null $description        __BT-X-19, From EXTENDED__ Description of the included referenced product
     * @param  string|null $sellerAssignedID   __BT-X-16, From EXTENDED__ ID assigned by the seller of the contained referenced product
     * @param  string|null $buyerAssignedID    __BT-X-17, From EXTENDED__ ID of the referenced product assigned by the buyer
     * @param  array|null  $globalID           __BT-X-15, From EXTENDED__ Array of global ids of the referenced product indexed by the identification scheme.
     * @param  float|null  $unitQuantity       __BT-X-20, From EXTENDED__ Quantity of the referenced product contained
     * @param  string|null $unitCode           __BT-X-20-1, From EXTENDED__ Unit code of Quantity of the referenced product contained
     * @param  string|null $industryAssignedID __BT-X-309, From EXTENDED__ ID of the referenced product contained assigned by the industry
     */
    public function get_document_position_referenced_product(?string &$name, ?string &$description, ?string &$seller_assigned_id, ?string &$buyer_assigned_id, ?array &$global_id, ?float &$unit_quantity, ?string &$unit_code, ?string &$industry_assigned_id): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $trade_line_item_referenced_product = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getIncludedReferencedProduct', []));
        $trade_line_item_referenced_product = $trade_line_item_referenced_product[$this->position_referenced_product_pointer];
        $name = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getName.value', '');
        $description = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getDescription.value', '');
        $seller_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getSellerAssignedID.value', '');
        $buyer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getBuyerAssignedID.value', '');
        $industry_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getIndustryAssignedID.value', '');
        $unit_quantity = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getUnitQuantity.value', 0);
        $unit_code = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getUnitQuantity.getUnitCode', '');
        $global_id = $this->get_invoice_value_by_path_from($trade_line_item_referenced_product, 'getGlobalID', []);
        $global_id = $this->convert_to_associative_array($global_id, 'getSchemeID', 'value');
        return $this;
    }
    /**
     * Sets the detailed information on the product origin.
     *
     * @param  string|null $country __BT-159, From EN 16931__ The code indicating the country the goods came from. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”.
     */
    public function get_document_position_product_origin_trade_country(?string &$country): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $country = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedTradeProduct.getOriginTradeCountry.getID.value', '');
        return $this;
    }
    /**
     * Get details of a related sales order reference.
     *
     * @param  string|null   $issuerAssignedId __BT-X-537, From EXTENDED__ Document number of a sales order reference
     * @param  string|null   $lineId           __BT-X-538, From EXTENDED__ An identifier for a position within a sales order.
     * @param  DateTime|null $issueDate        __BT-X-539, From EXTENDED__ Date of sales order
     */
    public function get_document_position_seller_order_referenced_document(?string &$issuer_assigned_id, ?string &$line_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getSellerOrderReferencedDocument.getIssuerAssignedID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getSellerOrderReferencedDocument.getLineID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getSellerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getSellerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', null));
        return $this;
    }
    /**
     * Get details of the related buyer order position.
     *
     * @param  string|null   $issuerAssignedId __BT-X-21, From EXTENDED__ An identifier issued by the buyer for a referenced order (order number)
     * @param  string|null   $lineId           __BT-132, From EN 16931__ An identifier for a position within an order placed by the buyer. Note: Reference is made to the order reference at the document level.
     * @param  DateTime|null $issueDate        __BT-X-22, From EXTENDED__ Date of order
     */
    public function get_document_position_buyer_order_referenced_document(?string &$issuer_assigned_id, ?string &$line_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getBuyerOrderReferencedDocument.getIssuerAssignedID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getBuyerOrderReferencedDocument.getLineID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getBuyerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getBuyerOrderReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', null));
        return $this;
    }
    /**
     * Get details of the associated offer position.
     *
     * @param  string|null   $issuerAssignedId __BT-X-310, From EXTENDED__ Offer number
     * @param  string|null   $lineId           __BT-X-311, From EXTENDED__ Position identifier within the offer
     * @param  DateTime|null $issueDate        __BT-X-312, From EXTENDED__ Date of offder
     */
    public function get_document_position_quotation_referenced_document(?string &$issuer_assigned_id, ?string &$line_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getQuotationReferencedDocument.getIssuerAssignedID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getQuotationReferencedDocument.getLineID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getQuotationReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getQuotationReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', null));
        return $this;
    }
    /**
     * Get details of the related contract position.
     *
     * @param  string|null   $issuerAssignedId __BT-X-24, From EXTENDED__ The contract reference should be assigned once in the context of the specific trade relationship and for a defined period of time (contract number)
     * @param  string|null   $lineId           __BT-X-25, From EXTENDED__ Identifier of the according contract position
     * @param  DateTime|null $issueDate        __BT-X-26, From EXTENDED__ Contract date
     */
    public function get_document_position_contract_referenced_document(?string &$issuer_assigned_id, ?string &$line_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getContractReferencedDocument.getIssuerAssignedID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getContractReferencedDocument.getLineID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getContractReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getContractReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', null));
        return $this;
    }
    /**
     * Seek to the first documents position additional referenced document. Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionAdditionalReferencedDocument.
     */
    public function first_document_position_additional_referenced_document(): bool
    {
        $this->position_add_ref_doc_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $add_ref_doc = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getAdditionalReferencedDocument', []));
        return isset($add_ref_doc[$this->position_add_ref_doc_pointer]);
    }
    /**
     * Seek to the next documents position additional referenced document. Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionAdditionalReferencedDocument.
     */
    public function next_document_position_additional_referenced_document(): bool
    {
        $this->position_add_ref_doc_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $add_ref_doc = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getAdditionalReferencedDocument', []));
        return isset($add_ref_doc[$this->position_add_ref_doc_pointer]);
    }
    /**
     * Details of an additional Document reference (on position level).
     *
     * - The documents justifying the invoice can be used to reference a document number, which should be
     *   known to the recipient, as well as an external document (referenced by a URL) or an embedded document (such
     *   as a timesheet as a PDF file). The option of linking to an external document is e.g. required when it comes
     *   to large attachments and / or sensitive information, e.g. for personal services, which must be separated
     *   from the bill
     * - Use ZugferdDocumentReader::firstDocumentAdditionalReferencedDocument and
     *   ZugferdDocumentReader::nextDocumentAdditionalReferencedDocument to seek between multiple additional referenced
     *   documents
     *
     * @param  string|null   $issuerAssignedId   __BT-X-27, From EXTENDED__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param  string|null   $typeCode           __BT-X-30, From EXTENDED__ Type of referenced document (See codelist UNTDID 1001)
     * @param  string|null   $uriId              __BT-X-28, From EXTENDED__ The Uniform Resource Locator (URL) at which the external document is available. A means of finding the resource including the primary access method intended for it, e.g. http: // or ftp: //. The location of the external document must be used if the buyer needs additional information to support the amounts billed. External documents are not part of the invoice. Access to external documents can involve certain risks.
     * @param  string|null   $lineId             __BT-X-29, From EXTENDED__ The referenced position identifier in the additional document
     * @param  array|null    $name               __BT-X-299, From EXTENDED__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     * @param  string|null   $refTypeCode        __BT-X-32, From EXTENDED__ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     * @param  DateTime|null $issueDate          __BT-X-33, From EXTENDED__ Document date
     * @param  string|null   $binaryDataFilename __BT-X-31, From EXTENDED__ Contains a file name of an attachment document embedded as a binary object
     */
    public function get_document_position_additional_referenced_document(?string &$issuer_assigned_id, ?string &$type_code, ?string &$uri_id, ?string &$line_id, ?array &$name, ?string &$ref_type_code, ?DateTime &$issue_date, ?string &$binary_data_filename): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $add_ref_doc = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getAdditionalReferencedDocument', []));
        $add_ref_doc = $add_ref_doc[$this->position_add_ref_doc_pointer];
        $type_code = $this->get_invoice_value_by_path_from($add_ref_doc, 'getTypeCode.value', '');
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($add_ref_doc, 'getIssuerAssignedID.value', '');
        $ref_type_code = $this->get_invoice_value_by_path_from($add_ref_doc, 'getReferenceTypeCode.value', '');
        $uri_id = $this->get_invoice_value_by_path_from($add_ref_doc, 'getURIID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($add_ref_doc, 'getLineID.value', '');
        $name = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($add_ref_doc, 'getName.value', null));
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($add_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path_from($add_ref_doc, 'getFormattedIssueDateTime.getDateTimeString.getFormat', null));
        $binary_data_filename = $this->get_invoice_value_by_path_from($add_ref_doc, 'getAttachmentBinaryObject.getFilename', '');
        $binarydata = $this->get_invoice_value_by_path_from($add_ref_doc, 'getAttachmentBinaryObject.value', '');
        if (String_Utils::string_is_null_or_empty($binary_data_filename) === false && String_Utils::string_is_null_or_empty($binarydata) === false && String_Utils::string_is_null_or_empty($this->binarydatadirectory) === false) {
            $binary_data_filename = Path_Utils::combine_path_with_file($this->binarydatadirectory, $binary_data_filename);
            File_Utils::base64to_file($binarydata, $binary_data_filename);
        } else {
            $binary_data_filename = '';
        }
        return $this;
    }
    //TODO: DocumentPositionUltimateCustomerOrderReferencedDocument
    /**
     * Get the unit price excluding sales tax before deduction of the discount on the item price.
     *
     * @param  float       $amount                __BT-148, From BASIC__ The unit price excluding sales tax before deduction of the discount on the item price. If the price is shown according to the net calculation, the price must also be shown according to the gross calculation.
     * @param  float|null  $basisQuantity         __BT-149-1, From BASIC__ The number of item units for which the price applies (price base quantity)
     * @param  string|null $basisQuantityUnitCode __BT-150-1, From BASIC__ The unit code of the number of item units for which the price applies (price base quantity)
     */
    public function get_document_position_gross_price(?float &$amount, ?float &$basis_quantity, ?string &$basis_quantity_unit_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getGrossPriceProductTradePrice.getChargeAmount.value', 0.0);
        $basis_quantity = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getGrossPriceProductTradePrice.getBasisQuantity.value', 0.0);
        $basis_quantity_unit_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getGrossPriceProductTradePrice.getBasisQuantity.getUnitCode', '');
        return $this;
    }
    /**
     * Seek to the first documents position gross price allowance charge position. Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionGrossPriceAllowanceCharge.
     */
    public function first_document_position_gross_price_allowance_charge(): bool
    {
        $this->position_gross_price_allowance_charge_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $allowance_charge = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getGrossPriceProductTradePrice.getAppliedTradeAllowanceCharge', []));
        return isset($allowance_charge[$this->position_gross_price_allowance_charge_pointer]);
    }
    /**
     * Seek to the next documents position gross price allowance charge position. Returns true if a other position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionGrossPriceAllowanceCharge.
     */
    public function next_document_position_gross_price_allowance_charge(): bool
    {
        $this->position_gross_price_allowance_charge_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $allowance_charge = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getGrossPriceProductTradePrice.getAppliedTradeAllowanceCharge', []));
        return isset($allowance_charge[$this->position_gross_price_allowance_charge_pointer]);
    }
    /**
     * Get Detailed information on surcharges and discounts on item gross price.
     *
     * @param  float       $actualAmount          __BT-147, From BASIC__ Discount on the item price. The total discount subtracted from the gross price to calculate the net price. Note: Only applies if the discount is given per unit and is not included in the gross price.
     * @param  boolean     $isCharge              __BT-147-02, From BASIC__ Switch for surcharge/discount, if true then its an charge
     * @param  float|null  $calculationPercent    __BT-X-34, From EXTENDED__Discount/surcharge in percent. Up to level EN16931, only the final result of the discount (ActualAmount) is transferred
     * @param  float|null  $basisAmount           __BT-X-35, From EXTENDED__ Base amount of the discount/surcharge
     * @param  string|null $reason                __BT-X-36, From EXTENDED__ Reason for surcharge/discount (free text)
     * @param  string|null $taxTypeCode           __BT-, From BASIC__
     * @param  string|null $taxCategoryCode       __BT-, From BASIC__
     * @param  float|null  $rateApplicablePercent __BT-, From BASIC__
     * @param  float|null  $sequence              __BT-, From BASIC__
     * @param  float|null  $basisQuantity         __BT-, From BASIC__
     * @param  string|null $basisQuantityUnitCode __BT-, From BASIC__
     * @param  string|null $reasonCode            __BT-X-313, From EXTENDED__ Reason code for surcharge/discount
     */
    public function get_document_position_gross_price_allowance_charge(?float &$actual_amount, ?bool &$is_charge, ?float &$calculation_percent, ?float &$basis_amount, ?string &$reason, ?string &$tax_type_code, ?string &$tax_category_code, ?float &$rate_applicable_percent, ?float &$sequence, ?float &$basis_quantity, ?string &$basis_quantity_unit_code, ?string &$reason_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $allowance_charge = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getGrossPriceProductTradePrice.getAppliedTradeAllowanceCharge', []));
        $allowance_charge = $allowance_charge[$this->position_gross_price_allowance_charge_pointer];
        $actual_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getActualAmount.value', 0.0);
        $is_charge = $this->get_invoice_value_by_path_from($allowance_charge, 'getChargeIndicator.getIndicator', false);
        $calculation_percent = $this->get_invoice_value_by_path_from($allowance_charge, 'getCalculationPercent.value', 0.0);
        $basis_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisAmount.value', 0.0);
        $reason = $this->get_invoice_value_by_path_from($allowance_charge, 'getReason.value', '');
        $tax_type_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getTypeCode.value', '');
        $tax_category_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getCategoryCode.value', '');
        $rate_applicable_percent = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getRateApplicablePercent.value', 0.0);
        $sequence = $this->get_invoice_value_by_path_from($allowance_charge, 'getSequenceNumeric.value', 0.0);
        $basis_quantity = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisQuantity.value', 0.0);
        $basis_quantity_unit_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisQuantity.getUnitCode', '');
        $reason_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getReasonCode.value', '');
        return $this;
    }
    /**
     * Get detailed information on the net price of the item.
     *
     * @param  float       $amount                __BT-146, From BASIC__ Net price of the item
     * @param  float|null  $basisQuantity         __BT-149, From BASIC__ Base quantity at the item price
     * @param  string|null $basisQuantityUnitCode __BT-150, From BASIC__ Code of the unit of measurement of the base quantity at the item price
     */
    public function get_document_position_net_price(?float &$amount, ?float &$basis_quantity, ?string &$basis_quantity_unit_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getChargeAmount.value', 0.0);
        $basis_quantity = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getBasisQuantity.value', 0.0);
        $basis_quantity_unit_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getBasisQuantity.getUnitCode', '');
        return $this;
    }
    /**
     * Tax included for B2C on position level.
     *
     * @param  string|null $categoryCode          __BT-, From __ Coded description of a sales tax category
     * @param  string|null $typeCode              __BT-, From __ Coded description of a sales tax category. Note: Fixed value = "VAT"
     * @param  float|null  $rateApplicablePercent __BT-, From __ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param  float|null  $calculatedAmount      __BT-, From __ The total amount to be paid for the relevant VAT category. Note: Calculated by multiplying the amount to be taxed according to the sales tax category by the sales tax rate applicable for the sales tax category concerned
     * @param  string|null $exemptionReason       __BT-, From __ Reason for tax exemption (free text)
     * @param  string|null $exemptionReasonCode   __BT-, From __ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility.
     */
    public function get_document_position_net_price_tax(?string &$category_code, ?string &$type_code, ?float &$rate_applicable_percent, ?float &$calculated_amount, ?string &$exemption_reason, ?string &$exemption_reason_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $category_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getIncludedTradeTax.getCategoryCode.value', '');
        $type_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getIncludedTradeTax.getTypeCode.value', '');
        $rate_applicable_percent = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getIncludedTradeTax.getRateApplicablePercent.value', 0.0);
        $calculated_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getIncludedTradeTax.getCalculatedAmount.value', 0.0);
        $exemption_reason = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getIncludedTradeTax.getExemptionReason.value', '');
        $exemption_reason_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeAgreement.getNetPriceProductTradePrice.getIncludedTradeTax.getExemptionReasonCode.value', '');
        return $this;
    }
    /**
     * Get the position Quantity.
     *
     * @param  float|null  $billedQuantity             __BT-129, From BASIC__ The quantity of individual items (goods or services) billed in the relevant line
     * @param  string|null $billedQuantityUnitCode     __BT-130, From BASIC__ The unit of measure applicable to the amount billed
     * @param  float|null  $chargeFreeQuantity         __BT-X-46, From EXTENDED__ Quantity, free of charge
     * @param  string|null $chargeFreeQuantityUnitCpde __BT-X-46-0, From EXTENDED__ Unit of measure code for the quantity free of charge
     * @param  float|null  $packageQuantity            __BT-X-47, From EXTENDED__ Number of packages
     * @param  string|null $packageQuantityUnitCode    __BT-X-47-0, From EXTENDED__ Unit of measure code for number of packages
     */
    public function get_document_position_quantity(?float &$billed_quantity, ?string &$billed_quantity_unit_code, ?float &$charge_free_quantity, ?string &$charge_free_quantity_unit_cpde, ?float &$package_quantity, ?string &$package_quantity_unit_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $billed_quantity = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getBilledQuantity.value', 0.0);
        $billed_quantity_unit_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getBilledQuantity.getUnitCode', '');
        $charge_free_quantity = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getChargeFreeQuantity.value', 0.0);
        $charge_free_quantity_unit_cpde = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getChargeFreeQuantity.getUnitCode', '');
        $package_quantity = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getPackageQuantity.value', 0.0);
        $package_quantity_unit_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getPackageQuantity.getUnitCode', '');
        return $this;
    }
    //TODO: GetDocumentPositionShipTo
    //TODO: GetDocumentPositionUltimateShipTo
    /**
     * Get detailed information on the actual delivery (on position level).
     *
     * @param  DateTime|null $date __BT-X-85, From EXTENDED__ Actual delivery date
     */
    public function get_document_position_supply_chain_event(?DateTime &$date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getActualDeliverySupplyChainEvent.getOccurrenceDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getActualDeliverySupplyChainEvent.getOccurrenceDateTime,getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Get detailed information on the associated shipping notification (on position level).
     *
     * @param  string|null   $issuerAssignedId __BT-X-86, From EXTENDED__ Shipping notification number
     * @param  string|null   $lineId           __BT-X-87, From EXTENDED__ Shipping notification position
     * @param  DateTime|null $issueDate        __BT-X-88, From EXTENDED__ Date of Shipping notification number
     */
    public function get_document_position_despatch_advice_referenced_document(?string &$issuer_assigned_id, ?string &$line_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getDespatchAdviceReferencedDocument.getIssuerAssignedID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getDespatchAdviceReferencedDocument.getLineID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSpecifiedLineTradeDelivery.getDespatchAdviceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSpecifiedLineTradeDelivery.getDespatchAdviceReferencedDocument.getFormattedIssueDateTime,getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Detailed information on the associated shipping notification (on position level).
     *
     * @param  string|null   $issuerAssignedId __BT-X-89, From EXTENDED__ Goods receipt number
     * @param  string|null   $lineId           __BT-X-90, From EXTENDED__ Goods receipt position
     * @param  DateTime|null $issueDate        __BT-X-91, From EXTENDED__ Date of Goods receipt
     */
    public function get_document_position_receiving_advice_referenced_document(?string &$issuer_assigned_id, ?string &$line_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getReceivingAdviceReferencedDocument.getIssuerAssignedID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getReceivingAdviceReferencedDocument.getLineID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSpecifiedLineTradeDelivery.getReceivingAdviceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSpecifiedLineTradeDelivery.getReceivingAdviceReferencedDocument.getFormattedIssueDateTime,getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Detailed information on the associated delivery note on position level.
     *
     * @param  string|null   $issuerAssignedId __BT-X-92, From EXTENDED__ Delivery note number
     * @param  string|null   $lineId           __BT-X-93, From EXTENDED__ Delivery note position
     * @param  DateTime|null $issueDate        __BT-X-94, From EXTENDED__ Date of Delivery note
     */
    public function get_document_position_delivery_note_referenced_document(?string &$issuer_assigned_id, ?string &$line_id, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getDeliveryNoteReferencedDocument.getIssuerAssignedID.value', '');
        $line_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeDelivery.getDeliveryNoteReferencedDocument.getLineID.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path('getSpecifiedLineTradeDelivery.getDeliveryNoteReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path('getSpecifiedLineTradeDelivery.getDeliveryNoteReferencedDocument.getFormattedIssueDateTime,getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Seek to the first document position tax. Returns true if the first tax position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionTax.
     */
    public function first_document_position_tax(): bool
    {
        $this->position_tax_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $taxes = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getApplicableTradeTax', []));
        return isset($taxes[$this->position_tax_pointer]);
    }
    /**
     * Seek to the next document position tax. Returns true if another tax position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionTax.
     */
    public function next_document_position_tax(): bool
    {
        $this->position_tax_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $taxes = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getApplicableTradeTax', []));
        return isset($taxes[$this->position_tax_pointer]);
    }
    /**
     * Get information about the sales tax that applies to the goods and services invoiced in the relevant invoice line.
     *
     * @param  string|null $categoryCode          __BT-151, From BASIC__ Coded description of a sales tax category
     * @param  string|null $typeCode              __BT-151-0, From BASIC__ In EN 16931 only the tax type “sales tax” with the code “VAT” is supported. Should other types of tax be specified, such as an insurance tax or a mineral oil tax the EXTENDED profile must be used. The code for the tax type must then be taken from the code list UNTDID 5153.
     * @param  float|null  $rateApplicablePercent __BT-152, From BASIC__ The VAT rate applicable to the item invoiced and expressed as a percentage. Note: The code of the sales tax category and the category-specific sales tax rate  must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param  float|null  $calculatedAmount      __BT-, From __ Tax amount. Information only for taxes that are not VAT (Obsolete)
     * @param  string|null $exemptionReason       __BT-, From __ Reason for tax exemption (free text) (Obsolete)
     * @param  string|null $exemptionReasonCode   __BT-, From __ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility. (Obsolete)
     */
    public function get_document_position_tax(?string &$category_code, ?string &$type_code, ?float &$rate_applicable_percent, ?float &$calculated_amount, ?string &$exemption_reason, ?string &$exemption_reason_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $taxes = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getApplicableTradeTax', []));
        $taxes = $taxes[$this->position_tax_pointer];
        $category_code = $this->get_invoice_value_by_path_from($taxes, 'getCategoryCode.value', '');
        $type_code = $this->get_invoice_value_by_path_from($taxes, 'getTypeCode.value', '');
        $rate_applicable_percent = $this->get_invoice_value_by_path_from($taxes, 'getRateApplicablePercent.value', 0.0);
        $calculated_amount = $this->get_invoice_value_by_path_from($taxes, 'getCalculatedAmount.value', 0.0);
        $exemption_reason = $this->get_invoice_value_by_path_from($taxes, 'getExemptionReason.value', '');
        $exemption_reason_code = $this->get_invoice_value_by_path_from($taxes, 'getExemptionReasonCode.value', '');
        return $this;
    }
    /**
     * Get information about the period relevant for the invoice item. Also known as the invoice line delivery period.
     *
     * @param  DateTime|null $startDate __BT-134, From BASIC__ Start of the billing period
     * @param  DateTime|null $endDate   __BT-135, From BASIC__ End of the billing period
     */
    public function get_document_position_billing_period(?DateTime &$start_date, ?DateTime &$end_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $start_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getBillingSpecifiedPeriod.getStartDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getBillingSpecifiedPeriod.getStartDateTime.getDateTimeString.getFormat', null));
        $end_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getBillingSpecifiedPeriod.getEndDateTime.getDateTimeString.value', null), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getBillingSpecifiedPeriod.getEndDateTime.getDateTimeString.getFormat', null));
        return $this;
    }
    /**
     * Seek to the first allowance charge (on position level). Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionAllowanceCharge.
     */
    public function first_document_position_allowance_charge(): bool
    {
        $this->position_allowance_charge_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $allowance_charge = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeAllowanceCharge', []));
        return isset($allowance_charge[$this->position_allowance_charge_pointer]);
    }
    /**
     * Seek to the next allowance charge (on position level). Returns true if another position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionAllowanceCharge.
     */
    public function next_document_position_allowance_charge(): bool
    {
        $this->position_allowance_charge_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $allowance_charge = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeAllowanceCharge', []));
        return isset($allowance_charge[$this->position_allowance_charge_pointer]);
    }
    /**
     * Detailed information on currentley seeked surcharges and discounts on position level.
     *
     * @param  float|null   $actualAmount          __BT-136/BT-141, From BASIC__ The surcharge/discount amount excluding sales tax
     * @param  boolean|null $isCharge              __BT-27-1/BT-28-1, From BASIC__ (true for BT-/ and false for /BT-) Switch that indicates whether the following data refer to an allowance or a discount, true means that it is a surcharge
     * @param  float|null   $calculationPercent    __BT-138, From BASIC__ The percentage that may be used in conjunction with the base invoice line discount amount to calculate the invoice line discount amount
     * @param  float|null   $basisAmount           __BT-137, From EN 16931__ The base amount that may be used in conjunction with the invoice line discount percentage to calculate the invoice line discount amount
     * @param  string|null  $reason                __BT-139/BT-144, From BASIC__ The reason given in text form for the invoice item discount/surcharge
     * @param  string|null  $reasonCode            __BT-140/BT-145, From BASIC__ The reason given as a code for the invoice line discount
     */
    public function get_document_position_allowance_charge(?float &$actual_amount, ?bool &$is_charge, ?float &$calculation_percent, ?float &$basis_amount, ?string &$reason, ?string &$tax_type_code, ?string &$tax_category_code, ?float &$rate_applicable_percent, ?float &$sequence, ?float &$basis_quantity, ?string &$basis_quantity_unit_code, ?string &$reason_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $allowance_charge = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeAllowanceCharge', []));
        $allowance_charge = $allowance_charge[$this->position_allowance_charge_pointer];
        $actual_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getActualAmount.value', 0.0);
        $is_charge = $this->get_invoice_value_by_path_from($allowance_charge, 'getChargeIndicator.getIndicator', false);
        $calculation_percent = $this->get_invoice_value_by_path_from($allowance_charge, 'getCalculationPercent.value', 0.0);
        $basis_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisAmount.value', 0.0);
        $reason = $this->get_invoice_value_by_path_from($allowance_charge, 'getReason.value', '');
        $tax_type_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getTypeCode.value', '');
        $tax_category_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getCategoryCode.value', '');
        $rate_applicable_percent = $this->get_invoice_value_by_path_from($allowance_charge, 'getCategoryTradeTax.getRateApplicablePercent.value', 0.0);
        $sequence = $this->get_invoice_value_by_path_from($allowance_charge, 'getSequenceNumeric.value', 0.0);
        $basis_quantity = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisQuantity.value', 0.0);
        $basis_quantity_unit_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisQuantity.getUnitCode', '');
        $reason_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getReasonCode.value', '');
        return $this;
    }
    /**
     * Detailed information on surcharges and discounts on position level (on a simple way).
     * This is the simplified version of ZugferdDocumentReader::getDocumentPositionAllowanceCharge.
     *
     * @param  float|null   $actualAmount       __BT-136/BT-141, From BASIC__ The surcharge/discount amount excluding sales tax
     * @param  boolean|null $isCharge           __BT-27-1/BT-28-1, From BASIC__ (true for BT-/ and false for /BT-) Switch that indicates whether the following data refer to an allowance or a discount, true means that it is a surcharge
     * @param  float|null   $calculationPercent __BT-138, From BASIC__ The percentage that may be used in conjunction with the base invoice line discount amount to calculate the invoice line discount amount
     * @param  float|null   $basisAmount        __BT-137, From EN 16931__ The base amount that may be used in conjunction with the invoice line discount percentage to calculate the invoice line discount amount
     * @param  string|null  $reasonCode         __BT-140/BT-145, From BASIC__ The reason given as a code for the invoice line discount
     * @param  string|null  $reason             __BT-139/BT-144, From BASIC__ The reason given in text form for the invoice item discount/surcharge
     */
    public function get_document_position_allowance_charge2(?float &$actual_amount, ?bool &$is_charge, ?float &$calculation_percent, ?float &$basis_amount, ?string &$reason_code, ?string &$reason): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $allowance_charge = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeAllowanceCharge', []));
        $allowance_charge = $allowance_charge[$this->position_allowance_charge_pointer];
        $actual_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getActualAmount.value', 0.0);
        $is_charge = $this->get_invoice_value_by_path_from($allowance_charge, 'getChargeIndicator.getIndicator', false);
        $calculation_percent = $this->get_invoice_value_by_path_from($allowance_charge, 'getCalculationPercent.value', 0.0);
        $basis_amount = $this->get_invoice_value_by_path_from($allowance_charge, 'getBasisAmount.value', 0.0);
        $reason = $this->get_invoice_value_by_path_from($allowance_charge, 'getReason.value', '');
        $reason_code = $this->get_invoice_value_by_path_from($allowance_charge, 'getReasonCode.value', '');
        return $this;
    }
    /**
     * Get detailed information on item totals.
     *
     * @param      float|null $lineTotalAmount            __BT-131, From BASIC__ The total amount of the invoice item.
     * @param      float|null $totalAllowanceChargeAmount __BT-, From __ Total amount of item surcharges and discounts
     * @deprecated 1.0.88
     */
    public function get_document_position_line_summation(?float &$line_total_amount, ?float &$total_allowance_charge_amount): Zugferd_Document_Reader
    {
        $total_allowance_charge_amount = 0.0;
        $this->get_document_position_line_summation_simple($line_total_amount);
        return $this;
    }
    /**
     * Get detailed information on item totals.
     *
     * @param  float $lineTotalAmount __BT-131, From BASIC__ The total amount of the invoice item.
     */
    public function get_document_position_line_summation_simple(?float &$line_total_amount): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $line_total_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeSettlementLineMonetarySummation.getLineTotalAmount.value', 0.0);
        return $this;
    }
    /**
     * Get detailed information on item totals (with support for EXTENDED profile).
     *
     * @param  float $lineTotalAmount            __BT-131, From BASIC__ The total amount of the invoice item
     * @param  float $chargeTotalAmount          __BT-X-327, From EXTENDED__ Total amount of item surcharges
     * @param  float $allowanceTotalAmount       __BT-X-328, From EXTENDED__ Total amount of item discounts
     * @param  float $taxTotalAmount             __BT-X-329, From EXTENDED__ Total amount of item taxes
     * @param  float $grandTotalAmount           __BT-X-330, From EXTENDED__ Total gross amount of the item
     * @param  float $totalAllowanceChargeAmount __BT-X-98, From EXTENDED__ Total amount of item surcharges and discounts
     */
    public function get_document_position_line_summation_ext(?float &$line_total_amount, ?float &$charge_total_amount, ?float &$allowance_total_amount, ?float &$tax_total_amount, ?float &$grand_total_amount, ?float &$total_allowance_charge_amount): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $line_total_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeSettlementLineMonetarySummation.getLineTotalAmount.value', 0.0);
        $charge_total_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeSettlementLineMonetarySummation.getChargeTotalAmount.value', 0.0);
        $allowance_total_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeSettlementLineMonetarySummation.getAllowanceTotalAmount.value', 0.0);
        $tax_total_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeSettlementLineMonetarySummation.getTaxTotalAmount.value', 0.0);
        $grand_total_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeSettlementLineMonetarySummation.getGrandTotalAmount.value', 0.0);
        $total_allowance_charge_amount = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getSpecifiedTradeSettlementLineMonetarySummation.getTotalAllowanceChargeAmount.value', 0.0);
        return $this;
    }
    /**
     * Get a Reference to the previous invoice (on position level).
     *
     * @param  string|null   $issuerAssignedId __BT-X-331, From EXTENDED__ The identification of an invoice previously sent by the seller
     * @param  string|null   $lineid           __BT-X-540, From EXTENDED__ Identification of the invoice item
     * @param  string|null   $typeCode         __BT-X-332, From EXTENDED__ Type of previous invoice (code)
     * @param  DateTime|null $issueDate        __BT-X-333, From EXTENDED__ Date of the previous invoice
     */
    public function get_document_position_invoice_referenced_document(?string &$issuer_assigned_id, ?string &$lineid, ?string &$type_code, ?DateTime &$issue_date): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getInvoiceReferencedDocument.getIssuerAssignedID.value', '');
        $lineid = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getInvoiceReferencedDocument.getLineID.value', '');
        $type_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getInvoiceReferencedDocument.getTypeCode.value', '');
        $issue_date = $this->get_object_helper()->to_date_time($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getInvoiceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.value', ''), $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getInvoiceReferencedDocument.getFormattedIssueDateTime.getDateTimeString.getFormat', ''));
        return $this;
    }
    /**
     * Seek to the first documents position additional referenced document (Object detection at the level of the accounting position). Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionAdditionalReferencedObjDocument.
     */
    public function first_document_position_additional_referenced_obj_document(): bool
    {
        $this->position_add_ref_obj_doc_pointer = 0;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $add_ref_doc = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getAdditionalReferencedDocument', []));
        return isset($add_ref_doc[$this->position_add_ref_obj_doc_pointer]);
    }
    /**
     * Seek to the next documents position additional referenced document (Object detection at the level of the accounting position). Returns true if the first position is available, otherwise false.
     * You may use it together with ZugferdDocumentReader::getDocumentPositionAdditionalReferencedObjDocument.
     */
    public function next_document_position_additional_referenced_obj_document(): bool
    {
        $this->position_add_ref_obj_doc_pointer++;
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $add_ref_doc = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getAdditionalReferencedDocument', []));
        return isset($add_ref_doc[$this->position_add_ref_obj_doc_pointer]);
    }
    /**
     * Get additional Document reference on a position (Object detection).
     *
     * @param  string|null $issuerAssignedId __BT-128, From EN 16931__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param  string|null $typeCode         __BT-128-0, From EN 16931__ Type of referenced document (See codelist UNTDID 1001)
     * @param  string|null $refTypeCode      __BT-128-1, From EN 16931__ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     */
    public function get_document_position_additional_referenced_obj_document(?string &$issuer_assigned_id, ?string &$type_code, ?string &$ref_type_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $add_ref_doc = $this->get_object_helper()->ensure_array($this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getAdditionalReferencedDocument', []));
        $add_ref_doc = $add_ref_doc[$this->position_add_ref_obj_doc_pointer];
        $type_code = $this->get_invoice_value_by_path_from($add_ref_doc, 'getTypeCode.value', '');
        $issuer_assigned_id = $this->get_invoice_value_by_path_from($add_ref_doc, 'getIssuerAssignedID.value', '');
        $ref_type_code = $this->get_invoice_value_by_path_from($add_ref_doc, 'getReferenceTypeCode.value', '');
        return $this;
    }
    /**
     * Get information on the booking reference (on position level).
     *
     * @param  null|string &$id       __BT-133, From EN 16931__ Posting reference of the byuer. If required, this reference shall be provided by the Buyer to the Seller prior to the issuing of the Invoice.
     * @param  null|string &$typeCode __BT-X-99, From EXTENDED__ Type of the posting reference
     */
    public function get_document_position_receivable_specified_trade_accounting_account(?string &$id, ?string &$type_code): Zugferd_Document_Reader
    {
        $trade_line_item = $this->get_invoice_value_by_path('getSupplyChainTradeTransaction.getIncludedSupplyChainTradeLineItem', []);
        $trade_line_item = $trade_line_item[$this->position_pointer];
        $id = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getReceivableSpecifiedTradeAccountingAccount.getId.value', '');
        $type_code = $this->get_invoice_value_by_path_from($trade_line_item, 'getSpecifiedLineTradeSettlement.getReceivableSpecifiedTradeAccountingAccount.getTypeCode.value', '');
        return $this;
    }
    /**
     * Function to return a value from $invoiceObject by path
     *
     * @param  mixed  $defaultValue
     * @return mixed
     */
    private function get_invoice_value_by_path(string $methods, $default_value)
    {
        return $this->get_invoice_value_by_path_from($this->get_invoice_object(), $methods, $default_value);
    }
    /**
     * Function to return a value from $from by path
     *
     * @param  mixed       $defaultValue
     * @return mixed
     */
    private function get_invoice_value_by_path_from(?object $from, string $methods, $default_value)
    {
        return $this->get_object_helper()->try_call_by_path_and_return($from, $methods) ?? $default_value;
    }
    /**
     * Convert to array
     *
     * @param  mixed $value
     */
    private function convert_to_array($value, array $methods): array
    {
        $result = [];
        $is_flat = count($methods) == 1;
        $value = $this->get_object_helper()->ensure_array($value);
        foreach ($value as $value_item) {
            $result_item = [];
            foreach ($methods as $method_key => $method) {
                if (is_array($method)) {
                    $default_value = $method[1];
                    $method = $method[0];
                } else {
                    $default_value = null;
                }
                if ($method instanceof Closure) {
                    $item_value = $method($value_item);
                } else {
                    $item_value = $this->get_object_helper()->try_call_by_path_and_return($value_item, $method) ?? $default_value;
                }
                if ($is_flat) {
                    $result[] = $item_value;
                } else {
                    $result_item[$method_key] = $item_value;
                }
            }
            if (!$is_flat) {
                $result[] = $result_item;
            }
        }
        return $result;
    }
    /**
     * Convert to associative array
     *
     * @param  mixed  $value
     */
    private function convert_to_associative_array($value, string $method_key, string $method_value): array
    {
        $result = [];
        $value = $this->get_object_helper()->ensure_array($value);
        foreach ($value as $value_item) {
            $the_value_for_key = $this->get_object_helper()->try_call_by_path_and_return($value_item, $method_key);
            $the_value_for_value = $this->get_object_helper()->try_call_by_path_and_return($value_item, $method_value);
            if (!Zugferd_Object_Helper::is_null_or_empty($the_value_for_key) && !Zugferd_Object_Helper::is_null_or_empty($the_value_for_value)) {
                $result[$the_value_for_key] = $the_value_for_value;
            }
        }
        return $result;
    }
}