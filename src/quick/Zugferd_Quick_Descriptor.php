<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd\quick;

use DateTime;
use horstoeko\stringmanagement\String_Utils;
use horstoeko\zugferd\codelists\Zugferd_Invoice_Type;
use horstoeko\zugferd\codelists\Zugferd_Payment_Means;
use horstoeko\zugferd\Zugferd_Document_Builder;
use horstoeko\zugferd\Zugferd_Profiles;
/**
 * Class representing the base class of all document descriptors.
 *
 * Creating them in a simple and common way in EN16931 profile
 * This class is slightly inspired by the invoicedescriptor of the
 * __https://github.com/stephanstapel/ZUGFeRD-csharp__ project
 *
 * This class contains only basic functionality
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Quick_Descriptor extends Zugferd_Document_Builder
{
    private const VT_TAXCATEGORY = 0;
    private const VT_TAXTYPE = 1;
    private const VT_TAXPERCENT = 2;
    private const VT_LINETOTALBASISAMOUNT = 3;
    private const VT_ALLOWANCEAMOUNT = 4;
    private const VT_CHARGEAMOUNT = 5;
    private const VT_ALLOWANCECHARGEAMOUNT = 6;
    private const VT_BASISAMOUNT = 7;
    private const VT_CALCULATEDAMOUNT = 8;
    private const VT_LOGSERVICECHARGE = 9;
    /**
     * Used for internal vat summation
     *
     * @var array
     */
    protected $vat_breakdown = [];
    /**
     * Internal storage for the prepaid amount. Will be used
     * in summation calculation
     *
     * @var float
     */
    protected $total_prepaid_amount = 0.0;
    /**
     * Internal flag to see if the totals are alread calculated
     *
     * @var boolean
     */
    protected $totals_are_calculated = false;
    /**
     * Returns the profile of the descriptor
     */
    protected static function get_profile(): int
    {
        return Zugferd_Profiles::PROFILE_EN16931;
    }
    /**
     * Creates a new ZugferdDocumentBuilder with profile EN16931
     */
    public static function do_create_new(): Zugferd_Quick_Descriptor
    {
        return static::create_new(static::get_profile());
    }
    /**
     * @inheritDoc
     *
     * @return void
     */
    protected function on_before_get_content()
    {
        $this->do_calc_totals();
    }
    /**
     * Create a new invoice
     *
     * @param  string      $invoiceNo          __BT-1, From MINIMUM__ The document no issued by the seller
     * @param  \DateTime   $invoiceDate        __BT-2, From MINIMUM__ Date of invoice. The date when the document was issued by the seller
     * @param  string      $currency           __BT-5, From MINIMUM__ Code for the invoice currency
     * @param  string|null $invoiceNoReference __BT-83, From BASIC WL__ Intended use for payment
     */
    public function do_create_invoice(string $invoice_no, \DateTime $invoice_date, string $currency, ?string $invoice_no_reference = null): Zugferd_Quick_Descriptor
    {
        $this->set_document_information($invoice_no, Zugferd_Invoice_Type::INVOICE, $invoice_date, $currency);
        $this->set_document_general_payment_information(null, $invoice_no_reference ?? $invoice_no);
        return $this;
    }
    /**
     * Create a new credit memo
     *
     * @param  string    $creditMemoNo          __BT-1, From MINIMUM__ The document no issued by the seller
     * @param  \DateTime $invoiceDate           __BT-2, From MINIMUM__ Date of invoice. The date when the document was issued by the seller
     * @param  string    $currency              __BT-5, From MINIMUM__ Code for the invoice currency
     * @param  string    $creditMemoNoReference __BT-83, From BASIC WL__ Intended use for refund. If null the number of the credit memo is used
     */
    public function do_create_credit_memo(string $credit_memo_no, \DateTime $invoice_date, string $currency, string $credit_memo_no_reference = ''): Zugferd_Quick_Descriptor
    {
        $this->set_document_information($credit_memo_no, Zugferd_Invoice_Type::CREDITNOTE, $invoice_date, $currency);
        $this->set_document_general_payment_information(null, String_Utils::string_is_null_or_empty($credit_memo_no_reference) ? $credit_memo_no : $credit_memo_no_reference);
        return $this;
    }
    /**
     * Add a payment term
     *
     * @param  string|null   $description __BT-20, From _BASIC WL__ A text description of the payment terms that apply to the payment amount due (including a description of possible penalties). Note: This element can contain multiple lines and multiple conditions.
     * @param  DateTime|null $dueDate     __BT-9, From BASIC WL__ The date by which payment is due Note: The payment due date reflects the net payment due date. In the case of partial payments, this indicates the first due date of a net payment. The corresponding description of more complex payment terms can be given in BT-20.
     */
    public function do_set_payment_terms(string $description, ?DateTime $due_date = null): Zugferd_Quick_Descriptor
    {
        $this->add_document_payment_term($description, $due_date);
        return $this;
    }
    /**
     * Set payment means to "direct debit"
     *
     * If $isSEPA is true code __31__ wil be useed for payment means code.
     * If $isSEPA is false code __59__ wil be useed for payment means code.
     *
     * @param  boolean $isSEPA    __BT-81, From BASIC WL__ The expected or used means of payment, expressed as a code. The entries from the UNTDID 4461 code list must be used. A distinction should be made between SEPA and non-SEPA payments as well as between credit payments, direct debits, card payments and other means of payment In particular, the following codes can be used:
     * @param  string  $buyerIban __BT-91, From BASIC WL__ The account to be debited by the direct debit
     */
    public function do_set_payment_means_for_debit_transfer(bool $is_sepa, string $buyer_iban): Zugferd_Quick_Descriptor
    {
        $this->add_document_payment_mean($is_sepa === false ? Zugferd_Payment_Means::UNTDID_4461_31 : Zugferd_Payment_Means::UNTDID_4461_59, null, null, null, null, $buyer_iban);
        return $this;
    }
    /**
     * Set payment means to "credit transfer"
     *
     * If $isSEPA is true code __58__ wil be useed for payment means code.
     * If $isSEPA is false code __30__ wil be useed for payment means code.
     *
     * @param  boolean     $isSEPA           __BT-81, From BASIC WL__ The expected or used means of payment, expressed as a code. The entries from the UNTDID 4461 code list must be used. A distinction should be made between SEPA and non-SEPA payments as well as between credit payments, direct debits, card payments and other means of payment In particular, the following codes can be used:
     * @param  string      $payeeIban        __BT-84, From BASIC WL__ A unique identifier for the financial account held with a payment service provider to which the payment should be made
     * @param  string|null $payeeAccountName __BT-85, From BASIC WL__ The name of the payment account held with a payment service provider to which the payment should be made
     * @param  string|null $payeePropId      __BT-BT-84-0, From BASIC WL__ National account number (not for SEPA)
     * @param  string|null $payeeBic         __BT-86, From EN 16931__ An identifier for the payment service provider with which the payment account is held
     */
    public function do_set_payment_means_for_credit_transfer(bool $is_sepa, string $payee_iban, ?string $payee_account_name = null, ?string $payee_prop_id = null, ?string $payee_bic = null): Zugferd_Quick_Descriptor
    {
        $this->add_document_payment_mean($is_sepa === false ? Zugferd_Payment_Means::UNTDID_4461_30 : Zugferd_Payment_Means::UNTDID_4461_58, null, null, null, null, null, $payee_iban, $payee_account_name, $payee_prop_id, $payee_bic);
        return $this;
    }
    /**
     * Set payment means to "Bank Card"
     *
     * @param  string $cardType       __BT-, From __ The type of the card
     * @param  string $cardId         __BT-87, From EN 16931__ The primary account number (PAN) to which the card used for payment belongs. In accordance with card payment security standards, an invoice should never contain a full payment card master account number. The following specification of the PCI Security Standards Council currently applies: The first 6 and last 4 digits at most are to be displayed
     * @param  string $cardHolderName __BT-88, From EN 16931__ Name of the payment card holder
     */
    public function do_set_payment_means_for_bank_card(string $card_type, string $card_id, string $card_holder_name): Zugferd_Quick_Descriptor
    {
        $this->add_document_payment_mean(Zugferd_Payment_Means::UNTDID_4461_48, null, $card_type, $card_id, $card_holder_name);
        return $this;
    }
    /**
     * Set payment means to "Credit Card"
     *
     * @param  string $cardType       __BT-, From __ The type of the card
     * @param  string $cardId         __BT-87, From EN 16931__ The primary account number (PAN) to which the card used for payment belongs. In accordance with card payment security standards, an invoice should never contain a full payment card master account number. The following specification of the PCI Security Standards Council currently applies: The first 6 and last 4 digits at most are to be displayed
     * @param  string $cardHolderName __BT-88, From EN 16931__ Name of the payment card holder
     */
    public function do_set_payment_means_for_credit_card(string $card_type, string $card_id, string $card_holder_name): Zugferd_Quick_Descriptor
    {
        $this->add_document_payment_mean(Zugferd_Payment_Means::UNTDID_4461_54, null, $card_type, $card_id, $card_holder_name);
        return $this;
    }
    /**
     * Set payment means to "Debit Card"
     *
     * @param  string $cardType       __BT-, From __ The type of the card
     * @param  string $cardId         __BT-87, From EN 16931__ The primary account number (PAN) to which the card used for payment belongs. In accordance with card payment security standards, an invoice should never contain a full payment card master account number. The following specification of the PCI Security Standards Council currently applies: The first 6 and last 4 digits at most are to be displayed
     * @param  string $cardHolderName __BT-88, From EN 16931__ Name of the payment card holder
     */
    public function do_set_payment_means_for_debit_card(string $card_type, string $card_id, string $card_holder_name): Zugferd_Quick_Descriptor
    {
        $this->add_document_payment_mean(Zugferd_Payment_Means::UNTDID_4461_55, null, $card_type, $card_id, $card_holder_name);
        return $this;
    }
    /**
     * Add note to the document
     *
     * @param  string      $note        __BT-22, From BASIC WL__ A free text containing unstructured information that is relevant to the invoice as a whole
     * @param  string|null $subjectCode __BT-21, From BASIC WL__ The qualification of the free text for the invoice from BT-22
     * @param  string|null $contentCode __BT-X-5, From EXTENDED__ A code to classify the content of the free text of the invoice
     */
    public function do_add_note(string $note, ?string $subject_code = null, ?string $content_code = null): Zugferd_Quick_Descriptor
    {
        $this->add_document_note($note, $content_code, $subject_code);
        return $this;
    }
    /**
     * Set details of the related buyer order
     *
     * @param  string   $orderNo   __BT-13, From MINIMUM__ An identifier issued by the buyer for a referenced order (order number)
     * @param  DateTime $orderDate __BT-X-147, From EXTENDED__ Date of order
     */
    public function do_set_buyer_order_reference_document(string $order_no, DateTime $order_date): Zugferd_Quick_Descriptor
    {
        $this->set_document_buyer_order_referenced_document($order_no, $order_date);
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
     * @param  string        $issuerAssignedID  __BT-122, From EN 16931__ The identifier of the tender or lot to which the invoice relates, or an identifier specified by the seller for an object on which the invoice is based, or an identifier of the document on which the invoice is based.
     * @param  DateTime|null $issueDateTime     __BT-X-149, From EXTENDED__ Document date
     * @param  string|null   $typeCode          __BT-122-0, From EN 16931__ Type of referenced document (See codelist UNTDID 1001)
     *                                          - Code 916 "reference paper" is used to reference the identification of the
     *                                          document on which the invoice is based - Code 50 "Price / sales catalog response"
     *                                          is used to reference the tender or the lot - Code 130 "invoice data sheet" is used
     *                                          to reference an identifier for an object specified by the seller.
     * @param  string|null   $name              __BT-123, From EN 16931__ A description of the document, e.g. Hourly billing, usage or consumption report, etc.
     * @param  string|null   $referenceTypeCode __BT-, From __ The identifier for the identification scheme of the identifier of the item invoiced. If it is not clear to the recipient which scheme is used for the identifier, an identifier of the scheme should be used, which must be selected from UNTDID 1153 in accordance with the code list entries.
     * @param  string|null   $filename          __BT-125, From EN 16931__ Contains a file name of an attachment document embedded as a binary object
     */
    public function do_add_additional_referenced_document(string $issuer_assigned_id, ?DateTime $issue_date_time = null, ?string $type_code = null, ?string $name = null, ?string $reference_type_code = null, ?string $filename = null): Zugferd_Quick_Descriptor
    {
        $this->add_document_additional_referenced_document($issuer_assigned_id, $type_code, null, $name, $reference_type_code, $issue_date_time, $filename);
        return $this;
    }
    /**
     * Set detailed information on the associated delivery note
     *
     * @param  string   $deliveryNoteNo   __BT-X-202, From EXTENDED__ Delivery slip number
     * @param  DateTime $deliveryNoteDate __BT-X-203, From EXTENDED__ Delivery slip date
     */
    public function do_set_delivery_note_reference_document(string $delivery_note_no, DateTime $delivery_note_date): Zugferd_Quick_Descriptor
    {
        $this->set_document_delivery_note_referenced_document($delivery_note_no, $delivery_note_date);
        return $this;
    }
    /**
     * Set a Reference to the previous invoice
     *
     * __Note__: To be used if:
     *  - a previous invoice is corrected
     *  - reference is made to previous partial invoices from a final invoice
     *  - Reference is made to previous invoices for advance payments from a final invoice
     *
     * @param  string        $id            __BT-25, From BASIC WL__ The identification of an invoice previously sent by the seller
     * @param  DateTime|null $issueDateTime __BT-26, From BASIC WL__ Date of the previous invoice
     */
    public function do_set_invoice_referenced_document(string $id, ?DateTime $issue_date_time = null): Zugferd_Quick_Descriptor
    {
        $this->set_document_invoice_referenced_document($id, null, $issue_date_time);
        return $this;
    }
    /**
     * Set Details of a project reference
     *
     * @param  string $id   __BT-11, From EN 16931__ The identifier of the project to which the invoice relates
     * @param  string $name __BT-11-0, From EN 16931__  The name of the project to which the invoice relates
     */
    public function do_set_specified_procuring_project(string $id, string $name): Zugferd_Quick_Descriptor
    {
        $this->set_document_procuring_project($id, $name);
        return $this;
    }
    /**
     * Set detailed information on the actual delivery
     *
     * @param  DateTime|null $date __BT-72, From BASIC WL__ Actual delivery time
     */
    public function do_set_supply_chain_event(?DateTime $date): Zugferd_Quick_Descriptor
    {
        $this->set_document_supply_chain_event($date);
        return $this;
    }
    /**
     * Detailed information about the buyer (service recipient)
     *
     * @param  string      $name           __BT-44, From MINIMUM__ The full name of the buyer
     * @param  string      $postcode       __BT-53, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string      $city           __BT-52, From BASIC WL__ Usual name of the city or municipality in which the buyers address is located
     * @param  string      $street         __BT-50, From BASIC WL__ The main line in the buyers address. This is usually the street name and house number or the post office box
     * @param  string      $country        __BT-55, From BASIC WL__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their
     *                                     subdivisions”
     * @param  string      $buyerReference __BT-10, From MINIMUM__ An identifier assigned by the buyer and used for internal routing
     * @param  string      $id             __BT-46, From BASIC WL__ An identifier of the buyer. In many systems, buyer identification is key information. Multiple buyer IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and buyer, e.g. a previously exchanged, seller-assigned identifier of the buyer
     * @param  string|null $globalID       __BT-46-0, From BASIC WL__ The buyers's identifier identification scheme is an identifier uniquely assigned to a buyer by a global registration organization.
     * @param  string|null $globalIDscheme __BT-46-1, From BASIC WL__ If the identifier is used for the identification scheme, it must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function do_set_buyer(string $name, string $postcode, string $city, string $street, string $country, ?string $buyer_reference = null, ?string $id = null, ?string $global_id = null, ?string $global_i_dscheme = null): Zugferd_Quick_Descriptor
    {
        $this->set_document_buyer($name, $id);
        $this->set_document_buyer_address($street, null, null, $postcode, $city, $country);
        $this->add_document_buyer_global_id($global_id, $global_i_dscheme);
        if ($buyer_reference != null) {
            $this->set_document_buyer_reference($buyer_reference);
        }
        return $this;
    }
    /**
     * Set contact of the buyer party
     *
     * @param  string      $name         __BT-56, From EN 16931__ Contact point for a legal entity, such as a personal name of the contact person
     * @param  string|null $orgunit      __BT-56-0, From EN 16931__ Contact point for a legal entity, such as a name of the department or office
     * @param  string|null $emailAddress __BT-58, From EN 16931__ An e-mail address of the contact point
     * @param  string|null $phoneno      __BT-57, From EN 16931__ A telephone number for the contact point
     * @param  string|null $faxno        __BT-X-115, From EXTENDED__ A fax number of the contact point
     */
    public function do_set_buyer_contact(string $name, ?string $orgunit = null, ?string $email_address = null, ?string $phoneno = null, ?string $faxno = null): Zugferd_Quick_Descriptor
    {
        $this->set_document_buyer_contact($name, $orgunit, $phoneno, $faxno, $email_address);
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
     * @param  string $no       __BT-48-0, From BASIC WL__ Type of tax number (FC = Tax number, VA = Sales tax identification number)
     * @param  string $schemeID __BT-48, From BASIC WL__ Tax number or sales tax identification number
     */
    public function do_add_buyer_tax_registration(string $no, string $scheme_id): Zugferd_Quick_Descriptor
    {
        $this->add_document_buyer_tax_registration($scheme_id, $no);
        return $this;
    }
    /**
     * Set Buyers electronic communication information
     *
     * @param  string $uri       __BT-49, From BASIC WL__ Specifies the buyer's electronic address to which the invoice is sent
     * @param  string $uriScheme __BT-49-1, From BASIC WL__ The identifier for the identification scheme of the buyer's electronic address (Default: EM)
     */
    public function do_set_buyer_electronic_communication(string $uri, string $uri_scheme = 'EM'): Zugferd_Quick_Descriptor
    {
        $this->set_document_buyer_communication($uri_scheme, $uri);
        return $this;
    }
    /**
     * Detailed information about the seller (=service provider)
     *
     * @param  string      $name           __BT-27, From MINIMUM__ The full formal name under which the seller is registered in the National Register of Legal Entities, Taxable Person or otherwise acting as person(s)
     * @param  string      $postcode       __BT-38, From BASIC WL__ Identifier for a group of properties, such as a zip code
     * @param  string      $city           __BT-37, From BASIC WL__ Usual name of the city or municipality in which the seller's address is located
     * @param  string      $street         __BT-35, From BASIC WL__ The main line in the sellers address. This is usually the street name and house number or the post office box
     * @param  string      $country        __BT-40, From MINIMUM__ Code used to identify the country. If no tax agent is specified, this is the country in which the sales tax is due. The lists of approved countries are maintained by the EN ISO 3166-1 Maintenance Agency “Codes for the representation of names of countries and their
     *                                     subdivisions”
     * @param  string|null $id             __BT-29, From BASIC WL__ An identifier of the seller. In many systems, seller identification is key information. Multiple seller IDs can be assigned or specified. They can be differentiated by using different identification schemes. If no scheme is given, it should be known to the buyer and seller, e.g. a previously exchanged, buyer-assigned identifier of the seller
     * @param  string|null $globalID       __BT-29/BT-29-0, From BASIC WL__ The seller's identifier identification scheme is an identifier uniquely assigned to a seller by a global registration organization.
     * @param  string|null $globalIDscheme __BT-29-1, From BASIC WL__ If the identifier is used for the identification scheme, it must be selected from the entries in the list published by the ISO / IEC 6523 Maintenance Agency.
     */
    public function do_set_seller(string $name, string $postcode, string $city, string $street, string $country, ?string $id = null, ?string $global_id = null, ?string $global_i_dscheme = null): Zugferd_Quick_Descriptor
    {
        $this->set_document_seller($name, $id);
        $this->set_document_seller_address($street, null, null, $postcode, $city, $country);
        $this->add_document_seller_global_id($global_id, $global_i_dscheme);
        return $this;
    }
    /**
     * Set contact of the seller party
     *
     * @param  string      $name         __BT-41, From EN 16931__ Such as personal name, name of contact person or department or office
     * @param  string|null $orgunit      __BT-41-0, From EN 16931__ If a contact person is specified, either the name or the department must be transmitted.
     * @param  string|null $emailAddress __BT-43, From EN 16931__ An e-mail address of the contact point
     * @param  string|null $phoneno      __BT-42, From EN 16931__ A telephone number for the contact point
     * @param  string|null $faxno        __BT-X-107, From EXTENDED__ A fax number of the contact point
     */
    public function do_set_seller_contact(string $name, ?string $orgunit = null, ?string $email_address = null, ?string $phoneno = null, ?string $faxno = null): Zugferd_Quick_Descriptor
    {
        $this->set_document_seller_contact($name, $orgunit, $phoneno, $faxno, $email_address);
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
     * @param  string $no       __BT-31/32, From MINIMUM/EN 16931__ Tax number of the seller or sales tax identification number of the seller
     * @param  string $schemeID __BT-31-0/BT-32-0, From MINIMUM/EN 16931__ Type of tax number of the seller (FC = Tax number, VA = Sales tax identification number)
     */
    public function do_add_seller_tax_registration(string $no, string $scheme_id): Zugferd_Quick_Descriptor
    {
        $this->add_document_seller_tax_registration($no, $scheme_id);
        return $this;
    }
    /**
     * Set Sellers electronic communication information
     *
     * @param  string $uri       __BT-34, From BASIC WL__ Specifies the electronic address of the seller to which the response to the invoice can be sent at application level
     * @param  string $uriScheme __BT-34-1, From BASIC WL__ The identifier for the identification scheme of the seller's electronic address (Default: EM)
     */
    public function do_set_seller_electronic_communication(string $uri, string $uri_scheme = 'EM'): Zugferd_Quick_Descriptor
    {
        $this->set_document_seller_communication($uri_scheme, $uri);
        return $this;
    }
    /**
     * Add a new text position
     *
     * @param      string $lineId  __BT-126, From BASIC__ Identification of the invoice item
     * @param      string $comment __BT-127, From BASIC__ A free text that contains unstructured information that is relevant to the invoice item
     * @deprecated 1.0.75
     */
    public function do_add_trade_line_comment_item(string $line_id, string $comment): Zugferd_Quick_Descriptor
    {
        $this->add_new_text_position($line_id);
        $this->set_document_position_note($comment);
        return $this;
    }
    /**
     * Adds a new position (line) to document
     *
     * @param  string $lineId                __BT-126, From BASIC__ Identification of the invoice item
     * @param  string $productName           __BT-153, From BASIC__ A name of the item (item name)
     * @param  float  $unitPrice             __BT-146, From BASIC__ Net price of the item
     * @param  float  $quantity              __BT-129, From BASIC__ The quantity of individual items (goods or services) billed in the relevant line
     * @param  string $unitCode              __BT-130, From BASIC__ The unit of measure applicable to the amount billed
     * @param  float  $allowanceChargeAmount __BT-136/BT-141, From BASIC__ The surcharge/discount amount excluding sales tax
     * @param  string $allowanceChargeReason __BT-139/BT-144, From BASIC__ The reason given in text form for the invoice item discount/surcharge
     * @param  string $taxCategoryCode       __BT-151, From BASIC__ Coded description of a sales tax category
     * @param  string $taxTypeCode           __BT-151-0, From BASIC__ In EN 16931 only the tax type “sales tax” with the code “VAT” is supported. Should other types of tax be specified, such as an insurance tax or a mineral oil tax the EXTENDED profile must be used. The code for the tax type must then be taken from the code list
     *                                       UNTDID 5153.
     * @param  float  $taxPercent            __BT-152, From BASIC__ The VAT rate applicable to the item invoiced and expressed as a percentage. Note: The code of the sales tax category and the category-specific sales tax rate  must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function do_add_trade_line_item(string $line_id, string $product_name, float $unit_price, float $quantity, string $unit_code, float $allowance_charge_amount, string $allowance_charge_reason, string $tax_category_code, string $tax_type_code, float $tax_percent): Zugferd_Quick_Descriptor
    {
        $has_charge_amount_is_allowance = $allowance_charge_amount != 0.0;
        $allowance_charge_amount_is_allowance = $allowance_charge_amount < 0.0;
        $allowance_amount = $allowance_charge_amount_is_allowance ? abs($allowance_charge_amount) : 0.0;
        $charge_amount = $allowance_charge_amount_is_allowance === false ? abs($allowance_charge_amount) : 0.0;
        $allowance_charge_amount = abs($allowance_charge_amount);
        $line_total_amount = round($unit_price * $quantity + $charge_amount - $allowance_amount, 2);
        $this->add_new_position($line_id);
        $this->set_document_position_product_details($product_name);
        $this->set_document_position_net_price($unit_price);
        $this->set_document_position_quantity($quantity, $unit_code);
        $this->add_document_position_tax($tax_category_code, $tax_type_code, $tax_percent);
        $this->set_document_position_line_summation($line_total_amount);
        if ($has_charge_amount_is_allowance == true) {
            $this->add_document_position_allowance_charge($allowance_charge_amount, $allowance_charge_amount_is_allowance === false, null, null, null, $allowance_charge_reason);
        }
        $this->add_to_internal_vat_buffer($tax_category_code, $tax_type_code, $tax_percent, $line_total_amount, 0.0, 0.0, 0.0);
        return $this;
    }
    /**
     * Add detailed information on the free text on the position
     *
     * @param  string $content __BT-127, From BASIC__ A free text that contains unstructured information that is relevant to the invoice item
     */
    public function do_set_document_position_note(string $content): Zugferd_Quick_Descriptor
    {
        $this->set_document_position_note($content);
        return $this;
    }
    /**
     * Adds a new position (line) to document with a surcharge amount
     *
     * @param  string $lineId          __BT-126, From BASIC__ Identification of the invoice item
     * @param  string $productName     __BT-153, From BASIC__ A name of the item (item name)
     * @param  float  $unitPrice       __BT-146, From BASIC__ Net price of the item
     * @param  float  $quantity        __BT-129, From BASIC__ The quantity of individual items (goods or services) billed in the relevant line
     * @param  string $unitCode        __BT-130, From BASIC__ The unit of measure applicable to the amount billed
     * @param  float  $chargeAmount    __BT-136/BT-141, From BASIC__ The surcharge amount excluding sales tax
     * @param  string $chargeReason    __BT-139/BT-144, From BASIC__ The reason given in text form for the invoice item surcharge
     * @param  string $taxCategoryCode __BT-151, From BASIC__ Coded description of a sales tax category
     * @param  string $taxTypeCode     __BT-151-0, From BASIC__ In EN 16931 only the tax type “sales tax” with the code “VAT” is supported. Should other types of tax be specified, such as an insurance tax or a mineral oil tax the EXTENDED profile must be used. The code for the tax type must then be taken from the code list
     *                                 UNTDID 5153.
     * @param  float  $taxPercent      __BT-152, From BASIC__ The VAT rate applicable to the item invoiced and expressed as a percentage. Note: The code of the sales tax category and the category-specific sales tax rate  must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function do_add_trade_line_item_with_surcharge(string $line_id, string $product_name, float $unit_price, float $charge_amount, string $charge_reason, float $quantity, string $unit_code, string $tax_category_code, string $tax_type_code, float $tax_percent): Zugferd_Quick_Descriptor
    {
        $this->do_add_trade_line_item($line_id, $product_name, $unit_price, $quantity, $unit_code, abs($charge_amount), $charge_reason, $tax_category_code, $tax_type_code, $tax_percent);
        return $this;
    }
    /**
     * Adds a new position (line) to document with a discount amount
     *
     * @param  string $lineId          __BT-126, From BASIC__ Identification of the invoice item
     * @param  string $productName     __BT-153, From BASIC__ A name of the item (item name)
     * @param  float  $unitPrice       __BT-146, From BASIC__ Net price of the item
     * @param  float  $quantity        __BT-129, From BASIC__ The quantity of individual items (goods or services) billed in the relevant line
     * @param  string $unitCode        __BT-130, From BASIC__ The unit of measure applicable to the amount billed
     * @param  float  $discountAmount  __BT-136/BT-141, From BASIC__ The discount amount excluding sales tax
     * @param  string $discountReason  __BT-139/BT-144, From BASIC__ The reason given in text form for the invoice item discount
     * @param  string $taxCategoryCode __BT-151, From BASIC__ Coded description of a sales tax category
     * @param  string $taxTypeCode     __BT-151-0, From BASIC__ In EN 16931 only the tax type “sales tax” with the code “VAT” is supported. Should other types of tax be specified, such as an insurance tax or a mineral oil tax the EXTENDED profile must be used. The code for the tax type must then be taken from the code list
     *                                 UNTDID 5153.
     * @param  float  $taxPercent      __BT-152, From BASIC__ The VAT rate applicable to the item invoiced and expressed as a percentage. Note: The code of the sales tax category and the category-specific sales tax rate  must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function do_add_trade_line_item_with_discount(string $line_id, string $product_name, float $unit_price, float $discount_amount, string $discount_reason, float $quantity, string $unit_code, string $tax_category_code, string $tax_type_code, float $tax_percent): Zugferd_Quick_Descriptor
    {
        $this->do_add_trade_line_item($line_id, $product_name, $unit_price, $quantity, $unit_code, -abs($discount_amount), $discount_reason, $tax_category_code, $tax_type_code, $tax_percent);
        return $this;
    }
    /**
     * Add a logistical service fees (On document level)
     *
     * @param  float  $amount          __BT-X-272, From EXTENDED__ Amount of the service fee
     * @param  string $description     __BT-X-271, From EXTENDED__ Identification of the service fee
     * @param  string $taxTypeCode     __BT-X-273-0, From EXTENDED__ Code of the Tax type. Note: Fixed value = "VAT"
     * @param  string $taxCategoryCode __BT-X-273, From EXTENDED__ Code of the VAT category
     * @param  float  $taxPercent      __BT-X-274, From EXTENDED__ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function do_add_logistics_service_charge(float $amount, string $description, string $tax_type_code, string $tax_category_code, float $tax_percent): Zugferd_Quick_Descriptor
    {
        $this->add_document_logistics_service_charge($description, $amount, [$tax_type_code], [$tax_category_code], [$tax_percent]);
        $this->add_to_internal_vat_buffer($tax_category_code, $tax_type_code, $tax_percent, 0.0, 0.0, 0.0, $amount);
        return $this;
    }
    /**
     * Add information about surcharges and charges applicable to the bill as a whole, Deductions,
     * such as for withheld taxes may also be specified in this group
     *
     * @param  float  $actualAmount    __BT-92/BT-99, From BASIC WL__ Amount of the surcharge or discount at document level
     * @param  string $reason          __BT-97/BT-104, From BASIC WL__ The reason given in text form for the surcharge or discount at document level
     * @param  string $taxCategoryCode __BT-95/BT-102, From BASIC WL__ A coded indication of which sales tax category applies to the surcharge or deduction at document level
     * @param  string $taxTypeCode     __BT-95-0/BT-102-0, From BASIC WL__ Code for the VAT category of the surcharge or charge at document level. Note: Fixed value = "VAT"
     * @param  float  $taxPercent      __BT-96/BT-103, From BASIC WL__ VAT rate for the surcharge or discount on document level. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     */
    public function do_add_trade_allowance_charge(float $actual_amount, string $reason, string $tax_category_code, string $tax_type_code, float $tax_percent): Zugferd_Quick_Descriptor
    {
        if ($actual_amount == 0.0) {
            return $this;
        }
        $allowance_charge_amount_is_allowance = $actual_amount < 0.0;
        $allowance_amount = $allowance_charge_amount_is_allowance ? abs($actual_amount) : 0.0;
        $charge_amount = $allowance_charge_amount_is_allowance === false ? abs($actual_amount) : 0.0;
        $this->add_document_allowance_charge(abs($actual_amount), $allowance_charge_amount_is_allowance == false, $tax_category_code, $tax_type_code, $tax_percent, null, null, null, null, null, null, $reason);
        $this->add_to_internal_vat_buffer($tax_category_code, $tax_type_code, $tax_percent, 0.0, $charge_amount, $allowance_amount, 0.0);
        return $this;
    }
    /**
     * Add a VAT breakdown (at document level)
     *
     * @param  float       $basisAmount                __BT-116, From BASIC WL__ Tax base amount, Each sales tax breakdown must show a category-specific tax base amount.
     * @param  float       $percent                    __BT-119, From BASIC WL__ The sales tax rate, expressed as the percentage applicable to the sales tax category in question. Note: The code of the sales tax category and the category-specific sales tax rate must correspond to one another. The value to be given is the percentage. For example, the value 20 is given for 20% (and not 0.2)
     * @param  string      $categoryCode               __BT-118, From BASIC WL__ Coded description of a sales tax category
     * @param  string|null $typeCode                   __BT-118-0, From BASIC WL__ Coded description of a sales tax category. Note: Fixed value = "VAT"
     * @param  float|null  $allowanceChargeBasisAmount __BT-X-263, From EXTENDED__ Total amount Additions and deductions to the tax rate at document level
     * @param  string|null $exemptionReasonCode        __BT-121, From BASIC WL__ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility.
     * @param  string|null $exemptionReason            __BT-120, From BASIC WL__ Reason for tax exemption (free text)
     */
    public function do_add_applicable_trade_tax(float $basis_amount, float $percent, string $category_code, ?string $type_code = null, ?float $allowance_charge_basis_amount = null, ?string $exemption_reason_code = null, ?string $exemption_reason = null): Zugferd_Quick_Descriptor
    {
        $this->add_document_tax($category_code, $type_code ?? 'VAT', $basis_amount, round(0.01 * $percent * $basis_amount, 2), $percent, $exemption_reason, $exemption_reason_code, null, $allowance_charge_basis_amount);
        return $this;
    }
    /**
     * Add a VAT breakdown (at document level)
     *
     * @param  float       $basisAmount                __BT-116, From BASIC WL__ Tax base amount, Each sales tax breakdown must show a category-specific tax base amount.
     * @param  float       $calculatedAmount           __BT-117, From BASIC WL__ The total amount to be paid for the relevant VAT category. Note: Calculated by multiplying the amount to be taxed according to the sales tax category by the sales tax rate applicable for the sales tax category concerned
     * @param  string      $categoryCode               __BT-118, From BASIC WL__ Coded description of a sales tax category
     * @param  string|null $typeCode                   __BT-118-0, From BASIC WL__ Coded description of a sales tax category. Note: Fixed value = "VAT"
     * @param  float|null  $allowanceChargeBasisAmount __BT-X-263, From EXTENDED__ Total amount Additions and deductions to the tax rate at document level
     * @param  string|null $exemptionReasonCode        __BT-121, From BASIC WL__ Reason given in code form for the exemption of the amount from VAT. Note: Code list issued and maintained by the Connecting Europe Facility.
     * @param  string|null $exemptionReason            __BT-120, From BASIC WL__ Reason for tax exemption (free text)
     */
    public function do_add_applicable_trade_tax2(float $basis_amount, float $calculated_amount, string $category_code, ?string $type_code = null, ?float $allowance_charge_basis_amount = null, ?string $exemption_reason_code = null, ?string $exemption_reason = null): Zugferd_Quick_Descriptor
    {
        $this->add_document_tax($category_code, $type_code ?? 'VAT', $basis_amount, $calculated_amount, round($calculated_amount * 100.0 / $basis_amount, 2), $exemption_reason, $exemption_reason_code, null, $allowance_charge_basis_amount);
        return $this;
    }
    /**
     * Sets the prepaid amount
     *
     * @param  float $totalPrepaidAmount __BT-113, From BASIC WL__ Prepayment amount
     */
    public function do_set_prepaid_amount(float $total_prepaid_amount = 0.0): Zugferd_Quick_Descriptor
    {
        $this->total_prepaid_amount = $total_prepaid_amount;
        return $this;
    }
    /**
     * Writes the vat breakdowns and the summation of the document
     */
    protected function do_calc_totals(): Zugferd_Quick_Descriptor
    {
        if ($this->totals_are_calculated !== false) {
            return $this;
        }
        $this->write_vat_break_down();
        $this->set_document_summation($this->summarize_vat_table_element(self::VT_BASISAMOUNT) + $this->summarize_vat_table_element(self::VT_CALCULATEDAMOUNT), $this->summarize_vat_table_element(self::VT_BASISAMOUNT) + $this->summarize_vat_table_element(self::VT_CALCULATEDAMOUNT) - $this->total_prepaid_amount, $this->summarize_vat_table_element(self::VT_LINETOTALBASISAMOUNT), $this->summarize_vat_table_element(self::VT_CHARGEAMOUNT) + $this->summarize_vat_table_element(self::VT_LOGSERVICECHARGE), $this->summarize_vat_table_element(self::VT_ALLOWANCEAMOUNT), $this->summarize_vat_table_element(self::VT_BASISAMOUNT), $this->summarize_vat_table_element(self::VT_CALCULATEDAMOUNT), 0.0, $this->total_prepaid_amount);
        $this->totals_are_calculated = true;
        return $this;
    }
    /**
     * Insert into internal vat table for later using, e.g. when creating
     * the vat breakdown
     *
     * @return void
     */
    protected function add_to_internal_vat_buffer(string $tax_category_code, string $tax_type_code, float $tax_percent, float $line_total_amount, float $charge_amount, float $allowance_amount, float $logistic_service_charge)
    {
        $vat_group = md5($tax_category_code . '_' . $tax_type_code . '_' . number_format($tax_percent, 10, '_', '__'));
        if (!isset($this->vat_breakdown[$vat_group])) {
            $this->vat_breakdown[$vat_group] = [self::VT_TAXCATEGORY => $tax_category_code, self::VT_TAXTYPE => $tax_type_code, self::VT_TAXPERCENT => $tax_percent, self::VT_LINETOTALBASISAMOUNT => 0.0, self::VT_ALLOWANCEAMOUNT => 0.0, self::VT_CHARGEAMOUNT => 0.0, self::VT_ALLOWANCECHARGEAMOUNT => 0.0, self::VT_CALCULATEDAMOUNT => 0.0, self::VT_LOGSERVICECHARGE => 0.0];
        }
        $this->vat_breakdown[$vat_group][self::VT_LINETOTALBASISAMOUNT] += $line_total_amount;
        $this->vat_breakdown[$vat_group][self::VT_ALLOWANCEAMOUNT] += $allowance_amount;
        $this->vat_breakdown[$vat_group][self::VT_CHARGEAMOUNT] += $charge_amount;
        $this->vat_breakdown[$vat_group][self::VT_LOGSERVICECHARGE] += $logistic_service_charge;
        $this->vat_breakdown[$vat_group][self::VT_ALLOWANCECHARGEAMOUNT] = $this->vat_breakdown[$vat_group][self::VT_CHARGEAMOUNT] - $this->vat_breakdown[$vat_group][self::VT_ALLOWANCEAMOUNT] + $this->vat_breakdown[$vat_group][self::VT_LOGSERVICECHARGE];
        $this->vat_breakdown[$vat_group][self::VT_BASISAMOUNT] = $this->vat_breakdown[$vat_group][self::VT_LINETOTALBASISAMOUNT] + $this->vat_breakdown[$vat_group][self::VT_ALLOWANCECHARGEAMOUNT];
        $this->vat_breakdown[$vat_group][self::VT_CALCULATEDAMOUNT] = round($this->vat_breakdown[$vat_group][self::VT_BASISAMOUNT] * $this->vat_breakdown[$vat_group][self::VT_TAXPERCENT] / 100.0, 2);
    }
    /**
     * Writes the document vat breakdown from the internal vat buffer
     */
    protected function write_vat_break_down(): void
    {
        foreach ($this->vat_breakdown as $item) {
            $this->add_document_tax($item[self::VT_TAXCATEGORY], $item[self::VT_TAXTYPE], $item[self::VT_BASISAMOUNT], $item[self::VT_CALCULATEDAMOUNT], $item[self::VT_TAXPERCENT], null, null, $item[self::VT_LINETOTALBASISAMOUNT], $item[self::VT_ALLOWANCECHARGEAMOUNT]);
        }
    }
    /**
     * Summarizes an array element in the internal vat table
     */
    protected function summarize_vat_table_element(int $index): float
    {
        $sum = 0.0;
        foreach ($this->vat_breakdown as $item) {
            $sum += $item[$index];
        }
        return $sum;
    }
}