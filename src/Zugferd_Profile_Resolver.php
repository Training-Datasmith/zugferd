<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Profile_Id_Exception;
use horstoeko\zugferd\exception\Zugferd_Unknown_Xml_Content_Exception;
use Simple_Xml_Element;
use Throwable;
/**
 * Class representing the profile resolver
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Profile_Resolver
{
    /**
     * Resolve profile id and profile definition by the content of $xmlContent
     *
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     */
    public static function resolve(string $xml_content): array
    {
        $prev_use_internal_errors = \libxml_use_internal_errors(true);
        try {
            libxml_clear_errors();
            $xmldocument = new Simple_Xml_Element($xml_content);
            $xmldocument->register_x_path_namespace('rsm', 'urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100');
            $xmldocument->register_x_path_namespace('ram', 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100');
            $typeelement = $xmldocument->xpath('/rsm:CrossIndustryInvoice/rsm:ExchangedDocumentContext/ram:GuidelineSpecifiedDocumentContextParameter/ram:ID');
            if (libxml_get_last_error()) {
                throw new Zugferd_Unknown_Xml_Content_Exception();
            }
        } catch (Throwable $throwable) {
            throw new Zugferd_Unknown_Xml_Content_Exception();
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($prev_use_internal_errors);
        }
        if (!is_array($typeelement) || !isset($typeelement[0])) {
            throw new Zugferd_Unknown_Xml_Content_Exception();
        }
        foreach (Zugferd_Profiles::PROFILEDEF as $profile => $profiledef) {
            if ($typeelement[0] == $profiledef['contextparameter']) {
                return [$profile, $profiledef];
            }
            if (in_array($typeelement[0], $profiledef['alternativecontextparameters'])) {
                return [$profile, $profiledef];
            }
        }
        throw new Zugferd_Unknown_Profile_Exception((string) $typeelement[0]);
    }
    /**
     * Resolve profile id by the content of $xmlContent
     *
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     */
    public static function resolve_profile_id(string $xml_content): int
    {
        return static::resolve($xml_content)[0];
    }
    /**
     * Resolve profile definition by the content of $xmlContent
     *
     * @throws ZugferdUnknownXmlContentException
     * @throws ZugferdUnknownProfileException
     */
    public static function resolve_profile_def(string $xml_content): array
    {
        return static::resolve($xml_content)[1];
    }
    /**
     * Resolve profile id and profile definition by it's id
     *
     * @throws ZugferdUnknownProfileIdException
     */
    public static function resolve_by_id(int $profile_id): array
    {
        if (!isset(Zugferd_Profiles::PROFILEDEF[$profile_id])) {
            throw new Zugferd_Unknown_Profile_Id_Exception($profile_id);
        }
        return [$profile_id, Zugferd_Profiles::PROFILEDEF[$profile_id]];
    }
    /**
     * Resolve profile profile definition by it's id
     *
     * @throws ZugferdUnknownProfileIdException
     */
    public static function resolve_profile_def_by_id(int $profile_id): array
    {
        $resolved = static::resolve_by_id($profile_id);
        return $resolved[1];
    }
}