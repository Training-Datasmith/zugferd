<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use DateTimeInterface;
use Dom_Document;
use Domx_Path;
use horstoeko\zugferd\codelists\Zugferd_Document_Type;
use horstoeko\zugferd\codelists\Zugferd_Payment_Means;
use horstoeko\zugferd\codelists\Zugferd_Reference_Code_Qualifiers;
use horstoeko\zugferd\exception\Zugferd_Unsupported_Mimetype;
/**
 * Class representing the document builder for outgoing documents
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Builder extends Zugferd_Document
{
    /**
     * HeaderTradeAgreement
     *
     * @var object
     */
    protected $header_trade_agreement;
    /**
     * HeaderTradeDelivery
     *
     * @var object
     */
    protected $header_trade_delivery;
    /**
     * HeaderTradeSettlement
     *
     * @var object
     */
    protected $header_trade_settlement;
    /**
     * SupplyChainTradeTransactionType
     *
     * @var object
     */
    protected $header_supply_chain_trade_transaction;
    /**
     * Last added payment terms
     *
     * @var object
     */
    protected $current_payment_terms;
    /**
     * Last added position (line) to the docuemnt
     *
     * @var object
     */
    protected $current_position;
    /**
     * Receive the content as XML string
     *
     * @see    https://www.php.net/manual/en/language.oop5.magic.php#object.tostring
     */
    public function __toString(): string
    {
        return $this->get_content();
    }
    /**
     * Creates a new ZugferdDocumentBuilder with profile $profile
     */
    public static function create_new(int $profile_id): Zugferd_Document_Builder
    {
        return (new static($profile_id))->init_new_document();
    }
    /**
     * Initialized a new document with profile settings
     */
    public function init_new_document(): Zugferd_Document_Builder
    {
        $this->create_invoice_object();
        $this->header_trade_agreement = $this->get_invoice_object()->get_supply_chain_trade_transaction()->get_applicable_header_trade_agreement();
        $this->header_trade_delivery = $this->get_invoice_object()->get_supply_chain_trade_transaction()->get_applicable_header_trade_delivery();
        $this->header_trade_settlement = $this->get_invoice_object()->get_supply_chain_trade_transaction()->get_applicable_header_trade_settlement();
        $this->header_supply_chain_trade_transaction = $this->get_invoice_object()->get_supply_chain_trade_transaction();
        return $this;
    }
    /**
     * This method can be overridden in derived class
     * It is called before a XML is written
     *
     * @return void
     */
    protected function on_before_get_content()
    {
        // Do nothing
    }
    /**
     * Write the content of a CrossIndustryInvoice object to a string
     */
    public function get_content(): string
    {
        $this->on_before_get_content();
        return $this->serialize_as_xml();
    }
    /**
     * Write the content of a invoice object to a DOMDocument instance
     */
    public function get_content_as_dom_document(): Dom_Document
    {
        $dom_document = new Dom_Document();
        $dom_document->load_xml($this->get_content());
        return $dom_document;
    }
    /**
     * Write the content of a invoice object to a DOMXpath instance
     *
     * @return DOMXpath
     */
    public function get_content_as_dom_x_path(): Dom_Xpath
    {
        return new Domx_Path($this->get_content_as_dom_document());
    }
    /**
     * Write the content of a CrossIndustryInvoice object to a file
     */
    public function write_file(string $xmlfilename): Zugferd_Document
    {
        file_put_contents($xmlfilename, $this->get_content());
        return $this;
    }
    /**
     * Set main information about this document.
     *
     * @param  string                 $documentNo               __BT-1, From MINIMUM__ The document no issued by the seller
     * @param  string                 $documentTypeCode         __BT-3, From MINIMUM__ The type of the document, See \horstoeko\codelists\ZugferdInvoiceType for details
     * @param  DateTimeInterface      $documentDate             __BT-2, From MINIMUM__ Date of invoice. The date when the document was issued by the seller
     * @param  string                 $invoiceCurrency          __BT-5, From MINIMUM__ Code for the invoice currency
     * @param  string|null            $documentName             __BT-X-2, From EXTENDED__ Document Type. The documenttype (free text)
     * @param  string|null            $documentLanguage         __BT-X-4, From EXTENDED__ Language indicator. The language code in which the document was written
     * @param  DateTimeInterface|null $effectiveSpecifiedPeriod __BT-X-6-000, From EXTENDED__ The contractual due date of the invoice
     */
    public function set_document_information(string $document_no, string $document_type_code, DateTimeInterface $document_date, string $invoice_currency, ?string $document_name = null, ?string $document_language = null, ?DateTimeInterface $effective_specified_period = null): Zugferd_Document_Builder
    {
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'setID', $this->get_object_helper()->get_id_type($document_no));
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'setName', $this->get_object_helper()->get_text_type($document_name));
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'setTypeCode', $this->get_object_helper()->get_document_code_type($document_type_code));
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'setIssueDateTime', $this->get_object_helper()->get_date_time_type($document_date));
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'addToLanguageID', $this->get_object_helper()->get_id_type($document_language));
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'setEffectiveSpecifiedPeriod', $this->get_object_helper()->get_specified_period_type(null, null, $effective_specified_period));
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setInvoiceCurrencyCode', $this->get_object_helper()->get_id_type($invoice_currency));
        return $this;
    }
    /**
     * Set general payment information.
     *
     * @param  string|null $creditorReferenceID __BT-90, From BASIC WL__ Identifier of the creditor
     * @param  string|null $paymentReference    __BT-83, From BASIC WL__ Intended use for payment
     */
    public function set_document_general_payment_information(?string $creditor_reference_id = null, ?string $payment_reference = null): Zugferd_Document_Builder
    {
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setCreditorReferenceID', $this->get_object_helper()->get_id_type($creditor_reference_id));
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setPaymentReference', $this->get_object_helper()->get_id_type($payment_reference));
        return $this;
    }
    /**
     * An identifier assigned by the buyer and used for internal routing.
     *
     * __Note__: The reference is specified by the buyer (e.g. contact details, department, office ID, project code),
     * but stated by the seller on the invoice.
     *
     * __Note__: The route ID must be specified in the Buyer Reference (BT-10) in the XRechnung. According to the XRechnung
     * standard, two syntaxes are permitted for displaying electronic invoices: Universal Business Language (UBL) and UN/CEFACT
     * Cross Industry Invoice (CII).
     *
     * @param  string $buyerReference __BT-10, From MINIMUM__ An identifier assigned by the buyer and used for internal routing
     */
    public function set_document_buyer_reference(?string $buyer_reference): Zugferd_Document_Builder
    {
        $reference = $this->get_object_helper()->get_text_type($buyer_reference);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setBuyerReference', $reference);
        return $this;
    }
    /**
     * Set the routing-id (needed for German XRechnung).
     *
     * This is an alias-method for setDocumentBuyerReference
     *
     * __Note__: The route ID must be specified in the Buyer Reference (BT-10) in the XRechnung.
     *
     * @param  string $routingId __BT-10, From MINIMUM__ An identifier assigned by the buyer and used for internal routing
     */
    public function set_document_routing_id(string $routing_id): Zugferd_Document_Builder
    {
        return $this->set_document_buyer_reference($routing_id);
    }
    /**
     * Set grouping of business process information.
     *
     * @param  string $id __BT-23, From MINIMUM__ Identifies the context of a business process where the transaction is taking place, thus allowing the buyer to process the invoice in an appropriate manner.
     */
    public function set_document_business_process(string $id): Zugferd_Document_Builder
    {
        if ($this->get_object_helper()->is_null_or_empty($id)) {
            return $this;
        }
        $bus_process_ctx_parameter = $this->get_object_helper()->create_class_instance('ram\DocumentContextParameterType');
        $this->get_object_helper()->try_call($bus_process_ctx_parameter, 'setID', $this->get_object_helper()->get_id_type($id));
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document_context(), 'setBusinessProcessSpecifiedDocumentContextParameter', $bus_process_ctx_parameter);
        return $this;
    }
    /**
     * Mark document as a copy from the original one __(BT-X-3-00, BT-X-3, From EXTENDED)__
     */
    public function set_is_document_copy(): Zugferd_Document_Builder
    {
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'setCopyIndicator', $this->get_object_helper()->get_indicator_type(true));
        return $this;
    }
    /**
     * Mark document as a test document.
     */
    public function set_is_test_document(): Zugferd_Document_Builder
    {
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document_context(), 'setTestIndicator', $this->get_object_helper()->get_indicator_type(true));
        return $this;
    }
    /**
     * Sets a foreign currency (code) with the tax amount. The exchange rate
     * is calculated by tax amounts
     *
     * @param  string     $foreignCurrencyCode __BT-6, From BASIC WL__ Foreign currency code
     * @param  float      $foreignTaxAmount    __BT-X-260, From EXTENDED__ Tax total amount in the foreign currency
     * @param  float|null $exchangeRate        __BT-X-260, From EXTENDED__ Exchange Rate
     */
    public function set_foreign_currency(string $foreign_currency_code, float $foreign_tax_amount, ?float $exchange_rate = null): Zugferd_Document_Builder
    {
        $invoice_currency_code = $this->get_object_helper()->try_call_by_path_and_return($this->header_trade_settlement, 'getInvoiceCurrencyCode.value');
        if (is_null($invoice_currency_code)) {
            return $this;
        }
        $document_summation = $this->get_object_helper()->try_call_by_path_and_return($this->header_trade_settlement, 'getSpecifiedTradeSettlementHeaderMonetarySummation');
        if (is_null($document_summation)) {
            return $this;
        }
        $tax_total_amounts = $this->get_object_helper()->try_call_by_path_and_return($document_summation, 'getTaxTotalAmount') ?? [];
        $tax_total_amount_invoice = null;
        $tax_total_amount_foreign = null;
        foreach ($tax_total_amounts as $tax_total_amount) {
            if ($this->get_object_helper()->try_call_and_return($tax_total_amount, 'getCurrencyID') == $invoice_currency_code) {
                $tax_total_amount_invoice = $tax_total_amount;
            }
            if ($this->get_object_helper()->try_call_and_return($tax_total_amount, 'getCurrencyID') == $foreign_currency_code) {
                $tax_total_amount_foreign = $tax_total_amount;
            }
        }
        if (is_null($tax_total_amount_invoice)) {
            return $this;
        }
        $invoice_tax_amount = $this->get_object_helper()->try_call_by_path_and_return($tax_total_amount_invoice, 'value') ?? 0;
        if ($invoice_tax_amount == 0) {
            return $this;
        }
        if (is_null($tax_total_amount_foreign)) {
            $tax_total_amount_foreign = $this->get_object_helper()->get_amount_type($foreign_tax_amount, $foreign_currency_code);
            $this->get_object_helper()->try_call($document_summation, 'addToTaxTotalAmount', $tax_total_amount_foreign);
        } else {
            $this->get_object_helper()->try_call_by_path($tax_total_amount_foreign, 'value', $foreign_tax_amount);
            $this->get_object_helper()->try_call_by_path($tax_total_amount_foreign, 'setCurrencyID', $foreign_currency_code);
        }
        $calculated_exchange_rate = $exchange_rate;
        if (is_null($calculated_exchange_rate)) {
            $calculated_exchange_rate = round($foreign_tax_amount / $invoice_tax_amount, 5);
        }
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setTaxCurrencyCode', $this->get_object_helper()->get_id_type($foreign_currency_code));
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setTaxApplicableTradeCurrencyExchange', $this->get_object_helper()->get_tax_applicable_trade_currency_exchange_type($invoice_currency_code, $foreign_currency_code, $calculated_exchange_rate));
        return $this;
    }
    /**
     * Add a note to the docuzment
     *
     * @param  string      $content     __BT-22, From BASIC WL__ A free text containing unstructured information that is relevant to the invoice as a whole
     * @param  string|null $contentCode __BT-X-5, From EXTENDED__ A code to classify the content of the free text of the invoice
     * @param  string|null $subjectCode __BT-21, From BASIC WL__ The qualification of the free text for the invoice from BT-22
     */
    public function add_document_note(string $content, ?string $content_code = null, ?string $subject_code = null): Zugferd_Document_Builder
    {
        $note = $this->get_object_helper()->get_note_type($content, $content_code, $subject_code);
        $this->get_object_helper()->try_call($this->get_invoice_object()->get_exchanged_document(), 'addToIncludedNote', $note);
        return $this;
    }
    /**
     * Detailed information about the seller (=service provider)
     *
     * @param  string      $name        __BT-27, From MINIMUM__ The full formal name under which the seller is registered in the National Register of Legal Entities, Taxable Person or otherwise acting as person(s)
     * @param  string|null $id          __BT-29, From BASIC WL__ An identifier of the seller. In many systems, seller identification is key information. Multiple seller IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged, buyer-assigned identifier of the seller
     * @param  string|null $description __BT-33, From EN 16931__ Further legal information that is relevant for the seller
     */
    public function set_document_seller(string $name, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->get_trade_party($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setSellerTradeParty', $seller_trade_party);
        return $this;
    }
    /**
     * Add an id to the document seller
     *
     * @param  string $id __BT-29, From BASIC WL__ An identifier of the seller. In many systems, seller identification is key information. Multiple seller IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged, buyer-assigned identifier of the seller
     */
    public function add_document_seller_id(string $id): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $this->get_object_helper()->try_call($seller_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id for the seller
     *
     * __Notes__
     *
     * - The Seller's ID identification scheme is a unique identifier
     *   assigned to a seller by a global registration organization
     *
     * @param  string|null $globalID     __BT-29/BT-29-0, From BASIC WL__ The seller's identifier identification scheme is an identifier uniquely assigned to a seller by a global registration organization.
     * @param  string|null $globalIDType __BT-29-1, From BASIC WL__ If the identifier is used for the identification scheme, it must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_seller_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $this->get_object_helper()->try_call($seller_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add detailed information on the seller's tax information
     *
     * The local identification (defined by the seller's address) of the seller for tax purposes or a reference that enables the seller
     * to indicate his reporting status for tax purposes The sales tax identification number of the seller
     * Note: This information may affect how the buyer the invoice settled (such as in relation to social security contributions). So
     * e.g. In some countries, if the seller is not reported for tax, the buyer will withhold the tax amount and pay it on behalf of the
     * seller. Sales tax number with a prefixed country code. A supplier registered as subject to VAT must provide his sales tax
     * identification number, unless he uses a tax agent.
     *
     * @param  string|null $taxRegType __BT-31-0/BT-32-0, From MINIMUM/EN 16931__ Type of tax number of the seller (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-31/32, From MINIMUM/EN 16931__ Tax number of the seller or sales tax identification number of the seller
     */
    public function add_document_seller_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($seller_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Add information about the seller's VAT Registration Number (Umsatzsteueridentnummer)
     *
     * @param  string|null $vatRegNo __BT-31, From MINIMUM/EN 16931__ VAT Registration Number (Umsatzsteueridentnummer)
     */
    public function add_document_seller_vat_registration_number(?string $vat_reg_no = null): Zugferd_Document_Builder
    {
        return $this->add_document_seller_tax_registration(Zugferd_Reference_Code_Qualifiers::VAT_REGI_NUMB, $vat_reg_no);
    }
    /**
     * Add information about the seller's Tax Number (Steuernummer)
     *
     * @param  string|null $taxNo __BT-32, From MINIMUM/EN 16931__ Tax Number (Steuernummer)
     */
    public function add_document_seller_tax_number(?string $tax_no = null): Zugferd_Document_Builder
    {
        return $this->add_document_seller_tax_registration(Zugferd_Reference_Code_Qualifiers::FISC_NUMB, $tax_no);
    }
    /**
     * Sets detailed information on the business address of the seller
     *
     * @param  string|null $lineOne     __BT-35, From BASIC WL__ The main line in the sellers address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-36, From BASIC WL__ Line 2 of the seller's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-162, From BASIC WL__ Line 3 of the seller's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-38, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-37, From BASIC WL__ Usual name of the city or municipality in which the seller's address is located
     * @param  string|null $country     __BT-40, From MINIMUM__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-39, From BASIC WL__ The sellers state
     */
    public function set_document_seller_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($seller_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set Organization details
     *
     * @param  string|null $legalOrgId   __BT-30, From MINIMUM__ An identifier issued by an official registrar that identifies the seller as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer and seller
     * @param  string|null $legalOrgType __BT-30-1, From MINIMUM__ The identifier for the identification scheme of the legal registration of the seller. If the identification scheme is used, it must be selected from ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-28, From BASIC WL__ A name by which the seller is known, if different from the seller's name (also known as the company name). Note: This may be used if different from the seller's name.
     */
    public function set_document_seller_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($seller_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set detailed information on the seller's contact person
     *
     * @param  string|null $contactPersonName     __BT-41, From EN 16931__ Such as personal name, name of contact person or department or office
     * @param  string|null $contactDepartmentName __BT-41-0, From EN 16931__ If a contact person is specified, either the name or the department must be transmitted.
     * @param  string|null $contactPhoneNo        __BT-42, From EN 16931__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-107, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-43, From EN 16931__ An e-mail address of the contact point
     */
    public function set_document_seller_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($seller_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the seller party (EXTENDED Profile only)
     *
     * @param  string|null $contactPersonName     __BT-41, From EN 16931__ Such as personal name, name of contact person or department or office
     * @param  string|null $contactDepartmentName __BT-41-0, From EN 16931__ If a contact person is specified, either the name or the department must be transmitted.
     * @param  string|null $contactPhoneNo        __BT-42, From EN 16931__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-107, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-43, From EN 16931__ An e-mail address of the contact point
     */
    public function add_document_seller_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($seller_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Set the seller's electronic communication information
     *
     * @param  string|null $uriScheme __BT-34-1, From BASIC WL__ The identifier for the identification scheme of the seller's electronic address
     * @param  string|null $uri       __BT-34, From BASIC WL__ Specifies the electronic address of the seller to which the response to the invoice can be sent at application level
     */
    public function set_document_seller_communication(?string $uri_scheme, ?string $uri): Zugferd_Document_Builder
    {
        $seller_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTradeParty');
        $communication = $this->get_object_helper()->get_universal_communication_type(null, $uri, $uri_scheme);
        $this->get_object_helper()->try_call($seller_trade_party, 'setURIUniversalCommunication', $communication);
        return $this;
    }
    /**
     * Detailed information about the buyer (service recipient)
     *
     * @param  string      $name        __BT-44, From MINIMUM__ The full name of the buyer
     * @param  string|null $id          __BT-46, From BASIC WL__ An identifier of the buyer. In many systems, buyer identification is key information. Multiple buyer IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and buyer, e.g. a previously exchanged, seller-assigned identifier of the buyer
     * @param  string|null $description __BT-X-334, From EXTENDED__ Further legal information about the buyer
     */
    public function set_document_buyer(string $name, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->get_trade_party($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setBuyerTradeParty', $buyer_trade_party);
        return $this;
    }
    /**
     * Add an id to the document buyer
     *
     * @param  string $id __BT-46, From BASIC WL__ An identifier of the buyer. In many systems, buyer identification is key information. Multiple buyer IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and buyer, e.g. a previously exchanged, seller-assigned identifier of the buyer
     */
    public function add_document_buyer_id(string $id): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $this->get_object_helper()->try_call($buyer_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id for the buyer
     *
     * @param  string|null $globalID     __BT-46-0, From BASIC WL__ The buyers's identifier identification scheme is an identifier uniquely assigned to a buyer by a global registration organization.
     * @param  string|null $globalIDType __BT-46-1, From BASIC WL__ If the identifier is used for the identification scheme, it must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_buyer_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $this->get_object_helper()->try_call($buyer_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add detailed information on the buyers's tax information
     *
     * The local identification (defined by the buyers's address) of the buyers for tax purposes or a reference that enables the buyers
     * to indicate his reporting status for tax purposes The sales tax identification number of the buyers
     * Note: This information may affect how the buyer the invoice settled (such as in relation to social security contributions). So
     * e.g. In some countries, if the buyers is not reported for tax, the buyer will withhold the tax amount and pay it on behalf of the
     * buyers. Sales tax number with a prefixed country code. A supplier registered as subject to VAT must provide his sales tax
     * identification number, unless he uses a tax agent.
     *
     * @param  string|null $taxRegType __BT-48-0, From BASIC WL__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-48, From BASIC WL__ Tax number or sales tax identification number
     */
    public function add_document_buyer_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($buyer_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Add information about the buyers's VAT Registration Number (Umsatzsteueridentnummer)
     *
     * @param  string|null $vatRegNo __BT-48, From MINIMUM/EN 16931__ VAT Registration Number (Umsatzsteueridentnummer)
     */
    public function add_document_buyer_vat_registration_number(?string $vat_reg_no = null): Zugferd_Document_Builder
    {
        return $this->add_document_buyer_tax_registration(Zugferd_Reference_Code_Qualifiers::VAT_REGI_NUMB, $vat_reg_no);
    }
    /**
     * Add information about the buyer's Tax Number (Steuernummer)
     *
     * @param  string|null $taxNo __BT-48, From MINIMUM/EN 16931__ Tax Number (Steuernummer)
     */
    public function add_document_buyer_tax_number(?string $tax_no = null): Zugferd_Document_Builder
    {
        return $this->add_document_buyer_tax_registration(Zugferd_Reference_Code_Qualifiers::FISC_NUMB, $tax_no);
    }
    /**
     * Sets detailed information on the business address of the buyer
     *
     * @param  string|null $lineOne     __BT-50, From BASIC WL__ The main line in the buyers address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-51, From BASIC WL__ Line 2 of the buyers address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-163, From BASIC WL__ Line 3 of the buyers address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-53, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-52, From BASIC WL__ Usual name of the city or municipality in which the buyers address is located
     * @param  string|null $country     __BT-55, From BASIC WL__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-54, From BASIC WL__ The buyers state
     */
    public function set_document_buyer_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($buyer_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the buyer party
     *
     * @param  string|null $legalOrgId   __BT-47, From MINIMUM__ An identifier issued by an official registrar that identifies the buyer as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer and buyer
     * @param  string|null $legalOrgType __BT-47-1, From MINIMUM__ The identifier for the identification scheme of the legal registration of the buyer. If the identification scheme is used, it must be selected from ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-45, From EN 16931__ A name by which the buyer is known, if different from the buyers name (also known as the company name)
     */
    public function set_document_buyer_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($buyer_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the buyer party
     *
     * @param  string|null $contactPersonName     __BT-56, From EN 16931__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-56-0, From EN 16931__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-57, From EN 16931__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-115, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-58, From EN 16931__ An e-mail address of the contact point
     */
    public function set_document_buyer_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($buyer_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the buyer party contact person (EXTENDED Profile only)
     *
     * @param  string|null $contactPersonName     __BT-56, From EN 16931__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-56-0, From EN 16931__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-57, From EN 16931__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-115, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-58, From EN 16931__ An e-mail address of the contact point
     */
    public function add_document_buyer_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($buyer_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Set the buyers's electronic communication information
     *
     * @param  string|null $uriScheme __BT-49-1, From BASIC WL__ The identifier for the identification scheme of the buyer's electronic address
     * @param  string|null $uri       __BT-49, From BASIC WL__ Specifies the buyer's electronic address to which the invoice is sent
     */
    public function set_document_buyer_communication(?string $uri_scheme, ?string $uri): Zugferd_Document_Builder
    {
        $buyer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getBuyerTradeParty');
        $communication = $this->get_object_helper()->get_universal_communication_type(null, $uri, $uri_scheme);
        $this->get_object_helper()->try_call($buyer_trade_party, 'setURIUniversalCommunication', $communication);
        return $this;
    }
    /**
     * Sets the Information about the seller's tax representative
     *
     * @param  string      $name        __BT-62, From BASIC WL__ The full name of the seller's tax agent
     * @param  string|null $id          __BT-X-116, From EXTENDED__ An identifier of the sellers tax agent.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the sellers tax agent
     */
    public function set_document_seller_tax_representative_trade_party(string $name, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $seller_tax_representative_trade_party = $this->get_object_helper()->get_trade_party($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setSellerTaxRepresentativeTradeParty', $seller_tax_representative_trade_party);
        return $this;
    }
    /**
     * Add a global id for the seller's Tax representative party
     *
     * @param  string|null $globalID     __BT-X-117, From EXTENDED__ The seller's tax agent identifier identification scheme is an identifier uniquely assigned to a seller by a global registration organization.
     * @param  string|null $globalIDType __BT-X-117-1, From EXTENDED__ If the identifier is used for the identification scheme, it must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_seller_tax_representative_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $taxrepresentative_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTaxRepresentativeTradeParty');
        $this->get_object_helper()->try_call($taxrepresentative_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to seller's tax representative party
     *
     * @param  string|null $taxRegType __BT-63-0, From BASIC WL__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-63, From BASIC WL__ Tax number or sales tax identification number
     */
    public function add_document_seller_tax_representative_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $taxrepresentative_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTaxRepresentativeTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($taxrepresentative_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the seller's tax representative party
     *
     * @param  string|null $lineOne     __BT-64, From BASIC WL__ The main line in the sellers tax agent address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-65, From BASIC WL__ Line 2 of the sellers tax agent address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-164, From BASIC WL__ Line 3 of the sellers tax agent address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-67, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-66, From BASIC WL__ Usual name of the city or municipality in which the sellers tax agent address is located
     * @param  string|null $country     __BT-69, From BASIC WL__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-68, From BASIC WL__ The sellers tax agent state
     */
    public function set_document_seller_tax_representative_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $taxrepresentative_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTaxRepresentativeTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($taxrepresentative_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the seller's tax representative party
     *
     * @param  string|null $legalOrgId   __BT-, From __ An identifier issued by an official registrar that identifies the seller tax agent as a legal entity or legal person.
     * @param  string|null $legalOrgType __BT-, From __ The identifier for the identification scheme of the legal registration of the sellers tax agent. If the identification scheme is used, it must be selected from  ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-, From __ A name by which the sellers tax agent is known, if different from the  sellers tax agent name (also known as the company name)
     */
    public function set_document_seller_tax_representative_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $taxrepresentative_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTaxRepresentativeTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($taxrepresentative_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set detailed information on the seller's tax representative party contact person
     *
     * @param  string|null $contactPersonName     __BT-X-120, From EXTENDED__ Such as personal name, name of contact person or department or office
     * @param  string|null $contactDepartmentName __BT-X-121, From EXTENDED__ If a contact person is specified, either the name or the department must be transmitted.
     * @param  string|null $contactPhoneNo        __BT-X-122, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-123, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-124, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_seller_tax_representative_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $taxrepresentative_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTaxRepresentativeTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($taxrepresentative_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the seller's tax representative party (EXTENDED Profile only)
     *
     * @param  string|null $contactPersonName     __BT-X-120, From EXTENDED__ Such as personal name, name of contact person or department or office
     * @param  string|null $contactDepartmentName __BT-X-121, From EXTENDED__ If a contact person is specified, either the name or the department must be transmitted.
     * @param  string|null $contactPhoneNo        __BT-X-122, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-123, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-124, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_seller_tax_representative_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $taxrepresentative_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getSellerTaxRepresentativeTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($taxrepresentative_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Detailed information on the deviating end user (general informaton)
     *
     * @param  string      $name        __BT-X-128, From EXTENDED__ Name/company name of the end user
     * @param  string|null $id          __BT-X-126, From EXTENDED__ An identifier of the product end user
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the product end user
     */
    public function set_document_product_end_user(string $name, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $product_end_user_trade_party = $this->get_object_helper()->get_trade_party($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setProductEndUserTradeParty', $product_end_user_trade_party);
        return $this;
    }
    /**
     * Add a Global identifier of the deviating end user
     *
     * @param  string|null $globalID     __BT-X-127, From EXTENDED__ The identifier is uniquely assigned to a party by a global registration organization.
     * @param  string|null $globalIDType __BT-X-127-0, From EXTENDED__ If the identifier is used for the identification scheme, it must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_product_end_user_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $product_end_user_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getProductEndUserTradeParty');
        $this->get_object_helper()->try_call($product_end_user_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to the deviating end user
     *
     * @param  string|null $taxRegType __BT-, From __ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-, From __ Tax number or sales tax identification number
     */
    public function add_document_product_end_user_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $product_end_user_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getProductEndUserTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($product_end_user_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the Product Enduser party
     *
     * @param  string|null $lineOne     __BT-X-397, From EXTENDED__ The main line in the product end users address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-398, From EXTENDED__ Line 2 of the product end users address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-399, From EXTENDED__ Line 3 of the product end users address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-396, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-400, From EXTENDED__ Usual name of the city or municipality in which the product end users address is located
     * @param  string|null $country     __BT-X-401, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-X-402, From EXTENDED__ The product end users state
     */
    public function set_document_product_end_user_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $product_end_user_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getProductEndUserTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($product_end_user_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the Product Enduser party
     *
     * @param  string|null $legalOrgId   __BT-X-129, From EXTENDED__ An identifier issued by an official registrar that identifies the product end user as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to all trade parties
     * @param  string|null $legalOrgType __BT-X-129-0, From EXTENDED__The identifier for the identification scheme of the legal registration of the product end user. If the identification scheme is used, it must be selected from ISO/IEC 6523 list
     * @param  string|null $legalOrgName __BT-X-130, From EXTENDED__ A name by which the product end user is known, if different from the product end users name (also known as the company name)
     */
    public function set_document_product_end_user_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $product_end_user_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getProductEndUserTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($product_end_user_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the Product Enduser party
     *
     * @param  string|null $contactPersonName     __BT-X-131, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-132, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-133, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-134, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-135, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_product_end_user_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $product_end_user_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getProductEndUserTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($product_end_user_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the Product Enduser party (EXTENDED Profile only)
     *
     * @param  string|null $contactPersonName     __BT-X-131, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-132, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-133, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-134, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-135, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_product_end_user_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $product_end_user_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_agreement, 'getProductEndUserTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($product_end_user_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Ship-To
     *
     * @param  string|null $name        __BT-70, From BASIC WL__ The name of the party to whom the goods are being delivered or for whom the services are being performed. Must be used if the recipient of the goods or services is not the same as the buyer.
     * @param  string|null $id          __BT-71, From BASIC WL__ An identifier for the place where the goods are delivered or where the services are provided. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function set_document_ship_to(?string $name = null, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->get_trade_party_allow_empty($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_delivery, 'setShipToTradeParty', $ship_to_trade_party);
        return $this;
    }
    /**
     * Add an id to the Ship-to Trade Party
     *
     * @param  string $id __BT-71, From BASIC WL__ An identifier for the place where the goods are delivered or where the services are provided. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     */
    public function add_document_ship_tol_id(string $id): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipToTradeParty');
        $this->get_object_helper()->try_call($ship_to_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id for the Ship-to Trade Party
     *
     * @param  string|null $globalID     __BT-71-0, From BASIC WL__ Global identifier of the goods recipient
     * @param  string|null $globalIDType __BT-71-1, From BASIC WL__ Type of global identification number, must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_ship_to_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipToTradeParty');
        $this->get_object_helper()->try_call($ship_to_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to Ship-To Trade party
     *
     * @param  string|null $taxRegType __BT-X-161-0, From EXTENDED__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-X-161, From EXTENDED__ Tax number or sales tax identification number
     */
    public function add_document_ship_to_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipToTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the Ship-To party
     *
     * @param  string|null $lineOne     __BT-75, From BASIC WL__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-76, From BASIC WL__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-165, From BASIC WL__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-78, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-77, From BASIC WL__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-80, From BASIC WL__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-79, From BASIC WL__ The party's state
     */
    public function set_document_ship_to_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipToTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the Ship-To party
     *
     * @param  string|null $legalOrgId   __BT-X-153, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-153-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-154, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_ship_to_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipToTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the Ship-To party
     *
     * @param  string|null $contactPersonName     __BT-X-155, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-156, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-157, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-158, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-159, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($ship_to_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the Ship-To party
     *
     * @param  string|null $contactPersonName     __BT-X-155, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-156, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-157, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-158, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-159, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Detailed information on the different end recipient
     *
     * @param  string|null $name        __BT-X-164, From EXTENDED__ Name or company name of the different end recipient
     * @param  string|null $id          __BT-X-162, From EXTENDED__ Identification of the different end recipient. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the different end recipient
     */
    public function set_document_ultimate_ship_to(?string $name = null, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->get_trade_party_allow_empty($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_delivery, 'setUltimateShipToTradeParty', $ship_to_trade_party);
        return $this;
    }
    /**
     * Add an id to the different end recipient
     *
     * @param  string $id __BT-X-162, From EXTENDED__ Identification of the different end recipient. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes.
     */
    public function add_document_ultimate_ship_to_id(string $id): Zugferd_Document_Builder
    {
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getUltimateShipToTradeParty');
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id for the different end recipient
     *
     * @param  string|null $globalID     __BT-X-163, From EXTENDED__ Global identifier of the different end recipient
     * @param  string|null $globalIDType __BT-X-163-0, From EXTENDED__ Type of global identification number, must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_ultimate_ship_to_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getUltimateShipToTradeParty');
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to the different end recipient
     *
     * @param  string|null $taxRegType __BT-X-180-0, From EXTENDED__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-X-180, From EXTENDED__ Tax number or sales tax identification number
     */
    public function add_document_ultimate_ship_to_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getUltimateShipToTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the different end recipient
     *
     * @param  string|null $lineOne     __BT-X-173, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box. For major customer addresses, this field must be filled with "-".
     * @param  string|null $lineTwo     __BT-X-174, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-175, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-172, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-176, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-177, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-X-178, From EXTENDED__ The party's state
     */
    public function set_document_ultimate_ship_to_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getUltimateShipToTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the different end recipient
     *
     * @param  string|null $legalOrgId   __BT-X-165, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-165-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-166, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_ultimate_ship_to_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getUltimateShipToTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the different end recipient
     *
     * @param  string|null $contactPersonName     __BT-X-167, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-168, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-169, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-170, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-171, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_ultimate_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getUltimateShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($ultimate_ship_to_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the different end recipient.
     *
     * @param  string|null $contactPersonName     __BT-X-167, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-168, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-169, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-170, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-171, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_ultimate_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getUltimateShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Set detailed information of the deviating consignor party
     *
     * @param  string|null $name        __BT-X-183, From EXTENDED__ The name of the party
     * @param  string|null $id          __BT-X-181, From EXTENDED__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function set_document_ship_from(?string $name = null, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $ship_to_trade_party = $this->get_object_helper()->get_trade_party_allow_empty($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_delivery, 'setShipFromTradeParty', $ship_to_trade_party);
        return $this;
    }
    /**
     * Add an id to the deviating consignor party
     *
     * @param  string $id __BT-X-181, From EXTENDED__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     */
    public function add_document_ship_from_id(string $id): Zugferd_Document_Builder
    {
        $ship_from_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipFromTradeParty');
        $this->get_object_helper()->try_call($ship_from_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id for the deviating consignor party
     *
     * @param  string|null $globalID     __BT-X-182, From EXTENDED__ Global identifier of the goods recipient
     * @param  string|null $globalIDType __BT-X-182-0, From EXTENDED__ Type of global identification number, must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_ship_from_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $ship_from_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipFromTradeParty');
        $this->get_object_helper()->try_call($ship_from_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to the deviating consignor party
     *
     * @param  string|null $taxRegType __BT-, From __ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-, From __ Tax number or sales tax identification number
     */
    public function add_document_ship_from_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $ship_from_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipFromTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($ship_from_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the deviating consignor party
     *
     * @param  string|null $lineOne     __BT-X-192, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-193, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-194, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-191, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-195, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-196, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-X-197, From EXTENDED__ The party's state
     */
    public function set_document_ship_from_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $ship_from_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipFromTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($ship_from_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the deviating consignor party
     *
     * @param  string|null $legalOrgId   __BT-X-184, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-184-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-185, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_ship_from_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $ship_from_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipFromTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($ship_from_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the deviating consignor party
     *
     * @param  string|null $contactPersonName     __BT-X-186, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-187, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-188, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-189, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-190, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_ship_from_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $ship_from_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipFromTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($ship_from_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the deviating consignor party
     *
     * @param  string|null $contactPersonName     __BT-X-186, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-187, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-188, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-189, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-190, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_ship_from_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $ship_from_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_delivery, 'getShipFromTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($ship_from_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Detailed information about the Invoicer Party
     *
     * @param  string      $name        __BT-X-207, From EXTENDED__ The name of the party
     * @param  string|null $id          __BT-X-205, From EXTENDED__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function set_document_invoicer(string $name, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->get_trade_party($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setInvoicerTradeParty', $invoicer_trade_party);
        return $this;
    }
    /**
     * Add an id to the Invoicer Party
     *
     * @param  string $id __BT-X-205, From EXTENDED__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     */
    public function add_document_invoicer_id(string $id): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoicerTradeParty');
        $this->get_object_helper()->try_call($invoicer_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id to the Invoicer Party
     *
     * @param  string|null $globalID     __BT-X-206, From EXTENDED__ Global identifier of the goods recipient
     * @param  string|null $globalIDType __BT-X-206-0, From EXTENDED__ Type of global identification number, must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_invoicer_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoicerTradeParty');
        $this->get_object_helper()->try_call($invoicer_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to Invoicer Party
     *
     * @param  string|null $taxRegType __BT-, From __ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-, From __ Tax number or sales tax identification number
     */
    public function add_document_invoicer_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoicerTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($invoicer_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the Invoicer Party
     *
     * @param  string|null $lineOne     __BT-X-216, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-217, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-218, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-215, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-219, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-220, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-X-221, From EXTENDED__ The party's state
     */
    public function set_document_invoicer_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoicerTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($invoicer_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the Invoicer Party
     *
     * @param  string|null $legalOrgId   __BT-X-208, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-208-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN,* 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-209, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_invoicer_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoicerTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($invoicer_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the Invoicer Party
     *
     * @param  string|null $contactPersonName     __BT-X-210, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-211, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-212, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-213, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-214, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_invoicer_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoicerTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($invoicer_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the Invoicer Party
     *
     * @param  string|null $contactPersonName     __BT-X-210, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-211, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-212, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-213, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-214, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_invoicer_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $invoicer_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoicerTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($invoicer_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Set detailed information on the different invoice recipient
     *
     * @param  string      $name        __BT-X-226, From EXTENDED__ The name of the party
     * @param  string|null $id          __BT-X-224, From EXTENDED__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function set_document_invoicee(string $name, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->get_trade_party($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setInvoiceeTradeParty', $invoicee_trade_party);
        return $this;
    }
    /**
     * Add an id to the Invoicee Party
     *
     * @param  string $id __BT-X-224, From EXTENDED__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     */
    public function add_document_invoicee_id(string $id): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoiceeTradeParty');
        $this->get_object_helper()->try_call($invoicee_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id for the Invoicee Party
     *
     * @param  string|null $globalID     __BT-X-225, From EXTENDED__ Global identification number
     * @param  string|null $globalIDType __BT-X-225-0, From EXTENDED__ Type of global identification number, must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_invoicee_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoiceeTradeParty');
        $this->get_object_helper()->try_call($invoicee_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to the Invoicee Party
     *
     * @param  string|null $taxRegType __BT-X-242-0, From EXTENDED__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-X-242, From EXTENDED__ Tax number or sales tax identification number
     */
    public function add_document_invoicee_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoiceeTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($invoicee_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the Invoicee Party
     *
     * @param  string|null $lineOne     __BT-X-235, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-236, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-237, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-234, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-238, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-239, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-X-240, From EXTENDED__ The party's state
     */
    public function set_document_invoicee_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoiceeTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($invoicee_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the Invoicee Party
     *
     * @param  string|null $legalOrgId   __BT-X-227, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-227-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-228, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_invoicee_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoiceeTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($invoicee_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the Invoicee Party
     *
     * @param  string|null $contactPersonName     __BT-X-229, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-230, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-231, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-232, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-233, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_invoicee_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoiceeTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($invoicee_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the Invoicee Party
     *
     * @param  string|null $contactPersonName     __BT-X-229, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-230, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-231, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-232, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-233, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_invoicee_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $invoicee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getInvoiceeTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($invoicee_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Set detailed information about the payee, i.e. about the place that receives the payment.
     * The role of the payee may also be performed by a party other than the seller, e.g. by a factoring service.
     *
     * @param  string      $name        __BT-59, From BASIC WL__ The name of the party. Must be used if the payee is not the same as the seller. However, the name of the payee may match the name of the seller.
     * @param  string|null $id          __BT-60, From BASIC WL__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party
     */
    public function set_document_payee(string $name, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->get_trade_party($name, $id, $description);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setPayeeTradeParty', $payee_trade_party);
        return $this;
    }
    /**
     * Add an id to the payee trade party
     *
     * @param  string $id __BT-60, From BASIC WL__ An identifier for the party. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should  be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     */
    public function add_document_payee_id(string $id): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getPayeeTradeParty');
        $this->get_object_helper()->try_call($payee_trade_party, 'addToID', $this->get_object_helper()->get_id_type($id));
        return $this;
    }
    /**
     * Add a global id for the payee trade party
     *
     * @param  string|null $globalID     __BT-60-0, From BASIC WL__ Global identification number
     * @param  string|null $globalIDType __BT-60-1, From BASIC WL__ Type of global identification number, must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_payee_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getPayeeTradeParty');
        $this->get_object_helper()->try_call($payee_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to payee trade party
     *
     * @param  string|null $taxRegType __BT-X-257-0, From EXTENDED__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-X-257, From EXTENDED Tax number or sales tax identification number
     */
    public function add_document_payee_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getPayeeTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($payee_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the payee trade party
     *
     * @param  string|null $lineOne     __BT-X-250, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT-X-251, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT-X-252, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT-X-249, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT-X-253, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT-X-254, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT-X-255, From EXTENDED__ The party's state
     */
    public function set_document_payee_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getPayeeTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($payee_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the payee trade party
     *
     * @param  string|null $legalOrgId   __BT-61, From BASIC WL__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-61-1, From BASIC WL__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-243, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_payee_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getPayeeTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($payee_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the payee trade party
     *
     * @param  string|null $contactPersonName     __BT-X-244, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-245, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-246, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-247, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-248, From EXTENDED__ An e-mail address of the contact point
     */
    public function set_document_payee_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getPayeeTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($payee_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an (additional) contact to the payee trade party
     *
     * @param  string|null $contactPersonName     __BT-X-244, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-245, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-246, From EXTENDED__ A telephone number for the contact point
     * @param  string|null $contactFaxNo          __BT-X-247, From EXTENDED__ A fax number of the contact point
     * @param  string|null $contactEmailAddress   __BT-X-248, From EXTENDED__ An e-mail address of the contact point
     */
    public function add_document_payee_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $payee_trade_party = $this->get_object_helper()->try_call_and_return($this->header_trade_settlement, 'getPayeeTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($payee_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Set information on the delivery conditions
     *
     * @param  string|null $code __BT-X-145, From EXTENDED__ The code indicating the type of delivery for these commercial delivery terms. To be selected from the entries in the list UNTDID 4053 + INCOTERMS
     */
    public function set_document_delivery_terms(?string $code): Zugferd_Document_Builder
    {
        $deliveryterms = $this->get_object_helper()->get_trade_delivery_terms_type($code);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setApplicableTradeDeliveryTerms', $deliveryterms);
        return $this;
    }
    /**
     * Set details of the associated order confirmation.
     *
     * @param  string                 $issuerAssignedId __BT-14, From EN 16931__ An identifier issued by the seller for a referenced sales order (Order confirmation number)
     * @param  DateTimeInterface|null $issueDate        __BT-X-146, From EXTENDED__ Order confirmation date
     */
    public function set_document_seller_order_referenced_document(string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $sellerorderrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setSellerOrderReferencedDocument', $sellerorderrefdoc);
        return $this;
    }
    /**
     * Set details of the related buyer order.
     *
     * @param  string                 $issuerAssignedId __BT-13, From MINIMUM__ An identifier issued by the buyer for a referenced order (order number)
     * @param  DateTimeInterface|null $issueDate        __BT-X-147, From EXTENDED__ Date of order
     */
    public function set_document_buyer_order_referenced_document(?string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $buyerorderrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setBuyerOrderReferencedDocument', $buyerorderrefdoc);
        return $this;
    }
    /**
     * Set details of the associated offer
     *
     * @param  string                 $issuerAssignedId __BT-X-403, From EXTENDED__ Offer number
     * @param  DateTimeInterface|null $issueDate        __BT-X-404, From EXTENDED__ Date of offer
     */
    public function set_document_quotation_referenced_document(?string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $quotationrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setQuotationReferencedDocument', $quotationrefdoc);
        return $this;
    }
    /**
     * Set details of the associated contract
     *
     * @param  string                 $issuerAssignedId __BT-12, From BASIC WL__ The contract reference should be assigned once in the context of the specific trade relationship and for a defined period of time (contract number)
     * @param  DateTimeInterface|null $issueDate        __BT-X-26, From EXTENDED__ Contract date
     */
    public function set_document_contract_referenced_document(?string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $contractrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setContractReferencedDocument', $contractrefdoc);
        return $this;
    }
    /**
     * Set information about billing documents that provide evidence of claims made in the bill
     *
     * __Notes__
     *  - The documents justifying the invoice can be used to reference a document number, which should be
     *    known to the recipient, as well as an external document (referenced by a URL) or an embedded document (such
     *    as a timesheet as a PDF file). The option of linking to an external document is e.g. required when it comes
     *    to large attachments and / or sensitive information, e.g. for personal services, which must be separated
     *    from the bill
     *
     * @param  string                 $issuerAssignedId   __BT-122, From EN 16931__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param  string                 $typeCode           __BT-122-0, From EN 16931__ Type of referenced document (See codelist UNTDID 1001)
     *                                                    - Code 916 "reference paper" is used to reference the identification of the
     *                                                    document on which the invoice is based - Code 50 "Price / sales catalog response"
     *                                                    is used to reference the tender or the lot - Code 130 "invoice data sheet" is used
     *                                                    to reference an identifier for an object specified by the seller.
     * @param  string|null            $uriId              __BT-124, From EN 16931__ A means of locating the resource, including the primary access method intended for it, e.g. http:// or ftp://. The storage location of the external document must be used if the buyer requires further information as
     *                                                    supporting documents for the invoiced amounts. External documents are not part of the invoice. Invoice processing should be possible without access to external documents. Access to external documents can entail certain risks.
     * @param  string|array|null      $name               __BT-123, From EN 16931__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     * @param  string|null            $refTypeCode        __BT-18-1, From ENN 16931__ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     * @param  DateTimeInterface|null $issueDate          __BT-X-149, From EXTENDED__ Document date
     * @param  string|null            $binaryDataFilename __BT-125, From EN 16931__ Contains a file name of an attachment document embedded as a binary object
     * @param  string|null            $base64EncodedData  __BT-125, From EN 16931__ Contains BASE64-Encoded data an attachment document embedded as a binary object. You must provide $binaryDataFilename
     */
    public function add_document_additional_referenced_document(string $issuer_assigned_id, string $type_code, ?string $uri_id = null, $name = null, ?string $ref_type_code = null, ?DateTimeInterface $issue_date = null, ?string $binary_data_filename = null, ?string $base64encoded_data = null): Zugferd_Document_Builder
    {
        $additionalrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, $uri_id, null, $type_code, $name, $ref_type_code, $issue_date, $binary_data_filename, $base64encoded_data);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'addToAdditionalReferencedDocument', $additionalrefdoc);
        return $this;
    }
    /**
     * Add an invoice supporting additional document reference with an URL which specifies the location where the information can be found
     * The invoice supporting documents can be used to reference a document number, which should be known to the recipient, as well as an external document (referenced by a URL).
     * The option of linking to an external document is required, for example, when large attachments and/or sensitive information, e.g. for personal services, are involved,
     * which must be separated from the invoice.
     *
     * @param  string            $issuerAssignedId __BT-122, From EN 16931__ Identification of the document supporting the invoice
     * @param  string            $uriId            __BT-124, From EN 16931__ A means of locating the resource, including the primary access method intended for it, e.g. http:// or ftp://. The storage location of the external document must be used if the buyer requires further information as
     * @param  string|array|null $name             __BT-123, From EN 16931__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     */
    public function add_document_invoice_supporting_document_with_uri(string $issuer_assigned_id, string $uri_id, $name = null): Zugferd_Document_Builder
    {
        return $this->add_document_additional_referenced_document($issuer_assigned_id, Zugferd_Document_Type::RELATED_DOCUMENT, $uri_id, $name);
    }
    /**
     * Add an invoice supporting additional document reference with an URL which specifies the location where the information can be found
     * The invoice supporting documents can be used to reference both a document number, which should be known to the recipient, and an embedded file (such as a timesheet as a PDF file).
     *
     * @param  string            $issuerAssignedId   __BT-122, From EN 16931__ Identification of the document supporting the invoice
     * @param  string            $binaryDataFilename __BT-125, From EN 16931__ Contains a file name of an attachment document embedded as a binary object
     * @param  string|array|null $name               __BT-123, From EN 16931__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     * @throws ZugferdUnsupportedMimetype
     */
    public function add_document_invoice_supporting_document_with_file(string $issuer_assigned_id, string $binary_data_filename, $name = null): Zugferd_Document_Builder
    {
        return $this->add_document_additional_referenced_document($issuer_assigned_id, Zugferd_Document_Type::RELATED_DOCUMENT, null, $name, null, null, $binary_data_filename);
    }
    /**
     * Add a tender or lot document reference
     *
     * @param  string $issuerAssignedId __BT-122, From EN 16931__ Tender or lot reference
     */
    public function add_document_tender_or_lot_reference_document(string $issuer_assigned_id): Zugferd_Document_Builder
    {
        return $this->add_document_additional_referenced_document($issuer_assigned_id, Zugferd_Document_Type::VALIDATED_PRICED_TENDER);
    }
    /**
     * Add details of the calculated object
     *
     * @param  string $issuerAssignedId __BT-18, From EN 16931__ Depending on the application, this can be a subscription number, a telephone number, a meter reading, a vehicle, a person, etc.
     * @param  string $refTypeCode      __BT-18-1, From ENN 16931__ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     */
    public function add_document_invoiced_object_reference_document(string $issuer_assigned_id, string $ref_type_code): Zugferd_Document_Builder
    {
        return $this->add_document_additional_referenced_document($issuer_assigned_id, Zugferd_Document_Type::INVOICING_DATA_SHEET, null, null, $ref_type_code);
    }
    /**
     * Add an invoice supporting additional document reference with an URL which specifies the location where the information can be found
     * The invoice supporting documents can be used to reference both a document number, which should be known to the recipient, and an embedded file (such as a timesheet as a PDF file).
     *
     * @param  string            $issuerAssignedId   __BT-122, From EN 16931__ Identification of the document supporting the invoice
     * @param  string            $attachmentFilename __BT-125, From EN 16931__ Contains a file name of an attachment document embedded as a binary object
     * @param  string            $base64EncodedData  __BT-125, From EN 16931__ Contains BASE64-Encoded data an attachment document embedded as a binary object. You must provide $binaryDataFilename
     * @param  string|array|null $name               __BT-123, From EN 16931__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     * @throws ZugferdUnsupportedMimetype
     */
    public function add_document_invoice_supporting_document_with_base64data(string $issuer_assigned_id, string $attachment_filename, string $base64encoded_data, $name = null): Zugferd_Document_Builder
    {
        return $this->add_document_additional_referenced_document($issuer_assigned_id, Zugferd_Document_Type::RELATED_DOCUMENT, null, $name, null, null, $attachment_filename, $base64encoded_data);
    }
    /**
     * Set a Reference to the previous invoice
     *
     * To be used if:
     *  - a previous invoice is corrected
     *  - reference is made from a final invoice to previous partial invoices
     *  - reference is made from a final invoice to previous invoices for advance payments.     *
     *
     * @param  string                 $issuerAssignedId __BT-25, From BASIC WL__ The identification of an invoice previously sent by the seller
     * @param  string|null            $typeCode         __BT-X-555, From EXTENDED__ Type of previous invoice (code)
     * @param  DateTimeInterface|null $issueDate        __BT-26, From BASIC WL__ Date of the previous invoice
     */
    public function set_document_invoice_referenced_document(string $issuer_assigned_id, ?string $type_code = null, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $invoicerefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, $type_code, null, null, $issue_date);
        $this->get_object_helper()->try_call_if_method_exists($this->header_trade_settlement, 'addToInvoiceReferencedDocument', 'setInvoiceReferencedDocument', [$invoicerefdoc], $invoicerefdoc);
        return $this;
    }
    /**
     * Add a Reference to the previous invoice
     *
     * To be used if:
     *  - a previous invoice is corrected
     *  - reference is made from a final invoice to previous partial invoices
     *  - reference is made from a final invoice to previous invoices for advance payments.     *
     *
     * @param  string                 $issuerAssignedId __BT-25, From BASIC WL__ The identification of an invoice previously sent by the seller
     * @param  string|null            $typeCode         __BT-X-555, From EXTENDED__ Type of previous invoice (code)
     * @param  DateTimeInterface|null $issueDate        __BT-26, From BASIC WL__ Date of the previous invoice
     */
    public function add_document_invoice_referenced_document(string $issuer_assigned_id, ?string $type_code = null, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $invoicerefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, $type_code, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToInvoiceReferencedDocument', $invoicerefdoc);
        return $this;
    }
    /**
     * Set Details of a project reference
     *
     * @param  string $id   __BT-11, From EN 16931__ The identifier of the project to which the invoice relates
     * @param  string $name __BT-11-0, From EN 16931__  The name of the project to which the invoice relates
     */
    public function set_document_procuring_project(string $id, string $name = 'Project Reference'): Zugferd_Document_Builder
    {
        $procuringproject = $this->get_object_helper()->get_procuring_project_type($id, $name);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'setSpecifiedProcuringProject', $procuringproject);
        return $this;
    }
    /**
     * Details of the associated end customer order
     *
     * @param  string                 $issuerAssignedId __BT-X-150, From EXTENDED__ Order number of the end customer
     * @param  DateTimeInterface|null $issueDate        __BT-X-151, From EXTENDED__ Date of the order issued by the end customer
     */
    public function add_document_ultimate_customer_order_referenced_document(string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $additionalrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_agreement, 'addToUltimateCustomerOrderReferencedDocument', $additionalrefdoc);
        return $this;
    }
    /**
     * Set detailed information on the actual delivery
     *
     * @param  DateTimeInterface|null $date __BT-72, From BASIC WL__ Actual delivery time
     */
    public function set_document_supply_chain_event(?DateTimeInterface $date): Zugferd_Document_Builder
    {
        $supply_chainevent = $this->get_object_helper()->get_supply_chain_event_type($date);
        $this->get_object_helper()->try_call($this->header_trade_delivery, 'setActualDeliverySupplyChainEvent', $supply_chainevent);
        return $this;
    }
    /**
     * Set Detailed information on the actual delivery
     *
     * @param  string                 $issuerAssignedId __BT-16, From BASIC WL__ Shipping notification reference
     * @param  DateTimeInterface|null $issueDate        __BT-X-200, From EXTENDED__ Shipping notification date
     */
    public function set_document_despatch_advice_referenced_document(?string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $despatchddvicerefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_delivery, 'setDespatchAdviceReferencedDocument', $despatchddvicerefdoc);
        return $this;
    }
    /**
     * Set detailed information on the associated goods receipt notification
     *
     * @param  string                 $issuerAssignedId __BT-15, From EN 16931__ An identifier for a referenced goods receipt notification (Goods receipt number)
     * @param  DateTimeInterface|null $issueDate        __BT-X-201, From EXTENDED__ Goods receipt date
     */
    public function set_document_receiving_advice_referenced_document(string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $receivingadvicerefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_delivery, 'setReceivingAdviceReferencedDocument', $receivingadvicerefdoc);
        return $this;
    }
    /**
     * Set detailed information on the associated delivery bill
     *
     * @param  string                 $issuerAssignedId __BT-X-202, From EXTENDED__ Delivery slip number
     * @param  DateTimeInterface|null $issueDate        __BT-X-203, From EXTENDED__ Delivery slip date
     */
    public function set_document_delivery_note_referenced_document(string $issuer_assigned_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $deliverynoterefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($this->header_trade_delivery, 'setDeliveryNoteReferencedDocument', $deliverynoterefdoc);
        return $this;
    }
    /**
     * Add detailed information on the payment method
     *
     * __Notes__
     *
     * The SpecifiedTradeSettlementPaymentMeans element can only be repeated for each bank account if
     * several bank accounts are to be transferred for transfers. The code for the payment method in the Typecode
     * element must therefore not differ in the repetitions. The elements ApplicableTradeSettlementFinancialCard
     * and PayerPartyDebtorFinancialAccount must not be specified for bank transfers.
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
    public function add_document_payment_mean(string $type_code, ?string $information = null, ?string $card_type = null, ?string $card_id = null, ?string $card_holder_name = null, ?string $buyer_iban = null, ?string $payee_iban = null, ?string $payee_account_name = null, ?string $payee_prop_id = null, ?string $payee_bic = null): Zugferd_Document_Builder
    {
        $payment_means = $this->get_object_helper()->get_trade_settlement_payment_means_type($type_code, $information);
        $financial_card = $this->get_object_helper()->get_trade_settlement_financial_card_type($card_type, $card_id, $card_holder_name);
        $buyerfinancialaccount = $this->get_object_helper()->get_debtor_financial_account_type($buyer_iban);
        $payeefinancialaccount = $this->get_object_helper()->get_creditor_financial_account_type($payee_iban, $payee_account_name, $payee_prop_id);
        $payeefinancial_institution = $this->get_object_helper()->get_creditor_financial_institution_type($payee_bic);
        $this->get_object_helper()->try_call($payment_means, 'setApplicableTradeSettlementFinancialCard', $financial_card);
        $this->get_object_helper()->try_call($payment_means, 'setPayerPartyDebtorFinancialAccount', $buyerfinancialaccount);
        $this->get_object_helper()->try_call($payment_means, 'setPayeePartyCreditorFinancialAccount', $payeefinancialaccount);
        $this->get_object_helper()->try_call($payment_means, 'setPayeeSpecifiedCreditorFinancialInstitution', $payeefinancial_institution);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedTradeSettlementPaymentMeans', $payment_means);
        return $this;
    }
    /**
     * Sets the document payment means to _SEPA Credit Transfer_
     *
     * @param  string      $payeeIban        __BT-84, From BASIC WL__ A unique identifier for the financial account held with a payment service provider to which the payment should be made
     * @param  string|null $payeeAccountName __BT-85, From BASIC WL__ The name of the payment account held with a payment service provider to which the payment should be made
     * @param  string|null $payeePropId      __BT-BT-84-0, From BASIC WL__ National account number (not for SEPA)
     * @param  string|null $payeeBic         __BT-86, From EN 16931__ An identifier for the payment service provider with which the payment account is held
     * @param  string|null $paymentReference __BT-83, From BASIC WL__ A text value used to link the payment to the invoice issued by the seller
     */
    public function add_document_payment_mean_to_credit_transfer(string $payee_iban, ?string $payee_account_name = null, ?string $payee_prop_id = null, ?string $payee_bic = null, ?string $payment_reference = null): Zugferd_Document_Builder
    {
        $payment_means = $this->get_object_helper()->get_trade_settlement_payment_means_type(Zugferd_Payment_Means::UNTDID_4461_58);
        $payeefinancialaccount = $this->get_object_helper()->get_creditor_financial_account_type($payee_iban, $payee_account_name, $payee_prop_id);
        $payeefinancial_institution = $this->get_object_helper()->get_creditor_financial_institution_type($payee_bic);
        $this->get_object_helper()->try_call($payment_means, 'setPayeePartyCreditorFinancialAccount', $payeefinancialaccount);
        $this->get_object_helper()->try_call($payment_means, 'setPayeeSpecifiedCreditorFinancialInstitution', $payeefinancial_institution);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedTradeSettlementPaymentMeans', $payment_means);
        if (!is_null($payment_reference)) {
            $this->get_object_helper()->try_call($this->header_trade_settlement, 'setPaymentReference', $this->get_object_helper()->get_id_type($payment_reference));
        }
        return $this;
    }
    /**
     * Sets the document payment means to _Non-SEPA Credit Transfer_
     *
     * @param  string      $payeeIban        __BT-84, From BASIC WL__ A unique identifier for the financial account held with a payment service provider to which the payment should be made
     * @param  string|null $payeeAccountName __BT-85, From BASIC WL__ The name of the payment account held with a payment service provider to which the payment should be made
     * @param  string|null $payeePropId      __BT-BT-84-0, From BASIC WL__ National account number (not for SEPA)
     * @param  string|null $payeeBic         __BT-86, From EN 16931__ An identifier for the payment service provider with which the payment account is held
     * @param  string|null $paymentReference __BT-83, From BASIC WL__ A text value used to link the payment to the invoice issued by the seller
     */
    public function add_document_payment_mean_to_credit_transfer_non_sepa(string $payee_iban, ?string $payee_account_name = null, ?string $payee_prop_id = null, ?string $payee_bic = null, ?string $payment_reference = null): Zugferd_Document_Builder
    {
        $payment_means = $this->get_object_helper()->get_trade_settlement_payment_means_type(Zugferd_Payment_Means::UNTDID_4461_30);
        $payeefinancialaccount = $this->get_object_helper()->get_creditor_financial_account_type($payee_iban, $payee_account_name, $payee_prop_id);
        $payeefinancial_institution = $this->get_object_helper()->get_creditor_financial_institution_type($payee_bic);
        $this->get_object_helper()->try_call($payment_means, 'setPayeePartyCreditorFinancialAccount', $payeefinancialaccount);
        $this->get_object_helper()->try_call($payment_means, 'setPayeeSpecifiedCreditorFinancialInstitution', $payeefinancial_institution);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedTradeSettlementPaymentMeans', $payment_means);
        if (!is_null($payment_reference)) {
            $this->get_object_helper()->try_call($this->header_trade_settlement, 'setPaymentReference', $this->get_object_helper()->get_id_type($payment_reference));
        }
        return $this;
    }
    /**
     * Sets the document payment means to _SEPA Direct Debit_
     *
     * @param  string      $buyerIban           __BT-91, From BASIC WL__ The account to be debited by the direct debit
     * @param  string|null $creditorReferenceID __BT-90, From BASIC WL__ Unique bank identifier of the payee or the seller assigned by the bank of the payee or the seller
     */
    public function add_document_payment_mean_to_direct_debit(string $buyer_iban, ?string $creditor_reference_id = null): Zugferd_Document_Builder
    {
        $payment_means = $this->get_object_helper()->get_trade_settlement_payment_means_type(Zugferd_Payment_Means::UNTDID_4461_59);
        $buyerfinancialaccount = $this->get_object_helper()->get_debtor_financial_account_type($buyer_iban);
        $this->get_object_helper()->try_call($payment_means, 'setPayerPartyDebtorFinancialAccount', $buyerfinancialaccount);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedTradeSettlementPaymentMeans', $payment_means);
        if (!is_null($creditor_reference_id)) {
            $this->get_object_helper()->try_call($this->header_trade_settlement, 'setCreditorReferenceID', $this->get_object_helper()->get_id_type($creditor_reference_id));
        }
        return $this;
    }
    /**
     * Sets the document payment means to _Non-SEPA Direct Debit_
     *
     * @param  string      $buyerIban           __BT-91, From BASIC WL__ The account to be debited by the direct debit
     * @param  string|null $creditorReferenceID __BT-90, From BASIC WL__ Unique bank identifier of the payee or the seller assigned by the bank of the payee or the seller
     */
    public function add_document_payment_mean_to_direct_debit_non_sepa(string $buyer_iban, ?string $creditor_reference_id = null): Zugferd_Document_Builder
    {
        $payment_means = $this->get_object_helper()->get_trade_settlement_payment_means_type(Zugferd_Payment_Means::UNTDID_4461_49);
        $buyerfinancialaccount = $this->get_object_helper()->get_debtor_financial_account_type($buyer_iban);
        $this->get_object_helper()->try_call($payment_means, 'setPayerPartyDebtorFinancialAccount', $buyerfinancialaccount);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedTradeSettlementPaymentMeans', $payment_means);
        if (!is_null($creditor_reference_id)) {
            $this->get_object_helper()->try_call($this->header_trade_settlement, 'setCreditorReferenceID', $this->get_object_helper()->get_id_type($creditor_reference_id));
        }
        return $this;
    }
    /**
     * Sets the document payment means to _Payment card_
     *
     * @param  string      $cardType       __BT-, From __ The type of the card
     * @param  string      $cardId         __BT-87, From EN 16931__ The primary account number (PAN) to which the card used for payment belongs. In accordance with card payment security standards, an invoice should never contain a full payment card master account number. The following specification of the PCI Security Standards Council currently applies: The first 6 and last 4 digits at most are to be displayed
     * @param  string|null $cardHolderName __BT-88, From EN 16931__ Name of the payment card holder
     */
    public function add_document_payment_mean_to_payment_card(string $card_type, string $card_id, ?string $card_holder_name = null): Zugferd_Document_Builder
    {
        $payment_means = $this->get_object_helper()->get_trade_settlement_payment_means_type(Zugferd_Payment_Means::UNTDID_4461_48);
        $financial_card = $this->get_object_helper()->get_trade_settlement_financial_card_type($card_type, $card_id, $card_holder_name);
        $this->get_object_helper()->try_call($payment_means, 'setApplicableTradeSettlementFinancialCard', $financial_card);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedTradeSettlementPaymentMeans', $payment_means);
        return $this;
    }
    /**
     * Add a VAT breakdown (at document level)
     *
     * @param  string                 $categoryCode               __BT-118, From BASIC WL__ Coded description of a sales tax category
     *                                                            The following entries from UNTDID 5305 are used (details in
     *                                                            brackets): - Standard rate (sales tax is due according to the
     *                                                            normal procedure) - Goods to be taxed according to the zero rate
     *                                                            (sales tax is charged with a percentage of zero) - Tax exempt
     *                                                            (USt./IGIC/IPSI) - Reversal of the tax liability (the rules for
     *                                                            reversing the tax liability at USt./IGIC/IPSI apply) - VAT exempt
     *                                                            for intra-community deliveries of goods (USt./IGIC/IPSI not levied
     *                                                            due to rules on intra-community deliveries) - Free export item, tax
     *                                                            not levied (VAT / IGIC/IPSI not levied due to export outside the
     *                                                            EU) - Services outside the tax scope (sales are not subject to VAT
     *                                                            / IGIC/IPSI) - Canary Islands general indirect tax (IGIC tax
     *                                                            applies) - IPSI (tax for Ceuta / Melilla) applies. The codes for
     *                                                            the VAT category are as follows: - S = sales tax is due at the
     *                                                            normal rate - Z = goods to be taxed according to the zero rate - E
     *                                                            = tax exempt - AE = reversal of tax liability - K = VAT is not
     *                                                            shown for intra-community deliveries - G = tax not levied due to
     *                                                            export outside the EU - O = Outside the tax scope - L = IGIC
     *                                                            (Canary Islands) - M = IPSI (Ceuta / Melilla)
     * @param  string                 $typeCode                   __BT-118-0, From BASIC WL__ Coded description of a sales tax category. Note: Fixed value = "VAT"
     * @param  float                  $basisAmount                __BT-116, From BASIC WL__ Tax base amount, Each sales tax breakdown must show a category-specific tax base amount.
     * @param  float                  $calculatedAmount           __BT-117, From BASIC WL__ The total amount to be paid for the relevant VAT category. Note: Calculated by multiplying the amount to be taxed according to the sales tax category by the sales tax rate applicable for the sales tax category concerned
     * @param  float|null             $rateApplicablePercent      __BT-119, From BASIC WL__ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param  string|null            $exemptionReason            __BT-120, From BASIC WL__ Reason for tax exemption (free text)
     * @param  string|null            $exemptionReasonCode        __BT-121, From BASIC WL__ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility.
     * @param  float|null             $lineTotalBasisAmount       __BT-X-262, From EXTENDED__ An amount used as the basis for calculating sales tax, duty or customs duty
     * @param  float|null             $allowanceChargeBasisAmount __BT-X-263, From EXTENDED__ Total amount Additions and deductions to the tax rate at document level
     * @param  DateTimeInterface|null $taxPointDate               __BT-7-00, From EN 16931__ Date on which tax is due. This is not used in Germany. Instead, the delivery and service date must be specified.
     * @param  string|null            $dueDateTypeCode            __BT-8, From BASIC WL__ The code for the date on which the VAT becomes relevant for settlement for the seller and for the buyer
     */
    public function add_document_tax(string $category_code, string $type_code, float $basis_amount, float $calculated_amount, ?float $rate_applicable_percent = null, ?string $exemption_reason = null, ?string $exemption_reason_code = null, ?float $line_total_basis_amount = null, ?float $allowance_charge_basis_amount = null, ?DateTimeInterface $tax_point_date = null, ?string $due_date_type_code = null): Zugferd_Document_Builder
    {
        $tax = $this->get_object_helper()->get_trade_tax_type($category_code, $type_code, $basis_amount, $calculated_amount, $rate_applicable_percent, $exemption_reason, $exemption_reason_code, $line_total_basis_amount, $allowance_charge_basis_amount, $tax_point_date, $due_date_type_code);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToApplicableTradeTax', $tax);
        return $this;
    }
    /**
     * Add a VAT breakdown (at document level) in a more simple way
     *
     * @param  string     $categoryCode          __BT-118, From BASIC WL__ Coded description of a sales tax category
     *                                           The following entries from UNTDID 5305 are used (details in
     *                                           brackets): - Standard rate (sales tax is due according to the
     *                                           normal procedure) - Goods to be taxed according to the zero rate
     *                                           (sales tax is charged with a percentage of zero) - Tax exempt
     *                                           (USt./IGIC/IPSI) - Reversal of the tax liability (the rules for
     *                                           reversing the tax liability at USt./IGIC/IPSI apply) - VAT exempt
     *                                           for intra-community deliveries of goods (USt./IGIC/IPSI not levied
     *                                           due to rules on intra-community deliveries) - Free export item, tax
     *                                           not levied (VAT / IGIC/IPSI not levied due to export outside the
     *                                           EU) - Services outside the tax scope (sales are not subject to VAT
     *                                           / IGIC/IPSI) - Canary Islands general indirect tax (IGIC tax
     *                                           applies) - IPSI (tax for Ceuta / Melilla) applies. The codes for
     *                                           the VAT category are as follows: - S = sales tax is due at the
     *                                           normal rate - Z = goods to be taxed according to the zero rate - E
     *                                           = tax exempt - AE = reversal of tax liability - K = VAT is not
     *                                           shown for intra-community deliveries - G = tax not levied due to
     *                                           export outside the EU - O = Outside the tax scope - L = IGIC
     *                                           (Canary Islands) - M = IPSI (Ceuta / Melilla)
     * @param  string     $typeCode              __BT-118-0, From BASIC WL__ Coded description of a sales tax category. Note: Fixed value = "VAT"
     * @param  float      $basisAmount           __BT-116, From BASIC WL__ Tax base amount, Each sales tax breakdown must show a category-specific tax base amount.
     * @param  float      $calculatedAmount      __BT-117, From BASIC WL__ The total amount to be paid for the relevant VAT category. Note: Calculated by multiplying the amount to be taxed according to the sales tax category by the sales tax rate applicable for the sales tax category concerned
     * @param  float|null $rateApplicablePercent __BT-119, From BASIC WL__ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function add_document_tax_simple(string $category_code, string $type_code, float $basis_amount, float $calculated_amount, ?float $rate_applicable_percent = null): Zugferd_Document_Builder
    {
        return $this->add_document_tax($category_code, $type_code, $basis_amount, $calculated_amount, $rate_applicable_percent);
    }
    /**
     * Get detailed information on the billing period
     *
     * @param  DateTimeInterface|null $startDate   __BT-73, From BASIC WL__ Start of the billing period
     * @param  DateTimeInterface|null $endDate     __BT-74, From BASIC WL__ End of the billing period
     * @param  string|null            $description __BT-X-264, From EXTENDED__ Further information of the billing period (Obsolete)
     */
    public function set_document_billing_period(?DateTimeInterface $start_date, ?DateTimeInterface $end_date, ?string $description): Zugferd_Document_Builder
    {
        $period = $this->get_object_helper()->get_specified_period_type($start_date, $end_date, null, $description);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setBillingSpecifiedPeriod', $period);
        return $this;
    }
    /**
     * Add information about surcharges and charges applicable to the bill as a whole, Deductions,
     * such as for withheld taxes may also be specified in this group
     *
     * @param float       $actualAmount          __BT-92/BT-99, From BASIC WL__ Amount of the surcharge or discount at document level
     * @param boolean     $isCharge              __BT-20-1/BT-21-1, From BASIC WL__ Switch that indicates whether the following data refer to an surcharge or a discount, true means that this an charge
     * @param string      $taxCategoryCode       __BT-95/BT-102, From BASIC WL__ A coded indication of which sales tax category applies to the surcharge or deduction at document level
     *
     *                                           The following entries from UNTDID 5305 are used (details in brackets):
     *                                           - Standard rate (sales tax is due according to the normal procedure)
     *                                           - Goods to be taxed according to the zero rate (sales tax is charged with a percentage of zero)
     *                                           - Tax exempt (USt./IGIC/IPSI)
     *                                           - Reversal of the tax liability (the rules for reversing the tax liability at USt./IGIC/IPSI apply)
     *                                           - VAT exempt for intra-community deliveries of goods (USt./IGIC/IPSI not levied due to rules on intra-community deliveries)
     *                                           - Free export item, tax not levied (VAT / IGIC/IPSI not levied due to export outside the EU)
     *                                           - Services outside the tax scope (sales are not subject to VAT / IGIC/IPSI)
     *                                           - Canary Islands general indirect tax (IGIC tax applies)
     *                                           - IPSI (tax for Ceuta / Melilla) applies.
     *
     *                                           The codes for the VAT category are as follows:
     *                                           - S = sales tax is due at the normal rate
     *                                           - Z = goods to be taxed according to the zero rate
     *                                           - E = tax exempt
     *                                           - AE = reversal of tax liability
     *                                           - K = VAT is not shown for intra-community deliveries
     *                                           - G = tax not levied due to export outside the EU
     *                                           - O = Outside the tax scope
     *                                           - L = IGIC (Canary Islands)
     *                                           - M = IPSI (Ceuta/Melilla)
     *
     * @param string      $taxTypeCode           __BT-95-0/BT-102-0, From BASIC WL__ Code for the VAT category of the surcharge or charge at document level. Note: Fixed value = "VAT"
     * @param float       $rateApplicablePercent __BT-96/BT-103, From BASIC WL__ VAT rate for the surcharge or discount on document level. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param float|null  $sequence              __BT-X-265, From EXTENDED__ Calculation order
     * @param float|null  $calculationPercent    __BT-94/BT-101, From BASIC WL__ Percentage surcharge or discount at document level
     * @param float|null  $basisAmount           __BT-93/BT-100, From BASIC WL__ The base amount that may be used in conjunction with the percentage of the surcharge or discount at document level to calculate the amount of the discount at document level
     * @param float|null  $basisQuantity         __BT-X-266, From EXTENDED__ Base quantity of the discount
     * @param string|null $basisQuantityUnitCode __BT-X-267, From EXTENDED__ Unit of the price base quantity
     * @param string|null $reasonCode            __BT-98/BT-105, From BASIC WL__ The reason given as a code for the surcharge or discount at document level. Note: Use entries from the UNTDID 5189 code list. The code of the reason for the surcharge or discount at document level and the reason for the surcharge or discount at document level must correspond to each other
     *
     *                                           Code list: UNTDID 7161 Complete list, code list: UNTDID 5189 Restricted
     *                                           Include PEPPOL subset:
     *                                           - 41 - Bonus for works ahead of schedule
     *                                           - 42 - Other bonus
     *                                           - 60 - Manufacturer’s consumer discount
     *                                           - 62 - Due to military status
     *                                           - 63 - Due to work accident
     *                                           - 64 - Special agreement
     *                                           - 65 - Production error discount
     *                                           - 66 - New outlet discount
     *                                           - 67 - Sample discount
     *                                           - 68 - End-of-range discount
     *                                           - 70 - Incoterm discount
     *                                           - 71 - Point of sales threshold allowance
     *                                           - 88 - Material surcharge/deduction
     *                                           - 95 - Discount
     *                                           - 100 - Special rebate
     *                                           - 102 - Fixed long term
     *                                           - 103 - Temporary
     *                                           - 104 - Standard
     *                                           - 105 - Yearly turnover
     *
     * @param  string|null $reason                __BT-97/BT-104, From BASIC WL__ The reason given in text form for the surcharge or discount at document level
     */
    public function add_document_allowance_charge(float $actual_amount, bool $is_charge, string $tax_category_code, string $tax_type_code, ?float $rate_applicable_percent, ?float $sequence = null, ?float $calculation_percent = null, ?float $basis_amount = null, ?float $basis_quantity = null, ?string $basis_quantity_unit_code = null, ?string $reason_code = null, ?string $reason = null): Zugferd_Document_Builder
    {
        $allowance_charge = $this->get_object_helper()->get_trade_allowance_charge_type($actual_amount, $is_charge, $tax_type_code, $tax_category_code, $rate_applicable_percent, $sequence, $calculation_percent, $basis_amount, $basis_quantity, $basis_quantity_unit_code, $reason_code, $reason);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedTradeAllowanceCharge', $allowance_charge);
        return $this;
    }
    /**
     * Add detailed information on logistics service fees
     *
     * @param  string     $description            __BT-X-271, From EXTENDED__ Identification of the service fee
     * @param  float      $appliedAmount          __BT-X-272, From EXTENDED__ Amount of the service fee
     * @param  array|null $taxTypeCodes           __BT-X-273-0, From EXTENDED__ Code of the Tax type. Note: Fixed value = "VAT"
     * @param  array|null $taxCategoryCodes       __BT-X-273, From EXTENDED__ Code of the VAT category
     * @param  array|null $rateApplicablePercents __BT-X-274, From EXTENDED__ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function add_document_logistics_service_charge(string $description, float $applied_amount, ?array $tax_type_codes = null, ?array $tax_category_codes = null, ?array $rate_applicable_percents = null): Zugferd_Document_Builder
    {
        $logcharge = $this->get_object_helper()->get_logistics_service_charge_type($description, $applied_amount, $tax_type_codes, $tax_category_codes, $rate_applicable_percents);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'addToSpecifiedLogisticsServiceCharge', $logcharge);
        return $this;
    }
    /**
     * Add a payment term
     *
     * @param  string|null            $description          __BT-20, From _BASIC WL__ A text description of the payment terms that apply to the payment amount due (including a description of possible penalties). Note: This element can contain multiple lines and multiple conditions.
     * @param  DateTimeInterface|null $dueDate              __BT-9, From BASIC WL__ The date by which payment is due Note: The payment due date reflects the net payment due date. In the case of partial payments, this indicates the first due date of a net payment. The corresponding description of more complex payment terms can be given in BT-20.
     * @param  string|null            $directDebitMandateID __BT-89, From BASIC WL__ Unique identifier assigned by the payee to reference the direct debit authorization.
     * @param  float|null             $partialPaymentAmount __BT-X-275, From EXTENDED__ Amount of the partial payment
     */
    public function add_document_payment_term(?string $description = null, ?DateTimeInterface $due_date = null, ?string $direct_debit_mandate_id = null, ?float $partial_payment_amount = null): Zugferd_Document_Builder
    {
        $payment_terms = $this->get_object_helper()->get_trade_payment_terms_type($description, $due_date, $direct_debit_mandate_id, $partial_payment_amount);
        $this->get_object_helper()->try_call_all($this->header_trade_settlement, ['addToSpecifiedTradePaymentTerms', 'setSpecifiedTradePaymentTerms'], $payment_terms);
        $this->current_payment_terms = $payment_terms;
        return $this;
    }
    /**
     * Add discount Terms to last added payment term
     *
     * @param  float|null             $calculationPercent         __BT-X-286, From EXTENDED__ Percentage of the down payment
     * @param  DateTimeInterface|null $basisDateTime              __BT-X-282, From EXTENDED__ Due date reference date
     * @param  float|null             $basisPeriodMeasureValue    __BT-X-283, From EXTENDED__ Maturity period (basis)
     * @param  string|null            $basisPeriodMeasureUnitCode __BT-X-284, From EXTENDED__ Maturity period (unit)
     * @param  float|null             $basisAmount                __BT-X-285, From EXTENDED__ Base amount of the payment discount
     * @param  float|null             $actualDiscountAmount       __BT-X-287, From EXTENDED__ Amount of the payment discount
     */
    public function add_discount_terms_to_payment_terms(?float $calculation_percent = null, ?DateTimeInterface $basis_date_time = null, ?float $basis_period_measure_value = null, ?string $basis_period_measure_unit_code = null, ?float $basis_amount = null, ?float $actual_discount_amount = null): Zugferd_Document_Builder
    {
        $discount_terms = $this->get_object_helper()->get_trade_payment_discount_terms_type($basis_date_time, $basis_period_measure_value, $basis_period_measure_unit_code, $basis_amount, $calculation_percent, $actual_discount_amount);
        $this->get_object_helper()->try_call($this->current_payment_terms, 'setApplicableTradePaymentDiscountTerms', $discount_terms);
        return $this;
    }
    /**
     * Add penalty Terms to last added payment term
     *
     * @param  float|null             $calculationPercent         __BT-X-280, From EXTENDED__ Percentage of the payment surcharge
     * @param  DateTimeInterface|null $basisDateTime              __BT-X-276, From EXTENDED__ Due date reference date
     * @param  float|null             $basisPeriodMeasureValue    __BT-X-277, From EXTENDED__ Maturity period (basis)
     * @param  string|null            $basisPeriodMeasureUnitCode __BT-X-278, From EXTENDED__ Maturity period (unit)
     * @param  float|null             $basisAmount                __BT-X-279, From EXTENDED__ Basic amount of the payment surcharge
     * @param  float|null             $actualPenaltyAmount        __BT-X-281, From EXTENDED__ Amount of the payment surcharge
     */
    public function add_penalty_terms_to_payment_terms(?float $calculation_percent = null, ?DateTimeInterface $basis_date_time = null, ?float $basis_period_measure_value = null, ?string $basis_period_measure_unit_code = null, ?float $basis_amount = null, ?float $actual_penalty_amount = null): Zugferd_Document_Builder
    {
        $penalty_terms = $this->get_object_helper()->get_trade_payment_penalty_terms_type($basis_date_time, $basis_period_measure_value, $basis_period_measure_unit_code, $basis_amount, $calculation_percent, $actual_penalty_amount);
        $this->get_object_helper()->try_call($this->current_payment_terms, 'setApplicableTradePaymentPenaltyTerms', $penalty_terms);
        return $this;
    }
    /**
     * Add a payment term in XRechnung-Style (in the Form #SKONTO#TAGE=14#PROZENT=1.00#BASISBETRAG=2.53#)
     *
     * @param  string                 $description                __BT-20, From _EN 16931 XRECHNUNG__ Text to add
     * @param  int[]                  $paymentDiscountDays        __BT-20, BR-DE-18, From _EN 16931 XRECHNUNG__ Array of Payment discount days (array of integer)
     * @param  float[]                $paymentDiscountPercents    __BT-20, BR-DE-18, From _EN 16931 XRECHNUNG__ Array of Payment discount percents (array of decimal)
     * @param  float[]                $paymentDiscountBaseAmounts __BT-20, BR-DE-18, From _EN 16931 XRECHNUNG__ Array of Payment discount base amounts (array of decimal)
     * @param  DateTimeInterface|null $dueDate                    __BT-9, From EN 16931 XRECHNUNG__ The date by which payment is due Note: The payment due date reflects the net payment due date. In the case of partial payments, this indicates the first due date of a net payment. The corresponding description of more complex payment terms can be given in BT-20.
     * @param  string|null            $directDebitMandateID       __BT-89, From EN 16931 XRECHNUNG__ Unique identifier assigned by the payee to reference the direct debit authorization.
     */
    public function add_document_payment_term_x_rechnung(string $description, array $payment_discount_days = [], array $payment_discount_percents = [], array $payment_discount_base_amounts = [], ?DateTimeInterface $due_date = null, ?string $direct_debit_mandate_id = null): Zugferd_Document_Builder
    {
        $payment_terms_description = [];
        if ($this->get_object_helper()->is_null_or_empty($description)) {
            return $this;
        }
        $payment_discount_days = array_filter($payment_discount_days, function ($k) use ($payment_discount_percents): bool {
            return isset($payment_discount_percents[$k]);
        }, ARRAY_FILTER_USE_KEY);
        if ($payment_discount_days === []) {
            return $this->add_document_payment_term(trim($description), $due_date, $direct_debit_mandate_id);
        }
        foreach ($payment_discount_days as $payment_discount_day_index => $payment_discount_day) {
            $payment_terms_description[] = sprintf(isset($payment_discount_base_amounts[$payment_discount_day_index]) ? '#SKONTO#TAGE=%s#PROZENT=%s#BASISBETRAG=%s#' : '#SKONTO#TAGE=%s#PROZENT=%s#', number_format($payment_discount_day, 0, '.', ''), number_format($payment_discount_percents[$payment_discount_day_index] ?? 0.0, 2, '.', ''), number_format($payment_discount_base_amounts[$payment_discount_day_index] ?? 0.0, 2, '.', ''));
        }
        return $this->add_document_payment_term(trim(sprintf("%s\n%s", implode("\n", $payment_terms_description), $description)), $due_date, $direct_debit_mandate_id);
    }
    /**
     * Add information on the booking reference
     *
     * @param  string      $id       __BT-19, From BASIC WL__ Posting reference of the byuer. If required, this reference shall be provided by the Buyer to the Seller prior to the issuing of the Invoice.
     * @param  string|null $typeCode __BT-X-290, From EXTENDED__ Type of the posting reference. Allowed values: 1 = Financial, 2 = Subsidiary, 3 = Budget, 4 = Cost Accounting, 5 = Payable, 6 = Job Cost Accounting
     */
    public function add_document_receivable_specified_trade_accounting_account(string $id, ?string $type_code = null): Zugferd_Document_Builder
    {
        $account = $this->get_object_helper()->get_trade_accounting_account_type($id, $type_code);
        $this->get_object_helper()->try_call_all($this->header_trade_settlement, ['addToReceivableSpecifiedTradeAccountingAccount', 'setReceivableSpecifiedTradeAccountingAccount'], $account);
        return $this;
    }
    /**
     * Initilize the main document summation
     */
    public function init_document_summation(): Zugferd_Document_Builder
    {
        $this->set_document_summation(0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
        return $this;
    }
    /**
     * Document money summation
     *
     * @param  float      $grandTotalAmount     __BT-112, From MINIMUM__ Total invoice amount including sales tax
     * @param  float      $duePayableAmount     __BT-115, From MINIMUM__ Payment amount due
     * @param  float|null $lineTotalAmount      __BT-106, From BASIC WL__ Sum of the net amounts of all invoice items
     * @param  float|null $chargeTotalAmount    __BT-108, From BASIC WL__ Sum of the surcharges at document level
     * @param  float|null $allowanceTotalAmount __BT-107, From BASIC WL__ Sum of the discounts at document level
     * @param  float|null $taxBasisTotalAmount  __BT-109, From MINIMUM__ Total invoice amount excluding sales tax
     * @param  float|null $taxTotalAmount       __BT-110/111, From MINIMUM/BASIC WL__ if BT-6 is not null $taxTotalAmount = BT-111. Total amount of the invoice sales tax, Total tax amount in the booking currency
     * @param  float|null $roundingAmount       __BT-114, From EN 16931__ Rounding amount
     * @param  float|null $totalPrepaidAmount   __BT-113, From BASIC WL__ Prepayment amount
     */
    public function set_document_summation(float $grand_total_amount, float $due_payable_amount, ?float $line_total_amount = null, ?float $charge_total_amount = null, ?float $allowance_total_amount = null, ?float $tax_basis_total_amount = null, ?float $tax_total_amount = null, ?float $rounding_amount = null, ?float $total_prepaid_amount = null): Zugferd_Document_Builder
    {
        $summation = $this->get_object_helper()->get_trade_settlement_header_monetary_summation_type($grand_total_amount, $due_payable_amount, $line_total_amount, $charge_total_amount, $allowance_total_amount, $tax_basis_total_amount, $tax_total_amount, $rounding_amount, $total_prepaid_amount);
        $this->get_object_helper()->try_call($this->header_trade_settlement, 'setSpecifiedTradeSettlementHeaderMonetarySummation', $summation);
        $tax_total_amount = $this->get_object_helper()->ensure_array($this->get_object_helper()->try_call_and_return($summation, 'getTaxTotalAmount'));
        if (isset($tax_total_amount[0])) {
            $invoice_currency_code = $this->get_object_helper()->try_call_by_path_and_return($this->header_trade_settlement, 'getInvoiceCurrencyCode.value');
            $this->get_object_helper()->try_call($tax_total_amount[0], 'setCurrencyID', $invoice_currency_code);
        }
        return $this;
    }
    /**
     * Adds a new position (line) to document
     *
     * @param string      $lineid               __BT-126, From BASIC__ Identification of the invoice item
     * @param string|null $lineStatusCode       __BT-X-7, From EXTENDED__ Indicates whether the invoice item contains prices that must be taken into account when calculating the invoice amount or whether only information is included.
     * @param string|null $lineStatusReasonCode __BT-X-8, From EXTENDED__ Adds the type to specify whether the invoice line is:
     *
     *                                          - DETAIL: detail (normal position)
     *                                          - GROUP: Subtotal
     *                                          - INFORMATION: Information only
     */
    public function add_new_position(string $lineid, ?string $line_status_code = null, ?string $line_status_reason_code = null): Zugferd_Document_Builder
    {
        $position = $this->get_object_helper()->get_supply_chain_trade_line_item_type($lineid, $line_status_code, $line_status_reason_code);
        $this->get_object_helper()->try_call($this->header_supply_chain_trade_transaction, 'addToIncludedSupplyChainTradeLineItem', $position);
        $this->current_position = $position;
        return $this;
    }
    /**
     * Adds a new text-only position (line) to document
     *
     * @param      string      $lineid               __BT-126, From BASIC__ Identification of the invoice item
     * @param      string|null $lineStatusCode       __BT-X-7, From EXTENDED__ Indicates whether the invoice item contains prices that must be taken into account when calculating the invoice amount or whether only information is included.
     * @param      string|null $lineStatusReasonCode __BT-X-8, From EXTENDED__ Adds the type to specify whether the invoice line is:
     * @deprecated 1.0.75
     */
    public function add_new_text_position(string $lineid, ?string $line_status_code = null, ?string $line_status_reason_code = null): Zugferd_Document_Builder
    {
        $position = $this->get_object_helper()->get_supply_chain_trade_line_item_type($lineid, $line_status_code, $line_status_reason_code, true);
        $this->get_object_helper()->try_call($this->header_supply_chain_trade_transaction, 'addToIncludedSupplyChainTradeLineItem', $position);
        $this->current_position = $position;
        return $this;
    }
    /**
     * Add detailed information on the free text on the position.
     *
     * @param  string      $content     __BT-127, From BASIC__ A free text that contains unstructured information that is relevant to the invoice item
     * @param  string|null $contentCode __BT-X-9, From EXTENDED__ A code to classify the content of the free text of the invoice. The code is agreed bilaterally and must have the same meaning as BT-127.
     * @param  string|null $subjectCode __BT-X-10, From EXTENDED__ Code for qualifying the free text for the invoice item (Codelist UNTDID 4451)
     */
    public function set_document_position_note(?string $content, ?string $content_code = null, ?string $subject_code = null): Zugferd_Document_Builder
    {
        $linedoc = $this->get_object_helper()->try_call_and_return($this->current_position, 'getAssociatedDocumentLineDocument');
        $note = $this->get_object_helper()->get_note_type($content, $content_code, $subject_code);
        $this->get_object_helper()->try_call_all($linedoc, ['addToIncludedNote', 'setIncludedNote'], $note);
        return $this;
    }
    /**
     * Adds product details to the last created position (line) in the document.
     *
     * @param  string      $name               __BT-153, From BASIC__ A name of the item (item name)
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
    public function set_document_position_product_details(string $name, ?string $description = null, ?string $seller_assigned_id = null, ?string $buyer_assigned_id = null, ?string $global_id_type = null, ?string $global_id = null, ?string $industry_assigned_id = null, ?string $model_id = null, ?string $batch_id = null, ?string $brand_name = null, ?string $model_name = null): Zugferd_Document_Builder
    {
        $product = $this->get_object_helper()->get_trade_product_type($name, $description, $seller_assigned_id, $buyer_assigned_id, $global_id_type, $global_id, $industry_assigned_id, $model_id, $batch_id, $brand_name, $model_name);
        $this->get_object_helper()->try_call($this->current_position, 'setSpecifiedTradeProduct', $product);
        return $this;
    }
    /**
     * Add extra characteristics to the formerly added product.
     * Contains information about the characteristics of the goods and services invoiced.
     *
     * @param  string      $description          __BT-160, From EN 16931__ The name of the attribute or property of the product such as "Colour"
     * @param  string      $value                __BT-161, From EN 16931__ The value of the attribute or property of the product such as "Red"
     * @param  string|null $typeCode             __BT-X-11, From EXTENDED__ Type of product characteristic (code). The codes must be taken from the UNTDID 6313 codelist.
     * @param  float|null  $valueMeasure         __BT-X-12, From EXTENDED__ Value of the product property (numerical measured variable)
     * @param  string|null $valueMeasureUnitCode __BT-X-12-0, From EXTENDED__ Unit of measurement code
     */
    public function add_document_position_product_characteristic(string $description, string $value, ?string $type_code = null, ?float $value_measure = null, ?string $value_measure_unit_code = null): Zugferd_Document_Builder
    {
        $product = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedTradeProduct');
        $product_characteristic = $this->get_object_helper()->get_product_characteristic_type($type_code, $description, $value_measure, $value_measure_unit_code, $value);
        $this->get_object_helper()->try_call($product, 'addToApplicableProductCharacteristic', $product_characteristic);
        return $this;
    }
    /**
     * Add detailed information on product classification.
     *
     * @param  string      $classCode     __BT-158, From EN 16931__ Item classification identifier. Classification codes are used for grouping similar items that can serve different purposes, such as public procurement (according to the Common Procurement Vocabulary ([CPV]), e-commerce (UNSPSC), etc.
     * @param  string|null $className     __BT-X-138, From EXTENDED__ Name with which an article can be classified according to type or quality.
     * @param  string|null $listId        __BT-158-1, From EN 16931__ The identifier for the identification scheme of the item classification identifier. The identification scheme must be selected from the entries in UNTDID 7143 [6].
     * @param  string|null $listVersionId __BT-158-2, From EN 16931__ The version of the identification scheme
     */
    public function add_document_position_product_classification(string $class_code, ?string $class_name = null, ?string $list_id = null, ?string $list_version_id = null): Zugferd_Document_Builder
    {
        $product = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedTradeProduct');
        $product_classification = $this->get_object_helper()->get_product_classification_type($class_code, $class_name, $list_id, $list_version_id);
        $this->get_object_helper()->try_call($product, 'addToDesignatedProductClassification', $product_classification);
        return $this;
    }
    /**
     * Add detailed information on included products. This information relates to the product that has just been added.
     *
     * @param  string      $name               __BT-X-18, From EXTENDED__ Name of the referenced product contained
     * @param  string|null $description        __BT-X-19, From EXTENDED__ Description of the included referenced product
     * @param  string|null $sellerAssignedID   __BT-X-16, From EXTENDED__ ID assigned by the seller of the contained referenced product
     * @param  string|null $buyerAssignedID    __BT-X-17, From EXTENDED__ ID of the referenced product assigned by the buyer
     * @param  string|null $globalID           __BT-X-15, From EXTENDED__ Global ID of the referenced product contained
     * @param  string|null $globalIDType       __BT-X-15-1, From EXTENDED__ Identification of the scheme
     * @param  float|null  $unitQuantity       __BT-X-20, From EXTENDED__ Quantity of the referenced product contained
     * @param  string|null $unitCode           __BT-X-20-1, From EXTENDED__ Unit code of Quantity of the referenced product contained
     * @param  string|null $industryAssignedID __BT-X-309, From EXTENDED__ ID of the referenced product contained assigned by the industry
     */
    public function add_document_position_referenced_product(string $name, ?string $description = null, ?string $seller_assigned_id = null, ?string $buyer_assigned_id = null, ?string $global_id = null, ?string $global_id_type = null, ?float $unit_quantity = null, ?string $unit_code = null, ?string $industry_assigned_id = null): Zugferd_Document_Builder
    {
        $product = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedTradeProduct');
        $referenced_product = $this->get_object_helper()->get_referenced_product_type($global_id, $global_id_type, $seller_assigned_id, $buyer_assigned_id, $industry_assigned_id, $name, $description, $unit_quantity, $unit_code);
        $this->get_object_helper()->try_call($product, 'addToIncludedReferencedProduct', $referenced_product);
        return $this;
    }
    /**
     * Sets the detailed information on the product origin.
     *
     * @param  string $country __BT-159, From EN 16931__ The code indicating the country the goods came from. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”.
     */
    public function set_document_position_product_origin_trade_country(string $country): Zugferd_Document_Builder
    {
        $product = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedTradeProduct');
        $product_trade_county = $this->get_object_helper()->get_trade_country_type($country);
        $this->get_object_helper()->try_call($product, 'setOriginTradeCountry', $product_trade_county);
        return $this;
    }
    /**
     * Set details of a sales order reference.
     *
     * @param  string                 $issuerAssignedId __BT-X-537, From EXTENDED__ Document number of a sales order reference
     * @param  string                 $lineId           __BT-X-538, From EXTENDED__ An identifier for a position within a sales order.
     * @param  DateTimeInterface|null $issueDate        __BT-X-539, From EXTENDED__ Date of sales order
     */
    public function set_document_position_seller_order_referenced_document(string $issuer_assigned_id, string $line_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $sellerorderrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'setSellerOrderReferencedDocument', $sellerorderrefdoc);
        return $this;
    }
    /**
     * Set details of the related buyer order position.
     *
     * @param  string                 $issuerAssignedId __BT-X-21, From EXTENDED__ An identifier issued by the buyer for a referenced order (order number)
     * @param  string                 $lineId           __BT-132, From EN 16931__ An identifier for a position within an order placed by the buyer. Note: Reference is made to the order reference at the document level.
     * @param  DateTimeInterface|null $issueDate        __BT-X-22, From EXTENDED__ Date of order
     */
    public function set_document_position_buyer_order_referenced_document(string $issuer_assigned_id, string $line_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $buyerorderrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'setBuyerOrderReferencedDocument', $buyerorderrefdoc);
        return $this;
    }
    /**
     * Set details of the associated offer position.
     *
     * @param  string                 $issuerAssignedId __BT-X-310, From EXTENDED__ Offer number
     * @param  string                 $lineId           __BT-X-311, From EXTENDED__ Position identifier within the offer
     * @param  DateTimeInterface|null $issueDate        __BT-X-312, From EXTENDED__ Date of offder
     */
    public function set_document_position_quotation_referenced_document(string $issuer_assigned_id, string $line_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $quotationrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'setQuotationReferencedDocument', $quotationrefdoc);
        return $this;
    }
    /**
     * Set details of the related contract position.
     *
     * @param  string                 $issuerAssignedId __BT-X-24, From EXTENDED__ The contract reference should be assigned once in the context of the specific trade relationship and for a defined period of time (contract number)
     * @param  string                 $lineId           __BT-X-25, From EXTENDED__ Identifier of the according contract position
     * @param  DateTimeInterface|null $issueDate        __BT-X-26, From EXTENDED__ Contract date
     */
    public function set_document_position_contract_referenced_document(string $issuer_assigned_id, string $line_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $contractrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'setContractReferencedDocument', $contractrefdoc);
        return $this;
    }
    /**
     * Add an additional Document reference on a position.
     *
     * The documents justifying the invoice can be used to reference a document number, which should be
     * known to the recipient, as well as an external document (referenced by a URL) or an embedded document (such
     * as a timesheet as a PDF file). The option of linking to an external document is e.g. required when it comes
     * to large attachments and / or sensitive information, e.g. for personal services, which must be separated
     * from the bill
     *
     * @param  string                 $issuerAssignedId   __BT-X-27, From EXTENDED__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param  string                 $typeCode           __BT-X-30, From EXTENDED__ Type of referenced document (See codelist UNTDID 1001)
     * @param  string|null            $uriId              __BT-X-28, From EXTENDED__ The Uniform Resource Locator (URL) at which the external document is available. A means of finding the resource including the primary access method intended for it, e.g. http: // or ftp: //. The location of the external document must be used if the buyer needs additional information to support the amounts billed. External documents are not part of the invoice. Access to external documents can involve certain risks.
     * @param  string|null            $lineId             __BT-X-29, From EXTENDED__ The referenced position identifier in the additional document
     * @param  string|null            $name               __BT-X-299, From EXTENDED__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     * @param  string|null            $refTypeCode        __BT-X-32, From EXTENDED__ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     * @param  DateTimeInterface|null $issueDate          __BT-X-33, From EXTENDED__ Document date
     * @param  string|null            $binaryDataFilename __BT-X-31, From EXTENDED__ Contains a file name of an attachment document embedded as a binary object
     */
    public function add_document_position_additional_referenced_document(string $issuer_assigned_id, string $type_code, ?string $uri_id = null, ?string $line_id = null, ?string $name = null, ?string $ref_type_code = null, ?DateTimeInterface $issue_date = null, ?string $binary_data_filename = null): Zugferd_Document_Builder
    {
        $addrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, $uri_id, $line_id, $type_code, $name, $ref_type_code, $issue_date, $binary_data_filename);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'addToAdditionalReferencedDocument', $addrefdoc);
        return $this;
    }
    /**
     * Add a referennce of a associated end customer order.
     *
     * @param  string                 $issuerAssignedId __BT-X-43, From EXTENDED__ Order number of the end customer
     * @param  string                 $lineId           __BT-X-44, From EXTENDED__ Order item (end customer)
     * @param  DateTimeInterface|null $issueDate        __BT-X-45, From EXTENDED__ Document date of end customer order
     */
    public function add_document_position_ultimate_customer_order_referenced_document(string $issuer_assigned_id, string $line_id, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $ultimaterefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'addToUltimateCustomerOrderReferencedDocument', $ultimaterefdoc);
        return $this;
    }
    /**
     * Set the unit price excluding sales tax before deduction of the discount on the item price.
     *
     * @param  float       $amount                __BT-148, From BASIC__ The unit price excluding sales tax before deduction of the discount on the item price. If the price is shown according to the net calculation, the price must also be shown according to the gross calculation.
     * @param  float|null  $basisQuantity         __BT-149-1, From BASIC__ The number of item units for which the price applies (price base quantity)
     * @param  string|null $basisQuantityUnitCode __BT-150-1, From BASIC__ The unit code of the number of item units for which the price applies (price base quantity)
     */
    public function set_document_position_gross_price(float $amount, ?float $basis_quantity = null, ?string $basis_quantity_unit_code = null): Zugferd_Document_Builder
    {
        $gross_price = $this->get_object_helper()->get_trade_price_type($amount, $basis_quantity, $basis_quantity_unit_code);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'setGrossPriceProductTradePrice', $gross_price);
        return $this;
    }
    /**
     * Detailed information on surcharges and discounts on item gross price.
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
    public function add_document_position_gross_price_allowance_charge(float $actual_amount, bool $is_charge, ?float $calculation_percent = null, ?float $basis_amount = null, ?string $reason = null, ?string $tax_type_code = null, ?string $tax_category_code = null, ?float $rate_applicable_percent = null, ?float $sequence = null, ?float $basis_quantity = null, ?string $basis_quantity_unit_code = null, ?string $reason_code = null): Zugferd_Document_Builder
    {
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $gross_price = $this->get_object_helper()->try_call_and_return($positionagreement, 'getGrossPriceProductTradePrice');
        $allowance_charge = $this->get_object_helper()->get_trade_allowance_charge_type($actual_amount, $is_charge, $tax_type_code, $tax_category_code, $rate_applicable_percent, $sequence, $calculation_percent, $basis_amount, $basis_quantity, $basis_quantity_unit_code, $reason_code, $reason);
        $this->get_object_helper()->try_call_all($gross_price, ['addToAppliedTradeAllowanceCharge', 'setAppliedTradeAllowanceCharge'], $allowance_charge);
        return $this;
    }
    /**
     * Set detailed information on the net price of the item.
     *
     * @param  float       $amount                __BT-146, From BASIC__ Net price of the item
     * @param  float|null  $basisQuantity         __BT-149, From BASIC__ Base quantity at the item price
     * @param  string|null $basisQuantityUnitCode __BT-150, From BASIC__ Code of the unit of measurement of the base quantity at the item price
     */
    public function set_document_position_net_price(float $amount, ?float $basis_quantity = null, ?string $basis_quantity_unit_code = null): Zugferd_Document_Builder
    {
        $net_price = $this->get_object_helper()->get_trade_price_type($amount, $basis_quantity, $basis_quantity_unit_code);
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $this->get_object_helper()->try_call($positionagreement, 'setNetPriceProductTradePrice', $net_price);
        return $this;
    }
    /**
     * Tax included for B2C on position level.
     *
     * @param  string      $categoryCode          __BT-, From __ Coded description of a sales tax category
     * @param  string      $typeCode              __BT-, From __ Coded description of a sales tax category. Note: Fixed value = "VAT"
     * @param  float       $rateApplicablePercent __BT-, From __ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param  float       $calculatedAmount      __BT-, From __ The total amount to be paid for the relevant VAT category. Note: Calculated by multiplying the amount to be taxed according to the sales tax category by the sales tax rate applicable for the sales tax category concerned
     * @param  string|null $exemptionReason       __BT-, From __ Reason for tax exemption (free text)
     * @param  string|null $exemptionReasonCode   __BT-, From __ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility.
     */
    public function set_document_position_net_price_tax(string $category_code, string $type_code, float $rate_applicable_percent, float $calculated_amount, ?string $exemption_reason = null, ?string $exemption_reason_code = null): Zugferd_Document_Builder
    {
        $positionagreement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeAgreement');
        $net_price = $this->get_object_helper()->try_call_and_return($positionagreement, 'getNetPriceProductTradePrice');
        $tax = $this->get_object_helper()->get_trade_tax_type($category_code, $type_code, null, $calculated_amount, $rate_applicable_percent, $exemption_reason, $exemption_reason_code);
        $this->get_object_helper()->try_call($net_price, 'setIncludedTradeTax', $tax);
        return $this;
    }
    /**
     * Set the position Quantity.
     *
     * @param  float       $billedQuantity             __BT-129, From BASIC__ The quantity of individual items (goods or services) billed in the relevant line
     * @param  string      $billedQuantityUnitCode     __BT-130, From BASIC__ The unit of measure applicable to the amount billed
     * @param  float|null  $chargeFreeQuantity         __BT-X-46, From EXTENDED__ Quantity, free of charge
     * @param  string|null $chargeFreeQuantityUnitCpde __BT-X-46-0, From EXTENDED__ Unit of measure code for the quantity free of charge
     * @param  float|null  $packageQuantity            __BT-X-47, From EXTENDED__ Number of packages
     * @param  string|null $packageQuantityUnitCode    __BT-X-47-0, From EXTENDED__ Unit of measure code for number of packages
     */
    public function set_document_position_quantity(float $billed_quantity, string $billed_quantity_unit_code, ?float $charge_free_quantity = null, ?string $charge_free_quantity_unit_cpde = null, ?float $package_quantity = null, ?string $package_quantity_unit_code = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $this->get_object_helper()->try_call($positiondelivery, 'setBilledQuantity', $this->get_object_helper()->get_quantity_type($billed_quantity, $billed_quantity_unit_code));
        $this->get_object_helper()->try_call($positiondelivery, 'setChargeFreeQuantity', $this->get_object_helper()->get_quantity_type($charge_free_quantity, $charge_free_quantity_unit_cpde));
        $this->get_object_helper()->try_call($positiondelivery, 'setPackageQuantity', $this->get_object_helper()->get_quantity_type($package_quantity, $package_quantity_unit_code));
        return $this;
    }
    /**
     * Set detailed information on the different ship-to party at position level.
     *
     * @param  string|null $name        __BT-X-50, From EXTENDED__ The name of the party to whom the goods are being delivered or for whom the services are being performed. Must be used if the recipient of the goods or services is not the same as the buyer.
     * @param  string|null $id          __BT-X-48, From EXTENDED__ An identifier for the place where the goods are delivered or where the services are provided. Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party (Obsolete)
     */
    public function set_document_position_ship_to(?string $name = null, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->get_trade_party_allow_empty($name, $id, $description);
        $this->get_object_helper()->try_call($positiondelivery, 'setShipToTradeParty', $ship_to_trade_party);
        return $this;
    }
    /**
     * Add a global id for the Ship-to Trade Party at position level.
     *
     * @param  string|null $globalID     __BT-X-49, From EXTENDED__ The identifier is uniquely assigned to a party by a global registration organization.
     * @param  string|null $globalIDType __BT-X-49-0, From EXTENDED__ If the identifier is used for the identification scheme, it must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_position_ship_to_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getShipToTradeParty');
        $this->get_object_helper()->try_call($ship_to_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to Ship-To Trade party at position level.
     *
     * @param  string|null $taxRegType __BT-X-66-0, From EXTENDED__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-X-66, From EXTENDED__ Tax number or sales tax identification number
     */
    public function add_document_position_ship_to_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getShipToTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the Ship-To party at position level.
     *
     * @param  string|null $lineOne     __BG-X-59, From EXTENDED__ The main line in the product end users address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BG-X-60, From EXTENDED__ Line 2 of the product end users address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BG-X-61, From EXTENDED__ Line 3 of the product end users address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BG-X-58, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BG-X-62, From EXTENDED__ Usual name of the city or municipality in which the product end users address is located
     * @param  string|null $country     __BG-X-63, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BG-X-64, From EXTENDED__ The product end users state
     */
    public function set_document_position_ship_to_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getShipToTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the Ship-To party on position level.
     *
     * @param  string|null $legalOrgId   __BT-X-51, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT-X-51-0, From EXTENDED__ Registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT-X-52, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_position_ship_to_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getShipToTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the Ship-To party on position level.
     *
     * @param  string|null $contactPersonName     __BT-X-54, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-54-1, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-55, From EXTENDED__ Detailed information on the party's phone number
     * @param  string|null $contactFaxNo          __BT-X-56, From EXTENDED__ Detailed information on the party's fax number
     * @param  string|null $contactEmailAddress   __BT-X-57, From EXTENDED__ Detailed information on the party's email address
     */
    public function set_document_position_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($ship_to_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an additional contact to the Ship-To party on position level.
     *
     * @param  string|null $contactPersonName     __BT-X-54, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT-X-54-1, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT-X-55, From EXTENDED__ Detailed information on the party's phone number
     * @param  string|null $contactFaxNo          __BT-X-56, From EXTENDED__ Detailed information on the party's fax number
     * @param  string|null $contactEmailAddress   __BT-X-57, From EXTENDED__ Detailed information on the party's email address
     */
    public function add_document_position_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($ship_to_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Detailed information on the different end recipient on position level.
     *
     * @param  string|null $name        __BT-X-69, From EXTENDED__ The name of the party to whom the goods are being delivered or for whom the services are being performed. Must be used if the recipient of the goods or services is not the same as the buyer.
     * @param  string|null $id          __BT-X-67, From EXTENDED__ An identifier for the party Multiple IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged identifier assigned by the buyer or seller.
     * @param  string|null $description __BT-, From __ Further legal information that is relevant for the party (Obsolete)
     */
    public function set_document_position_ultimate_ship_to(?string $name = null, ?string $id = null, ?string $description = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ship_to_trade_party = $this->get_object_helper()->get_trade_party_allow_empty($name, $id, $description);
        $this->get_object_helper()->try_call($positiondelivery, 'setUltimateShipToTradeParty', $ship_to_trade_party);
        return $this;
    }
    /**
     * Add a global id for the Ship-to Trade Party on position level.
     *
     * @param  string|null $globalID     __BT-X-68, From EXTENDED__ Global identifier of the parfty
     * @param  string|null $globalIDType __BT-X-68-0, From EXTENDED__ Type of global identification number, must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function add_document_position_ultimate_ship_to_global_id(?string $global_id = null, ?string $global_id_type = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getUltimateShipToTradeParty');
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'addToGlobalID', $this->get_object_helper()->get_id_type($global_id, $global_id_type));
        return $this;
    }
    /**
     * Add Tax registration to Ship-To Trade party on position level.
     *
     * @param  string|null $taxRegType __BT-X-84-0, From EXTENDED__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string|null $taxRegId   __BT-X-84, From EXTENDED__ Tax number or sales tax identification number
     */
    public function add_document_position_ultimate_ship_to_tax_registration(?string $tax_reg_type = null, ?string $tax_reg_id = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getUltimateShipToTradeParty');
        $tax_reg = $this->get_object_helper()->get_tax_registration_type($tax_reg_type, $tax_reg_id);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'addToSpecifiedTaxRegistration', $tax_reg);
        return $this;
    }
    /**
     * Sets the postal address of the Ship-To party on position level.
     *
     * @param  string|null $lineOne     __BT_X-77, From EXTENDED__ The main line in the party's address. This is usually the street name and house number or the post office box
     * @param  string|null $lineTwo     __BT_X-78, From EXTENDED__ Line 2 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $lineThree   __BT_X-79, From EXTENDED__ Line 3 of the party's address. This is an additional address line in an address that can be used to provide additional details in addition to the main line
     * @param  string|null $postCode    __BT_X-76, From EXTENDED__ Identifier for a group of properties, such as a zip code
     * @param  string|null $city        __BT_X-80, From EXTENDED__ Usual name of the city or municipality in which the party's address is located
     * @param  string|null $country     __BT_X-81, From EXTENDED__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their subdivisions”
     * @param  string|null $subDivision __BT_X-82, From EXTENDED__ The party's state
     */
    public function set_document_position_ultimate_ship_to_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getUltimateShipToTradeParty');
        $address = $this->get_object_helper()->get_trade_address($line_one, $line_two, $line_three, $post_code, $city, $country, $sub_division);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'setPostalTradeAddress', $address);
        return $this;
    }
    /**
     * Set legal organisation of the Ship-To party on position level.
     *
     * @param  string|null $legalOrgId   __BT_X-70, From EXTENDED__ An identifier issued by an official registrar that identifies the party as a legal entity or legal person. If no identification scheme ($legalorgtype) is provided, it should be known to the buyer or seller party
     * @param  string|null $legalOrgType __BT_X-70-0, From EXTENDED__ The identifier for the identification scheme of the legal registration of the party. In particular, the following scheme codes are used: 0021 : SWIFT, 0088 : EAN, 0060 : DUNS, 0177 : ODETTE
     * @param  string|null $legalOrgName __BT_X-71, From EXTENDED__ A name by which the party is known, if different from the party's name (also known as the company name)
     */
    public function set_document_position_ultimate_ship_to_legal_organisation(?string $legal_org_id, ?string $legal_org_type, ?string $legal_org_name): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getUltimateShipToTradeParty');
        $legal_org = $this->get_object_helper()->get_legal_organization($legal_org_id, $legal_org_type, $legal_org_name);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'setSpecifiedLegalOrganization', $legal_org);
        return $this;
    }
    /**
     * Set contact of the Ship-To party on position level.
     *
     * @param  string|null $contactPersonName     __BT_X-72, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT_X-72-1, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT_X-73, From EXTENDED__ Detailed information on the party's phone number
     * @param  string|null $contactFaxNo          __BT_X-74, From EXTENDED__ Detailed information on the party's fax number
     * @param  string|null $contactEmailAddress   __BT_X-75, From EXTENDED__ Detailed information on the party's email address
     */
    public function set_document_position_ultimate_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getUltimateShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call_if_method_exists($ultimate_ship_to_trade_party, 'addToDefinedTradeContact', 'setDefinedTradeContact', [$contact], $contact);
        return $this;
    }
    /**
     * Add an additional contact of the Ship-To party on position level.
     *
     * @param  string|null $contactPersonName     __BT_X-72, From EXTENDED__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $contactDepartmentName __BT_X-72-1, From EXTENDED__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $contactPhoneNo        __BT_X-73, From EXTENDED__ Detailed information on the party's phone number
     * @param  string|null $contactFaxNo          __BT_X-74, From EXTENDED__ Detailed information on the party's fax number
     * @param  string|null $contactEmailAddress   __BT_X-75, From EXTENDED__ Detailed information on the party's email address
     */
    public function add_document_position_ultimate_ship_to_contact(?string $contact_person_name, ?string $contact_department_name, ?string $contact_phone_no, ?string $contact_fax_no, ?string $contact_email_address): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $ultimate_ship_to_trade_party = $this->get_object_helper()->try_call_and_return($positiondelivery, 'getUltimateShipToTradeParty');
        $contact = $this->get_object_helper()->get_trade_contact($contact_person_name, $contact_department_name, $contact_phone_no, $contact_fax_no, $contact_email_address);
        $this->get_object_helper()->try_call($ultimate_ship_to_trade_party, 'addToDefinedTradeContact', $contact);
        return $this;
    }
    /**
     * Detailed information on the actual delivery on position level.
     *
     * @param  DateTimeInterface|null $date __BT-X-85, From EXTENDED__ Actual delivery date
     */
    public function set_document_position_supply_chain_event(?DateTimeInterface $date): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $supply_chainevent = $this->get_object_helper()->get_supply_chain_event_type($date);
        $this->get_object_helper()->try_call($positiondelivery, 'setActualDeliverySupplyChainEvent', $supply_chainevent);
        return $this;
    }
    /**
     * Detailed information on the associated shipping notification on position level.
     *
     * @param  string                 $issuerAssignedId __BT-X-86, From EXTENDED__ Shipping notification number
     * @param  string|null            $lineId           __BT-X-87, From EXTENDED__ Shipping notification position
     * @param  DateTimeInterface|null $issueDate        __BT-X-88, From EXTENDED__ Date of Shipping notification number
     */
    public function set_document_position_despatch_advice_referenced_document(string $issuer_assigned_id, ?string $line_id = null, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $despatchddvicerefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($positiondelivery, 'setDespatchAdviceReferencedDocument', $despatchddvicerefdoc);
        return $this;
    }
    /**
     * Detailed information on the associated goods receipt notification.
     *
     * @param  string                 $issuerAssignedId __BT-X-89, From EXTENDED__ Goods receipt number
     * @param  string|null            $lineId           __BT-X-90, From EXTENDED__ Goods receipt position
     * @param  DateTimeInterface|null $issueDate        __BT-X-91, From EXTENDED__ Date of Goods receipt
     */
    public function set_document_position_receiving_advice_referenced_document(string $issuer_assigned_id, ?string $line_id = null, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $receivingadvicerefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($positiondelivery, 'setReceivingAdviceReferencedDocument', $receivingadvicerefdoc);
        return $this;
    }
    /**
     * Detailed information on the associated delivery bill on position level.
     *
     * @param  string                 $issuerAssignedId __BT-X-92, From EXTENDED__ Delivery note number
     * @param  string|null            $lineId           __BT-X-93, From EXTENDED__ Delivery note position
     * @param  DateTimeInterface|null $issueDate        __BT-X-94, From EXTENDED__ Date of Delivery note
     */
    public function set_document_position_delivery_note_referenced_document(string $issuer_assigned_id, ?string $line_id = null, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $positiondelivery = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeDelivery');
        $deliverynoterefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $line_id, null, null, null, $issue_date);
        $this->get_object_helper()->try_call($positiondelivery, 'setDeliveryNoteReferencedDocument', $deliverynoterefdoc);
        return $this;
    }
    /**
     * Add information about the sales tax that applies to the goods and services invoiced in the relevant invoice line.
     *
     * @param  string      $categoryCode          __BT-151, From BASIC__ Coded description of a sales tax category
     * @param  string      $typeCode              __BT-151-0, From BASIC__ In EN 16931 only the tax type “sales tax” with the code “VAT” is supported. Should other types of tax be specified, such as an insurance tax or a mineral oil tax the EXTENDED profile must be used. The code for the tax type must then be taken from the code list UNTDID 5153.
     * @param  float       $rateApplicablePercent __BT-152, From BASIC__ The VAT rate applicable to the item invoiced and expressed as a percentage. Note: The code of the sales tax category and the category-specific sales tax rate  must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param  float|null  $calculatedAmount      __BT-, From __ Tax amount. Information only for taxes that are not VAT (Obsolete)
     * @param  string|null $exemptionReason       __BT-, From __ Reason for tax exemption (free text) (Obsolete)
     * @param  string|null $exemptionReasonCode   __BT-, From __ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility. (Obsolete)
     */
    public function add_document_position_tax(string $category_code, string $type_code, ?float $rate_applicable_percent, ?float $calculated_amount = null, ?string $exemption_reason = null, ?string $exemption_reason_code = null): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $tax = $this->get_object_helper()->get_trade_tax_type($category_code, $type_code, null, $calculated_amount, $rate_applicable_percent, $exemption_reason, $exemption_reason_code);
        $this->get_object_helper()->try_call_all($positionsettlement, ['addToApplicableTradeTax', 'setApplicableTradeTax'], $tax);
        return $this;
    }
    /**
     * Set information about the period relevant for the invoice item. Also known as the invoice line delivery period.
     *
     * @param  DateTimeInterface|null $startDate __BT-134, From BASIC__ Start of the billing period
     * @param  DateTimeInterface|null $endDate   __BT-135, From BASIC__ End of the billing period
     */
    public function set_document_position_billing_period(?DateTimeInterface $start_date, ?DateTimeInterface $end_date): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $period = $this->get_object_helper()->get_specified_period_type($start_date, $end_date);
        $this->get_object_helper()->try_call($positionsettlement, 'setBillingSpecifiedPeriod', $period);
        return $this;
    }
    /**
     * Add surcharges and discounts on position level.
     *
     * @param  float       $actualAmount       __BT-136/BT-141, From BASIC__ The surcharge/discount amount excluding sales tax
     * @param  boolean     $isCharge           __BT-27-1/BT-28-1, From BASIC__ (true for BT-/ and false for /BT-) Switch that indicates whether the following data refer to an allowance or a discount, true means that it is a surcharge
     * @param  float|null  $calculationPercent __BT-138, From BASIC__ The percentage that may be used in conjunction with the base invoice line discount amount to calculate the invoice line discount amount
     * @param  float|null  $basisAmount        __BT-137, From EN 16931__ The base amount that may be used in conjunction with the invoice line discount percentage to calculate the invoice line discount amount
     * @param  string|null $reasonCode         __BT-140/BT-145, From BASIC__ The reason given as a code for the invoice line discount
     * @param  string|null $reason             __BT-139/BT-144, From BASIC__ The reason given in text form for the invoice item discount/surcharge
     */
    public function add_document_position_allowance_charge(float $actual_amount, bool $is_charge, ?float $calculation_percent = null, ?float $basis_amount = null, ?string $reason_code = null, ?string $reason = null): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $allowance_charge = $this->get_object_helper()->get_trade_allowance_charge_type($actual_amount, $is_charge, null, null, null, null, $calculation_percent, $basis_amount, null, null, $reason_code, $reason);
        $this->get_object_helper()->try_call($positionsettlement, 'addToSpecifiedTradeAllowanceCharge', $allowance_charge);
        return $this;
    }
    /**
     * Set information on item totals.
     *
     * @param  float $lineTotalAmount __BT-131, From BASIC__ The total amount of the invoice item.
     */
    public function set_document_position_line_summation(float $line_total_amount): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $summation = $this->get_object_helper()->get_trade_settlement_line_monetary_summation_type($line_total_amount);
        $this->get_object_helper()->try_call($positionsettlement, 'setSpecifiedTradeSettlementLineMonetarySummation', $summation);
        return $this;
    }
    /**
     * Set information on item totals (with support for EXTENDED profile).
     *
     * @param  float $lineTotalAmount            __BT-131, From BASIC__ The total amount of the invoice item
     * @param  float $chargeTotalAmount          __BT-X-327, From EXTENDED__ Total amount of item surcharges
     * @param  float $allowanceTotalAmount       __BT-X-328, From EXTENDED__ Total amount of item discounts
     * @param  float $taxTotalAmount             __BT-X-329, From EXTENDED__ Total amount of item taxes
     * @param  float $grandTotalAmount           __BT-X-330, From EXTENDED__ Total gross amount of the item
     * @param  float $totalAllowanceChargeAmount __BT-X-98, From EXTENDED__ Total amount of item surcharges and discounts
     */
    public function set_document_position_line_summation_ext(float $line_total_amount, ?float $charge_total_amount = null, ?float $allowance_total_amount = null, ?float $tax_total_amount = null, ?float $grand_total_amount = null, ?float $total_allowance_charge_amount = null): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $summation = $this->get_object_helper()->get_trade_settlement_line_monetary_summation_type($line_total_amount, $charge_total_amount, $allowance_total_amount, $tax_total_amount, $grand_total_amount, $total_allowance_charge_amount);
        $this->get_object_helper()->try_call($positionsettlement, 'setSpecifiedTradeSettlementLineMonetarySummation', $summation);
        return $this;
    }
    /**
     * Add a Reference to the previous invoice (on position level).
     *
     * To be used if:
     *  - a previous invoice is corrected
     *  - reference is made from a final invoice to previous partial invoices
     *  - reference is made from a final invoice to previous invoices for advance payments.     *
     *
     * @param  string                 $issuerAssignedId __BT-X-331, From EXTENDED__ The identification of an invoice previously sent by the seller
     * @param  string                 $lineid           __BT-X-540, From EXTENDED__ Identification of the invoice item
     * @param  string|null            $typeCode         __BT-X-332, From EXTENDED__ Type of previous invoice (code)
     * @param  DateTimeInterface|null $issueDate        __BT-X-333, From EXTENDED__ Date of the previous invoice
     */
    public function add_document_position_invoice_referenced_document(string $issuer_assigned_id, string $lineid, ?string $type_code = null, ?DateTimeInterface $issue_date = null): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $invoicerefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, $lineid, $type_code, null, null, $issue_date);
        $this->get_object_helper()->try_call($positionsettlement, 'setInvoiceReferencedDocument', $invoicerefdoc);
        return $this;
    }
    /**
     * Add an additional Document reference on a position (Object detection).
     *
     * @param      string      $issuerAssignedId __BT-128, From EN 16931__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param      string      $typeCode         __BT-128-0, From EN 16931__ Type of referenced document (See codelist UNTDID 1001)
     * @param      string|null $refTypeCode      __BT-128-1, From EN 16931__ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     * @deprecated v1.0.110 Please use addDocumentPositionAdditionalReferencedObjDocument instead
     */
    public function add_document_position_additional_referenced_document_obj(string $issuer_assigned_id, string $type_code, ?string $ref_type_code = null): Zugferd_Document_Builder
    {
        return $this->add_document_position_additional_referenced_obj_document($issuer_assigned_id, $type_code, $ref_type_code);
    }
    /**
     * Add an additional Document reference on a position (Object detection).
     *
     * @param  string      $issuerAssignedId __BT-128, From EN 16931__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param  string      $typeCode         __BT-128-0, From EN 16931__ Type of referenced document (See codelist UNTDID 1001)
     * @param  string|null $refTypeCode      __BT-128-1, From EN 16931__ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     */
    public function add_document_position_additional_referenced_obj_document(string $issuer_assigned_id, string $type_code, ?string $ref_type_code = null): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $addrefdoc = $this->get_object_helper()->get_referenced_document_type($issuer_assigned_id, null, null, $type_code, null, $ref_type_code);
        $this->get_object_helper()->try_call_all($positionsettlement, ['addToAdditionalReferencedDocument', 'setAdditionalReferencedDocument'], $addrefdoc);
        return $this;
    }
    /**
     * Add an AccountingAccount on position level.
     *
     * @param  string      $id       __BT-133, From EN 16931__ Posting reference of the byuer. If required, this reference shall be provided by the Buyer to the Seller prior to the issuing of the Invoice.
     * @param  string|null $typeCode __BT-X-99, From EXTENDED__ Type of the posting reference. Allowed values: 1 = Financial, 2 = Subsidiary, 3 = Budget, 4 = Cost Accounting, 5 = Payable, 6 = Job Cost Accounting
     */
    public function add_document_position_receivable_specified_trade_accounting_account(string $id, ?string $type_code = null): Zugferd_Document_Builder
    {
        $positionsettlement = $this->get_object_helper()->try_call_and_return($this->current_position, 'getSpecifiedLineTradeSettlement');
        $account = $this->get_object_helper()->get_trade_accounting_account_type($id, $type_code);
        $this->get_object_helper()->try_call_all($positionsettlement, ['addToReceivableSpecifiedTradeAccountingAccount', 'setReceivableSpecifiedTradeAccountingAccount'], $account);
        return $this;
    }
}