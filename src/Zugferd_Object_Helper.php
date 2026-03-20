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
use DateTimeInterface;
use finfo;
use horstoeko\mimedb\Mime_Db;
use horstoeko\stringmanagement\File_Utils;
use horstoeko\stringmanagement\String_Utils;
use horstoeko\zugferd\exception\Zugferd_Unknown_Date_Format_Exception;
use horstoeko\zugferd\exception\Zugferd_Unsupported_Mimetype;
/**
 * Class representing a collection of common helpers and class factories
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Object_Helper
{
    /**
     * Internal profile id
     *
     * @var integer
     */
    public $profile = -1;
    /**
     * Internal profile definition
     *
     * @var array
     */
    public $profiledef = [];
    /**
     * A list of supported mimetypes by binaryattachments
     */
    public const SUPPORTEDTMIMETYPES = ['application/pdf', 'image/png', 'image/jpeg', 'text/csv', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.oasis.opendocument.spreadsheet', 'application/xml'];
    /**
     * Constructor
     */
    public function __construct(int $profile)
    {
        $this->profile = $profile;
        $this->profiledef = Zugferd_Profile_Resolver::resolve_profile_def_by_id($profile);
    }
    /**
     * Creates an instance of DocumentCodeType
     */
    public function get_document_code_type(?string $value = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        return $this->create_class_instance('qdt\DocumentCodeType', $value);
    }
    /**
     * Creates an instance of IDType
     *
     * @return object
     */
    public function get_id_type(?string $value = null, ?string $scheme_id = null): ?object
    {
        if (self::is_null_or_empty($value)) {
            return null;
        }
        $id_type = $this->create_class_instance('udt\IDType', $value);
        $this->try_call($id_type, 'setSchemeID', $scheme_id);
        return $id_type;
    }
    /**
     * Creates an instance of TextType
     *
     * @return object
     */
    public function get_text_type(?string $value = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        return $this->create_class_instance('udt\TextType', $value);
    }
    /**
     * Creates an instance of CodeType
     */
    public function get_code_type(?string $value = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        return $this->create_class_instance('udt\CodeType', $value);
    }
    /**
     * Creates an instance of CodeType with extended list
     * information
     */
    public function get_code_type2(?string $value = null, ?string $list_id = null, ?string $list_version_id = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $code_type = $this->create_class_instance('udt\CodeType', $value);
        $this->try_call($code_type, 'setListID', $list_id);
        $this->try_call($code_type, 'setListVersionID', $list_version_id);
        return $code_type;
    }
    /**
     * Get indicator type
     */
    public function get_indicator_type(?bool $value = null): ?object
    {
        if ($value === null) {
            return null;
        }
        $indicator_type = $this->create_class_instance('udt\IndicatorType');
        $this->try_call($indicator_type, 'setIndicator', $value);
        return $indicator_type;
    }
    /**
     * Get Note type
     */
    public function get_note_type(?string $content = null, ?string $content_code = null, ?string $subject_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        if (self::is_null_or_empty($content)) {
            return null;
        }
        $note_type = $this->create_class_instance('ram\NoteType');
        $this->try_call($note_type, 'setContentCode', $this->get_code_type($content_code));
        $this->try_call($note_type, 'setSubjectCode', $this->get_code_type($subject_code));
        $this->try_call($note_type, 'setContent', $this->get_text_type($content));
        return $note_type;
    }
    /**
     * Get formatted issue date
     */
    public function get_formatted_date_time_type(?DateTimeInterface $date_time = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $date_time_string_a_type = $this->create_class_instance('qdt\FormattedDateTimeType\DateTimeStringAType');
        $this->try_call($date_time_string_a_type, 'value', $date_time->format('Ymd'));
        $this->try_call($date_time_string_a_type, 'setFormat', '102');
        $formatted_date_time_type = $this->create_class_instance('qdt\FormattedDateTimeType');
        $this->try_call($formatted_date_time_type, 'setDateTimeString', $date_time_string_a_type);
        return $formatted_date_time_type;
    }
    /**
     * Get formatted issue date
     */
    public function get_date_time_type(?DateTimeInterface $date_time = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $date_time_string_a_type = $this->create_class_instance('udt\DateTimeType\DateTimeStringAType');
        $this->try_call($date_time_string_a_type, 'value', $date_time->format('Ymd'));
        $this->try_call($date_time_string_a_type, 'setFormat', '102');
        $date_time_type = $this->create_class_instance('udt\DateTimeType');
        $this->try_call($date_time_type, 'setDateTimeString', $date_time_string_a_type);
        return $date_time_type;
    }
    /**
     * Get date
     */
    public function get_date_type(?DateTimeInterface $date_time = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $date_string_a_type = $this->create_class_instance('udt\DateType\DateStringAType');
        $this->try_call($date_string_a_type, 'value', $date_time->format('Ymd'));
        $this->try_call($date_string_a_type, 'setFormat', '102');
        $date_type = $this->create_class_instance('udt\DateType');
        $this->try_call($date_type, 'setDateString', $date_string_a_type);
        return $date_type;
    }
    /**
     * Representation of Amount
     */
    public function get_amount_type(?float $value, ?string $currency_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        if (self::is_null_or_empty($value)) {
            return null;
        }
        $amount_type = $this->create_class_instance('udt\AmountType');
        $this->try_call($amount_type, 'value', $value);
        $this->try_call($amount_type, 'setCurrencyID', $currency_code);
        return $amount_type;
    }
    /**
     * Representation of Percdnt
     */
    public function get_percent_type(?float $value): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $percent_type = $this->create_class_instance('udt\PercentType');
        $this->try_call($percent_type, 'value', $value);
        return $percent_type;
    }
    /**
     * Representation of Quantity
     */
    public function get_quantity_type(?float $value, ?string $unit_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        if (self::is_null_or_empty($value)) {
            return null;
        }
        $quantity_type = $this->create_class_instance('udt\QuantityType');
        $this->try_call($quantity_type, 'value', $value);
        $this->try_call($quantity_type, 'setUnitCode', $unit_code);
        return $quantity_type;
    }
    /**
     * Representation of Quantity Measure
     */
    public function get_measure_type(?float $value, ?string $unit_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        if (self::is_null_or_empty($value)) {
            return null;
        }
        $measure_type = $this->create_class_instance('udt\MeasureType');
        $this->try_call($measure_type, 'value', $value);
        $this->try_call($measure_type, 'setUnitCode', $unit_code);
        return $measure_type;
    }
    /**
     * Get an instance of GetNumericType
     */
    public function get_numeric_type(?float $value = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $numeric_type = $this->create_class_instance('udt\NumericType');
        $this->try_call($numeric_type, 'value', $value);
        return $numeric_type;
    }
    /**
     * Representation of Tax Category
     */
    public function get_tax_category_code_type(?string $tax_category_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $tax_category_code_type = $this->create_class_instance('qdt\TaxCategoryCodeType');
        $this->try_call($tax_category_code_type, 'value', $tax_category_code);
        return $tax_category_code_type;
    }
    /**
     * Representation of Tax Type
     */
    public function get_tax_type_code_type(?string $tax_type_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $tax_type_code_type = $this->create_class_instance('qdt\TaxTypeCodeType');
        $this->try_call($tax_type_code_type, 'value', $tax_type_code);
        return $tax_type_code_type;
    }
    /**
     * Representation of Time Reference Code
     */
    public function get_time_reference_code_type(?string $value = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $time_reference_code_type = $this->create_class_instance('qdt\TimeReferenceCodeType');
        $this->try_call($time_reference_code_type, 'value', $value);
        return $time_reference_code_type;
    }
    /**
     * Get Specified Period type
     */
    public function get_specified_period_type(?DateTimeInterface $start_date = null, ?DateTimeInterface $end_date = null, ?DateTimeInterface $complete_date = null, ?string $description = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $specified_period_type = $this->create_class_instance('ram\SpecifiedPeriodType');
        $this->try_call($specified_period_type, 'setDescription', $this->get_text_type($description));
        $this->try_call($specified_period_type, 'setStartDateTime', $this->get_date_time_type($start_date));
        $this->try_call($specified_period_type, 'setEndDateTime', $this->get_date_time_type($end_date));
        $this->try_call($specified_period_type, 'setCompleteDateTime', $this->get_date_time_type($complete_date));
        return $specified_period_type;
    }
    /**
     * Get a BinaryObjectType object
     */
    public function get_binary_object_type(?string $binary_data = null, ?string $mimetype = null, ?string $filename = null): ?object
    {
        if (self::is_null_or_empty($binary_data) || self::is_null_or_empty($mimetype) || self::is_null_or_empty($filename)) {
            return null;
        }
        $binary_object_type = $this->create_class_instance('udt\BinaryObjectType');
        $this->try_call($binary_object_type, 'value', $binary_data);
        $this->try_call($binary_object_type, 'setMimeCode', $mimetype);
        $this->try_call($binary_object_type, 'setFilename', $filename);
        return $binary_object_type;
    }
    /**
     * Get a reference document object
     *
     * @param  string|array|null      $name
     */
    public function get_referenced_document_type(?string $issuer_assigned_id = null, ?string $uri_id = null, ?string $line_id = null, ?string $type_code = null, $name = null, ?string $ref_type_code = null, ?DateTimeInterface $issue_date = null, ?string $binary_data_filename = null, ?string $base64encoded_data = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $referenced_document_type = $this->create_class_instance('ram\ReferencedDocumentType', $issuer_assigned_id);
        $this->try_call($referenced_document_type, 'setIssuerAssignedID', $this->get_id_type($issuer_assigned_id));
        $this->try_call($referenced_document_type, 'setURIID', $this->get_id_type($uri_id));
        $this->try_call($referenced_document_type, 'setLineID', $this->get_id_type($line_id));
        $this->try_call($referenced_document_type, 'setTypeCode', $this->get_code_type($type_code));
        $this->try_call($referenced_document_type, 'setReferenceTypeCode', $this->get_code_type($ref_type_code));
        $this->try_call($referenced_document_type, 'setFormattedIssueDateTime', $this->get_formatted_date_time_type($issue_date));
        foreach ($this->ensure_string_array($name) as $name) {
            $this->try_call_all($referenced_document_type, ['addToName', 'setName'], $this->get_text_type($name));
        }
        $loaded_from_base64 = false;
        if (String_Utils::string_is_null_or_empty($binary_data_filename) === false && String_Utils::string_is_null_or_empty($base64encoded_data) === false && base64_encode($base64encoded_data) !== false) {
            $finfo = new finfo();
            $mimetype = $finfo->buffer(base64_decode($base64encoded_data), FILEINFO_MIME_TYPE);
            if ($mimetype !== false) {
                if (in_array($mimetype, self::SUPPORTEDTMIMETYPES)) {
                    $file_extension = (new Mime_Db())->find_first_file_extension_by_mime_type($mimetype);
                    if (!is_null($file_extension)) {
                        $this->try_call($referenced_document_type, 'setAttachmentBinaryObject', $this->get_binary_object_type($base64encoded_data, $mimetype, File_Utils::get_filename_with_extension(File_Utils::change_file_extension(File_Utils::get_filename_with_extension($binary_data_filename), $file_extension))));
                        $loaded_from_base64 = true;
                    } else {
                        throw new Zugferd_Unsupported_Mimetype();
                    }
                } else {
                    throw new Zugferd_Unsupported_Mimetype();
                }
            } else {
                throw new Zugferd_Unsupported_Mimetype();
            }
        }
        if ($loaded_from_base64 === false && String_Utils::string_is_null_or_empty($binary_data_filename) === false && File_Utils::file_exists($binary_data_filename)) {
            $mime_db = new Mime_Db();
            $mime_types = $mime_db->find_all_mime_types_by_extension(File_Utils::get_file_extension($binary_data_filename));
            if (!is_null($mime_types)) {
                $mime_types_supported = array_intersect($mime_types, self::SUPPORTEDTMIMETYPES);
                if ($mime_types_supported !== []) {
                    $content = File_Utils::file_to_base64($binary_data_filename);
                    $this->try_call($referenced_document_type, 'setAttachmentBinaryObject', $this->get_binary_object_type($content, $mime_types_supported[0], File_Utils::get_filename_with_extension($binary_data_filename)));
                } else {
                    throw new Zugferd_Unsupported_Mimetype();
                }
            } else {
                throw new Zugferd_Unsupported_Mimetype();
            }
        }
        return $referenced_document_type;
    }
    /**
     * Get instance of CountryID
     */
    public function get_country_id_type(?string $id = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        return $this->create_class_instance('qdt\CountryIDType', $id);
    }
    /**
     * Get instance of TradeCountry
     */
    public function get_trade_country_type(?string $id = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_country_type = $this->create_class_instance('ram\TradeCountryType');
        $this->try_call($trade_country_type, 'setID', $this->get_country_id_type($id));
        return $trade_country_type;
    }
    /**
     * Return the main invoice object
     *
     * @return \horstoeko\zugferd\entities\basic\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\basicwl\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\en16931\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\extended\rsm\CrossIndustryInvoice
     */
    public function get_cross_industry_invoice(): ?object
    {
        $cross_industry_invoice = $this->create_class_instance('rsm\CrossIndustryInvoice');
        $cross_industry_invoice->set_exchanged_document_context($this->create_class_instance('ram\ExchangedDocumentContextType'));
        $cross_industry_invoice->set_exchanged_document($this->create_class_instance('ram\ExchangedDocumentType'));
        $cross_industry_invoice->set_supply_chain_trade_transaction($this->create_class_instance('ram\SupplyChainTradeTransactionType'));
        $cross_industry_invoice->get_exchanged_document_context()->set_guideline_specified_document_context_parameter($this->create_class_instance('ram\DocumentContextParameterType'));
        $cross_industry_invoice->get_exchanged_document_context()->get_guideline_specified_document_context_parameter()->set_id($this->get_id_type($this->profiledef['contextparameter']));
        if ($this->profiledef['businessprocess']) {
            $cross_industry_invoice->get_exchanged_document_context()->set_business_process_specified_document_context_parameter($this->create_class_instance('ram\DocumentContextParameterType'));
            $cross_industry_invoice->get_exchanged_document_context()->get_business_process_specified_document_context_parameter()->set_id($this->get_id_type($this->profiledef['businessprocess']));
        }
        $cross_industry_invoice->get_supply_chain_trade_transaction()->set_applicable_header_trade_agreement($this->create_class_instance('ram\HeaderTradeAgreementType'));
        $cross_industry_invoice->get_supply_chain_trade_transaction()->set_applicable_header_trade_delivery($this->create_class_instance('ram\HeaderTradeDeliveryType'));
        $cross_industry_invoice->get_supply_chain_trade_transaction()->set_applicable_header_trade_settlement($this->create_class_instance('ram\HeaderTradeSettlementType'));
        return $cross_industry_invoice;
    }
    /**
     * Tradeparty type
     */
    public function get_trade_party(?string $name = null, ?string $id = null, ?string $description = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        return $this->get_trade_party_allow_empty($name, $id, $description);
    }
    /**
     * Tradeparty type (allow all nulls)
     */
    public function get_trade_party_allow_empty(?string $name = null, ?string $id = null, ?string $description = null): ?object
    {
        $trade_party_type = $this->create_class_instance('ram\TradePartyType');
        $this->try_call($trade_party_type, 'addToID', $this->get_id_type($id));
        $this->try_call($trade_party_type, 'setName', $this->get_text_type($name));
        $this->try_call($trade_party_type, 'setDescription', $this->get_text_type($description));
        return $trade_party_type;
    }
    /**
     * Address type
     */
    public function get_trade_address(?string $line_one = null, ?string $line_two = null, ?string $line_three = null, ?string $post_code = null, ?string $city = null, ?string $country = null, ?string $sub_division = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_address_type = $this->create_class_instance('ram\TradeAddressType');
        $this->try_call($trade_address_type, 'setLineOne', $this->get_text_type($line_one));
        $this->try_call($trade_address_type, 'setLineTwo', $this->get_text_type($line_two));
        $this->try_call($trade_address_type, 'setLineThree', $this->get_text_type($line_three));
        $this->try_call($trade_address_type, 'setPostcodeCode', $this->get_code_type($post_code));
        $this->try_call($trade_address_type, 'setCityName', $this->get_text_type($city));
        $this->try_call($trade_address_type, 'setCountryID', $this->get_country_id_type($country));
        $this->try_call($trade_address_type, 'setCountrySubDivisionName', $this->get_text_type($sub_division));
        return $trade_address_type;
    }
    /**
     * Legal organization type
     */
    public function get_legal_organization(?string $legal_org_id = null, ?string $legal_org_type = null, ?string $legal_org_name = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $legal_organization_type = $this->create_class_instance('ram\LegalOrganizationType', $legal_org_name);
        $this->try_call($legal_organization_type, 'setID', $this->get_id_type($legal_org_id, $legal_org_type));
        $this->try_call($legal_organization_type, 'setTradingBusinessName', $this->get_text_type($legal_org_name));
        return $legal_organization_type;
    }
    /**
     * Contact type
     */
    public function get_trade_contact(?string $contact_person_name = null, ?string $contact_department_name = null, ?string $contact_phone_no = null, ?string $contact_fax_no = null, ?string $contact_email_address = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_contact_type = $this->create_class_instance('ram\TradeContactType', $contact_person_name);
        $contact_phone_no = $this->get_universal_communication_type($contact_phone_no);
        $contact_fax_no = $this->get_universal_communication_type($contact_fax_no);
        $contact_email_address = $this->get_universal_communication_type(null, $contact_email_address);
        $this->try_call($trade_contact_type, 'setPersonName', $this->get_text_type($contact_person_name));
        $this->try_call($trade_contact_type, 'setDepartmentName', $this->get_text_type($contact_department_name));
        $this->try_call($trade_contact_type, 'setTelephoneUniversalCommunication', $contact_phone_no);
        $this->try_call($trade_contact_type, 'setFaxUniversalCommunication', $contact_fax_no);
        $this->try_call($trade_contact_type, 'setEmailURIUniversalCommunication', $contact_email_address);
        return $trade_contact_type;
    }
    /**
     * Communication type
     */
    public function get_universal_communication_type(?string $number = null, ?string $uri_id = null, ?string $uri_scheme = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $communication_type = $this->create_class_instance('ram\UniversalCommunicationType');
        $this->try_call($communication_type, 'setCompleteNumber', $this->get_text_type($number));
        $this->try_call($communication_type, 'setURIID', $this->get_id_type($uri_id, $uri_scheme));
        return $communication_type;
    }
    /**
     * Tax registration type
     */
    public function get_tax_registration_type(?string $tax_reg_type = null, ?string $tax_reg_id = null): ?object
    {
        if (self::is_null_or_empty($tax_reg_type)) {
            return null;
        }
        if (self::is_null_or_empty($tax_reg_id)) {
            return null;
        }
        $tax_registration_type = $this->create_class_instance('ram\TaxRegistrationType');
        $this->try_call($tax_registration_type, 'setID', $this->get_id_type($tax_reg_id, $tax_reg_type));
        return $tax_registration_type;
    }
    /**
     * Delivery terms type
     */
    public function get_trade_delivery_terms_type(?string $code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_delivery_terms_type = $this->create_class_instance('ram\TradeDeliveryTermsType');
        $this->try_call($trade_delivery_terms_type, 'setDeliveryTypeCode', $this->get_trade_delivery_terms_code_type($code));
        return $trade_delivery_terms_type;
    }
    /**
     * Delivery terms code type
     */
    public function get_trade_delivery_terms_code_type(?string $code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        return $this->create_class_instance('qdt\DeliveryTermsCodeType', $code);
    }
    /**
     * Procuring project type
     */
    public function get_procuring_project_type(?string $id = null, ?string $name = null): ?object
    {
        if (self::is_one_null_or_empty(func_get_args())) {
            return null;
        }
        $procuring_project_type = $this->create_class_instance('ram\ProcuringProjectType');
        $this->try_call($procuring_project_type, 'setID', $this->get_id_type($id));
        $this->try_call($procuring_project_type, 'setName', $this->get_text_type($name));
        return $procuring_project_type;
    }
    /**
     * Undocumented function
     */
    public function get_supply_chain_event_type(?DateTimeInterface $date = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $supply_chain_event_type = $this->create_class_instance('ram\SupplyChainEventType');
        $this->try_call($supply_chain_event_type, 'setOccurrenceDateTime', $this->get_date_time_type($date));
        return $supply_chain_event_type;
    }
    /**
     * Get instance of TradeSettlementFinancialCardType
     */
    public function get_trade_settlement_financial_card_type(?string $type = null, ?string $id = null, ?string $holder_name = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        // At the moment PCI Security Standards Council has defined that the first 6 digits and
        // last 4 digits are the maximum number of digits to be shown.
        $id = strlen($id) > 4 ? substr($id, 0, 6) . substr($id, -4) : $id;
        $trade_settlement_financial_card_type = $this->create_class_instance('ram\TradeSettlementFinancialCardType');
        $this->try_call($trade_settlement_financial_card_type, 'setID', $this->get_id_type($id, $type));
        $this->try_call($trade_settlement_financial_card_type, 'setCardholderName', $this->get_text_type($holder_name));
        return $trade_settlement_financial_card_type;
    }
    /**
     * Get instance of DebtorFinancialAccountType
     */
    public function get_debtor_financial_account_type(?string $iban = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $debtor_financial_account_type = $this->create_class_instance('ram\DebtorFinancialAccountType');
        $this->try_call($debtor_financial_account_type, 'setIBANID', $this->get_id_type($iban));
        return $debtor_financial_account_type;
    }
    /**
     * Get instance of CreditorFinancialAccountType
     */
    public function get_creditor_financial_account_type(?string $iban = null, ?string $account_name = null, ?string $proprietary_id = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $creditor_financial_account_type = $this->create_class_instance('ram\CreditorFinancialAccountType');
        $this->try_call($creditor_financial_account_type, 'setIBANID', $this->get_id_type($iban));
        $this->try_call($creditor_financial_account_type, 'setAccountName', $this->get_text_type($account_name));
        $this->try_call($creditor_financial_account_type, 'setProprietaryID', $this->get_id_type($proprietary_id));
        return $creditor_financial_account_type;
    }
    /**
     * Undocumented function
     */
    public function get_creditor_financial_institution_type(?string $bic = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $creditor_financial_institution_type = $this->create_class_instance('ram\CreditorFinancialInstitutionType');
        $this->try_call($creditor_financial_institution_type, 'setBICID', $this->get_id_type($bic));
        return $creditor_financial_institution_type;
    }
    /**
     * Get instance of TradeSettlementPaymentMeansType
     */
    public function get_trade_settlement_payment_means_type(?string $type_code = null, ?string $information = null): ?object
    {
        if (self::is_null_or_empty($type_code)) {
            return null;
        }
        $trade_settlement_payment_means_type = $this->create_class_instance('ram\TradeSettlementPaymentMeansType');
        $this->try_call($trade_settlement_payment_means_type, 'setTypeCode', $this->get_code_type($type_code));
        $this->try_call($trade_settlement_payment_means_type, 'setInformation', $this->get_text_type($information));
        return $trade_settlement_payment_means_type;
    }
    /**
     * Get instance of TradePaymentTermsType
     */
    public function get_trade_payment_terms_type(?string $description = null, ?DateTimeInterface $due_date = null, ?string $direct_debit_mandate_id = null, ?float $partial_payment_amount = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_payment_terms_type = $this->create_class_instance('ram\TradePaymentTermsType');
        $this->try_call($trade_payment_terms_type, 'setDescription', $this->get_text_type($description));
        $this->try_call($trade_payment_terms_type, 'setDueDateDateTime', $this->get_date_time_type($due_date));
        $this->try_call($trade_payment_terms_type, 'setDirectDebitMandateID', $this->get_id_type($direct_debit_mandate_id));
        $this->try_call($trade_payment_terms_type, 'setPartialPaymentAmount', $this->get_amount_type($partial_payment_amount));
        return $trade_payment_terms_type;
    }
    /**
     * Get instance of TradePaymentDiscountTermsType
     */
    public function get_trade_payment_discount_terms_type(?DateTimeInterface $basis_date_time = null, ?float $basis_period_measure_value = null, ?string $basis_period_measure_unit_code = null, ?float $basis_amount = null, ?float $calculation_percent = null, ?float $actual_discount_amount = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_payment_discount_terms_type = $this->create_class_instance('ram\TradePaymentDiscountTermsType');
        $this->try_call($trade_payment_discount_terms_type, 'setBasisDateTime', $this->get_date_time_type($basis_date_time));
        $this->try_call($trade_payment_discount_terms_type, 'setBasisPeriodMeasure', $this->get_measure_type($basis_period_measure_value, $basis_period_measure_unit_code));
        $this->try_call($trade_payment_discount_terms_type, 'setBasisAmount', $this->get_amount_type($basis_amount));
        $this->try_call($trade_payment_discount_terms_type, 'setCalculationPercent', $this->get_percent_type($calculation_percent));
        $this->try_call($trade_payment_discount_terms_type, 'setActualDiscountAmount', $this->get_amount_type($actual_discount_amount));
        return $trade_payment_discount_terms_type;
    }
    /**
     * Get instance of TradePaymentPenaltyTermsType
     */
    public function get_trade_payment_penalty_terms_type(?DateTimeInterface $basis_date_time = null, ?float $basis_period_measure_value = null, ?string $basis_period_measure_unit_code = null, ?float $basis_amount = null, ?float $calculation_percent = null, ?float $actual_penalty_amount = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_payment_discount_terms_type = $this->create_class_instance('ram\TradePaymentPenaltyTermsType');
        $this->try_call($trade_payment_discount_terms_type, 'setBasisDateTime', $this->get_date_time_type($basis_date_time));
        $this->try_call($trade_payment_discount_terms_type, 'setBasisPeriodMeasure', $this->get_measure_type($basis_period_measure_value, $basis_period_measure_unit_code));
        $this->try_call($trade_payment_discount_terms_type, 'setBasisAmount', $this->get_amount_type($basis_amount));
        $this->try_call($trade_payment_discount_terms_type, 'setCalculationPercent', $this->get_percent_type($calculation_percent));
        $this->try_call($trade_payment_discount_terms_type, 'setActualPenaltyAmount', $this->get_amount_type($actual_penalty_amount));
        return $trade_payment_discount_terms_type;
    }
    /**
     * Get instance of TradeTaxType
     * Sales tax breakdown, Umsatzsteueraufschlüsselung
     */
    public function get_trade_tax_type(?string $category_code = null, ?string $type_code = null, ?float $basis_amount = null, ?float $calculated_amount = null, ?float $rate_applicable_percent = null, ?string $exemption_reason = null, ?string $exemption_reason_code = null, ?float $line_total_basis_amount = null, ?float $allowance_charge_basis_amount = null, ?DateTimeInterface $tax_point_date = null, ?string $due_date_type_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_tax_type = $this->create_class_instance('ram\TradeTaxType');
        $this->try_call($trade_tax_type, 'setCalculatedAmount', $this->get_amount_type($calculated_amount));
        $this->try_call($trade_tax_type, 'setTypeCode', $this->get_tax_type_code_type($type_code));
        $this->try_call($trade_tax_type, 'setExemptionReason', $this->get_text_type($exemption_reason));
        $this->try_call($trade_tax_type, 'setBasisAmount', $this->get_amount_type($basis_amount));
        $this->try_call($trade_tax_type, 'setLineTotalBasisAmount', $this->get_amount_type($line_total_basis_amount));
        $this->try_call($trade_tax_type, 'setAllowanceChargeBasisAmount', $this->get_amount_type($allowance_charge_basis_amount));
        $this->try_call($trade_tax_type, 'setCategoryCode', $this->get_tax_category_code_type($category_code));
        $this->try_call($trade_tax_type, 'setExemptionReasonCode', $this->get_code_type($exemption_reason_code));
        $this->try_call($trade_tax_type, 'setTaxPointDate', $this->get_date_type($tax_point_date));
        $this->try_call($trade_tax_type, 'setDueDateTypeCode', $this->get_time_reference_code_type($due_date_type_code));
        $this->try_call($trade_tax_type, 'setRateApplicablePercent', $this->get_percent_type($rate_applicable_percent));
        return $trade_tax_type;
    }
    /**
     * Get Allowance/Charge type
     * Zu- und Abschläge
     */
    public function get_trade_allowance_charge_type(?float $actual_amount = null, ?bool $is_charge = null, ?string $tax_type_code = null, ?string $tax_category_code = null, ?float $rate_applicable_percent = null, ?float $sequence = null, ?float $calculation_percent = null, ?float $basis_amount = null, ?float $basis_quantity = null, ?string $basis_quantity_unit_code = null, ?string $reason_code = null, ?string $reason = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_allowance_charge_type = $this->create_class_instance('ram\TradeAllowanceChargeType');
        $this->try_call($trade_allowance_charge_type, 'setChargeIndicator', $this->get_indicator_type($is_charge));
        $this->try_call($trade_allowance_charge_type, 'setSequenceNumeric', $this->get_numeric_type($sequence));
        $this->try_call($trade_allowance_charge_type, 'setCalculationPercent', $this->get_percent_type($calculation_percent));
        $this->try_call($trade_allowance_charge_type, 'setBasisAmount', $this->get_amount_type($basis_amount));
        $this->try_call($trade_allowance_charge_type, 'setBasisQuantity', $this->get_quantity_type($basis_quantity, $basis_quantity_unit_code));
        $this->try_call($trade_allowance_charge_type, 'setActualAmount', $this->get_amount_type($actual_amount));
        $this->try_call($trade_allowance_charge_type, 'setReasonCode', $this->get_code_type($reason_code));
        $this->try_call($trade_allowance_charge_type, 'setReason', $this->get_text_type($reason));
        if (!is_null($tax_category_code) && !is_null($tax_type_code)) {
            $this->try_call($trade_allowance_charge_type, 'setCategoryTradeTax', $this->get_trade_tax_type($tax_category_code, $tax_type_code, null, null, $rate_applicable_percent));
        }
        return $trade_allowance_charge_type;
    }
    /**
     * Get instance of
     */
    public function get_logistics_service_charge_type(?string $description = null, ?float $applied_amount = null, ?array $tax_type_codes = null, ?array $tax_category_codes = null, ?array $rate_applicable_percents = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $logistics_service_charge_type = $this->create_class_instance('ram\LogisticsServiceChargeType');
        $this->try_call($logistics_service_charge_type, 'setDescription', $this->get_text_type($description));
        $this->try_call($logistics_service_charge_type, 'setAppliedAmount', $this->get_amount_type($applied_amount));
        if (!is_null($tax_category_codes) && !is_null($tax_type_codes) && !is_null($rate_applicable_percents)) {
            foreach ($rate_applicable_percents as $index => $rate_applicable_percent) {
                $tax_breakdown = $this->get_trade_tax_type($tax_category_codes[$index], $tax_type_codes[$index], null, null, $rate_applicable_percent);
                $this->try_call($logistics_service_charge_type, 'addToAppliedTradeTax', $tax_breakdown);
            }
        }
        return $logistics_service_charge_type;
    }
    /**
     * Get instance of TradeSettlementHeaderMonetarySummationType
     */
    public function get_trade_settlement_header_monetary_summation_type(?float $grand_total_amount = null, ?float $due_payable_amount = null, ?float $line_total_amount = null, ?float $charge_total_amount = null, ?float $allowance_total_amount = null, ?float $tax_basis_total_amount = null, ?float $tax_total_amount = null, ?float $rounding_amount = null, ?float $total_prepaid_amount = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_settlement_header_monetary_summation_type = $this->create_class_instance('ram\TradeSettlementHeaderMonetarySummationType');
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setLineTotalAmount', $this->get_amount_type($line_total_amount));
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setChargeTotalAmount', $this->get_amount_type($charge_total_amount));
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setAllowanceTotalAmount', $this->get_amount_type($allowance_total_amount));
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setTaxBasisTotalAmount', $this->get_amount_type($tax_basis_total_amount));
        $this->try_call_all($trade_settlement_header_monetary_summation_type, ['addToTaxTotalAmount', 'setTaxTotalAmount'], $this->get_amount_type($tax_total_amount));
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setRoundingAmount', $this->get_amount_type($rounding_amount));
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setGrandTotalAmount', $this->get_amount_type($grand_total_amount));
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setTotalPrepaidAmount', $this->get_amount_type($total_prepaid_amount));
        $this->try_call($trade_settlement_header_monetary_summation_type, 'setDuePayableAmount', $this->get_amount_type($due_payable_amount));
        return $trade_settlement_header_monetary_summation_type;
    }
    /**
     * Create summation class only
     */
    public function get_trade_settlement_header_monetary_summation_type_only(): ?object
    {
        return $this->create_class_instance('ram\TradeSettlementHeaderMonetarySummationType');
    }
    /**
     * Get an instance of TradeAccountingAccountType
     */
    public function get_trade_accounting_account_type(?string $id = null, ?string $type_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_accounting_account_type = $this->create_class_instance('ram\TradeAccountingAccountType');
        $this->try_call($trade_accounting_account_type, 'setID', $this->get_id_type($id));
        $this->try_call($trade_accounting_account_type, 'setTypeCode', $this->get_code_type($type_code));
        return $trade_accounting_account_type;
    }
    /**
     * Get Document line
     */
    public function get_document_line_document_type(?string $line_id = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $document_line_document_type = $this->create_class_instance('ram\DocumentLineDocumentType');
        $this->try_call($document_line_document_type, 'setLineID', $this->get_id_type($line_id));
        return $document_line_document_type;
    }
    /**
     * Get instance of SupplyChainTradeLineItemType
     */
    public function get_supply_chain_trade_line_item_type(?string $line_id = null, ?string $line_status_code = null, ?string $line_status_reason_code = null, bool $is_text_position = false): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $supply_chain_trade_line_item_type = $this->create_class_instance('ram\SupplyChainTradeLineItemType');
        $doclinedoc = $this->get_document_line_document_type($line_id);
        $line_trade_agreement_type = $this->create_class_instance('ram\LineTradeAgreementType');
        $line_trade_delivery_type = $this->create_class_instance('ram\LineTradeDeliveryType');
        $line_trade_settlement_type = $this->create_class_instance('ram\LineTradeSettlementType');
        $this->try_call($supply_chain_trade_line_item_type, 'setAssociatedDocumentLineDocument', $doclinedoc);
        $this->try_call($doclinedoc, 'setLineStatusCode', $this->get_code_type($line_status_code));
        $this->try_call($doclinedoc, 'setLineStatusReasonCode', $this->get_code_type($line_status_reason_code));
        if ($is_text_position == false) {
            $this->try_call($supply_chain_trade_line_item_type, 'setSpecifiedLineTradeAgreement', $line_trade_agreement_type);
            $this->try_call($supply_chain_trade_line_item_type, 'setSpecifiedLineTradeDelivery', $line_trade_delivery_type);
        }
        $this->try_call($supply_chain_trade_line_item_type, 'setSpecifiedLineTradeSettlement', $line_trade_settlement_type);
        return $supply_chain_trade_line_item_type;
    }
    /**
     * Get product specification
     */
    public function get_trade_product_type(?string $name = null, ?string $description = null, ?string $seller_assigned_id = null, ?string $buyer_assigned_id = null, ?string $global_id_type = null, ?string $global_id = null, ?string $industry_assigned_id = null, ?string $model_id = null, ?string $batch_id = null, ?string $brand_name = null, ?string $model_name = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_product_type = $this->create_class_instance('ram\TradeProductType');
        $this->try_call($trade_product_type, 'setGlobalID', $this->get_id_type($global_id, $global_id_type));
        $this->try_call($trade_product_type, 'setSellerAssignedID', $this->get_id_type($seller_assigned_id));
        $this->try_call($trade_product_type, 'setBuyerAssignedID', $this->get_id_type($buyer_assigned_id));
        $this->try_call($trade_product_type, 'setName', $this->get_text_type($name));
        $this->try_call($trade_product_type, 'setDescription', $this->get_text_type($description));
        $this->try_call($trade_product_type, 'setIndustryAssignedID', $this->get_id_type($industry_assigned_id));
        $this->try_call($trade_product_type, 'setModelID', $this->get_id_type($model_id));
        $this->try_call($trade_product_type, 'addToBatchID', $this->get_id_type($batch_id));
        $this->try_call($trade_product_type, 'setBrandName', $this->get_text_type($brand_name));
        $this->try_call($trade_product_type, 'setModelName', $this->get_text_type($model_name));
        return $trade_product_type;
    }
    /**
     * Get Product Characteristic
     */
    public function get_product_characteristic_type(?string $type_code = null, ?string $description = null, ?float $value_measure = null, ?string $value_measure_unit_code = null, ?string $value = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $product_characteristic_type = $this->create_class_instance('ram\ProductCharacteristicType');
        $this->try_call($product_characteristic_type, 'setTypeCode', $this->get_code_type($type_code));
        $this->try_call($product_characteristic_type, 'setDescription', $this->get_text_type($description));
        $this->try_call($product_characteristic_type, 'setValueMeasure', $this->get_measure_type($value_measure, $value_measure_unit_code));
        $this->try_call($product_characteristic_type, 'setValue', $this->get_text_type($value));
        return $product_characteristic_type;
    }
    /**
     * Get Product Classification
     */
    public function get_product_classification_type(?string $class_code = null, ?string $class_name = null, ?string $list_id = null, ?string $list_version_id = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $product_classification_type = $this->create_class_instance('ram\ProductClassificationType');
        $this->try_call($product_classification_type, 'setClassCode', $this->get_code_type2($class_code, $list_id, $list_version_id));
        $this->try_call($product_classification_type, 'setClassName', $this->get_text_type($class_name));
        return $product_classification_type;
    }
    /**
     * Get product reference product
     */
    public function get_referenced_product_type(?string $global_id, ?string $global_id_type, ?string $seller_assigned_id, ?string $buyer_assigned_id, ?string $industry_assigned_id, ?string $name, ?string $description, ?float $unit_quantity, ?string $unit_code): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $referenced_product_type = $this->create_class_instance('ram\ReferencedProductType');
        $this->try_call_all($referenced_product_type, ['addToGlobalID', 'setGlobalID'], $this->get_id_type($global_id, $global_id_type));
        $this->try_call($referenced_product_type, 'setSellerAssignedID', $this->get_id_type($seller_assigned_id));
        $this->try_call($referenced_product_type, 'setBuyerAssignedID', $this->get_id_type($buyer_assigned_id));
        $this->try_call($referenced_product_type, 'setIndustryAssignedID', $this->get_id_type($industry_assigned_id));
        $this->try_call($referenced_product_type, 'setName', $this->get_text_type($name));
        $this->try_call($referenced_product_type, 'setDescription', $this->get_text_type($description));
        $this->try_call($referenced_product_type, 'setUnitQuantity', $this->get_quantity_type($unit_quantity, $unit_code));
        return $referenced_product_type;
    }
    /**
     * Get trade price
     */
    public function get_trade_price_type(?float $amount = null, ?float $basis_quantity = null, ?string $basis_quantity_unit_code = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_price_type = $this->create_class_instance('ram\TradePriceType');
        $this->try_call($trade_price_type, 'setChargeAmount', $this->get_amount_type($amount));
        $this->try_call($trade_price_type, 'setBasisQuantity', $this->get_quantity_type($basis_quantity, $basis_quantity_unit_code));
        return $trade_price_type;
    }
    /**
     * Get Line Summation
     */
    public function get_trade_settlement_line_monetary_summation_type(?float $line_total_amount = null, ?float $charge_total_amount = null, ?float $allowance_total_amount = null, ?float $tax_total_amount = null, ?float $grand_total_amount = null, ?float $total_allowance_charge_amount = null): ?object
    {
        if (self::is_all_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_settlement_line_monetary_summation_type = $this->create_class_instance('ram\TradeSettlementLineMonetarySummationType');
        $this->try_call($trade_settlement_line_monetary_summation_type, 'setLineTotalAmount', $this->get_amount_type($line_total_amount));
        $this->try_call($trade_settlement_line_monetary_summation_type, 'setChargeTotalAmount', $this->get_amount_type($charge_total_amount));
        $this->try_call($trade_settlement_line_monetary_summation_type, 'setAllowanceTotalAmount', $this->get_amount_type($allowance_total_amount));
        $this->try_call($trade_settlement_line_monetary_summation_type, 'setTaxTotalAmount', $this->get_amount_type($tax_total_amount));
        $this->try_call($trade_settlement_line_monetary_summation_type, 'setGrandTotalAmount', $this->get_amount_type($grand_total_amount));
        $this->try_call($trade_settlement_line_monetary_summation_type, 'setTotalAllowanceChargeAmount', $this->get_amount_type($total_allowance_charge_amount));
        return $trade_settlement_line_monetary_summation_type;
    }
    /**
     * Undocumented function
     */
    public function get_tax_applicable_trade_currency_exchange_type(?string $source_currency_code = null, ?string $target_currency_code = null, ?float $rate = null, ?DateTimeInterface $rate_date_time = null): ?object
    {
        if (self::is_one_null_or_empty(func_get_args())) {
            return null;
        }
        $trade_currency_exchange_type = $this->create_class_instance('ram\TradeCurrencyExchangeType');
        $this->try_call($trade_currency_exchange_type, 'setSourceCurrencyCode', $this->get_id_type($source_currency_code));
        $this->try_call($trade_currency_exchange_type, 'setTargetCurrencyCode', $this->get_id_type($target_currency_code));
        $this->try_call($trade_currency_exchange_type, 'setConversionRate', $this->get_rate_type($rate));
        $this->try_call($trade_currency_exchange_type, 'setConversionRateDateTime', $this->get_date_time_type($rate_date_time));
        return $trade_currency_exchange_type;
    }
    /**
     * Create a datetime object
     */
    public function to_date_time(?string $date_time_string, ?string $format): ?DateTime
    {
        if (self::is_null_or_empty($date_time_string) || self::is_null_or_empty($format)) {
            return null;
        }
        $date_time_string = trim($date_time_string);
        if ($format == '102') {
            return DateTime::create_from_format('Ymd', $date_time_string);
        }
        if ($format == '101') {
            return DateTime::create_from_format('ymd', $date_time_string);
        }
        if ($format == '201') {
            return DateTime::create_from_format('ymdHi', $date_time_string);
        }
        if ($format == '202') {
            return DateTime::create_from_format('ymdHis', $date_time_string);
        }
        if ($format == '203') {
            return DateTime::create_from_format('YmdHi', $date_time_string);
        }
        if ($format == '204') {
            return DateTime::create_from_format('YmdHis', $date_time_string);
        }
        if ($format == '610') {
            return DateTime::create_from_format('Ym', $date_time_string)->modify('first day of')->modify('midnight');
        }
        throw new Zugferd_Unknown_Date_Format_Exception($format);
    }
    /**
     * Get Exchange rate type instance
     */
    public function get_rate_type(?float $rate_value): ?object
    {
        $rate_type = $this->create_class_instance('udt\RateType');
        $this->try_call($rate_type, 'value', $rate_value);
        return $rate_type;
    }
    /**
     * Creates an instance of a class needed by $invoiceObject
     *
     * @param  string $classname
     * @param  mixed  $constructorvalue
     */
    public function create_class_instance($classname, $constructorvalue = null): ?object
    {
        $class_name = 'horstoeko\zugferd\entities\\' . $this->profiledef['name'] . '\\' . $classname;
        if (!class_exists($class_name)) {
            return null;
        }
        return new $class_name($constructorvalue);
    }
    /**
     * Tries to call a method
     *
     * @param  object $instance
     * @param  mixed  $value
     */
    public function try_call($instance, string $method, $value): Zugferd_Object_Helper
    {
        if (!$instance) {
            return $this;
        }
        if ($method === '') {
            return $this;
        }
        if (self::is_null_or_empty($value)) {
            return $this;
        }
        if ($this->method_exists($instance, $method)) {
            $instance->{$method}($value);
        }
        return $this;
    }
    /**
     * Try call all methods
     *
     * @param  object   $instance
     * @param  string[] $methods
     * @param  mixed    $value
     */
    public function try_call_all($instance, array $methods, $value): Zugferd_Object_Helper
    {
        if (!$instance) {
            return $this;
        }
        if (self::is_null_or_empty($value)) {
            return $this;
        }
        foreach ($methods as $method) {
            if ($this->method_exists($instance, $method)) {
                $instance->{$method}($value);
                return $this;
            }
        }
        return $this;
    }
    /**
     * Tries to call a method and return the returnvalue from call to $method
     * in object $instance
     *
     * @param  object $instance
     * @return mixed
     */
    public function try_call_and_return($instance, string $method)
    {
        if (!$instance) {
            return null;
        }
        if ($method === '') {
            return null;
        }
        if ($this->method_exists($instance, $method)) {
            return $instance->{$method}();
        }
        return null;
    }
    /**
     * Try call methods in a form .object.method1.method2.method3
     *
     * @param  object $instance
     * @param  mixed  $value
     */
    public function try_call_by_path($instance, string $methods, $value): void
    {
        $methods = explode('.', $methods);
        foreach ($methods as $index => $method) {
            if ($index == count($methods) - 1) {
                $this->try_call($instance, $method, $value);
            } else {
                $instance = $this->try_call_and_return($instance, $method);
            }
        }
    }
    /**
     * Try call methods in a form .object.method1.method2.method3
     *
     * @param  object $instance
     * @return mixed
     */
    public function try_call_by_path_and_return($instance, string $methods)
    {
        $result = null;
        $methods = explode('.', $methods);
        foreach ($methods as $method) {
            $result = $this->try_call_and_return($instance, $method);
            $instance = $result;
        }
        return $result;
    }
    /**
     * Call $method if exists, otherwise $method2 is calles with $value
     *
     * @param  object $instance
     * @param  mixed  $value
     * @param  mixed  $value2
     */
    public function try_call_if_method_exists($instance, string $method_to_look_for, string $method_to_call, $value, $value2): Zugferd_Object_Helper
    {
        if (!$instance) {
            return $this;
        }
        if ($method_to_look_for === '') {
            return $this;
        }
        if ($method_to_call === '') {
            return $this;
        }
        if (!$this->method_exists($instance, $method_to_call)) {
            return $this;
        }
        if ($this->method_exists($instance, $method_to_look_for)) {
            $instance->{$method_to_call}($value);
        } else {
            $instance->{$method_to_call}($value2);
        }
        return $this;
    }
    /**
     * Ensure that $input is an array
     *
     * @param  mixed $input
     */
    public function ensure_string_array($input): array
    {
        if (is_array($input)) {
            return $input;
        }
        return [(string) $input];
    }
    /**
     * Ensure array
     *
     * @param  mixed $value
     */
    public function ensure_array($value): array
    {
        if (!is_array($value)) {
            if (!is_null($value)) {
                return [$value];
            }
            return [];
        }
        return $value;
    }
    /**
     * Test if a value is null or empty
     *
     * @param  mixed $value
     * @return boolean
     */
    public static function is_null_or_empty($value)
    {
        if ($value === null) {
            return true;
        }
        return !is_object($value) && (string) $value === '';
    }
    /**
     * Checks if all function arguments are null or empty
     */
    public static function is_all_null_or_empty(array $args): bool
    {
        foreach ($args as $arg) {
            if ($arg instanceof DateTime) {
                return false;
            }
            if (!self::is_null_or_empty($arg)) {
                return false;
            }
        }
        return true;
    }
    /**
     * Checks if all function arguments are null or empty
     */
    public static function is_one_null_or_empty(array $args): bool
    {
        foreach ($args as $arg) {
            if ($arg instanceof DateTime) {
                if ($arg == null) {
                    return true;
                }
            } elseif (self::is_null_or_empty($arg)) {
                return true;
            }
        }
        return false;
    }
    /**
     * Wrapper for method_exists for use in PHP8
     *
     * @param  string|object $instance
     * @param  string        $method
     */
    public function method_exists($instance, $method): bool
    {
        if ($instance == null) {
            return false;
        }
        if (!is_object($instance) && !is_string($instance)) {
            return false;
        }
        return method_exists($instance, $method);
    }
}