<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use Goetas_Webservices\Xsd\Xsd_To_Php_Runtime\Jms\Handler\Base_Types_Handler;
use Goetas_Webservices\Xsd\Xsd_To_Php_Runtime\Jms\Handler\Xml_Schema_Date_Handler;
use horstoeko\stringmanagement\Path_Utils;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Id_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Parameter_Exception;
use horstoeko\zugferd\jms\Zugferd_Types_Handler;
use JMS\Serializer\Exception\InvalidArgumentException;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\Handler\Handler_Registry_Interface;
use JMS\Serializer\Serializer_Builder;
use JMS\Serializer\Serializer_Interface;
/**
 * Class representing the document basics
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document
{
    /**
     * @var integer $profileId Internal profile id
     */
    private $profile_id = -1;
    /**
     * @var array $profileDefinition Internal profile definition
     */
    private $profile_definition = [];
    /**
     * @var SerializerBuilder $serializerBuilder Serializer builder
     */
    private $serializer_builder;
    /**
     * @var SerializerInterface $serializer Serializer
     */
    private $serializer;
    /**
     * @var \horstoeko\zugferd\entities\basic\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\basicwl\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\en16931\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\extended\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\minimum\rsm\CrossIndustryInvoice $invoiceObject The internal invoice object
     */
    private $invoice_object;
    /**
     * @var ZugferdObjectHelper $objectHelper Object Helper
     */
    private $object_helper;
    /**
     * Constructor
     *
     * @param  integer $profile The ID of the profile of the document
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    final protected function __construct(int $profile)
    {
        $this->init_profile($profile);
        $this->init_object_helper();
        $this->init_serialzer();
    }
    /**
     * Returns the internal invoice object (created by the serializer). This is used e.g. in the validator
     *
     * @return \horstoeko\zugferd\entities\basic\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\basicwl\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\en16931\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\extended\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\minimum\rsm\CrossIndustryInvoice
     */
    protected function get_invoice_object()
    {
        return $this->invoice_object;
    }
    /**
     * Create a new instance of the internal invoice object
     *
     * @return \horstoeko\zugferd\entities\basic\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\basicwl\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\en16931\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\extended\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\minimum\rsm\CrossIndustryInvoice
     */
    protected function create_invoice_object()
    {
        $this->invoice_object = $this->get_object_helper()->get_cross_industry_invoice();
        return $this->invoice_object;
    }
    /**
     * Get the instance of the internal serializuer
     *
     * @return SerializerInterface
     */
    protected function get_serializer()
    {
        return $this->serializer;
    }
    /**
     * Get object helper instance
     *
     * @return \horstoeko\zugferd\ZugferdObjectHelper
     */
    protected function get_object_helper()
    {
        return $this->object_helper;
    }
    /**
     * Returns the selected profile id
     */
    public function get_profile_id(): int
    {
        return $this->profile_id;
    }
    /**
     * Returns the profile definition
     */
    public function get_profile_definition(): array
    {
        return $this->profile_definition;
    }
    /**
     * Get a parameter from profile definition
     *
     * @return mixed
     * @throws ZugferdUnknownProfileParameterException
     */
    public function get_profile_definition_parameter(string $parameter_name)
    {
        $profile_definition = $this->get_profile_definition();
        if (isset($profile_definition[$parameter_name])) {
            return $profile_definition[$parameter_name];
        }
        throw new Zugferd_Unknown_Profile_Parameter_Exception($parameter_name);
    }
    /**
     * Sets the internal profile definitions
     *
     * @throws ZugferdUnknownProfileIdException
     */
    protected function init_profile(int $profile): Zugferd_Document
    {
        $this->profile_id = $profile;
        $this->profile_definition = Zugferd_Profile_Resolver::resolve_profile_def_by_id($profile);
        return $this;
    }
    /**
     * Build the internal object helper
     */
    protected function init_object_helper(): Zugferd_Document
    {
        $this->object_helper = new Zugferd_Object_Helper($this->profile_id);
        return $this;
    }
    /**
     * Build the internal serialzer
     *
     * @throws ZugferdUnknownProfileParameterException
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    protected function init_serialzer(): Zugferd_Document
    {
        $this->serializer_builder = Serializer_Builder::create();
        $this->serializer_builder->add_metadata_dir(Path_Utils::combine_all_paths(Zugferd_Settings::get_yaml_directory(), $this->get_profile_definition_parameter('name'), 'qdt'), sprintf('horstoeko\zugferd\entities\%s\qdt', $this->get_profile_definition_parameter('name')));
        $this->serializer_builder->add_metadata_dir(Path_Utils::combine_all_paths(Zugferd_Settings::get_yaml_directory(), $this->get_profile_definition_parameter('name'), 'ram'), sprintf('horstoeko\zugferd\entities\%s\ram', $this->get_profile_definition_parameter('name')));
        $this->serializer_builder->add_metadata_dir(Path_Utils::combine_all_paths(Zugferd_Settings::get_yaml_directory(), $this->get_profile_definition_parameter('name'), 'rsm'), sprintf('horstoeko\zugferd\entities\%s\rsm', $this->get_profile_definition_parameter('name')));
        $this->serializer_builder->add_metadata_dir(Path_Utils::combine_all_paths(Zugferd_Settings::get_yaml_directory(), $this->get_profile_definition_parameter('name'), 'udt'), sprintf('horstoeko\zugferd\entities\%s\udt', $this->get_profile_definition_parameter('name')));
        if (Zugferd_Settings::has_serializer_cache_directory()) {
            $this->serializer_builder->set_cache_dir(Zugferd_Settings::get_serializer_cache_directory());
        }
        $this->serializer_builder->add_default_listeners();
        $this->serializer_builder->add_default_handlers();
        $this->serializer_builder->configure_handlers(function (Handler_Registry_Interface $handler): void {
            $handler->register_subscribing_handler(new Base_Types_Handler());
            $handler->register_subscribing_handler(new Xml_Schema_Date_Handler());
            $handler->register_subscribing_handler(new Zugferd_Types_Handler());
        });
        $this->serializer = $this->serializer_builder->build();
        return $this;
    }
    /**
     * Deserialize XML content to internal invoice object
     *
     * @param  mixed $xmlContent
     * @return \horstoeko\zugferd\entities\basic\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\basicwl\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\en16931\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\extended\rsm\CrossIndustryInvoice|\horstoeko\zugferd\entities\minimum\rsm\CrossIndustryInvoice
     * @throws ZugferdUnknownProfileParameterException
     * @throws RuntimeException
     */
    public function deserialize($xml_content)
    {
        $this->invoice_object = $this->get_serializer()->deserialize($xml_content, 'horstoeko\zugferd\entities\\' . $this->get_profile_definition_parameter('name') . '\rsm\CrossIndustryInvoice', 'xml');
        return $this->invoice_object;
    }
    /**
     * Serialize internal invoice object as XML
     *
     * @throws RuntimeException
     */
    public function serialize_as_xml(): string
    {
        return $this->get_serializer()->serialize($this->get_invoice_object(), 'xml');
    }
    /**
     * Serialize internal invoice object as JSON
     *
     * @throws RuntimeException
     */
    public function serialize_as_json(): string
    {
        return $this->get_serializer()->serialize($this->get_invoice_object(), 'json');
    }
}