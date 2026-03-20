<?php

declare (strict_types=1);
/**
 * This file is a part of horstoeko/zugferd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace horstoeko\zugferd\jms;

use horstoeko\zugferd\Zugferd_Settings;
use JMS\Serializer\Graph_Navigator;
use JMS\Serializer\Handler\Subscribing_Handler_Interface;
use JMS\Serializer\Xml_Serialization_Visitor;
/**
 * Class representing a collection of serialization handlers for amount formatting and so on
 *
 * @category Zugferd
 * @package  Zugferd
 * @author   D. Erling <horstoeko@erling.com.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/horstoeko/zugferd
 */
class Zugferd_Types_Handler implements Subscribing_Handler_Interface
{
    /**
     * Return format:
     *
     *      array(
     *          array(
     *              'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
     *              'format' => 'json',
     *              'type' => 'DateTime',
     *              'method' => 'serializeDateTimeToJson',
     *          ),
     *      )
     */
    public static function get_subscribing_methods(): array
    {
        return [['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\minimum\udt\AmountType', 'method' => 'serializeAmountType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basic\udt\AmountType', 'method' => 'serializeAmountType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basicwl\udt\AmountType', 'method' => 'serializeAmountType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\en16931\udt\AmountType', 'method' => 'serializeAmountType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\extended\udt\AmountType', 'method' => 'serializeAmountType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basic\udt\QuantityType', 'method' => 'serializeQuantityType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basicwl\udt\QuantityType', 'method' => 'serializeQuantityType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\en16931\udt\QuantityType', 'method' => 'serializeQuantityType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\extended\udt\QuantityType', 'method' => 'serializeQuantityType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basic\udt\PercentType', 'method' => 'serializePercentType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basicwl\udt\PercentType', 'method' => 'serializePercentType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\en16931\udt\PercentType', 'method' => 'serializePercentType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\extended\udt\PercentType', 'method' => 'serializePercentType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basic\udt\IndicatorType', 'method' => 'serializeIndicatorType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basicwl\udt\IndicatorType', 'method' => 'serializeIndicatorType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\en16931\udt\IndicatorType', 'method' => 'serializeIndicatorType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\extended\udt\IndicatorType', 'method' => 'serializeIndicatorType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basic\udt\MeasureType', 'method' => 'serializeMeasureType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\basicwl\udt\MeasureType', 'method' => 'serializeMeasureType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\en16931\udt\MeasureType', 'method' => 'serializeMeasureType'], ['direction' => Graph_Navigator::DIRECTION_SERIALIZATION, 'format' => 'xml', 'type' => 'horstoeko\zugferd\entities\extended\udt\MeasureType', 'method' => 'serializeMeasureType']];
    }
    /**
     * Serialize Anount type
     * The amounts will be serialized (by default) with a precission of 2 digits
     *
     * @param mixed                   $data
     */
    public function serialize_amount_type(Xml_Serialization_Visitor $visitor, $data)
    {
        $node = $visitor->get_document()->create_text_node(number_format($data->value(), Zugferd_Settings::get_special_decimal_places_map($visitor->get_current_node()->get_node_path(), Zugferd_Settings::get_amount_decimals()), Zugferd_Settings::get_decimal_separator(), Zugferd_Settings::get_thousands_separator()));
        if ($data->get_currency_id() != null) {
            $attr = $visitor->get_document()->create_attribute('currencyID');
            $attr->value = $data->get_currency_id();
            $visitor->get_current_node()->append_child($attr);
        }
        return $node;
    }
    /**
     * Serialize quantity type
     * The quantity will be serialized (by default) with a precission of 2 digits
     *
     * @param mixed                   $data
     */
    public function serialize_quantity_type(Xml_Serialization_Visitor $visitor, $data)
    {
        $node = $visitor->get_document()->create_text_node(number_format($data->value(), Zugferd_Settings::get_special_decimal_places_map($visitor->get_current_node()->get_node_path(), Zugferd_Settings::get_quantity_decimals()), Zugferd_Settings::get_decimal_separator(), Zugferd_Settings::get_thousands_separator()));
        if ($data->get_unit_code() != null) {
            $attr = $visitor->get_document()->create_attribute('unitCode');
            $attr->value = $data->get_unit_code();
            $visitor->get_current_node()->append_child($attr);
        }
        return $node;
    }
    /**
     * Serialize a percantage value
     * The valze will be serialized (by default) with a precission of 2 digits
     *
     * @param mixed                   $data
     */
    public function serialize_percent_type(Xml_Serialization_Visitor $visitor, $data)
    {
        return $visitor->get_document()->create_text_node(number_format($data->value(), Zugferd_Settings::get_special_decimal_places_map($visitor->get_current_node()->get_node_path(), Zugferd_Settings::get_percent_decimals()), Zugferd_Settings::get_decimal_separator(), Zugferd_Settings::get_thousands_separator()));
    }
    /**
     * Serialize a meassure value
     * The valze will be serialized (by default) with a precission of 2 digits
     *
     * @param mixed                   $data
     */
    public function serialize_measure_type(Xml_Serialization_Visitor $visitor, $data)
    {
        $node = $visitor->get_document()->create_text_node(number_format($data->value(), Zugferd_Settings::get_special_decimal_places_map($visitor->get_current_node()->get_node_path(), Zugferd_Settings::get_measure_decimals()), Zugferd_Settings::get_decimal_separator(), Zugferd_Settings::get_thousands_separator()));
        if ($data->get_unit_code() != null) {
            $attr = $visitor->get_document()->create_attribute('unitCode');
            $attr->value = $data->get_unit_code();
            $visitor->get_current_node()->append_child($attr);
        }
        return $node;
    }
    /**
     * Serialize a inditcator
     * False and true values will be serialized correctly (false won't be serialized
     * in the default implementation)
     *
     * @param mixed                   $data
     */
    public function serialize_indicator_type(Xml_Serialization_Visitor $visitor, $data)
    {
        return $visitor->get_document()->create_element('udt:Indicator', $data->get_indicator() == false ? 'false' : 'true');
    }
}