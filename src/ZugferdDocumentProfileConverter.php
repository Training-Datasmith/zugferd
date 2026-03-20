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
use horstoeko\zugferd\exception\Zugferd_File_Not_Readable_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Id_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Parameter_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Xml_Content_Exception;
use JMS\Serializer\Exception\InvalidArgumentException;
use JMS\Serializer\Exception\RuntimeException;
/**
 * Class representing a converter to change a document's profile to another profile
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Document_Profile_Converter extends Zugferd_Document
{
    /**
     * The source
     *
     * @var string
     */
    protected $convert_from_content = '';
    /**
     * The new profile ID
     *
     * @var int
     */
    protected $convert_to_profile_id = -1;
    /**
     * Path to the profile id
     */
    protected const PATH_1 = 'getExchangedDocumentContext.getGuidelineSpecifiedDocumentContextParameter.setID';
    /**
     * Path to the context parameter
     */
    protected const PATH_2 = 'getExchangedDocumentContext.setBusinessProcessSpecifiedDocumentContextParameter';
    /**
     * Path to the context parameter id
     */
    protected const PATH_3 = 'getExchangedDocumentContext.getBusinessProcessSpecifiedDocumentContextParameter.setID';
    /**
     * Convert from file to file
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     * @throws ZugferdUnknownXmlContentException
     */
    public static function convert_from_file_to_file(string $from_filename, string $to_file, int $new_profile_id): void
    {
        static::convert_from_file($from_filename, $new_profile_id)->convert_to_file($to_file);
    }
    /**
     * Convert from file to string
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     * @throws ZugferdUnknownXmlContentException
     */
    public static function convert_from_file_to_string(string $from_filename, int $new_profile_id): string
    {
        return static::convert_from_file($from_filename, $new_profile_id)->convert_to_string();
    }
    /**
     * Convert from content to file
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     * @throws ZugferdUnknownXmlContentException
     */
    public static function convert_from_content_to_file(string $from_content, string $to_file, int $new_profile_id): void
    {
        static::convert_from_content($from_content, $new_profile_id)->convert_to_file($to_file);
    }
    /**
     * Convert from content to string
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ZugferdUnknownProfileException
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     * @throws ZugferdUnknownXmlContentException
     */
    public static function convert_from_content_to_string(string $from_content, int $new_profile_id): string
    {
        return static::convert_from_content($from_content, $new_profile_id)->convert_to_string();
    }
    /**
     * Create an instance by filename
     *
     * @throws ZugferdFileNotFoundException
     * @throws ZugferdFileNotReadableException
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     */
    protected static function convert_from_file(string $from_filename, int $new_profile_id): Zugferd_Document_Profile_Converter
    {
        if (!file_exists($from_filename)) {
            throw new Zugferd_File_Not_Found_Exception($from_filename);
        }
        $from_content = file_get_contents($from_filename);
        if ($from_content === false) {
            throw new Zugferd_File_Not_Readable_Exception($from_filename);
        }
        return static::convert_from_content($from_content, $new_profile_id);
    }
    /**
     * Create an instance by cpntent
     *
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     */
    protected static function convert_from_content(string $from_content, int $new_profile_id): Zugferd_Document_Profile_Converter
    {
        $from_profile_id = Zugferd_Profile_Resolver::resolve_profile_id($from_content);
        $profile_converter = new static($from_profile_id);
        $profile_converter->set_convert_from_content($from_content);
        $profile_converter->set_convert_to_profile_id($new_profile_id);
        return $profile_converter;
    }
    /**
     * Set the destination (the new) profile id
     */
    protected function set_convert_to_profile_id(int $to_profile_id): Zugferd_Document_Profile_Converter
    {
        $this->convert_to_profile_id = $to_profile_id;
        return $this;
    }
    /**
     * Set the source-content
     */
    protected function set_convert_from_content(string $from_content): Zugferd_Document_Profile_Converter
    {
        $this->convert_from_content = $from_content;
        return $this;
    }
    /**
     * Convert and save to file
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     */
    protected function convert_to_file(string $to_file): Zugferd_Document_Profile_Converter
    {
        file_put_contents($to_file, $this->perform_conversion()->convert_to_string());
        return $this;
    }
    /**
     * Convert and get xml content as string
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     */
    protected function convert_to_string(): string
    {
        return $this->perform_conversion()->serialize_as_xml();
    }
    /**
     * Internal conversion method
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     * @throws ZugferdUnknownProfileIdException
     * @throws ZugferdUnknownProfileParameterException
     */
    protected function perform_conversion(): Zugferd_Document_Profile_Converter
    {
        $this->init_profile($this->convert_to_profile_id);
        $this->init_object_helper();
        $this->init_serialzer();
        $this->deserialize($this->convert_from_content);
        $this->update_profile_in_invoice_object();
        return $this;
    }
    /**
     * Update profile parameters in the internal invoice object
     *
     * @return void
     * @throws ZugferdUnknownProfileIdException
     */
    protected function update_profile_in_invoice_object()
    {
        $profile_def = Zugferd_Profile_Resolver::resolve_profile_def_by_id($this->convert_to_profile_id);
        $this->get_object_helper()->try_call_by_path($this->get_invoice_object(), static::PATH_1, $this->get_object_helper()->get_id_type($profile_def['contextparameter']));
        if ($profile_def['businessprocess']) {
            $this->get_object_helper()->try_call_by_path($this->get_invoice_object(), static::PATH_2, $this->get_object_helper()->create_class_instance('ram\DocumentContextParameterType'));
            $this->get_object_helper()->try_call_by_path($this->get_invoice_object(), static::PATH_3, $this->get_object_helper()->get_id_type($profile_def['businessprocess']));
        }
    }
}