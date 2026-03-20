<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd;

use horstoeko\stringmanagement\Path_Utils;
use horstoeko\stringmanagement\String_Utils;
/**
 * Class representing the general settings
 *
 * @category Zugferd
 * @package  zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Settings
{
    /**
     * The number of decimals for amount values
     *
     * @var integer
     */
    protected static $amount_decimals = 2;
    /**
     * The number of decimals for quantity values
     *
     * @var integer
     */
    protected static $quantity_decimals = 2;
    /**
     * The number of decimals for percent values
     *
     * @var integer
     */
    protected static $percent_decimals = 2;
    /**
     * The number of decimals for measure values
     *
     * @var integer
     */
    protected static $measure_decimals = 2;
    /**
     * The decimal separator
     *
     * @var string
     */
    protected static $decimal_separator = '.';
    /**
     * The thousands seperator
     *
     * @var string
     */
    protected static $thousands_separator = '';
    /**
     * The filename of a ICC profile
     *
     * @var string
     */
    protected static $icc_profile_filename = 'sRGB2014.icc';
    /**
     * The filename of the XMP meta data
     *
     * @var string
     */
    protected static $xmp_meta_data_filename = 'facturx_extension_schema.xmp';
    /**
     * Node paths which present an amount. Used for special amount formatting
     *
     * @var array<string,integer>
     */
    protected static $special_decimal_places_maps = [];
    /**
     * The configured cache directory for the serializer
     *
     * @var string
     */
    protected static $serializer_cache_directory = '';
    /**
     * Get the number of decimals to use for amount values
     */
    public static function get_amount_decimals(): int
    {
        return static::$amount_decimals;
    }
    /**
     * Set the number of decimals to use for amount values
     */
    public static function set_amount_decimals(int $amount_decimals): void
    {
        static::$amount_decimals = $amount_decimals;
    }
    /**
     * Get the number of decimals to use for amount values
     */
    public static function get_quantity_decimals(): int
    {
        return static::$quantity_decimals;
    }
    /**
     * Set the number of decimals to use for quantity values
     */
    public static function set_quantity_decimals(int $quantity_decimals): void
    {
        static::$quantity_decimals = $quantity_decimals;
    }
    /**
     * Get the number of decimals to use for percent values
     */
    public static function get_percent_decimals(): int
    {
        return static::$percent_decimals;
    }
    /**
     * Set the number of decimals to use for percent values
     */
    public static function set_percent_decimals(int $percent_decimals): void
    {
        static::$percent_decimals = $percent_decimals;
    }
    /**
     * Get the number of decimals to use for measure values
     */
    public static function get_measure_decimals(): int
    {
        return static::$measure_decimals;
    }
    /**
     * Set the number of decimals to use for measure values
     */
    public static function set_measure_decimals(int $measure_decimals): void
    {
        static::$measure_decimals = $measure_decimals;
    }
    /**
     * Get the decimal separator
     */
    public static function get_decimal_separator(): string
    {
        return static::$decimal_separator;
    }
    /**
     * Set the decimal separator
     */
    public static function set_decimal_separator(string $decimal_separator): void
    {
        static::$decimal_separator = $decimal_separator;
    }
    /**
     * Get the thousands separator
     */
    public static function get_thousands_separator(): string
    {
        return static::$thousands_separator;
    }
    /**
     * Set the thousands separator
     */
    public static function set_thousands_separator(string $thousands_separator): void
    {
        static::$thousands_separator = $thousands_separator;
    }
    /**
     * Get the filename of the ICC Profile
     */
    public static function get_icc_profile_filename(): string
    {
        return static::$icc_profile_filename;
    }
    /**
     * Set the filename of the ICC Profile
     */
    public static function set_icc_profile_filename(string $icc_profile_filename): void
    {
        static::$icc_profile_filename = $icc_profile_filename;
    }
    /**
     * Get the filename for the XMP meta data
     */
    public static function get_xmp_meta_data_filename(): string
    {
        return static::$xmp_meta_data_filename;
    }
    /**
     * Set the filename for the XMP meta data
     */
    public static function set_xmp_meta_data_filename(string $xmp_meta_data_filename): void
    {
        static::$xmp_meta_data_filename = $xmp_meta_data_filename;
    }
    /**
     * Returns a list of node paths which have a special number of decimal places
     */
    public static function get_special_decimal_places_maps(): array
    {
        return static::$special_decimal_places_maps;
    }
    /**
     * Get a specific map for node paths with a special number of decimal places. If not map
     * is found then the default value is returns
     */
    public static function get_special_decimal_places_map(string $node_path, int $default_decimal_places): int
    {
        $node_path = preg_replace('@\[\d+\]@', '', $node_path);
        return static::$special_decimal_places_maps[$node_path] ?? $default_decimal_places;
    }
    /**
     * Update the map of node paths which have a special number of decimal places
     */
    public static function set_special_decimal_places_maps(array $special_decimal_places_maps): void
    {
        static::$special_decimal_places_maps = $special_decimal_places_maps;
    }
    /**
     * Add a new map for a node path with a special number of decimal places
     */
    public static function add_special_decimal_places_map(string $node_path, int $default_decimal_places): void
    {
        $node_path = preg_replace('@\[\d+\]@', '', $node_path);
        static::$special_decimal_places_maps[$node_path] = $default_decimal_places;
    }
    /**
     * Set the number of decimals to use for unit single amount (unit prices) values
     */
    public static function set_unit_amount_decimals(int $default_decimal_places): void
    {
        static::add_special_decimal_places_map('/rsm:CrossIndustryInvoice/rsm:SupplyChainTradeTransaction/ram:IncludedSupplyChainTradeLineItem/ram:SpecifiedLineTradeAgreement/ram:GrossPriceProductTradePrice/ram:ChargeAmount', $default_decimal_places);
        static::add_special_decimal_places_map('/rsm:CrossIndustryInvoice/rsm:SupplyChainTradeTransaction/ram:IncludedSupplyChainTradeLineItem/ram:SpecifiedLineTradeAgreement/ram:NetPriceProductTradePrice/ram:ChargeAmount', $default_decimal_places);
    }
    /**
     * Set the cache directory for the internal serializer
     */
    public static function set_serializer_cache_directory(string $serializer_cache_directoty): void
    {
        static::$serializer_cache_directory = $serializer_cache_directoty;
    }
    /**
     * Returns the cache directory for the internal serializer. This might be empty
     */
    public static function get_serializer_cache_directory(): string
    {
        return static::$serializer_cache_directory;
    }
    /**
     * Returns true if a cache directory for the internal serializer is configured, otherwise false
     */
    public static function has_serializer_cache_directory(): bool
    {
        return String_Utils::string_is_null_or_empty(static::$serializer_cache_directory) === false;
    }
    /**
     * Get root directory
     */
    public static function get_root_directory(): string
    {
        return Path_Utils::combine_all_paths(__DIR__, '..');
    }
    /**
     * Get the directory where all the sources are stored
     */
    public static function get_source_directory(): string
    {
        return Path_Utils::combine_all_paths(static::get_root_directory(), 'src');
    }
    /**
     * Get the directory where all the assets are stored
     */
    public static function get_asset_directory(): string
    {
        return Path_Utils::combine_all_paths(static::get_source_directory(), 'assets');
    }
    /**
     * Get the directory where all the assets are stored
     */
    public static function get_yaml_directory(): string
    {
        return Path_Utils::combine_all_paths(static::get_source_directory(), 'yaml');
    }
    /**
     * Get the directory where all the validation files are located
     */
    public static function get_validation_directory(): string
    {
        return Path_Utils::combine_all_paths(static::get_source_directory(), 'validation');
    }
    /**
     * Get the directory where all the schema (XSD) files are located
     */
    public static function get_schema_directory(): string
    {
        return Path_Utils::combine_all_paths(static::get_source_directory(), 'schema');
    }
    /**
     * Get the directory where all the stylesheets (XSLT) files are located
     */
    public static function get_schematron_directory(): string
    {
        return Path_Utils::combine_all_paths(static::get_schema_directory(), 'schematron');
    }
    /**
     * Get the directory where all the stylesheets (XSLT) files are located
     */
    public static function get_xslt_directory(): string
    {
        return Path_Utils::combine_all_paths(static::get_schema_directory(), 'xslt');
    }
    /**
     * Get the full filename of the ICC profile to use
     */
    public static function get_full_icc_profile_filename(): string
    {
        return Path_Utils::combine_path_with_file(static::get_asset_directory(), static::$icc_profile_filename);
    }
    /**
     * Get the full filename containg the XNP information to user
     */
    public static function get_full_xmp_meta_data_filename(): string
    {
        return Path_Utils::combine_path_with_file(static::get_asset_directory(), static::$xmp_meta_data_filename);
    }
}